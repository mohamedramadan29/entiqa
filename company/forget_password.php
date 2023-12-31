<?php
ob_start();
$pagetitle = ' استعادة كلمة المرور ';
session_start();
include 'init.php';
?>
<div class="register_form forget_email">
    <div class="container">
        <div class="data">
            <form class="message_form" action="#" method="post">
                <?php
                $email = $_SESSION['mail'];
                ?>
                <div class="box">
                    <input class="form-control passwordinput" type="password" name="password"
                        placeholder="كلمة مرور جديدة ">
                </div>
                <div class="box">
                    <input class="form-control passwordinput" type="password" name="confirm_password"
                        placeholder="تأكيد كلمة المرور">
                </div>
                <div class="box">
                    <button type="submit" class="btn btn-primary"> تحديث </button>
                </div>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $password = $_POST["password"];
                $confirm_password = $_POST['confirm_password'];
                $formerror = [];
                if (empty($password)) {
                    $formerror[] = ' من فضلك ادخل كلمة المرور ';
                }
                if ($password !== $confirm_password) {
                    $formerror[] = 'تاكيد كلمة المرور غير متطابق ';
                }
                if (strlen($password) < 8) {
                    $formerror[] = " كلمة المرور يجب ان تكون اكثر من 8 احرف وارقام ";
                }
                if (empty($formerror)) {
                    $stmt = $connect->prepare("UPDATE company_register SET com_password=? WHERE com_email=?");
                    $stmt->execute(array($password, $email));
                    if ($stmt) {

                        $to_email = $email;
                        $subject = "   تغير كلمة المرور  ";
                        $body = "  تم تغير كلمة المرور الخاصة بك بنجاح  علي منصة انتقاء ";
                        $headers = "From: info@entiqa.online";
                        mail($to_email, $subject, $body, $headers);
                        unset($_SESSION['mail']);
                        header('Location:login');
                        unset($_SESSION['mail']);
                        ?>
                        <div class="container">
                            <div class="alert alert-success text-center mt-2 fw-bold"> تم تعديل كلمة المرور بنجاح
                                <a class="login_forget" href="company_login.php"> | تسجيل دخول </a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    foreach ($formerror as $error) { ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fa fa-close"></i>
                            <?php echo $error; ?>
                        </div>
                        <?php
                    }
                }

            }
            ?>
        </div>
    </div>
</div>
<?php
include $tem . "footer.php";
ob_end_flush();

?>