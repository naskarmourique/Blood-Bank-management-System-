<?php
include 'connect.php';

/**
 * Automatically update event status based on current date
 * upcoming -> ongoing -> completed
 */
function updateEventStatusAutomatically($conn) {
    $today = date('Y-m-d');
    $current_time = date('H:i:s');
    
    // Update upcoming events to ongoing if event date is today and current time is after start time
    $sql = "UPDATE blood_events SET status = 'ongoing' 
            WHERE status = 'upcoming' 
            AND event_date = ? 
            AND start_time <= ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $today, $current_time);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    // Update ongoing events to completed if event date is in the past
    $sql = "UPDATE blood_events SET status = 'completed' 
            WHERE status = 'ongoing' 
            AND event_date < ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $today);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

/**
 * Get all events with automatic status update
 */
function getAllEvents($conn) {
    // First update statuses automatically
    updateEventStatusAutomatically($conn);
    
    $sql = "SELECT * FROM blood_events ORDER BY 
            CASE status 
                WHEN 'ongoing' THEN 1 
                WHEN 'upcoming' THEN 2 
                WHEN 'completed' THEN 3 
            END, 
            event_date ASC, start_time ASC";
    
    $result = mysqli_query($conn, $sql);
    $events = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }
    
    return $events;
}

/**
 * Get events by status
 */
function getEventsByStatus($conn, $status) {
    updateEventStatusAutomatically($conn);
    
    $sql = "SELECT * FROM blood_events WHERE status = ? ORDER BY event_date ASC, start_time ASC";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $status);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $events = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }
    
    mysqli_stmt_close($stmt);
    return $events;
}

/**
 * Get featured events
 */
function getFeaturedEvents($conn) {
    updateEventStatusAutomatically($conn);
    
    $sql = "SELECT * FROM blood_events WHERE featured = 1 AND status != 'completed' ORDER BY event_date ASC";
    $result = mysqli_query($conn, $sql);
    
    $events = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }
    
    return $events;
}

/**
 * Get single event by ID
 */
function getEventById($conn, $id) {
    $sql = "SELECT * FROM blood_events WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $event = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    
    return $event;
}

/**
 * Add new event (Admin only)
 */
function addEvent($conn, $event_data) {
    $sql = "INSERT INTO blood_events (title, event_type, location, event_date, start_time, end_time, target_donors, description, contact_person, status, featured) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssisssi", 
        $event_data['title'], 
        $event_data['event_type'], 
        $event_data['location'], 
        $event_data['event_date'], 
        $event_data['start_time'], 
        $event_data['end_time'], 
        $event_data['target_donors'], 
        $event_data['description'], 
        $event_data['contact_person'], 
        $event_data['status'], 
        $event_data['featured']
    );
    
    $result = mysqli_stmt_execute($stmt);
    $insert_id = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt);
    
    return $result ? $insert_id : false;
}

/**
 * Update event (Admin only)
 */
function updateEvent($conn, $id, $event_data) {
    $sql = "UPDATE blood_events SET 
            title = ?, event_type = ?, location = ?, event_date = ?, 
            start_time = ?, end_time = ?, target_donors = ?, 
            description = ?, contact_person = ?, featured = ? 
            WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssissii", 
        $event_data['title'], 
        $event_data['event_type'], 
        $event_data['location'], 
        $event_data['event_date'], 
        $event_data['start_time'], 
        $event_data['end_time'], 
        $event_data['target_donors'], 
        $event_data['description'], 
        $event_data['contact_person'], 
        $event_data['featured'], 
        $id
    );
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    return $result;
}

/**
 * Delete event (Admin only)
 */
function deleteEvent($conn, $id) {
    $sql = "DELETE FROM blood_events WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    return $result;
}

/**
 * Update event statistics
 */
function updateEventStats($conn, $id, $stats) {
    $sql = "UPDATE blood_events SET 
            registered_donors = ?, donated_units = ?, pending_units = ? 
            WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiii", 
        $stats['registered_donors'], 
        $stats['donated_units'], 
        $stats['pending_units'], 
        $id
    );
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    return $result;
}

/**
 * Format date for display
 */
function formatEventDate($date) {
    return date('d', strtotime($date));
}

/**
 * Format month for display
 */
function formatEventMonth($date) {
    return strtoupper(date('M', strtotime($date)));
}

/**
 * Calculate days left for upcoming events
 */
function getDaysLeft($event_date) {
    $today = new DateTime();
    $event_date_obj = new DateTime($event_date);
    $interval = $today->diff($event_date_obj);
    
    if ($event_date_obj < $today) {
        return 0;
    }
    
    return $interval->days;
}

/**
 * Get status class for CSS styling
 */
function getStatusClass($status) {
    switch ($status) {
        case 'upcoming':
            return 'status-upcoming';
        case 'ongoing':
            return 'status-ongoing';
        case 'completed':
            return 'status-completed';
        default:
            return 'status-upcoming';
    }
}

/**
 * Get status text for display
 */
function getStatusText($status) {
    switch ($status) {
        case 'upcoming':
            return 'Upcoming';
        case 'ongoing':
            return 'Ongoing';
        case 'completed':
            return 'Completed';
        default:
            return 'Upcoming';
    }
}
?>