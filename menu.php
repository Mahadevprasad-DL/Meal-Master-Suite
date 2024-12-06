<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarMess</title>
    <style>
        /* Reset and basic styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #333;
        }

        /* Header styling */
        header {
            background-color: #007bff;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            width: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        header h1 {
            margin: 0;
            font-size: 1.8rem;
            animation: slideInLeft 1s ease-in-out;
            letter-spacing: 2px;
        }

        /* Navigation buttons */
        .nav-buttons {
            display: flex;
            gap: 20px;
        }

        .nav-buttons a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-right: 80px;
        }

        .nav-buttons a:hover {
            background-color: #0056b3;
        }

        /* Login button */
        .login-button {
            background-color: #fff;
            color: #007bff;
            text-decoration: none;
            padding: 5px 15px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .login-button:hover {
            background-color: #0056b3;
            color: #fff;
        }

        /* Main content */
        .container {
            margin-top: 100px;
            padding: 20px;
        }

        .section {
            margin-bottom: 50px;
        }

        .section h2 {
            font-size: 2.2rem;
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            animation: fadeIn 1.5s ease-in-out;
        }

        .food-items {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            justify-items: center;
        }

        .food-item {
            width: 180px;
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: bounceIn 1.2s ease-in-out;
        }

        .food-item img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-bottom: 2px solid #f1f1f1;
        }

        .food-item h3 {
            font-size: 1.2rem;
            margin: 10px 0;
            color: #555;
        }

        .food-item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        footer {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            margin-top: 30px;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        footer a {
            color: #ffd700;
            text-decoration: none;
            font-weight: bold;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }

        @keyframes bounceIn {
            from {
                transform: scale(0.5);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <h1>StarMess</h1>
        <div class="nav-buttons">
            <a href="menu.php">Home</a>
            <a href="contactus.php">Contact Us</a>
            <a href="aboutus.php">About Us</a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <!-- Veg Foods Section -->
        <div class="section">
            <h2>Veg Foods</h2>
            <div class="food-items">
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'mess_db');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch Veg Food
                $veg_query = "SELECT * FROM foods WHERE category = 'veg'";
                $result = $conn->query($veg_query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                            <div class='food-item'>
                                <img src='{$row['image']}' alt='{$row['name']}'>
                                <h3>{$row['name']}</h3>
                            </div>
                        ";
                    }
                } else {
                    echo "<p>No Veg Food available.</p>";
                }
                ?>
            </div>
        </div>

        <!-- Non-Veg Foods Section -->
        <div class="section">
            <h2>Non-Veg Foods</h2>
            <div class="food-items">
                <?php
                // Fetch Non-Veg Food
                $nonveg_query = "SELECT * FROM foods WHERE category = 'non-veg'";
                $result = $conn->query($nonveg_query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                            <div class='food-item'>
                                <img src='{$row['image']}' alt='{$row['name']}'>
                                <h3>{$row['name']}</h3>
                            </div>
                        ";
                    }
                } else {
                    echo "<p>No Non-Veg Food available.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
</body>
</html>
