<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "phpecomm";

// Creating database Connection
$con = mysqli_connect($host, $username, $password, $database);

// Check Database connection
if (!$con) {
    die("Connection Failed" . mysqli_connect_error());
} 