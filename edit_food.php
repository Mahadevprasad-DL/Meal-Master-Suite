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

// Check if the food ID is passed and valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request.");
}

$food_id = intval($_GET['id']); // Sanitize food ID

// Fetch food item details
$sql = "SELECT * FROM foodcat WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $food_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $food = $result->fetch_assoc();
} else {
    die("Food item not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food_name = trim($_POST['food_name']);
    $days = trim($_POST['days']);
    $image_name = $food['image']; // Use existing image by default

    // Validate inputs
    if (empty($food_name) || empty($days)) {
        echo "<p style='color: red;'>Food name and days are required.</p>";
    } else {
        // Check if a new image is uploaded
        if (!empty($_FILES['image']['name'])) {
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_name = basename($_FILES['image']['name']);
            } else {
                echo "<p style='color: red;'>Error uploading the image.</p>";
            }
        }

        // Update food item in the database
        $update_sql = "UPDATE foodcat SET food_name = ?, days = ?, image = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssi", $food_name, $days, $image_name, $food_id);

        if ($update_stmt->execute()) {
            header("Location: staff.php");
            exit();
        } else {
            echo "<p style='color: red;'>Error updating record: " . $conn->error . "</p>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Food Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }


        .container {
            width: 50%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="file"], select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .cancel-btn {
            background-color: #f44336;
        }

        .cancel-btn:hover {
            background-color: #d32f2f;
        }

        .actions {
            display: flex;
            justify-content: space-between;
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
            color: white;
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
<body>
<header>
    <h1>
        <a href="home.php"><img src="images/food.png" alt="Food Icon"></a>
        Welcome to StarMess
    </h1>
    <div class="nav-buttons">
        <button onclick="location.href='staff.php'">View Food</button>
        <button onclick="location.href='view_subscription.php'">View Subscription</button>
        <button onclick="location.href='view_feedback.php'">View Feedback</button>
        <button class="logout-button" onclick="location.href='staff_login.php'">Logout</button>
    </div>
</header>

<div class="container">
    <h1>Edit Food Item</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="food_name">Food Name:</label>
        <input type="text" id="food_name" name="food_name" value="<?php echo htmlspecialchars($food['food_name']); ?>" required>

        <label for="days">Days:</label>
        <input type="text" id="days" name="days" value="<?php echo htmlspecialchars($food['days']); ?>" required>

        <label for="image">Food Image:</label>
        <input type="file" id="image" name="image">
        <p>Current Image: <img src="images/<?php echo htmlspecialchars($food['image']); ?>" alt="<?php echo htmlspecialchars($food['food_name']); ?>" width="100"></p>

        <div class="actions">
            <button type="submit">Save Changes</button>
            <button type="button" class="cancel-btn" onclick="window.location.href='staff.php'">Cancel</button>
        </div>
    </form>
</div>

</body>
</html>
