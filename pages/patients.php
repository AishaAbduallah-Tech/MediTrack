<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

require_once "../config.php";

if (isset($_POST['add_patient'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];

    $sql_insert = "INSERT INTO patients (name, age, phone, register_date)
                   VALUES ('$name', '$age', '$phone', CURDATE())";

    mysqli_query($conn, $sql_insert);

    header("Location: patients.php");
    exit();
}

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];

    $sql = "SELECT * FROM patients 
            WHERE name LIKE '%$search%' 
            OR phone LIKE '%$search%'";
}else{
    $sql = "SELECT * FROM patients";
}

$result = mysqli_query($conn, $sql);

include "../includes/header.php";
?>

<div class="page-card">

    <h2>Patients Management</h2>

    <h3>Add New Patient</h3>

    <form method="POST" class="simple-form">
        <input type="text" name="name" placeholder="Patient Name" required>

        <input type="number" name="age" placeholder="Age" required>

        <input type="text" name="phone" placeholder="Phone" required>

        <input type="submit" name="add_patient" value="Add Patient">
    </form>

    <form method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search patient by name or phone"
               value="<?php echo $search; ?>">

        <input type="submit" value="Search">

        <a href="patients.php" class="reset-btn">Reset</a>
    </form>

    <h3>Patients List</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Phone</th>
            <th>Register Date</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['age']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['register_date']; ?></td>
                <td>
                    <a href="edit_patient.php?id=<?php echo $row['id']; ?>">Edit</a>
                    |
                    <a href="delete_patient.php?id=<?php echo $row['id']; ?>"
                       onclick="return confirm('Are you sure you want to delete this Patient?');">
                       Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>

</div>

<?php include "../includes/footer.php"; ?>
