<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mess Management System</title>
    <style>
        /* Reset and basic styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('images/home.avif') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        /* Container for content */
        .container {
            background: rgba(0, 0, 0, 0.6); /* Semi-transparent black background */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            animation: scaleIn 1.5s ease;
        }

        /* Heading styles */
        h1 {
            font-size: 3.5rem;
            margin-bottom: 40px;
            animation: slideIn 1.5s ease-out;
            line-height: 1.5;
        }

        /* Button container styles */
        .button-container {
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        /* Button styles */
        .button {
            text-decoration: none;
            font-size: 1.2rem;
            color: #fff;
            border: 2px solid #fff;
            padding: 12px 25px;
            border-radius: 50px;
            cursor: pointer;
            transition: transform 0.3s ease, color 0.3s ease, border-color 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.3);
            transition: left 0.5s ease;
        }

        .button:hover::before {
            left: 0;
        }

        .button:hover {
            color: #000;
            border-color: #f0e68c;
        }

        .button:hover::before {
            background: rgba(240, 230, 140, 0.6);
        }

        /* Animations */
        @keyframes scaleIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Media Query for Responsiveness */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }
            .button {
                font-size: 1rem;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to <br> Mess Management System</h1>
        <div class="button-container">
            <a href="menu.php" class="button">Menu</a>
            <a href="staff_login.php" class="button">Staff</a>
            <a href="user_register.php" class="button">User</a>
        </div>
    </div>
</body>
</html>
