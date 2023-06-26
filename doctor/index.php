<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Dashboard</title>


</head>

<body>
    <?php

    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }


    //import database
    include("../connection.php");
    $userrow = $database->query("select * from tbl_doctor where docemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["docid"];
    $username = $userfetch["docname"];


    //echo $userid;
    //echo $username;

    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username, 0, 13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail, 0, 22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord ">
                        <a href="index.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Dashboard</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-appoinment">
                <a href="appointment.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">My Appointments</p>
                </a>
    </div>
    </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-session">
            <a href="schedule.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">My Sessions</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-patient">
            <a href="patient.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">My Patients</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings">
            <a href="settings.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Settings</p>
            </a></div>
        </td>
    </tr>

    </table>
    </div>
    <div class="dash-body" style="margin-top: 15px">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">

            <tr>

                <td colspan="1" class="nav-bar">
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;"> Dashboard</p>

                </td>
                <td width="25%">

                </td>
                <td width="15%">
                    
                    
                        <?php
                       
                        $today = date('Y-m-d');                    
                        $patientrow = $database->query("select  * from  tbl_patient;");
                        $doctorrow = $database->query("select  * from  tbl_doctor;");
                        $appointmentrow = $database->query("select  * from  tbl_appointment where appodate>='$today';");
                        $schedulerow = $database->query("select  * from  tbl_schedule where scheduledate='$today';");


                        ?>
                    </p>
                </td>       
            </tr>
            <tr>
                <td colspan="4">

                    <center>
                        <table class="filter-container doctor-header" style="border: none;width:95%" border="0">
                            <tr>
                                <td>
                                    <h3>Welcome!</h3>
                                    <h1><?php echo $username  ?>.</h1>
                                    <p>Thanks for joining with us. We are always trying to get you a complete service<br>
                                        You can view your daily schedule, Reach Patients Appointment at home!<br><br>
                                    </p>
                                    <a href="appointment.php" class="non-style-link"><button class="btn-primary btn" style="width:30%">View My Appointments</button></a>
                                    <br>
                                    <br>
                                </td>
                            </tr>
                        </table>
                    </center>

                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <table border="0" width="100%"">
                            <tr>
                                <td width=" 50%">
                        <center>
                            <table class="filter-container" style="border: none;" border="0">
                                <tr>
                                    <td colspan="4">
                                        <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Status</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex">
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $doctorrow->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    All Doctors &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                            </div>
                                            <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                        </div>
                                    </td>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex;">
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $patientrow->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    All Patients &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                            </div>
                                            <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex; ">
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $appointmentrow->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    NewBooking &nbsp;&nbsp;
                                                </div>
                                            </div>
                                            <div class="btn-icon-back dashboard-icons" style="margin-left: 0px;background-image: url('../img/icons/book-hover.svg');"></div>
                                        </div>

                                    </td>

                                    <td style="width: 25%;">
                                        <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex;padding-top:21px;padding-bottom:21px;">
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $schedulerow->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 15px">
                                                    Today Sessions
                                                </div>
                                            </div>
                                            <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/session-iceblue.svg');"></div>
                                        </div>
                                    </td>

                                </tr>
                            </table>
                        </center>

                </td>
                <td>



                    <p id="anim" style="font-size: 20px;font-weight:600;padding-left: 40px;">Your Up Coming Sessions until Next week</p>
                    <center>
                        <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                            <table width="85%" class="sub-table scrolldown" border="0">
                                <thead>

                                    <tr>
                                        <th class="table-headin">


                                            Session Title

                                        </th>

                                        <th class="table-headin">
                                            Scheduled Date
                                        </th>
                                        <th class="table-headin">

                                            Time

                                        </th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $nextweek = date("Y-m-d", strtotime("+1 week"));
                                    $sqlmain = "select tbl_schedule.scheduleid,tbl_schedule.title,tbl_doctor.docname,tbl_schedule.scheduledate,tbl_schedule.scheduletime,tbl_schedule.nop 
                                            from tbl_schedule inner join tbl_doctor on tbl_schedule.docid=tbl_doctor.docid  where tbl_schedule.scheduledate>='$today' and tbl_schedule.scheduledate<='$nextweek' order by tbl_schedule.scheduledate desc";
                                    $result = $database->query($sqlmain);

                                    if ($result->num_rows == 0) {
                                        echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>                                                
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';
                                    } else {
                                        for ($x = 0; $x < $result->num_rows; $x++) {
                                            $row = $result->fetch_assoc();
                                            $scheduleid = $row["scheduleid"];
                                            $title = $row["title"];
                                            $docname = $row["docname"];
                                            $scheduledate = $row["scheduledate"];
                                            $scheduletime = $row["scheduletime"];
                                            $nop = $row["nop"];
                                            echo '<tr>
                                                        <td style="padding:20px;"> &nbsp;' .
                                                substr($title, 0, 30)
                                                . '</td>
                                                        <td style="padding:20px;font-size:13px;">
                                                        ' . substr($scheduledate, 0, 10) . '
                                                        </td>
                                                        <td style="text-align:center;">
                                                            ' . substr($scheduletime, 0, 5) . '
                                                        </td>

                
                                                       
                                                    </tr>';
                                        }
                                    }

                                    ?>

                                </tbody>

                            </table>
                        </div>
                    </center>

                </td>
            </tr>
        </table>
        </td>
        <tr>
            </table>
    </div>
    </div>


</body>

</html>