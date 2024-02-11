 <?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../ind/mail/vendor/autoload.php';
    $mail = new PHPMailer(true);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['add_car'])) {
            $name = sanitizeInput($_POST['name']);
            $password = sanitizeInput($_POST['password']);
            $confirm_password = sanitizeInput($_POST['confirm_password']);
            $email =  sanitizeInput($_POST['email']);
            /// More Validation To Show Error
            $formerror = [];
            if (empty($email)) {
                $formerror[] = 'من فضلك ادخل البريد الألكتروني';
            }
            if (strlen($password) < 8) {
                $formerror[] = 'كلمة المرور يجب ان تكون اكبر من او تساوي 8 احرف وارقام';
            }
            if ($password !== $confirm_password) {
                $formerror[] = 'يجب تاكيد كلمة المرور بشكل صحيح ';
            }
            // check if email or user_name is used 
            $stmt = $connect->prepare("SELECT * FROM service_team WHERE email = ?");
            $stmt->execute(array($email));
            $count_mails = $stmt->rowCount();
            if ($count_mails > 0) {
                $formerror[] = 'البريد الألكتروني مستخدم من قبل من فضلك استخدم بريد الكتروني جديد';
            }
            // check if email or user_name is used 
            $stmt = $connect->prepare("SELECT * FROM service_team WHERE name = ?");
            $stmt->execute(array($name));
            $count_mails = $stmt->rowCount();
            if ($count_mails > 0) {
                $formerror[] = ' اسم المستخدم موجود من قبل من فضلك ادخل اسم مستخدم جديد';
            }
            // check the email in the coashes members
            $stmt = $connect->prepare("SELECT * FROM coshes WHERE co_email=?");
            $stmt->execute(array($email));
            $count_coash_mail = $stmt->rowCount();
            if ($count_coash_mail > 0) {
                $formerror[] = 'البريد الألكتروني مستخدم بالفعل في قسم المدربين من فضلك اختر بريد الكتروني جديد ';
            }
            // check the user name in the coashes members
            $stmt = $connect->prepare("SELECT * FROM coshes WHERE co_name=?");
            $stmt->execute(array($name));
            $count_coash_mail = $stmt->rowCount();
            if ($count_coash_mail > 0) {
                $formerror[] = 'اسم المستخدم مستخدم بالفعل في قسم المدربين من فضلك اختر اسم جديد ';
            }

            // check if email or user_name is used in individual
            $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_email = ?");
            $stmt->execute(array($email));
            $count_ind_mails = $stmt->rowCount();
            if ($count_ind_mails > 0) {
                $formerror[] = 'البريد الألكتروني مستخدم بالفعل في قسم المتدربين من فضلك اختر بريد الكتروني جديد ';
            }

            // check if email or user_name is used in company
            $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_email = ?");
            $stmt->execute(array($email));
            $count_com_mails = $stmt->rowCount();
            if ($count_com_mails > 0) {
                $formerror[] = 'البريد الألكتروني مستخدم بالفعل في قسم الشركات من فضلك اختر بريد الكتروني جديد ';
            }


            if (strlen($name) > 50) {
                $formerror[] = 'اسم المستخدم يجب ان يكون اقل من 50 حرف';
            }
            if (!preg_match('/^[a-zA-Z]+$/', $name)) {
                $formerror[] = ' يجب ان تكون الحروف المستخدمة فى اسم المستخدم حروف انجليزية فقط ';
            }

            if (empty($formerror)) {
                $stmt = $connect->prepare("INSERT INTO service_team (name,email,password)
                VALUES (:zname,:zemail,:zpassword)");
                $stmt->execute([
                    'zname' => $name,
                    'zemail' => $email,
                    'zpassword' => $password,
                ]);
                if ($stmt) {
                    // START SEND MAIL ////////////////////////////////////
                    //Create an instance; passing `true` enables exceptions

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
                        $mail->addAddress($email, $name);
                        $mail->Subject = ' معلومات تسجيل الدخول الخاصة بك  كعضو فريق خدمه  علي منصة انتقاء  ';
                        $mail->Body = " <p style='font-size:18px; font-family:inherit'>مرحبا " . $name . ",</p>
                                                    <p style='font-size:18px; font-family:inherit'>اسم المستخدم الخاص بك .</p>
                                                    <p><strong>" . $name . "</strong></p>
                                                    <p style='font-size:18px; font-family:inherit'>كلمة المرور.</p>
                                                    <p><strong>" . $password . "</strong></p>
                                            ";
                        $mail->AltBody = 'This is the plain text message body for non-HTML mail clients.';
                        // إرسال البريد الإلكتروني
                        $mail->send();
                        $_SESSION['mail'] = $email;
                    } catch (Exception $e) {
                        echo "حدث خطأ في إرسال البريد الإلكتروني: {$mail->ErrorInfo}";
                    }
                    // END SEND MAIL //////////////////////////////////////

                    $_SESSION['success_message'] = " تمت الأضافة بنجاح ";
    ?>
                 <div class="alert-success ">
                     تم اضافة عضو جديد بنجاح

                     <?php // header('refresh:3;url=main.php?dir=city&page=report'); 
                        header('Location:main.php?dir=service_team&page=report');
                        ?>
                 </div>
 <?php }
            } else {
                foreach ($formerror as $errors) {
                    $_SESSION['error_messages'] = $formerror;
                    header('Location:main.php?dir=service_team&page=report');
                    echo "<div class='alert alert-danger danger_message'>" .
                        $errors .
                        '</div>';
                }
            }
        }
    }
