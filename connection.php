<?php

    $database= new mysqli("localhost","root","","appointers_db");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>