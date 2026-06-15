<?php

$host = "127.0.0.1";
$port = "3307";
$username = "root";
$password = "";
$database = "smart_health";

$conn = mysqli_connect($host, $username, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

?>