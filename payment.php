<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'mess_db');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve and sanitize form inputs
    $username = $conn->real_escape_string($_POST['username']);
    $location = $conn->real_escape_string($_POST['location']);
    $start_date = $conn->real_escape_string($_POST['start-date']);
    $end_date = $conn->real_escape_string($_POST['end-date']);

    // Insert data into the database
    $sql = "INSERT INTO subscriptions (username, location, start_date, end_date, status) 
            VALUES ('$username', '$location', '$start_date', '$end_date', 'confirmed')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Subscription confirmed successfully!');
                window.location.href = 'user.php';
              </script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>
