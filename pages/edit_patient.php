<?php
session_start();
require_once "../config.php";

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM patients WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $name = $_POST['name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];

    mysqli_query($conn,
    "UPDATE patients
     SET name='$name',
         age='$age',
         phone='$phone'
     WHERE id=$id");

    header("Location: patients.php");
}
?>

<h2>Edit Patient</h2>

<form method="POST">

Name:<br>
<input type="text" name="name"
value="<?php echo $row['name']; ?>"><br><br>

Age:<br>
<input type="number" name="age"
value="<?php echo $row['age']; ?>"><br><br>

Phone:<br>
<input type="text" name="phone"
value="<?php echo $row['phone']; ?>"><br><br>

<input type="submit"
name="update"
value="Update Patient">

</form>