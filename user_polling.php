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

// Fetch food items by category
$categories = ["Breakfast", "Lunch", "Dinner"];
$food_items = [];
foreach ($categories as $category) {
    $sql = "SELECT * FROM food_items WHERE category = '$category'";
    $result = $conn->query($sql);
    $food_items[$category] = $result->fetch_all(MYSQLI_ASSOC);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food_id = $_POST['food_id'];
    $rating = $_POST['rating'];

    $stmt = $conn->prepare("INSERT INTO polling (food_id, rating) VALUES (?, ?)");
    $stmt->bind_param("ii", $food_id, $rating);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Your feedback has been recorded!');</script>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Polling</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }
        .container {
            margin-top: 150px; /* Increased margin to create a gap */
            margin: 20px auto;
            max-width: 1000px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            text-align: center;
            color: #333;
        }
        .category-container {
            margin-bottom: 40px;
        }
        .food-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .food-item img {
            width: 80px;
            height: 80px;
            border-radius: 5px;
        }
        .food-details {
            flex: 1;
            margin-left: 15px;
        }
        .food-details p {
            margin: 0;
            font-size: 14px;
            color: #555;
        }
        .rating-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .rating-container select {
            padding: 5px;
        }
        .rating-container button {
            padding: 5px 10px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .rating-container button:hover {
            background: #45a049;
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
            margin-bottom: 180px;
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
        <button onclick="location.href='user.php'">Menu List</button>
        <div class="dropdown">
            <button class="dropdown-btn">Subscription</button>
            <div class="dropdown-content">
                <a href="weekly_subscription.php">Weekly</a>
                <a href="user_subscriptionmonth.php">Monthly</a>
                <a href="year_subscription.php">Yearly</a>
            </div>
        </div>
        <button onclick="location.href='user_feedback.php'">Feedback</button>
        <button onclick="location.href='user_polling.php'">Add Polling</button>
        <button class="logout-button" onclick="location.href='user_login.php'">Logout</button>
    </div>
</header>

<body>
    <div class="container">
        <h2>Food Polling</h2>
        <?php foreach ($food_items as $category => $items): ?>
            <div class="category-container">
                <h3><?= $category ?></h3>
                <?php foreach ($items as $item): ?>
                    <div class="food-item">
                        <img src="images/<?= $item['image'] ?>" alt="<?= $item['food_name'] ?>">
                        <div class="food-details">
                            <p><strong><?= $item['food_name'] ?></strong></p>
                            <p>Available on: <?= $item['days'] ?></p>
                        </div>
                        <form method="POST" class="rating-container">
                            <input type="hidden" name="food_id" value="<?= $item['id'] ?>">
                            <label for="rating">Rating:</label>
                            <select name="rating" required>
                                <option value="" disabled selected>Choose</option>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
