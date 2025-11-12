<?php
include 'admin_check.php';
include 'connect.php';

$id = $_GET['id'];

$sql = "DELETE FROM blood_inventory WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header("Location: landing_page.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
