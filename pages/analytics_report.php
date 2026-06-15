<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

require_once "../config.php";
include "../includes/header.php";

$patients_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM patients"))['total'];
$doctors_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM doctors"))['total'];
$appointments_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM appointments"))['total'];
?>

<h2>Analytics Report</h2>

<p>Logged in as: <?php echo $_SESSION['username']; ?></p>

<hr>

<div class="cards">
    <div class="card">
        <h3>Total Patients</h3>
        <p><?php echo $patients_count; ?></p>
    </div>

    <div class="card">
        <h3>Total Doctors</h3>
        <p><?php echo $doctors_count; ?></p>
    </div>

    <div class="card">
        <h3>Total Appointments</h3>
        <p><?php echo $appointments_count; ?></p>
    </div>
</div>

<?php
include "../includes/footer.php";
?>