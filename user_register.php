<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

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
        padding: 20px;
    }

    .left-side h1 {
        font-size: 3.5rem;
        margin-bottom: 20px;
    }

    .left-side p {
        font-size: 1.5rem;
        font-style: italic;
    }

    .right-side {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container {
        width: 100%;
        max-width: 450px;
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

<body>
    <div class="left-side">
        <div>
            <h1>Welcome to Starmess</h1>
            <p>"Good food is the foundation of genuine happiness."</p>
        </div>
    </div>

    <div class="right-side">
        <div class="container">
            <?php
            if (isset($_POST["submit"])) {
                $fullName = $_POST["fullname"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $passwordRepeat = $_POST["repeat_password"];

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $errors = array();

                if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
                    array_push($errors, "All fields are required");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid");
                }
                if (strlen($password) < 8) {
                    array_push($errors, "Password must be at least 8 characters long");
                }
                if ($password !== $passwordRepeat) {
                    array_push($errors, "Password does not match");
                }

                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount > 0) {
                    array_push($errors, "Email already exists!");
                }

                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                } else {
                    $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>You are registered successfully. Login Here</a></div>";
                    } else {
                        die("Something went wrong");
                    }
                }
            }
            ?>
            <form action="user_register.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="fullname" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password" required>
                </div>
                <div class="form-btn">
                    <input type="submit" value="Register" name="submit" class="btn btn-primary">
                </div>
            </form>
            <div>
                <p>Already registered? <a href="user_login.php">Login Here</a></p>
            </div>
        </div>
    </div>
</body>

</html>
