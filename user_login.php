<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to right, #f06, #4A90E2);
        }

        .left-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            animation: fadeInLeft 1.5s ease-in-out;
        }

        .left-side h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
        }

        .left-side p {
            font-size: 1.8rem;
            font-style: italic;
            color: white;
        }

        .right-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 80%;
            max-width: 400px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            animation: fadeInRight 1.5s ease-in-out;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
        }

        .form-btn {
            text-align: center;
        }

        .form-btn input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            background-color: #ffbc00;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
        }

        .form-btn input:hover {
            background-color: white;
            transition: background-color 0.3s ease;
        }

        .alert {
            margin-bottom: 15px;
        }

        /* Animation Effects */
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

    </style>
</head>
<body>
    <div class="left-side">
        <div>
            <h1>Welcome to Starmess</h1>
            <p>"Food is the ingredient that binds us together."</p>
        </div>
    </div>

    <div class="right-side">
        <div class="container">
            <?php
            if (isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];
                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        $_SESSION["user"] = "yes";
                        header("Location: user.php");
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Incorrect password</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Email does not exist</div>";
                }
            }
            ?>
            <form action="user_login.php" method="post">
                <div class="form-group">
                    <input type="email" placeholder="Enter Email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Enter Password" name="password" class="form-control" required>
                </div>
                <div class="form-btn">
                    <input type="submit" value="Login" name="login" class="btn btn-primary">
                </div>
            </form>
            <div>
                <p>Not registered yet? <a href="user_register.php">Register Here</a></p>
            </div>
        </div>
    </div>
</body>
</html>
