<?php
session_start();
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecclms";

    $conn = new mysqli($server, $username, $password, $dbname);

    if($conn -> connect_error){
        die("Connection Failed!" . $conn->connect_error);
    }