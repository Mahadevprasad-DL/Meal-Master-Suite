<?php
// Initialize an error message variable
$error_message = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate username and password
    if ($username === 'starmess' && $password === '12345') {
        // Redirect to staff.php if login is successful
        header('Location: staff.php');
        exit;
    } else {
        // Set an error message for incorrect credentials
        $error_message = 'Invalid Username or Password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            background: url('images/login.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .left-side {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .right-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            width: 400px;
            padding: 40px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
        .message {
            text-align: center;
            font-size: 24px;
            color: black;
            margin-bottom: 280px;
        }
    </style>
</head>
<body>
    <div class="left-side">
        <div class="message">
            <h1>Welcome to StarMess</h1>
            <p>Eat Healthy, Stay Healthy</p>
        </div>
    </div>

    <div class="right-side">
        <div class="login-container">
            <h2>Staff Login</h2>
            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
