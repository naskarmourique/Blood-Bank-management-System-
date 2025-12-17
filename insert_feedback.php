<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "connect.php";

if (isset($_POST["submit"])) {
    $name = $_POST["name"] ?? null;
    $type = $_POST["type"] ?? null;
    $rating = $_POST["rating"] ?? null;
    $feedback = $_POST["feedback"] ?? null;

    if (!$name || !$type || !$rating || !$feedback) {
        // As there is no visible feedback form, we redirect to the landing page on error.
        // A real implementation would redirect to the feedback form.
        header("Location: landing_page.php?status=error&message=" . urlencode('All feedback fields are required.'));
        exit;
    }

    try {
        $stmt = $conn->prepare("INSERT INTO `feedback` (name, type, rating, feedback) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $name, $type, $rating, $feedback);

        if ($stmt->execute()) {
            header("Location: landing_page.php?status=success&message=" . urlencode('Thank you for your feedback!'));
            exit;
        } else {
            throw new Exception('Failed to execute statement.');
        }
    } catch (Exception $e) {
        $error_message = 'An error occurred: ' . $e->getMessage();
        if (!headers_sent()) {
            // As there is no visible feedback form, we redirect to the landing page on error.
            header("Location: landing_page.php?status=error&message=" . urlencode($error_message));
        } else {
            echo "Error: " . htmlspecialchars($error_message);
        }
        exit;
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($conn)) {
            $conn->close();
        }
    }
} else {
    // If the form wasn't submitted, redirect to the main page
    header("Location: landing_page.php");
    exit;
}
?>