<!doctype html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login_form/fonts/icomoon/style.css">
    <link rel="stylesheet" href="login_form/css/owl.carousel.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="login_form/css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="login_form/css/style.css">
</head>

<body>
    <div class="d-md-flex half text-right">
        <div class="bg" style="background-image: url('login_form/images/bg_1.jpg');"></div>
        <div class="contents">
            <div class="container">
                <?php
                $pagetitle = 'نسيت كلمة المرور';
                ob_start();
                session_start();
                $Nonavbar = '';

                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\Exception;

                require 'vendor/autoload.php';
                include 'init.php';

                $length = 8; // Set the length of the random string
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Set the characters to use
                $randomString = '';

                // Generate the random string
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, strlen($characters) - 1)];
                }
                $randomString =  substr($randomString, 0, 8);
                ?>
                <?php
                if (isset($_POST['forget_password'])) {
                    $username_email = $_POST['username_email'];
                    $permision = $_POST['select_permision'];
                    $formerror = [];
                    if (empty($username_email)) {
                        $formerror[] = ' من فضلك ادخل اسم المستخدم او البريد الالكتروني  ';
                    }
                    if (empty($formerror)) {
                        if ($permision == 'admin') {
                            $stmt = $connect->prepare(
                                'SELECT  * FROM admin WHERE (admin_name=? OR admin_email = ?)'
                            );
                            $stmt->execute(array($username_email, $username_email));
                            $data = $stmt->fetch();
                            $count = $stmt->rowCount();
                            if ($count > 0) {
                                $stmt = $connect->prepare("UPDATE admin SET pass_code=?, admin_password=? WHERE admin_name=?");
                                $stmt->execute(array($randomString, $randomString, $data['admin_name']));
                                $to_email = $data['admin_email'];
                                $to_name = $data['admin_name'];
                            }
                        } elseif ($permision == 'services') {
                            $stmt = $connect->prepare(
                                'SELECT  * FROM service_team WHERE (name=? OR email = ?)'
                            );
                            $stmt->execute(array($username_email, $username_email));
                            $data = $stmt->fetch();
                            $count = $stmt->rowCount();
                            if ($count > 0) {
                                $stmt = $connect->prepare("UPDATE service_team SET pass_code=?, password=? WHERE name=?");
                                $stmt->execute(array($randomString, $randomString, $data['name']));
                                $to_email = $data['email'];
                                $to_name = $data['name'];
                            }
                        } elseif ($permision == 'coash') {
                            $stmt = $connect->prepare(
                                'SELECT  * FROM coshes WHERE (co_name=? OR co_email = ?)'
                            );
                            $stmt->execute(array($username_email, $username_email));
                            $data = $stmt->fetch();
                            $count = $stmt->rowCount();
                            if ($count > 0) {
                                $stmt = $connect->prepare("UPDATE coshes SET pass_code=?, co_password=? WHERE co_name=?");
                                $stmt->execute(array($randomString, $randomString, $data['co_name']));
                                $to_email = $data['co_email'];
                                $to_name = $data['co_name'];
                            }
                        }
                        $mail = new PHPMailer(true);
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
                            $mail->addAddress($to_email, $to_name);
                            $mail->Subject = ' تعديل كلمة المرور ';
                            $mail->Body = " <p style='font-size:18px; font-family:inherit'>مرحبا " . $to_name . ",</p>
                                                <p style='font-size:18px; font-family:inherit'> كلمة المرور الجديدة الخاصة بك هي  .</p>
                                                <p><strong>" . $randomString . "</strong></p>
                                        ";
                            $mail->AltBody = 'This is the plain text message body for non-HTML mail clients.';
                            // إرسال البريد الإلكتروني
                            $mail->send();
                        } catch (Exception $e) {
                            echo "حدث خطأ في إرسال البريد الإلكتروني: {$mail->ErrorInfo}";
                        }
                        if ($stmt) {
                ?>
                            <li class="alert alert-success"> تم ارسال كلمة المرور الجديدة علي الايميل الخاص بك ( <?php echo $to_email; ?> ) </li>

                        <?php
                            header('refresh:4;url=index');
                        }
                    } else { ?>
                        <ul>
                            <?php
                            foreach ($formerror as $error) {
                            ?>
                                <li class="alert alert-danger"> <?php echo $error; ?> </li>
                            <?php
                            }
                            ?>
                        </ul>
                <?php
                    }
                }

                ?>
                <div class="row align-items-center justify-content-center" style="margin-top: 13%; margin-bottom:1px">
                    <div class="col-md-12">
                        <div class="form-block mx-auto">
                            <div class="text-center mb-5">
                                <h3 class="text-uppercase"> نسيت كلمة المرور <strong></strong></h3>
                            </div>
                            <form action="" method="POST">
                                <div class="form-group first">
                                    <label for=""> اسم المستخدم او البريد الالكتروني </label>
                                    <input required type="text" name="username_email" id="username_email" class="form-control" value="<?php if (isset($_REQUEST['username_email'])) echo $_REQUEST['username_email'] ?>" class="form-control">
                                </div>
                                <div class="form-group last mb-3">
                                    <label for="password"> اختر الصلاحية </label>
                                    <select required name="select_permision" id="" class="form-control select2">
                                        <option value=""> -- اختر --</option>
                                        <option value="admin"> الادمن </option>
                                        <option value="services"> فريق الخدمة </option>
                                        <option value="coash"> المدرب </option>
                                    </select>
                                </div>
                                 
                                <button class="btn btn-primary" name="forget_password" type="submit"> تاكيد </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="login_form/js/jquery-3.3.1.min.js"></script>
    <script src="login_form/js/popper.min.js"></script>
    <script src="login_form/js/bootstrap.min.js"></script>
    <script src="login_form/js/main.js"></script>
</body>

</html>

<?php

if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
}
if (isset($_SESSION['com_id'])) {
    unset($_SESSION['com_id']);
}
if (isset($_SESSION['coash_id'])) {
    unset($_SESSION['coash_id']);
}
if (isset($_SESSION['admin_session'])) {
    unset($_SESSION['admin_session']);
}
if (isset($_SESSION['serv_name'])) {
    unset($_SESSION['serv_name']);
}
session_destroy();

?>