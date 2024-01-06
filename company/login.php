<?php
$pagetitle = ' تسجيل دخول   ';
ob_start();
session_start();
$com_navbar = 'com';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'mail/vendor/autoload.php';

$mail = new PHPMailer(true);

include 'init.php';
if (!isset($_SESSION['com_id']) && !isset($_SESSION['ind_id'])) {
?>
    <!-- Contacts-->
    <section class="section section-md contact_us">
        <div class="container">
            <?php
            // resend email activation 
            if (isset($_POST["resend_email_active"])) {
                $emailoruser = $_POST['emailoruser'];
                $stmt = $connect->prepare("SELECT * FROM company_register WHERE (com_username=? OR com_email=?)");
                $stmt->execute(array($emailoruser, $emailoruser));
                $count_users = $stmt->rowCount();
                if ($count_users > 0) {
                    $com_data = $stmt->fetch();
                    $ind_email = $com_data['com_email'];
                    $ind_username = $com_data['com_username'];
                    $ind_name = $com_data['com_name'];
                    // Generate a unique activation code 
                    $activationCode = rand(1, 55555);
                    $stmt = $connect->prepare("UPDATE company_register SET active_status_code = ? WHERE com_username=?");
                    $stmt->execute(array($activationCode, $ind_username));

                    // START SEND MAIL ////////////////////////////////////
                    //Create an instance; passing `true` enables exceptions

                    try {
                        // الإعدادات الأساسية لإعداد البريد الإلكتروني
                        $mail->CharSet = 'UTF-8';
                        $mail->WordWrap = true;
                        $mail->isSMTP();
                        $mail->Host = 'entiqa.online';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'info@entiqa.online';
                        $mail->Password = 'mohamedramadan2930';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        //To load the French version
                        // $mail->setLanguage('ar');
                        $mail->Port = 587;

                        // مُحتوى الرسالة

                        $mail->setFrom('info@entiqa.online', 'انتقاء');
                        $mail->addAddress($ind_email, $ind_name);
                        $mail->Subject = 'تفعيل الحساب الخاص بك  ';
                        $mail->Body = " <p style='font-size:18px; font-family:inherit'>مرحبا " . $ind_username . ",</p>
                                                    <p style='font-size:18px; font-family:inherit'>شكرا لك على تسجيلك في انتقاء.</p>
                                                    <a  style='font-size:18px; font-family:inherit' href='https://entiqa.online/entiqa_test/company/activate?active_code=$activationCode' class='btn btn-primary'> أضغط هنا لتفعيل الحساب الخاص بك  </a>
                                            ";
                        $mail->AltBody = 'This is the plain text message body for non-HTML mail clients.';
                        // إرسال البريد الإلكتروني
                        $mail->send();
                        $_SESSION['mail'] = $ind_email;

                        // header('Location:activate');
            ?>
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                        <script>
                            new swal({
                                title: " شكرا لك   !",
                                text: " تم ارسال لينك التفعيل علي البريد الألكتروني الخاص بك ",
                                icon: "success",
                                button: "اغلاق",
                            });
                        </script>
                        <?php header('refresh:3;url=login'); ?>

                        <?php
                    } catch (Exception $e) {
                        echo "حدث خطأ في إرسال البريد الإلكتروني: {$mail->ErrorInfo}";
                    }
                    // END SEND MAIL //////////////////////////////////////
                }
            }


            if (isset($_POST["send_message"])) {
                $com_email = sanitizeInput($_POST["com_email"]);
                $password = sanitizeInput($_POST["password"]);
                $formerror = [];
                if (empty($com_email)) {
                    $formerror[] = " من فضلك ادخل البريد الالكتروني ";
                }
                if (empty($password)) {
                    $formerror[] = " يجب اضافة  كلمة المرور    ";
                }

                if (empty($formerror)) {
                    $stmt = $connect->prepare("SELECT * FROM company_register WHERE (com_username = ? OR com_email = ?) AND com_password = ?");
                    $stmt->execute(array($com_email, $com_email, $password));
                    $com_data = $stmt->fetch();
                    $count = $stmt->rowCount();
                    if ($count > 0) {
                        if ($com_data['active_status'] == 1) {
                            // إذا تم تحديد خانة "تذكرني"، قم بضبط الكوكيز
                            if (isset($_POST['remember_me'])) {
                                setcookie('email', $com_email, time() + (86400 * 30));
                                setcookie('pass', $password, time() + (86400 * 30));
                            }
                            $_SESSION['com_id'] = $com_data['com_id'];
                            $_SESSION['com_username'] = $com_data['com_username'];
                            header('Location:profile');
                            exit();
                        } else {
                        ?>
                            <div class="alert alert-danger text-center" role="alert"> من فضلك يجب عليك تفعيل الحساب الخاص بك اولا من خلال الايميل المرسل
                                <form action="" method="post">
                                    <input type="hidden" name="emailoruser" value="<?php echo $com_email ?>">
                                    <button class="btn btn-primary mt-3" type="submit" name="resend_email_active"> إعادة ارسال </button>
                                </form>

                            </div>
                        <?php
                        }
                    } else { ?>
                        <div class="alert alert-danger"> لا يوجد سجل بهذة البيانات من فضلك اعد المحاولة مرة اخري </div>
                    <?php
                    }
                } else {
                    foreach ($formerror as $error) { ?>

                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>

            <?php

                    }
                }
            }
            ?>
            <div class="register_form">
                <div class="row">
                    <h2>تسجيل دخول </h2>
                    <div class="col-12">
                        <!--RD Mailform-->
                        <form class="login" method="post" action="" autocomplete="off">
                            <div class="row row-10">
                                <div class="col-md-12">
                                    <div class="box">
                                        <input autocomplete="off" value="<?php if (isset($_COOKIE['email'])) {
                                                                                echo $_COOKIE['email'];
                                                                            } ?>" class="form-control" id="contact-last-name" type="text" name="com_email" required placeholder=" اسم المستخدم او  البريد الالكتروني ">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="box">
                                        <input autocomplete="off" class="form-control" id="password" type="password" value="<?php if (isset($_COOKIE['pass'])) {
                                                                                                                                echo $_COOKIE['pass'];
                                                                                                                            } ?>" name="password" required placeholder="كلمة المرور ">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex">
                                        <input style="width: 15px; height: 15px;" type="checkbox" id="remember_me" name="remember_me">
                                        <label for="remember_me" style="margin-right: 15px; color:#000;">تذكرني</label>
                                    </div>
                                    <div>
                                        <a href="forget_email" style="color: #000; text-align:left"> نسيت كلمة المرور ؟ </a>
                                    </div>
                                </div>

                                <div class="submit_button">
                                    <button class="button button-size-1 button-block button-primary" type="submit" name="send_message"> تسجيل دخول </button>
                                </div>
                                <div class="have_accout">
                                    <p class="text-center"> ليس لديك حساب ؟ <a href="register"> افتح حساب الأن </a> </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php

    include $tem . "footer.php";
} else {
    header('Location:index');
    exit();
}
