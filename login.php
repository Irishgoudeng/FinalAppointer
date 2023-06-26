<?php
session_start();
$_SESSION["user"] = "";
$_SESSION["usertype"] = "";

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$_SESSION["date"] = $date;

include("connection.php");

if ($_POST) {
    $email = $_POST['useremail'];
    $password = $_POST['userpassword'];

    $error = '<label for="promter" class="error-label"></label>';

    $result = $database->query("SELECT * FROM tbl_webuser WHERE email='$email'");
    if ($result->num_rows == 1) {
        $utype = $result->fetch_assoc()['usertype'];
        if ($utype == 'p') {
            $checker = $database->query("SELECT * FROM tbl_patient WHERE pemail='$email' AND ppassword='$password'");
            if ($checker->num_rows == 1) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'p';
                header('location: patient/index.php');
            } else {
                $error = '<label for="promter" class="error-label">Wrong credentials: Invalid email or password</label>';
            }
        } elseif ($utype == 'a') {
            $checker = $database->query("SELECT * FROM tbl_admin WHERE aemail='$email' AND apassword='$password'");
            if ($checker->num_rows == 1) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'a';
                header('location: admin/index.php');
            } else {
                $error = '<label for="promter" class="error-label">Wrong credentials: Invalid email or password</label>';
            }
        } elseif ($utype == 'd') {
            $checker = $database->query("SELECT * FROM tbl_doctor WHERE docemail='$email' AND docpassword='$password'");
            if ($checker->num_rows == 1) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'd';
                header('location: doctor/index.php');
            } else {
                $error = '<label for="promter" class="error-label">Wrong credentials: Invalid email or password</label>';
            }
        }
    } else {
        $error = '<label for="promter" class="error-label">We can\'t find any account for this email.</label>';
    }
} else {
    $error = '<label for="promter" class="form-label">&nbsp;</label>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
    <style>
        body {
            background-color: #e6f2ff;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 400px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header-text {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #007bff;
        }

        .sub-text {
            font-size: 16px;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .input-text {
            width: 100%;
            height: 40px;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .error-label {
            color: rgb(255, 62, 62);
            text-align: center;
            margin-bottom: 10px;
        }

        .login-btn {
            width: 100%;
            height: 40px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .signup-label {
            font-size: 14px;
            font-weight: 280;
            text-align: center;
            margin-top: 20px;
        }

        .signup-link {
            color: #007bff;
            text-decoration: none;
        }
    </style>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <p class="header-text">Welcome Back!</p>
        <p class="sub-text">Login with your details to continue</p>
        <form action="" method="POST">
            <label for="useremail" class="form-label">Email:</label>
            <input type="email" name="useremail" class="input-text" placeholder="Email Address" required>
            <label for="userpassword" class="form-label">Password:</label>
            <input type="password" name="userpassword" class="input-text" placeholder="Password" required>
            <?php echo $error ?>
            <input type="submit" value="Login" class="login-btn">
        </form>
        <br>
        <label for="" class="signup-label">Don't have an account? </label>
        <a href="signup.php" class="signup-link">Sign Up</a>
    </div>
</body>
</html>
