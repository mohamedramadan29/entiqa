<?php
$pagetitle = ' استعادة كلمة المرور ';
ob_start();
session_start();
include 'init.php';
?>
<div class="register_form forget_email">
    <div class="container">
        <div class="data">
            <br> <br> <br> <br>
            <h2> استعادة كلمة المرور </h2>
            <form class="message_form" action="#" method="post">
                <div class="box">
                    <?php
                    $code = substr(sha1(mt_rand()), 17, 6);
                    ?>
                    <p class="alert alert-success">
                        <?php echo $_SESSION['mail']; ?> تم ارسال كود الي البريد الإلكتروني الخاص بك
                    </p>
                    <label for=""> من فضلك ادخل الكود <span class="star"> * </span> </label>
                    <input class="form-control" type="text" name="code">
                </div>
                <div class="box">
                    <button type="submit" class="btn" style="background-color:#f16583;border-color:#f16583;color:#fff;"> استمر </button>
                </div>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $code = $_POST["code"];
                $stmt = $connect->prepare("SELECT code FROM ind_register WHERE code= ?");
                $stmt->execute(array($code));
                $data = $stmt->fetch();
                $count = $stmt->rowCount();
                if ($count > 0) {
                    header('Location:forget_password');
                    if ($stmt) { ?>
                        <div class="container">
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="container">
                        <div class="alert alert-danger text-center mt-2 fw-bold"> هذا الكود غير صحيح </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- END MAIN ABOUT -->
<?php

include $tem . "footer.php";
ob_end_flush();

?>