<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mess_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch ratings and categorize by food types
$categories = ["Breakfast", "Lunch", "Dinner"];
$food_data = [];

foreach ($categories as $category) {
    $sql = "SELECT f.food_name, f.category, f.image, 
                   COUNT(p.id) AS total_votes, 
                   AVG(p.rating) AS avg_rating
            FROM food_items f
            LEFT JOIN polling p ON f.id = p.food_id
            WHERE f.category = '$category'
            GROUP BY f.id";
    $result = $conn->query($sql);
    $food_data[$category] = $result->fetch_all(MYSQLI_ASSOC);
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Polling Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }
        .container {
            margin: 20px auto;
            max-width: 800px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #4CAF50;
            color: white;
        }
        img {
            width: 50px;
            height: 50px;
            border-radius: 5px;
        }
        .category-container {
            margin-bottom: 30px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 15px 20px;
        }

        header h1 {
            font-size: 24px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        header h1 img {
            width: 40px;
            height: 40px;
            cursor: pointer;
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
            transition: background-color 0.3s ease;
            font-size: 14px;
        }

        .nav-buttons button:hover {
            background-color: #45a049;
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
        <button onclick="location.href='view_polling.php'">View Polling</button>
        <button onclick="location.href='view_feedback.php'">View Feedback</button>
        <button class="logout-button" onclick="location.href='staff_login.php'">Logout</button>
    </div>
</header>

<body>
    <div class="container">
        <h2>Polling Results</h2>
        <?php foreach ($food_data as $category => $items): ?>
            <div class="category-container">
                <h3><?= $category ?></h3>
                <table>
                    <thead>
                        <tr>
                            <th>Food</th>
                            <th>Image</th>
                            <th>Total Votes</th>
                            <th>Average Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= $item['food_name'] ?></td>
                                <td><img src="images/<?= $item['image'] ?>" alt="<?= $item['food_name'] ?>"></td>
                                <td><?= $item['total_votes'] ?></td>
                                <td><?= number_format($item['avg_rating'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
