<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

require_once "../config.php";

if(isset($_POST['add_appointment'])){

    $patient_name = $_POST['patient_name'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $status = "Scheduled";

    $check_patient = mysqli_query($conn,
        "SELECT id FROM patients WHERE name='$patient_name' LIMIT 1"
    );

    if(mysqli_num_rows($check_patient) > 0){
        $patient = mysqli_fetch_assoc($check_patient);
        $patient_id = $patient['id'];
    }else{
        mysqli_query($conn,
            "INSERT INTO patients (name, age, phone, register_date)
             VALUES ('$patient_name', 0, '', CURDATE())"
        );

        $patient_id = mysqli_insert_id($conn);
    }

    $sql = "INSERT INTO appointments
    (patient_id, doctor_id, appointment_date, appointment_time, status)
    VALUES
    ('$patient_id','$doctor_id','$appointment_date','$appointment_time','$status')";

    mysqli_query($conn,$sql);

    header("Location: appointments.php");
    exit();
}

$sql = "
SELECT appointments.*,
patients.name,
doctors.doctor_name
FROM appointments
INNER JOIN patients
ON appointments.patient_id = patients.id
INNER JOIN doctors
ON appointments.doctor_id = doctors.doctor_id
";

$result = mysqli_query($conn,$sql);

include "../includes/header.php";
?>

<div class="page-card">

<h2>Appointments Management</h2>

<h3>Add Appointment</h3>

<form method="POST" class="simple-form">

<input type="text" name="patient_name" placeholder="Patient Name" required>

<select name="doctor_id" required>
    <option value="">Select Doctor</option>

    <?php
    $doctors2 = mysqli_query($conn,"SELECT * FROM doctors");

    while($row=mysqli_fetch_assoc($doctors2)){
    ?>
        <option value="<?php echo $row['doctor_id']; ?>">
            <?php echo $row['doctor_name']; ?>
        </option>
    <?php } ?>
</select>

<input type="date" name="appointment_date" required>

<input type="time" name="appointment_time" required>

<button type="submit" name="add_appointment">
Add Appointment
</button>

</form>

<h3>Appointments List</h3>

<table>
<tr>
<th>ID</th>
<th>Patient</th>
<th>Doctor</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>
<td><?php echo $row['appointment_id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['doctor_name']; ?></td>
<td><?php echo $row['appointment_date']; ?></td>
<td><?php echo $row['appointment_time']; ?></td>
<td><?php echo $row['status']; ?></td>
<td>
<a href="edit_appointment.php?id=<?php echo $row['appointment_id']; ?>">Edit</a>
|
<a href="delete_appointment.php?id=<?php echo $row['appointment_id']; ?>"
onclick="return confirm('Are you sure you want to delete this Appointment?');">
Delete
</a>
</td>
</tr>

<?php } ?>

</table>

</div>

<?php
include "../includes/footer.php";
?>