<?php
include 'admin_check.php';
include 'connect.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $blood_group = $_POST['blood_group'];
    $available_units = $_POST['available_units'];

    if ($available_units <= 50) {
        $status = 'Critical';
    } elseif ($available_units <= 100) {
        $status = 'Low Stock';
    } else {
        $status = 'Available';
    }

    // First, get the current available_units before updating
    $sql_get_current_units = "SELECT available_units FROM blood_inventory WHERE id=$id";
    $result_get_current_units = mysqli_query($conn, $sql_get_current_units);
    $row_current_units = mysqli_fetch_assoc($result_get_current_units);
    $previous_available_units = $row_current_units['available_units'];

    // Now, update the blood_inventory table including the previous_available_units
    $sql = "UPDATE blood_inventory SET blood_group='$blood_group', available_units='$available_units', previous_available_units='$previous_available_units', status='$status' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: landing_page.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
