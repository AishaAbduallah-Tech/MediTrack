<?php include("../includes/header.php"); ?>

<div class="page-card">
    <h2>الاستعلامات</h2>

    <p class="page-desc">
        يمكنك من خلال هذه الصفحة الاستعلام عن بيانات المرضى، الأطباء، أو المواعيد داخل نظام MediTrack.
    </p>

    <div class="inquiry-grid">

        <div class="inquiry-box">
            <h3>استعلام عن مريض</h3>
            <p>البحث عن بيانات المرضى المسجلين في النظام.</p>
            <a href="/smart_health_system/pages/patients.php">عرض المرضى</a>
        </div>

        <div class="inquiry-box">
            <h3>استعلام عن طبيب</h3>
            <p>عرض بيانات الأطباء والتخصصات المتاحة.</p>
            <a href="/smart_health_system/pages/doctors.php">عرض الأطباء</a>
        </div>

        <div class="inquiry-box">
            <h3>استعلام عن موعد</h3>
            <p>متابعة مواعيد المرضى وحالة كل موعد.</p>
            <a href="/smart_health_system/pages/appointments.php">عرض المواعيد</a>
        </div>
		<div class="inquiry-box">
    <h3>حجز موعد جديد</h3>
    <p>يمكنك إضافة موعد جديد للمريض مع الطبيب المناسب.</p>
    <a href="/smart_health_system/pages/appointments.php">حجز موعد</a>
</div>

    </div>
</div>

<?php include("../includes/footer.php"); ?>
