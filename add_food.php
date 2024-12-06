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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $food_name = $_POST['food_name'];
    $category = $_POST['category'];
    $days = $_POST['days'];
    $image = $_FILES['image']['name']; // Get image name

    // Upload the image to the 'images' folder
    $target_dir = "images/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert data into the foodcat table
    $sql = "INSERT INTO foodcat (food_name, category, days, image) 
            VALUES ('$food_name', '$category', '$days', '$image')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to staff.php after successful insertion
        header("Location: staff.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        .container {
            width: 50%;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 14px;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="file"], select, textarea {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
        <button onclick="location.href='staff.php'">View Food</button>
        <button onclick="location.href='view_subscription.php'">View Subscription</button>
        <button onclick="location.href='view_feedback.php'">View Feedback</button>
        <button class="logout-button" onclick="location.href='staff_login.php'">Logout</button>
    </div>
</header>
<div class="container">
    <form action="add_food.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="food_name">Food Name:</label>
            <input type="text" id="food_name" name="food_name" required>
        </div>

        <div class="form-group">
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="Breakfast">Breakfast</option>
                <option value="Lunch">Lunch</option>
                <option value="Dinner">Dinner</option>
            </select>
        </div>

        <div class="form-group">
            <label for="days">Days Available:</label>
            <input type="text" id="days" name="days" required>
        </div>

        <div class="form-group">
            <label for="image">Food Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <input type="submit" value="Add Food">
    </form>
</div>

</body>
</html>
