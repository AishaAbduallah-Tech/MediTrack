<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

require_once "../config.php";

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "DELETE FROM patients WHERE id='$id'";

    mysqli_query($conn, $sql);
}

header("Location: patients.php");
exit();
?>