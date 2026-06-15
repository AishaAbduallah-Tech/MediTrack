<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

require_once "../config.php";
include "../includes/header.php";

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM appointments WHERE appointment_id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update_appointment'])){

    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $status = $_POST['status'];

    mysqli_query($conn,
    "UPDATE appointments
     SET appointment_date='$appointment_date',
         appointment_time='$appointment_time',
         status='$status'
     WHERE appointment_id=$id");

    header("Location: appointments.php");
    exit();
}
?>

<h2>Edit Appointment</h2>

<form method="POST">

<label>Date</label><br>
<input type="date" name="appointment_date" value="<?php echo $row['appointment_date']; ?>" required><br><br>

<label>Time</label><br>
<input type="time" name="appointment_time" value="<?php echo $row['appointment_time']; ?>" required><br><br>

<label>Status</label><br>
<select name="status">
    <option value="Scheduled" <?php if($row['status']=="Scheduled") echo "selected"; ?>>Scheduled</option>
    <option value="Completed" <?php if($row['status']=="Completed") echo "selected"; ?>>Completed</option>
    <option value="Cancelled" <?php if($row['status']=="Cancelled") echo "selected"; ?>>Cancelled</option>
</select><br><br>

<input type="submit" name="update_appointment" value="Update Appointment">

</form>

<?php
include "../includes/footer.php";
?>