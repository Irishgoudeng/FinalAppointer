<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/signup.css">

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

        .sub-text {
            font-size: 14px;
            font-weight: 280;
            text-align: center;
            margin-top: 20px;
        }

        .non-style-link {
            color: #007bff;
            text-decoration: none;
        }
    </style>

    <title>Sign Up</title>
</head>

<body>
    <?php

    // Unset all the server-side variables
    session_start();
    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";

    // Set the new timezone
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    $_SESSION["date"] = $date;

    if ($_POST) {
        $_SESSION["personal"] = array(
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'address' => $_POST['address'],
            'nic' => $_POST['nic'],
            'dob' => $_POST['dob']
        );

        print_r($_SESSION["personal"]);
        header("location: create-account.php");
    }

    ?>

    <center>
        <div class="container">
            <p class="header-text">Let's Get Started</p>
            <p class="sub-text">Add Your Personal Details to Continue</p>
            <form action="" method="POST">
                <label for="name" class="form-label">Name:</label>
                <div style="display: flex;">
                    <input type="text" name="fname" class="input-text" placeholder="First Name" required>
                    <input type="text" name="lname" class="input-text" placeholder="Last Name" required>
                </div>
                <label for="address" class="form-label">Address:</label>
                <input type="text" name="address" class="input-text" placeholder="Address" required>
                <label for="nic" class="form-label">NIC:</label>
                <input type="text" name="nic" class="input-text" placeholder="NIC Number" required>
                <label for="dob" class="form-label">Date of Birth:</label>
                <input type="date" name="dob" class="input-text" required>
                <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                <input type="submit" value="Next" class="login-btn btn-primary btn">
            </form>
            <br>
            <label for="" class="sub-text" style="font-weight: 280;">Already have an account?</label>
            <a href="login.php" class="hover-link1 non-style-link">Login</a>
            <br><br><br>
        </div>
    </center>
</body>
</html>
