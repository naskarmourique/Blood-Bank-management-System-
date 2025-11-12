<?php
include 'connect.php';

$new_username = 'mourique';
$new_password = 'izya';
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Update the admin user's credentials
// It's assumed there is only one admin, but for safety, we can limit the update to 1 row.
$sql = "UPDATE users SET username = '{$new_username}', password = '{$hashed_password}' WHERE role = 'admin' LIMIT 1";

if (mysqli_query($conn, $sql)) {
    if (mysqli_affected_rows($conn) > 0) {
        echo "Admin credentials updated successfully.<br>";
        echo "<b>New Username:</b> {$new_username}<br>";
        echo "<b>New Password:</b> {$new_password}<br>";
    } else {
        echo "No admin user found to update or credentials are the same.<br>";
    }
} else {
    echo "Error updating record: " . mysqli_error($conn) . "<br>";
}

mysqli_close($conn);
?>
