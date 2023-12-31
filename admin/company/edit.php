<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $com_id = $_POST['com_id'];
    $com_status = $_POST['com_status'];

    $stmt = $connect->prepare("UPDATE company_register SET com_status=? WHERE com_id=?");
    $stmt->execute([$com_status, $com_id]);

    if ($stmt) {
        $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id = ? AND com_status = 1 ");
        $stmt->execute(array($com_id));
        $com_data = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $to_email = $com_data['com_email'];
            $subject = " تفعيل حساب الشركة ";
            $body = "  رااائع !!  لقد تم تفعيل الحساب الخاص بك علي منصة  انتقاء يمكنك الان تكوين الفريق الخاص بك  ";
            $headers = "From: info@entiqa.online";
            mail($to_email, $subject, $body, $headers);
        }


?>
        <div class="container">
            <div class="alert-success">
                تم تعديل حالة الشركه بنجاح
                <?php // header('refresh:3,url=main.php?dir=city&page=report'); 
                header('Location:main.php?dir=company&page=report');
                ?>
            </div>
        </div>

<?php }
}
