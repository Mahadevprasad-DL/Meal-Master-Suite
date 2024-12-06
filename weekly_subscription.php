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
        echo "<script>alert('Subscription confirmed successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Subscription Plan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }

        header h1 {
            font-size: 24px;
            margin: 0;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
        }

        .nav-buttons button {
            padding: 10px 15px;
            background-color: #4CAF50;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }

        .logout-button {
            background-color: #f44336;
            margin-right: 40px;
        }

        .container {
            width: 80%;
            margin: 100px auto;
            display: flex;
            gap: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            flex: 2;
        }

        h3 {
            text-align: center;
            font-size: 24px;
            color: #2c3e50;
        }

        .monthly-plan {
            text-align: center;
            color: #2980b9;
        }

        .input-group {
            margin: 15px 0;
        }

        .input-group label {
            font-size: 16px;
            color: #2c3e50;
            display: block;
            margin-bottom: 5px;
            margin-left: 30px;
        }

        .input-group input {
            width: 80%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-left: 30px;
        }

        .pricing-confirm {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .input-price {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            margin-left: 30px;
        }

        .confirm-btn {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .scanner-section {
            flex: 1;
            text-align: center;
        }

        .scanner-section h4 {
            font-size: 20px;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .scanner {
            width: 100%;
            height: 400px;
            border: 2px dashed #ccc;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #888;
            font-size: 16px;
            margin-bottom: 20px;
            background-image: url('images/giri.jpg');
            background-size: cover;
            background-position: center;
        }

        .features-container {
            width: 40%;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .features-container h3 {
            text-align: center;
            font-size: 26px;
            color: #34495e;
            margin-bottom: 20px;
        }

        .features-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            justify-content: flex-start;
        }

        .feature-item {
            font-size: 16px;
            color: #2c3e50;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .feature-item i {
            color: #27ae60;
        }

        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 10px rgba(0, 0, 0, 0.15);
        }

        .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .modal-actions button {
        padding: 10px 20px;
        margin: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .modal-actions button:first-child {
        background-color: #4CAF50;
        color: white;
    }

    .modal-actions button:last-child {
        background-color: #f44336;
        color: white;
    }

    .dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-btn {
    background-color: #3498db;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 4px;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    font-size: 16px;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
    background-color: #ddd;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}
header h1 img {
            width: 40px;
            height: 40px;
            cursor: pointer;
        }



    </style>

<script>
    function openModal() {
        document.getElementById('confirmationModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('confirmationModal').style.display = 'none';
    }

    function submitForm() {
        document.querySelector('form').submit();
    }


</script>

</head>
<body>

<header>
<div>
        <h1>
            <a href="home.php"><img src="images/food.png" alt="Food Icon"></a>
            Welcome to StarMess
        </h1>
    </div>

    <div class="nav-buttons">
        <button onclick="location.href='user.php'">Menu List</button>
        <button onclick="location.href='user_feedback.php'">Feedback</button>
        <div class="dropdown">
            <button class="dropdown-btn">Subscription</button>
            <div class="dropdown-content">
                <a href="weekly_subscription.php">Weekly</a>
                <a href="user_subscriptionmonth.php">Monthly</a>
                <a href="year_subscription.php">Yearly</a>
            </div>
        </div>

        <button class="logout-button" onclick="location.href='user_login.php'">Logout</button>
    </div>
</header>

<div class="container">
    <div class="form-section">
        <h3>Your Current Plan</h3>
        <div class="monthly-plan">
            <h4>Weekly Plan</h4>
            <p>This plan includes breakfast, lunch, and dinner.<br><strong>Note:</strong> Absences are not the responsibility of the staff.</p>
        </div>

        <form action="payment.php" method="POST">
            <div class="input-group">
                <label for="username">User Name</label>
                <input type="text" id="username" name="username" placeholder="Enter your name" required>
            </div>

            <div class="input-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" placeholder="Enter your location" required>
            </div>

            <div class="input-group">
                <label for="start-date">Start Date</label>
                <input type="date" id="start-date" name="start-date" required>
            </div>

            <div class="input-group">
                <label for="end-date">End Date</label>
                <input type="date" id="end-date" name="end-date" required>
            </div>

            <div class="pricing-confirm">
                <button class="input-price" type="button">₹1500</button>
                <button class="confirm-btn" type="submit">Pay and Confirm</button>
            </div>

            <form action="" method="POST">

        </form>
    </div>

    <div class="scanner-section">
        <h4>QR Code Scanner</h4>
        <div class="scanner"></div>
        <p>Use the scanner to confirm your identity and plan.</p>
    </div>

    <div id="confirmationModal" class="modal">
</div>

</div>
<div class="features-container">
    <h3>Features of the Weekly Subscription</h3>
    <div class="features-list">
        <div class="feature-item"><i class="fas fa-check"></i> Daily freshly cooked meals</div>
        <div class="feature-item"><i class="fas fa-check"></i> Nutritional balance guaranteed</div>
        <div class="feature-item"><i class="fas fa-check"></i> Access to weekly menu</div>
        <div class="feature-item"><i class="fas fa-check"></i> Hygienic cooking standards</div>
        <div class="feature-item"><i class="fas fa-check"></i> Timely meal deliveries</div>
        <div class="feature-item"><i class="fas fa-check"></i> Personalized diet options</div>
    </div>
</div>

</body>
</html>
