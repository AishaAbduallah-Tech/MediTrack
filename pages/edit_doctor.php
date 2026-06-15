<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

require_once "../config.php";
include "../includes/header.php";

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM doctors WHERE doctor_id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update_doctor'])){

    $doctor_name = $_POST['doctor_name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    mysqli_query($conn,
    "UPDATE doctors
     SET doctor_name='$doctor_name',
         specialization='$specialization',
         phone='$phone',
         email='$email'
     WHERE doctor_id=$id");

    header("Location: doctors.php");
    exit();
}
?>

<h2>Edit Doctor</h2>

<form method="POST">

<label>Doctor Name</label><br>
<input type="text" name="doctor_name" value="<?php echo $row['doctor_name']; ?>" required><br><br>

<label>Specialization</label><br>
<input type="text" name="specialization" value="<?php echo $row['specialization']; ?>" required><br><br>

<label>Phone</label><br>
<input type="text" name="phone" value="<?php echo $row['phone']; ?>" required><br><br>

<label>Email</label><br>
<input type="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

<input type="submit" name="update_doctor" value="Update Doctor">

</form>

<?php
include "../includes/footer.php";
?>