<?php
ob_start();
session_start();
$pagetitle = ' تفعيل الحساب  ';
include 'init.php';
if (isset($_GET['active_code'])) {
    $active_code = $_GET['active_code'];
}else{
    header("Location:../index");
}
?>
<!--<div class="register_form forget_email activate_code" style='background-color:#f1f1f1'>-->
<!--    <div class="container">-->
<!--        <div class="data">-->
<!--            <h2> تفعيل الحساب الخاص بك علي انتقاء </h2>-->
<!--            <form class="message_form" action="#" method="POST"> <!-- عدلت وحطيت رابط الفورم -->-->
<!--                --><?php
//                $email = $_SESSION['mail'];
//                ?>
<!--                <div class="box">-->
<!--                    <label for=""> من فضلك ادخل كود التفعيل المرسل علي البريد الالكتروني </label>-->
<!--                    <input required class="form-control" type="text" name="code" placeholder="  ">-->
<!--                </div>-->
<!--                <div class="box">-->
<!--                    <button name="active_code" type="submit" class="btn btn-primary" style="margin: auto; display: block;"> تفعيل </button>-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<?php
if (isset($_GET['active_code'])){
    $active_code = $_GET['active_code'];
        $stmt = $connect->prepare("SELECT * FROM ind_register WHERE active_status_code =? ");
        $stmt->execute(array($active_code));
        $count = $stmt->rowCount();
        if ($count > 0) {
            $stmt = $connect->prepare("UPDATE ind_register SET active_status = 1 WHERE active_status_code=?");
            $stmt->execute(array($active_code));
            ?>
            <div class="section section-md contact_us login_page" style='background-color:#f1f1f1'>
                <div class="container">
                    <div class="register_form">
                        <div class="alert alert-success"> تم تفعيل الحساب بنجاح سجل دخول الان </div>
                    </div>
                </div>
            </div>
            <?php
            header("refresh:1;url=login");
        } else {
            ?>
            <div class="alert alert-danger"> كود التفعيل الخاص بك خطأ </div>
            <?php
        }

}


?>