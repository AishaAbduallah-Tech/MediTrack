<?php include("../includes/header.php"); ?>

<div class="page-card">

    <h2>تواصل معنا</h2>

    <p class="page-desc">
        يسعدنا استقبال استفساراتكم وملاحظاتكم حول نظام MediTrack.
    </p>

    <div class="contact-layout">

        <div class="contact-card">
            <h3>MediTrack Support</h3>

            <p>📧 <strong>البريد الإلكتروني:</strong> support@meditrack.com</p>
            <p>📱 <strong>رقم الهاتف:</strong> +966 50 123 4567</p>
            <p>📍 <strong>العنوان:</strong> جدة - المملكة العربية السعودية</p>
        </div>

        <form class="contact-form" method="post">
            <input type="text" name="name" placeholder="الاسم الكامل" required>

            <input type="email" name="email" placeholder="البريد الإلكتروني" required>

            <textarea name="message" placeholder="اكتب رسالتك هنا" required></textarea>

            <input type="submit" value="إرسال الرسالة">
        </form>

    </div>

</div>

<?php include("../includes/footer.php"); ?>
