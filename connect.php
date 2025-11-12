<?php
    $conn = mysqli_connect("localhost", "root", "", "blood_connect");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
