<?php
session_start();
require_once "../config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users
            WHERE email='$email'
            AND password='$password'";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){

        $user = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $user['username'];

        header("Location: ../index.php");
        exit();

    }else{
        $error = "البريد الإلكتروني أو كلمة المرور غير صحيحة";
    }
}
?>

<?php include("../includes/header.php"); ?>

<div class="login-card">

    <h2>تسجيل الدخول</h2>

    <?php
    if(isset($error)){
        echo "<p style='color:red;'>$error</p>";
    }
    ?>

    <p>مرحبًا بك في نظام MediTrack</p>

    <form method="post">

        <input type="email"
               name="email"
               placeholder="البريد الإلكتروني"
               required>

        <input type="password"
               name="password"
               placeholder="كلمة المرور"
               required>

        <input type="submit"
               value="تسجيل الدخول">

    </form>

    <p class="register-link">
        ليس لديك حساب؟
        <a href="/smart_health_system/pages/register.php">
            إنشاء حساب جديد
        </a>
    </p>

</div>

<?php include("../includes/footer.php"); ?>
