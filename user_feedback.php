<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'mess_db');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $rating = $_POST['rating'];
    $message = $_POST['message'];
    $imagePath = null;

    // Handle file upload
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        $imagePath = $targetDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO feedback (username, image, rating, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $username, $imagePath, $rating, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Feedback submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error submitting feedback.');</script>";
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Feedback</title>
    <style>
                body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f4f4f9, #d3e0ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            gap: 50px;
            align-items: flex-start;
            max-width: 1200px;
            margin: 20px;
            margin-top: 100px;
        }

        /* Left Section */
        .left-section {
            flex: 1;
            max-width: 600px;
            margin-top: 100px;
            animation: fadeSlideIn 1.5s ease-out;
        }

        .left-section h2 {
            font-size: 2.5rem;
            color: #007BFF;
            margin-bottom: 20px;
            animation: bounceIn 1.2s ease-out;
        }

        .left-section p {
            font-size: 1.2rem;
            color: #007BFF;
            line-height: 1.5;
            animation: fadeIn 1.5s ease-in;
        }

        /* Form Section */
        .form-container {
            flex: 1;
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            animation: slideInRight 1s ease-in-out;
            position: relative;
        }

        form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007BFF;
        }

        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        form input, form textarea, form button {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
        }

        form input:focus, form textarea:focus {
            border-color: #007BFF;
            outline: none;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
            transition: 0.3s;
        }

        form button {
            background: #007BFF;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        form button:hover {
            background: #0056b3;
        }

        .stars {
            display: flex;
            justify-content: space-between;
            max-width: 160px;
            margin-bottom: 20px;
        }

        .stars label {
            font-size: 24px;
            color: gray;
            cursor: pointer;
        }

        .stars input[type="radio"] {
            display: none;
        }

        .stars input[type="radio"]:checked ~ label {
            color: gold;
        }

        /* Animations */
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeSlideIn {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes bounceIn {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Header */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 15px 20px;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 24px;
            margin: 0;
            color: white;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .nav-buttons button {
            padding: 10px 15px;
            background-color: #4CAF50;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            font-size: 14px;
        }

        .nav-buttons button:hover {
            background-color: #45a049;
            transform: translateY(-3px);
        }

        .logout-button {
            background-color: #f44336;
            margin-right: 40px;
        }

        .logout-button:hover {
            background-color: #e60000;
            transform: translateY(-3px);
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
        <!-- Subscription button with dropdown -->
        <div class="dropdown">
            <button class="dropdown-btn">Subscription</button>
            <div class="dropdown-content">
                <a href="weekly_subscription.php">Weekly</a>
                <a href="user_subscriptionmonth.php">Monthly</a>
                <a href="year_subscription.php">Yearly</a>
            </div>
        </div>
        <button onclick="location.href='user_feedback.php'">Feedback</button>
        <button class="logout-button" onclick="location.href='user_login.php'">Logout</button>
    </div>
</header>

    <div class="container">
        <div class="left-section">
            <h2>Feedback Matters</h2>
            <p>“Your feedback helps us improve and serve you better!”</p>
        </div>
        <div class="form-container">
            <form method="POST" enctype="multipart/form-data">
                <h2>Submit Your Feedback</h2>
                <label for="username">Enter Your Name</label>
                <input type="text" id="username" name="username" placeholder="Name" required>

                <label for="image">Upload Your Image</label>
                <input type="file" id="image" name="image">

                <label for="rating">Give the Rating</label>
                <div class="stars">
                    <input type="radio" id="star5" name="rating" value="5" required>
                    <label for="star5">★</label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4">★</label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3">★</label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2">★</label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1">★</label>
                </div>

                <label for="message">Give the Valuable Feedback Message</label>
                <textarea id="message" name="message" rows="5" placeholder="Write your feedback here..." required></textarea>

                <button type="submit">Submit Feedback</button>
            </form>
        </div>
    </div>
</body>
</html>
