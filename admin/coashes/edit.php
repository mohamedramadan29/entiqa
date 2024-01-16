<?php

if (!isset($_SESSION['admin_session'])) {
    header("Location:index");
}
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../ind/mail/vendor/autoload.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $formerror = [];
    $co_id = $_POST['co_id'];
    $co_name = sanitizeInput($_POST['co_name']);
    $co_email = sanitizeInput($_POST['co_email']);
    $co_phone = sanitizeInput($_POST['co_phone']);
    $co_services = sanitizeInput($_POST['co_services']);
    $co_exper = sanitizeInput($_POST['co_exper']);
    if (!empty(sanitizeInput($_POST['co_password']))) {
        $co_password = sanitizeInput($_POST['co_password']);
        $confirm_password = sanitizeInput($_POST['confirm_password']);
        if (strlen($co_password) < 8) {
            $formerror[] = 'كلمة المرور يجب ان تكون اكثر من 8 حروف وارقام';
        }
        if ($co_password !== $confirm_password) {
            $formerror[] = 'يجب تاكيد كلمة المرور بشكل صحيح ';
        }

        // يسمح بالأحرف الإنجليزية (كبيرة وصغيرة) والأرقام
        if (!preg_match('/^[a-zA-Z0-9!@#$%^&*()_+]+$/', $co_password)) {
            $formerror[] = "كلمة المرور يجب أن تحتوي على الأحرف الإنجليزية والأرقام والرموز الخاصة.";
        }
    }

    if (empty($co_name) || empty($co_email) || empty($co_phone) || empty($co_services) || empty($co_exper)) {
        $formerror[] = 'من فضلك ادخل المعلومات كاملة';
    }


    if (!preg_match('/^[a-zA-Z]+$/', $co_name)) {
        $formerror[] = ' يجب ان تكون الحروف المستخدمة فى  الاسم حروف انجليزية فقط ';
    }


    if (!is_numeric($co_phone) || strlen($co_phone) < 8 || strlen($co_phone) > 20) {
        $formerror[] = 'من فضلك، أدخل رقم هاتف صحيح بين 8 و 20 رقمًا.';
    }

    if (empty($co_email)) {
        $formerror[] = " يجب اضافة البريد الالكتروني  ";
    } elseif (!filter_var($co_email, FILTER_VALIDATE_EMAIL)) {
        $formerror[] = " يجب إدخال عنوان بريد إلكتروني صالح ";
    } elseif (strlen($co_email) > 100) {
        $formerror[] = "طول البريد الإلكتروني يجب أن لا يتجاوز 100 حرفًا";
    } elseif (!preg_match('/^[a-zA-Z0-9.@]+$/', $co_email)) {
        $formerror[] = "البريد الإلكتروني يجب أن يحتوي على أحرف وأرقام ورموز صحيحة فقط";
    } elseif (strpos($co_email, '..') !== false) {
        $formerror[] = "البريد الإلكتروني يحتوي على أحرف غير صالحة";
    }

    $stmt = $connect->prepare("SELECT * FROM coshes WHERE co_name=? AND co_id !=?");
    $stmt->execute(array($co_name, $co_id));
    $name_count = $stmt->rowCount();
    if ($name_count > 0) {
        $formerror[] = 'اسم المدرب موجود من قبل من فضلك ادخل اسم جديد ';
    }
    $stmt = $connect->prepare("SELECT * FROM coshes WHERE co_email=? AND co_id !=?");
    $stmt->execute(array($co_email, $co_id));
    $email_count = $stmt->rowCount();
    if ($email_count > 0) {
        $formerror[] = ' البريد الألكتروني مستخدم بالفعل من فضلك ادخل بريد الكتروني جديد ';
    }
    // check the email in the Services team members
    $stmt = $connect->prepare("SELECT * FROM service_team WHERE email=?");
    $stmt->execute(array($co_email));
    $count_coash_mail = $stmt->rowCount();
    if ($count_coash_mail > 0) {
        $formerror[] = 'البريد الألكتروني مستخدم بالفعل في قسم فريق الخدمة  من فضلك اختر بريد الكتروني جديد ';
    }
    // check the user name in the Services team members
    $stmt = $connect->prepare("SELECT * FROM service_team WHERE name=?");
    $stmt->execute(array($co_name));
    $count_coash_mail = $stmt->rowCount();
    if ($count_coash_mail > 0) {
        $formerror[] = 'اسم المستخدم مستخدم بالفعل في قسم فريق الخدمة من فضلك اختر اسم جديد ';
    }
    $stmt = $connect->prepare("SELECT * FROM coshes WHERE co_phone=?  AND co_id !=?");
    $stmt->execute(array($co_phone, $co_id));
    $phone_count = $stmt->rowCount();
    if ($phone_count > 0) {
        $formerror[] = ' رقم الهاتف مستخدم من قبل  ';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE coshes SET co_name=?,co_phone=?,co_email=?,co_services=?,co_exper=? WHERE co_id=?");
        $stmt->execute([$co_name, $co_phone, $co_email, $co_services, $co_exper, $co_id]);
        if (!empty(sanitizeInput($_POST['co_password']))) {
            $stmt = $connect->prepare("UPDATE coshes SET co_password=? WHERE co_id=?");
            $stmt->execute([$co_password, $co_id]);
        }
        if ($stmt) {
            // START SEND MAIL ////////////////////////////////////
            //Create an instance; passing `true` enables exceptions
            /*
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
                //To load the French version
                // $mail->setLanguage('ar');
                $mail->Port = 587;

                // مُحتوى الرسالة

                $mail->setFrom('test@entiqa.online', 'انتقاء');
                $mail->addAddress($co_email, $co_name);
                $mail->Subject = 'تعديل معلومات تسجيل الدخول الخاصة بك كمدرب علي منصة انتقاء  ';
                $mail->Body = " <p style='font-size:18px; font-family:inherit'>مرحبا " . $co_name . ",</p>
                                                    <p style='font-size:18px; font-family:inherit'>اسم المستخدم الخاص بك .</p>
                                                    <p><strong>" . $co_name . "</strong></p>
                                                    <p style='font-size:18px; font-family:inherit'>كلمة المرور.</p>
                                                    <p><strong>" . $co_password . "</strong></p>
                                            ";
                $mail->AltBody = 'This is the plain text message body for non-HTML mail clients.';
                // إرسال البريد الإلكتروني
                $mail->send();
                $_SESSION['mail'] = $co_email;
                header('Location:activate');
            } catch (Exception $e) {
                echo "حدث خطأ في إرسال البريد الإلكتروني: {$mail->ErrorInfo}";
            }
            // END SEND MAIL //////////////////////////////////////
            */

?>
            <div class="container">
                <div class="alert-success">
                    تم تعديل المدرب بنجاح
                    <?php
                    $_SESSION['success_message'] = " تم التعديل بنجاح  ";
                    header("Location:main.php?dir=coashes&page=report");

                    ?>
                </div>
            </div>
<?php }
    } else {
        foreach ($formerror as $errors) {
            $_SESSION['error_messages'] = $formerror;

            echo "<div class='alert alert-danger danger_message'>" .
                $errors .
                '</div>';
        }
        header("Location:main.php?dir=coashes&page=report");
    }
}
