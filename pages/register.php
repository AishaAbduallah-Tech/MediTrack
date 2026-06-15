<?php
session_start();
require_once "../config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users
            (username,email,phone,password,role)
            VALUES
            ('$username','$email','$phone','$password','User')";

    if(mysqli_query($conn,$sql)){
        $success = "تم إنشاء الحساب بنجاح";
    }else{
        $error = "حدث خطأ أثناء إنشاء الحساب";
    }
}
?>

<?php include("../includes/header.php"); ?>

<div class="login-card">

    <h2>إنشاء حساب جديد</h2>

    <?php
    if(isset($success)){
        echo "<p style='color:green;'>$success</p>";
    }

    if(isset($error)){
        echo "<p style='color:red;'>$error</p>";
    }
    ?>

    <form method="post">

        <input type="text"
               name="username"
               placeholder="اسم المستخدم"
               required>

        <input type="email"
               name="email"
               placeholder="البريد الإلكتروني"
               required>

        <input type="text"
               name="phone"
               placeholder="رقم الجوال"
               required>

        <input type="password"
               name="password"
               placeholder="كلمة المرور"
               required>

        <input type="submit"
               value="إنشاء حساب">

    </form>

    <p class="register-link">
        لديك حساب بالفعل؟
        <a href="/smart_health_system/pages/login.php">
            تسجيل الدخول
        </a>
    </p>

</div>

<?php include("../includes/footer.php"); ?>
