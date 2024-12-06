<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mess_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch food items categorized by Breakfast, Lunch, and Dinner
$breakfast_sql = "SELECT * FROM foodcat WHERE category = 'Breakfast'";
$lunch_sql = "SELECT * FROM foodcat WHERE category = 'Lunch'";
$dinner_sql = "SELECT * FROM foodcat WHERE category = 'Dinner'";

// Delete food item if delete button is clicked
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM foodcat WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: staff.php"); // Redirect to refresh the page after delete
        exit();
    }
}

$breakfast_result = $conn->query($breakfast_sql);
$lunch_result = $conn->query($lunch_sql);
$dinner_result = $conn->query($dinner_sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td img {
            width: 100px;
            height: 100px;
        }

        .action-buttons button {
            padding: 5px 10px;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            font-size: 12px;
            transition: background-color 0.3s ease;
        }

        .action-buttons .add-btn {
            background-color: blue;
        }

        .action-buttons .delete-btn {
            background-color: #f44336;
        }

        .action-buttons .edit-btn {
            background-color: #ffa500;
        }

        .action-buttons button:hover {
            opacity: 0.8;
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
        <button onclick="location.href='add_food.php'">Add Food</button>
        <button onclick="location.href='view_subscription.php'">View Subscription</button>
        <button onclick="location.href='view_polling.php'">View Polling</button>
        <button onclick="location.href='view_feedback.php'">View Feedback</button>
        <button class="logout-button" onclick="location.href='staff_login.php'">Logout</button>
    </div>
</header>

<!-- Breakfast Table -->
<h2 style="text-align:center;">Breakfast</h2>
<table>
    <tr>
        <th>Food Image</th>
        <th>Food Name</th>
        <th>Days</th>
        <th>Status</th>
    </tr>
    <?php while ($row = $breakfast_result->fetch_assoc()): ?>
    <tr>
        <td><img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['food_name']; ?>"></td>
        <td><?php echo $row['food_name']; ?></td>
        <td><?php echo $row['days']; ?></td>
        <td class="action-buttons">
            <button class="add-btn" onclick="location.href='add_food.php'">Add</button>
            <button class="edit-btn" onclick="location.href='edit_food.php?id=<?php echo $row['id']; ?>'">Edit</button>
            <button class="delete-btn" onclick="window.location.href='staff.php?delete_id=<?php echo $row['id']; ?>'">Delete</button>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<!-- Lunch Table -->
<h2 style="text-align:center;">Lunch</h2>
<table>
    <tr>
        <th>Food Image</th>
        <th>Food Name</th>
        <th>Days</th>
        <th>Status</th>
    </tr>
    <?php while ($row = $lunch_result->fetch_assoc()): ?>
    <tr>
        <td><img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['food_name']; ?>"></td>
        <td><?php echo $row['food_name']; ?></td>
        <td><?php echo $row['days']; ?></td>
        <td class="action-buttons">
            <button class="add-btn" onclick="location.href='add_food.php'">Add</button>
            <button class="edit-btn" onclick="location.href='edit_food.php?id=<?php echo $row['id']; ?>'">Edit</button>
            <button class="delete-btn" onclick="window.location.href='staff.php?delete_id=<?php echo $row['id']; ?>'">Delete</button>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<!-- Dinner Table -->
<h2 style="text-align:center;">Dinner</h2>
<table>
    <tr>
        <th>Food Image</th>
        <th>Food Name</th>
        <th>Days</th>
        <th>Status</th>
    </tr>
    <?php while ($row = $dinner_result->fetch_assoc()): ?>
    <tr>
        <td><img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['food_name']; ?>"></td>
        <td><?php echo $row['food_name']; ?></td>
        <td><?php echo $row['days']; ?></td>
        <td class="action-buttons">
            <button class="add-btn" onclick="location.href='add_food.php'">Add</button>
            <button class="edit-btn" onclick="location.href='edit_food.php?id=<?php echo $row['id']; ?>'">Edit</button>
            <button class="delete-btn" onclick="window.location.href='staff.php?delete_id=<?php echo $row['id']; ?>'">Delete</button>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
