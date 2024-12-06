<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mess_db"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected day from the dropdown
$selectedDay = isset($_POST['day']) ? $_POST['day'] : "";

// Function to fetch food list based on the selected day and category
function getFoodList($day, $category) {
    global $conn;
    if (empty($day)) {
        echo "<p>Please select a day to view the menu.</p>";
        return;
    }

    $sql = "SELECT DISTINCT food_name FROM foodcat WHERE category = ? AND FIND_IN_SET(?, days)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $category, $day);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<ul>"; // Using an unordered list to display food names
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . htmlspecialchars($row['food_name']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No food available for the selected day.</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Mess Menu</title>
    <link rel="stylesheet" href="style.css"> <!-- External CSS file -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, white 0%, white 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            overflow-x: hidden;
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

        .container {
            width: 90%;
            max-width: 1200px;
            background: #fff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 15px;
            margin-top: 100px; /* To avoid overlap with the fixed header */
            animation: slideIn 1s ease-out;
            transform: translateY(30px);
        }

        h1 {
            text-align: center;
            font-size: 2.8rem;
            color: black;
            margin-bottom: 30px;
            text-transform: uppercase;
            animation: fadeIn 1.5s ease-in-out;
        }

        .day-selector {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            flex-direction: column;
            align-items: center;
        }

        select {
            padding: 10px;
            font-size: 1.2rem;
            margin-right: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 25px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        .meal-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 30px;
        }

        .meal-box {
            flex: 1;
            padding: 20px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .meal-box:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .meal-box h2 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 15px;
        }

        .meal-box ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .meal-box li {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 10px;
        }

        hr {
            border: 0;
            height: 1px;
            background-color: #ccc;
            margin: 20px 0;
        }

        .note {
            color: red;
            font-size: 1.2rem;
            margin-top: 15px;
            font-weight: bold;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
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
        .left-icon {
    margin-right: 10px; /* Space between the left icon and the text */
}

.right-icon {
    margin-left: 10px; /* Space between the right icon and the text */
}
.container h1 img {
    width: 150px; /* Set the width of the icons */
    height: 80px; /* Set the height of the icons */
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
        <button onclick="location.href='user_polling.php'">Add Polling</button>
        <button class="logout-button" onclick="location.href='user_login.php'">Logout</button>
    </div>
</header>

    <div class="container">
        <h1>
        <img src="images/food.png" alt="Left Icon" class="left-icon"> Today's Mess Menu 
        <img src="images/food.png" alt="Right Icon" class="right-icon">

        </h1>

        <!-- Dropdown for selecting day -->
        <form method="POST" action="">
            <div class="day-selector">
                <select name="day">
                    <option value="">Select a Day</option>
                    <option value="Monday" <?= $selectedDay == 'Monday' ? 'selected' : '' ?>>Monday</option>
                    <option value="Tuesday" <?= $selectedDay == 'Tuesday' ? 'selected' : '' ?>>Tuesday</option>
                    <option value="Wednesday" <?= $selectedDay == 'Wednesday' ? 'selected' : '' ?>>Wednesday</option>
                    <option value="Thursday" <?= $selectedDay == 'Thursday' ? 'selected' : '' ?>>Thursday</option>
                    <option value="Friday" <?= $selectedDay == 'Friday' ? 'selected' : '' ?>>Friday</option>
                    <option value="Saturday" <?= $selectedDay == 'Saturday' ? 'selected' : '' ?>>Saturday</option>
                    <option value="Sunday" <?= $selectedDay == 'Sunday' ? 'selected' : '' ?>>Sunday</option>
                </select>
                <button type="submit">Submit</button>
            </div>
        </form>

        <!-- Display meal sections -->
        <div class="meal-container">
            <div class="meal-box">
                <h2>Breakfast <br> 8am - 10am</h2><hr>
                <?php getFoodList($selectedDay, 'Breakfast'); ?>
                <hr>
            </div>
            <div class="meal-box">
                <h2>Lunch <br> 12pm - 2pm</h2><hr>
                <?php getFoodList($selectedDay, 'Lunch'); ?>
                <hr>
            </div>
            <div class="meal-box">
                <h2>Dinner<br> 7.30pm- 9.30pm</h2><hr>
                <?php getFoodList($selectedDay, 'Dinner'); ?>
                <hr>
            </div>
        </div>

    </div>
</body>
</html>

<?php
$conn->close();
?>
