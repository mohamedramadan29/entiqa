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
            $co_name = sanitizeInput($_POST['co_name']);
            $co_password = sanitizeInput($_POST['co_password']);
            $confirm_password = sanitizeInput($_POST['confirm_password']);
            $co_email = sanitizeInput($_POST['co_email']);
            $co_phone = sanitizeInput($_POST['co_phone']);
            $co_services = sanitizeInput($_POST['co_services']);
            $co_exper = sanitizeInput($_POST['co_exper']);

            /// More Validation To Show Error
            $formerror = [];
            if (empty($co_name) || empty($co_password) || empty($confirm_password) || empty($co_email) || empty($co_phone) || empty($co_services) || empty($co_exper)) {
                $formerror[] = 'من فضلك ادخل المعلومات كاملة';
            }
            if (strlen($co_password) < 8) {
                $formerror[] = 'كلمة المرور يجب ان تكون اكثر من 8 حروف وارقام';
            }
            if ($co_password !== $confirm_password) {
                $formerror[] = 'يجب تاكيد كلمة المرور بشكل صحيح ';
            }
            $stmt = $connect->prepare("SELECT * FROM coshes WHERE co_name=?");
            $stmt->execute(array($co_name));
            $name_count = $stmt->rowCount();
            if ($name_count > 0) {
                $formerror[] = 'اسم المدرب موجود من قبل من فضلك ادخل اسم جديد ';
            }
            $stmt = $connect->prepare("SELECT * FROM coshes WHERE co_email=?");
            $stmt->execute(array($co_email));
            $email_count = $stmt->rowCount();
            if ($email_count > 0) {
                $formerror[] = ' البريد الألكتروني مستخدم بالفعل من فضلك ادخل بريد الكتروني جديد ';
            }
            $stmt = $connect->prepare("SELECT * FROM coshes WHERE co_phone=?");
            $stmt->execute(array($co_phone));
            $phone_count = $stmt->rowCount();
            if ($phone_count > 0) {
                $formerror[] = ' رقم الهاتف مستخدم من قبل  ';
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
            if (empty($co_name)) {
                $formerror[] = 'من فضلك ادخل الاسم';
            }
            foreach ($formerror as $errors) {
                echo "<div class='alert alert-danger danger_message'>" .
                    $errors .
                    '</div>';
            }

            if (empty($formerror)) {
                $stmt = $connect->prepare("INSERT INTO coshes (co_name,co_password,co_phone,co_email,co_services,co_exper)
                VALUES (:zname,:zco_password,:zphone,:zemail,:zservices,:zexper)");
                $stmt->execute([
                    'zname' => $co_name,
                    'zco_password' => $co_password,
                    'zphone' => $co_phone,
                    'zemail' => $co_email,
                    'zservices' => $co_services,
                    'zexper' => $co_exper,
                ]);
                if ($stmt) {
                    // START SEND MAIL ////////////////////////////////////
                    //Create an instance; passing `true` enables exceptions

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
                        $mail->Subject = ' معلومات تسجيل الدخول الخاصة بك كمدرب علي منصة انتقاء  ';
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
                    } catch (Exception $e) {
                        echo "حدث خطأ في إرسال البريد الإلكتروني: {$mail->ErrorInfo}";
                    }
                    // END SEND MAIL //////////////////////////////////////

    ?>
                 <div class="alert-success ">
                     تم اضافة مدرب جديد بنجاح
                     <?php
                        header("Location:main.php?dir=coashes&page=report");
                        ?>
                 </div>
 <?php }
            }
        }
    }
