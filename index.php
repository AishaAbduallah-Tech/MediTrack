<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

require_once "config.php";
include "includes/header.php";

$patients_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM patients"))['total'];
$doctors_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM doctors"))['total'];
$appointments_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM appointments"))['total'];

$recent = mysqli_query($conn, "
SELECT appointments.*, patients.name, doctors.doctor_name
FROM appointments
INNER JOIN patients ON appointments.patient_id = patients.id
INNER JOIN doctors ON appointments.doctor_id = doctors.doctor_id
ORDER BY appointments.appointment_date DESC, appointments.appointment_time DESC
LIMIT 5
");
?>

<p class="welcome-user">
مرحباً <?php echo $_SESSION['username']; ?> 👋
</p>
<p>
ادارة مواعيد المرضى والاطباء من مكان واحد
</p>

<form method="GET" action="search.php">
    <input type="text" name="keyword" placeholder="Search patients or doctors" required>
    <input type="submit" value="Search">
</form>

<br>

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

<hr>

<h2>Recent Appointments</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Patient</th>
    <th>Doctor</th>
    <th>Date</th>
    <th>Time</th>
    <th>Status</th>
</tr>

<?php while($row = mysqli_fetch_assoc($recent)) { ?>
<tr>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['doctor_name']; ?></td>
    <td><?php echo $row['appointment_date']; ?></td>
    <td><?php echo $row['appointment_time']; ?></td>
    <td><?php echo $row['status']; ?></td>
</tr>
<?php } ?>

</table>

<?php
include "includes/footer.php";
?>