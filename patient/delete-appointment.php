<?php

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
        header("location: index.php");
    }
} else {
    header("location: index.php");
}


if ($_GET) {
    //import database
    include("../connection.php");
    $id = $_GET["id"];
    $result001 = $database->query("select * from tbl_schedule where scheduleid=$id;");
    $email = ($result001->fetch_assoc())["docemail"];
    $sql = $database->query("delete from tbl_appointment where appoid='$id';");
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $sql = $database->query("delete from tbl_doctor where docemail='$email';");
    //print_r($email);
    header("location: appointment.php");
}
