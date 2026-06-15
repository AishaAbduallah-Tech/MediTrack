<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

require_once "../config.php";

if(isset($_POST['add_doctor'])){
    $doctor_name = $_POST['doctor_name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $insert = "INSERT INTO doctors (doctor_name, specialization, phone, email)
               VALUES ('$doctor_name', '$specialization', '$phone', '$email')";

    mysqli_query($conn, $insert);

    header("Location: doctors.php");
    exit();
}

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];

    $sql = "SELECT * FROM doctors
            WHERE doctor_name LIKE '%$search%'
            OR specialization LIKE '%$search%'
            OR phone LIKE '%$search%'";
}else{
    $sql = "SELECT * FROM doctors";
}

$result = mysqli_query($conn, $sql);

include "../includes/header.php";
?>

<div class="page-card">

    <h2>Doctors Management</h2>

    <h3>Add New Doctor</h3>

    <form method="POST" class="simple-form">
        <input type="text" name="doctor_name" placeholder="Doctor Name" required>

        <input type="text" name="specialization" placeholder="Specialization" required>

        <input type="text" name="phone" placeholder="Phone" required>

        <input type="email" name="email" placeholder="Email" required>

        <input type="submit" name="add_doctor" value="Add Doctor">
    </form>

    <form method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search doctor by name, specialization or phone"
               value="<?php echo $search; ?>">

        <input type="submit" value="Search">

        <a href="doctors.php" class="reset-btn">Reset</a>
    </form>

    <h3>Doctors List</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Doctor Name</th>
            <th>Specialization</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['doctor_id']; ?></td>
                <td><?php echo $row['doctor_name']; ?></td>
                <td><?php echo $row['specialization']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="edit_doctor.php?id=<?php echo $row['doctor_id']; ?>">Edit</a>
                    |
                    <a href="delete_doctor.php?id=<?php echo $row['doctor_id']; ?>"
                       onclick="return confirm('Are you sure you want to delete this Doctor?');">
                       Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>

</div>

<?php include "../includes/footer.php"; ?>