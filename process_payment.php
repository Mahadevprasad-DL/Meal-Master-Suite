<?php
// Start the session
session_start();

// Check if the form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = htmlspecialchars($_POST['username']);
    $location = htmlspecialchars($_POST['location']);

    // Store the user details in the session
    $_SESSION['user_name'] = $userName;
    $_SESSION['location'] = $location;

    // Redirect to the view subscription page
    header("Location: view_subscription.php");
    exit();
}
?>
