<?php
ob_start();
$pagetitle = ' استعادة كلمة المرور ';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail/vendor/autoload.php';
include 'init.php';
?>
<div class="register_form forget_email">
    <div class="container">
        <div class="data">
            <form class="login" action="#" method="post">
                <div class="box">
                    <?php
                    $code = rand(1, 55555);
                    ?>
                    <label for=""><span class="star"> * </span> البريد الإلكتروني </label>
                    <input class="form-control" type="text" name="email">
                </div>
                <div class="box">
                    <button type="submit" class="btn btn-primary"> استمر </button>
                </div>
            </form> <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $email = $_POST["email"];
                        $_SESSION['mail'] = $email;
                        $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_email= ?");
                        $stmt->execute(array($email));
                        $data = $stmt->fetch();
                        $user_name = $data['com_name'];
                        $count = $stmt->rowCount();
                        if ($count > 0) {
                            $stmt = $connect->prepare("UPDATE company_register SET code=? WHERE com_email=?");
                            $stmt->execute(array($code, $email));
                            if ($stmt) { ?> <div class="container">
                            <div class="alert alert-success text-center mt-2 fw-bold"> تم ارسال الكود الخاص بك الي البريد الالكروني <?php echo $email ?>
                            </div>
                        </div> <?php
                                $mail = new PHPMailer(true);
                                try {
                                    // الإعدادات الأساسية لإعداد البريد الإلكتروني
                                    $mail->CharSet = 'UTF-8';
                                    $mail->WordWrap = true;
                                    $mail->isSMTP();
                                    $mail->Host = 'entiqa.online';
                                    $mail->SMTPAuth = true;
                                    $mail->Username = 'test@entiqa.online';
                                    $mail->Password = 'mohamedramadan2930';
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                                    $mail->Port = 587;
                                    // مُحتوى الرسالة
                                    $mail->setFrom('test@entiqa.online', 'انتقاء');
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

                                header('Location:forget_code.php');
                            }
                        } else {
                                ?> <div class="container">
                        <div class="alert alert-danger text-center mt-2 fw-bold"> عفوا هذا البريد الالكتروني غير صحيح </div>
                    </div> <?php
                        }
                    }
                            ?>
        </div>
    </div>
</div>
<?php

include $tem . "footer.php";


?>