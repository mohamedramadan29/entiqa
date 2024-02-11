<?php
$pagetitle = ' استعادة كلمة المرور ';
ob_start();
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail/vendor/autoload.php';
$ind_navabar = 'ind';
include 'init.php'; ?>
<div class="register_form forget_email">
    <div class="container">
        <div class="data">
            <br> <br> <br> <br>
            <h2> استعادة كلمة المرور </h2>
            <form class="login" action="#" method="post">
                <div class="box">
                    <?php
                    $code = rand(1, 55555);
                    ?>
                    <input class="form-control" type="text" name="email" placeholder="  البريد الإلكتروني  ">
                </div>
                <div class="box">
                    <button type="submit" class="btn btn-primary button"> استمر </button>
                </div>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST["email"];
                $_SESSION['mail'] = $email;
                $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_email= ?");
                $stmt->execute(array($email));
                $data = $stmt->fetch();
                $user_name = $data['ind_name'];
                $count = $stmt->rowCount();
                if ($count > 0) {
                    $stmt = $connect->prepare("UPDATE ind_register SET code=? WHERE ind_email=?");
                    $stmt->execute(array($code, $email));
                    if ($stmt) { ?>
                        <div class="container">
                            <div class="alert alert-success text-center mt-2 fw-bold"> تم ارسال الكود الخاص بك الي البريد الالكروني
                                <?php echo $email ?>
                            </div>
                        </div>
                    <?php
                        $mail = new PHPMailer(true);
                        try {
                            // الإعدادات الأساسية لإعداد البريد الإلكتروني
                            $mail->CharSet = 'UTF-8';
                            $mail->WordWrap = true;
                            $mail->isSMTP();
                            $mail->Host = 'entiqa.co';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'support@entiqa.co';
                            $mail->Password = 'mohamedramadan2930';
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            //To load the French version
                            // $mail->setLanguage('ar');
                            $mail->Port = 587;
                            // مُحتوى الرسالة
                            $mail->setFrom('support@entiqa.co', 'انتقاء');
                            $mail->addAddress($email, $user_name);
                            $mail->Subject = ' تعديل كلمة المرور ';
                            $mail->Body = " <p style='font-size:18px; font-family:inherit'> مرحبا ! استعادة كلمة المرور الخاصة بك علي منصة انتقاء " . $user_name . ",</p>
                                            <p style='font-size:18px; font-family:inherit'> الكود الخاص بك هو  .</p>
                                            <p><strong>" . $code . "</strong></p>
                                    ";
                            $mail->AltBody = 'This is the plain text message body for non-HTML mail clients.';
                            // إرسال البريد الإلكتروني
                            $mail->send();
                        } catch (Exception $e) {
                            echo "حدث خطأ في إرسال البريد الإلكتروني: {$mail->ErrorInfo}";
                        }
                        // $to_email = $email;
                        // $subject = "استعادة كلمة المرور";
                        // $body = "الكود الخاص بك هو " . $code . '';
                        // $headers = "From: info@entiqa.online";
                        // mail($to_email, $subject, $body, $headers);
                        header('Location:forget_code');
                    }
                } else {
                    ?>
                    <div class="container">
                        <div class="alert alert-danger text-center mt-2 fw-bold"> عفوا هذا البريد الالكتروني غير صحيح </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php

include $tem . "footer.php";


?>