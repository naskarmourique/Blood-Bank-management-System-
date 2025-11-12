<?php
include 'admin_check.php';
include 'connect.php';

if (isset($_POST['submit'])) {
    $blood_group = $_POST['blood_group'];
    $available_units = $_POST['available_units'];

    if ($available_units <= 50) {
        $status = 'Critical';
    } elseif ($available_units <= 100) {
        $status = 'Low Stock';
    } else {
        $status = 'Available';
    }

    $sql = "INSERT INTO blood_inventory (blood_group, available_units, previous_available_units, status) VALUES ('$blood_group', '$available_units', 0, '$status')";

    if (mysqli_query($conn, $sql)) {
        header("Location: landing_page.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
