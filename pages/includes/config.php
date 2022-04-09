<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "crud";
$port = 3308;

$con = new mysqli($host, $user, $password, $database, $port);
// $con = new mysqli("localhost", "root", "", "crud", "3308")

if($con->connect_error) {
    echo $con->connect_error;
}

