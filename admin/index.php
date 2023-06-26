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
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
            header("location: ../login.php");
        }
    } else {
        header("location: ../login.php");
    }


    //import database
    include("../connection.php");


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
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">admin@appointer.com</p>
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
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text">Dashboard</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor ">
                <a href="doctors.php" class="non-style-link-menu ">
                    <div>
                        <p class="menu-text">Doctors</p>
                </a>
    </div>
    </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-schedule">
            <a href="schedule.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Schedule</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Appointment</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-patient">
            <a href="patient.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Patients</p>
            </a></div>
        </td>
    </tr>
    </table>
    </div>
    <div class="dash-body" style="margin-top: 15px">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">

            <tr>

                <?php
                date_default_timezone_set('Asia/Kolkata');

                $today = date('Y-m-d');
                //echo $today;


                $patientrow = $database->query("select  * from  tbl_patient;");
                $doctorrow = $database->query("select  * from  tbl_doctor;");
                $appointmentrow = $database->query("select  * from  tbl_appointment where appodate>='$today';");
                $schedulerow = $database->query("select  * from  tbl_schedule where scheduledate='$today';");


                ?>

            </tr>

            <tr>
                <td colspan="4">
                    <table width="100%" border="0" class="dashbord-tables">
                        <tr>
                            <td>
                                <p style="padding:10px;padding-left:48px;padding-bottom:0;font-size:23px;font-weight:700;color:var(--primarycolor);">
                                    Upcoming Appointments until Next <?php
                                                                        echo date("l", strtotime("+1 week"));
                                                                        ?>
                                </p>
                                <p style="padding-bottom:19px;padding-left:50px;font-size:15px;font-weight:500;color:#212529e3;line-height: 20px;">
                                    Here's Quick access to Upcoming Appointments until 7 days<br>
                                    More details available in Appointment section.
                                </p>

                            </td>
                            <td>
                                <p style="text-align:right;padding:10px;padding-right:48px;padding-bottom:0;font-size:23px;font-weight:700;color:var(--primarycolor);">
                                    Upcoming Sessions until Next
                                    <?php
                                    echo date("l", strtotime("+1 week"));
                                    ?>
                                </p>
                                <p style="padding-bottom:19px;text-align:right;padding-right:50px;font-size:15px;font-weight:500;color:#212529e3;line-height: 20px;">
                                    Here's Quick access to Upcoming Sessions that Scheduled until 7 days<br>
                                    Add,Remove and Many features available in Schedule section.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%">
                                <center>
                                    <div class="abc scroll" style="height: 200px;">
                                        <table width="85%" class="sub-table scrolldown" border="0">
                                            <thead>
                                                <tr>
                                                    <th class="table-headin" style="font-size: 12px;">

                                                        Appointment number

                                                    </th>
                                                    <th class="table-headin">
                                                        Patient name
                                                    </th>
                                                    <th class="table-headin">


                                                        Doctor

                                                    </th>
                                                    <th class="table-headin">


                                                        Session

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $nextweek = date("Y-m-d", strtotime("+1 week"));
                                                $sqlmain = "select tbl_appointment.appoid,tbl_schedule.scheduleid,tbl_schedule.title,tbl_doctor.docname,tbl_patient.pname,
                                            tbl_schedule.scheduledate,tbl_schedule.scheduletime,tbl_appointment.apponum,tbl_appointment.appodate 
                                            from tbl_schedule inner join tbl_appointment on tbl_schedule.scheduleid=tbl_appointment.scheduleid inner join
                                            tbl_patient on tbl_patient.pid=tbl_appointment.pid inner join tbl_doctor on tbl_schedule.docid=tbl_doctor.docid  where tbl_schedule.scheduledate>='$today'  
                                            and tbl_schedule.scheduledate<='$nextweek' order by tbl_schedule.scheduledate desc";

                                                $result = $database->query($sqlmain);

                                                if ($result->num_rows == 0) {
                                                    echo '<tr>
                                                    <td colspan="3">
                                                    <br><br><br><br>
                                                    <center>                                                  
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';
                                                } else {
                                                    for ($x = 0; $x < $result->num_rows; $x++) {
                                                        $row = $result->fetch_assoc();
                                                        $appoid = $row["appoid"];
                                                        $scheduleid = $row["scheduleid"];
                                                        $title = $row["title"];
                                                        $docname = $row["docname"];
                                                        $scheduledate = $row["scheduledate"];
                                                        $scheduletime = $row["scheduletime"];
                                                        $pname = $row["pname"];
                                                        $apponum = $row["apponum"];
                                                        $appodate = $row["appodate"];
                                                        echo '<tr>


                                                        <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);padding:20px;">
                                                            ' . $apponum . '
                                                            
                                                        </td>

                                                        <td style="font-weight:600;"> &nbsp;' .

                                                            substr($pname, 0, 25)
                                                            . '</td >
                                                        <td style="font-weight:600;"> &nbsp;' .

                                                            substr($docname, 0, 25)
                                                            . '</td >
                                                           
                                                        
                                                        <td>
                                                        ' . substr($title, 0, 15) . '
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
                            <td width="50%" style="padding: 0;">
                                <center>
                                    <div class="abc scroll" style="height: 200px;padding: 0;margin: 0;">
                                        <table width="85%" class="sub-table scrolldown" border="0">
                                            <thead>
                                                <tr>
                                                    <th class="table-headin">


                                                        Session Title

                                                    </th>

                                                    <th class="table-headin">
                                                        Doctor
                                                    </th>
                                                    <th class="table-headin">

                                                        Sheduled Date & Time

                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $nextweek = date("Y-m-d", strtotime("+1 week"));
                                                $sqlmain = "select tbl_schedule.scheduleid,tbl_schedule.title,tbl_doctor.docname,tbl_schedule.scheduledate,tbl_schedule.scheduletime,
                                            tbl_schedule.nop from tbl_schedule inner join tbl_doctor on tbl_schedule.docid=tbl_doctor.docid  where tbl_schedule.scheduledate>='$today' and 
                                            tbl_schedule.scheduledate<='$nextweek' order by tbl_schedule.scheduledate desc";
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
                                                        <td>
                                                        ' . substr($docname, 0, 20) . '
                                                        </td>
                                                        <td style="text-align:center;">
                                                            ' . substr($scheduledate, 0, 10) . ' ' . substr($scheduletime, 0, 5) . '
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
                        <tr>
                            <td>
                                <center>
                                    <a href="appointment.php" class="non-style-link"><button class="btn-primary btn" style="width:85%">Show all Appointments</button></a>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <a href="schedule.php" class="non-style-link"><button class="btn-primary btn" style="width:85%">Show all Sessions</button></a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </td>

            </tr>
        </table>
        </center>
        </td>
        </tr>
        </table>
    </div>
    </div>


</body>

</html>