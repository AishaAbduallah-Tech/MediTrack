<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

require_once "config.php";
include "includes/header.php";

$keyword = "";

if(isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];
}
?>

<h2>Search Results</h2>

<form method="GET" action="search.php">
    <input type="text" name="keyword" placeholder="Search patients or doctors"
           value="<?php echo $keyword; ?>" required>
    <input type="submit" value="Search">
</form>

<hr>

<h3>Patients Results</h3>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Age</th>
    <th>Phone</th>
</tr>

<?php
$patients = mysqli_query($conn,
"SELECT * FROM patients
 WHERE name LIKE '%$keyword%'
 OR phone LIKE '%$keyword%'");

while($row = mysqli_fetch_assoc($patients)){
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['age']; ?></td>
    <td><?php echo $row['phone']; ?></td>
</tr>
<?php } ?>
</table>

<h3>Doctors Results</h3>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Doctor Name</th>
    <th>Specialization</th>
    <th>Phone</th>
    <th>Email</th>
</tr>

<?php
$doctors = mysqli_query($conn,
"SELECT * FROM doctors
 WHERE doctor_name LIKE '%$keyword%'
 OR specialization LIKE '%$keyword%'
 OR phone LIKE '%$keyword%'
 OR email LIKE '%$keyword%'");

while($row = mysqli_fetch_assoc($doctors)){
?>
<tr>
    <td><?php echo $row['doctor_id']; ?></td>
    <td><?php echo $row['doctor_name']; ?></td>
    <td><?php echo $row['specialization']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['email']; ?></td>
</tr>
<?php } ?>
</table>

<?php
include "includes/footer.php";
?>