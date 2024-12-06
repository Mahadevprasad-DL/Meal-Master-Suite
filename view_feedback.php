<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'mess_db');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch feedback data
$sql = "SELECT username, image, rating, message, created_at FROM feedback ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .feedback-container {
            margin-top: 90px; /* Adjusted for proper spacing from the header */
            max-width: 600px;
            margin: 90px auto 50px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1.5s ease-in-out;
        }

        .feedback-item {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: scale(0.98);
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .feedback-item:hover {
            transform: scale(1);
            background-color: #eaf3fc;
        }

        .feedback-item:last-child {
            border-bottom: none;
        }

        .feedback-item img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }

        .feedback-item h3 {
            margin: 0;
            color: #007BFF;
            font-size: 1.2em;
        }

        .feedback-item .rating {
            color: gold;
            font-size: 1.1em;
        }

        .feedback-item p {
            margin: 5px 0;
            color: #555;
            font-size: 0.95em;
        }

        small {
            color: #888;
            font-size: 0.85em;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
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

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 4px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 16px;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

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

<header>

<div>
        <h1>
            <a href="home.php"><img src="images/food.png" alt="Food Icon"></a>
            Welcome to StarMess
        </h1>
    </div>

    <div class="nav-buttons">
        <button onclick="location.href='add_food.php'">Add Food</button>
        <button onclick="location.href='view_subscription.php'">View Subscription</button>
        <button onclick="location.href='view_feedback.php'">View Feedback</button>
        <button class="logout-button" onclick="location.href='staff_login.php'">Logout</button>
    </div>
</header>



<body>
    <div class="feedback-container">
        <h2 style="text-align: center;">User Feedback</h2>
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="feedback-item">
            <div style="display: flex; align-items: center;">
                <?php if ($row['image']): ?>
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="User Image">
                <?php endif; ?>
                <h3><?php echo htmlspecialchars($row['username']); ?></h3>
            </div>
            <div class="rating">
                <?php echo str_repeat('★', $row['rating']); ?>
            </div>
            <p><?php echo htmlspecialchars($row['message']); ?></p>
            <small>Submitted on: <?php echo htmlspecialchars($row['created_at']); ?></small>
        </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>
