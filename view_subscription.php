<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'mess_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = intval($_POST['id']);
    $deleteSql = "DELETE FROM subscriptions WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $deleteMessage = "Subscription deleted successfully.";
    } else {
        $deleteMessage = "Error deleting subscription: " . $conn->error;
    }
    $stmt->close();
}

// Fetch data from the database
$sql = "SELECT id, username, location, start_date, end_date, status FROM subscriptions";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Subscriptions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .table-container {
            width: 90%;
            margin: 50px auto;
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
            color: green;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #3498db;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        .delete-btn {
            padding: 5px 10px;
            color: white;
            background-color: #e74c3c;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 15px 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

header h1 {
    font-size: 24px;
    margin: 0;
    color: white;
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
    text-transform: uppercase;
}

.nav-buttons button:hover {
    background-color: #45a049;
}

.logout-button {
    background-color: #f44336;
}

.logout-button:hover {
    background-color: #d32f2f;
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
    <div class="table-container">
        <h1>Subscription Details</h1>
        <?php if (isset($deleteMessage)): ?>
            <p class="message"><?php echo htmlspecialchars($deleteMessage); ?></p>
        <?php endif; ?>
        <table>
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Location</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['location']); ?></td>
                            <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="delete" class="delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">No subscriptions found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php $conn->close(); ?>
