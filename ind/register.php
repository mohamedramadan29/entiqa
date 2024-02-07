<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'mail/vendor/autoload.php';

$mail = new PHPMailer(true);
$pagetitle = ' حساب فرد جديد  ';
ob_start();
session_start();
if (!isset($_SESSION['com_id']) && !isset($_SESSION['ind_id'])) {


    //$ind_navabar = 'ind';
    $nonavbar = "no_navbar";
    include 'init.php';
    ini_set('display_errors', 0); // Disable error display on the webpage
    ini_set('log_errors', 1); // Enable error logging
    if (!isset($_SESSION['ind_id'])) {
?>
        <section class="section section-md">
            <div class="container">
                <div class="register_form">
                    <a href="index" class="btn btn-primary" style='background-color:#e4157e;
                 border-color:#e4157e;width: 100px;border-radius: 5px;'><i class="fa fa-arrow-right"></i> رجوع
                    </a>
                    <div class="row">
                        <!--RD Mailform-->
                        <?php
                        $formerror = [];
                        if (isset($_POST['send_information'])) {
                            $ind_username = sanitizeInput($_POST["ind_username"]);
                            $ind_name = sanitizeInput($_POST["ind_name"]);
                            $ind_birthdate = sanitizeInput($_POST["ind_birthdate"]);
                            $ind_email = sanitizeInput($_POST["ind_email"]);
                            $ind_phone = sanitizeInput($_POST["ind_phone"]);
                            $ind_nationality = sanitizeInput($_POST["ind_nationality"]);
                            $ind_address = sanitizeInput($_POST["ind_address"]);
                            $ind_gender = sanitizeInput($_POST["ind_gender"]);
                            $ind_transfer = sanitizeInput($_POST["ind_transfer"]);
                            $ind_english = sanitizeInput($_POST["ind_english"]);
                            $ind_password = sanitizeInput($_POST["ind_password"]);
                            $confirm_password = sanitizeInput($_POST["confirm_password"]);
                            if (empty($ind_username)) {
                                $formerror[] = "  من فضلك ادخل الاسم الخاص بك ";
                            }
                            if (strlen($ind_username) > 50) {
                                $formerror[] = 'اسم المستخدم يجب ان يكون اقل من 50 حرف';
                            }

                            if (!preg_match('/^[a-zA-Z]+$/', $ind_username)) {
                                $formerror[] = ' يجب ان تكون الحروف المستخدمة فى اسم المتخدم حروف انجليزية فقط ';
                            }

                            if (empty($ind_email)) {
                                $formerror[] = " يجب اضافة البريد الالكتروني  ";
                            } elseif (!filter_var($ind_email, FILTER_VALIDATE_EMAIL)) {
                                $formerror[] = " يجب إدخال عنوان بريد إلكتروني صالح ";
                            } elseif (strlen($ind_email) > 100) {
                                $formerror[] = "طول البريد الإلكتروني يجب أن لا يتجاوز 100 حرفًا";
                            } elseif (!preg_match('/^[a-zA-Z0-9.@ـ\-\_\+\,\']+$/u', $ind_email)) {
                                $formerror[] = "البريد الإلكتروني يجب أن يحتوي على أحرف وأرقام ورموز صحيحة فقط";
                            } elseif (strpos($ind_email, '..') !== false) {
                                $formerror[] = "البريد الإلكتروني يحتوي على أحرف غير صالحة";
                            }
                            if (empty($ind_password)) {
                                $formerror[] = " يجب اضافة  كلمة المرور    ";
                            }
                            if (strlen($ind_password) < 8 || !preg_match('/^[a-zA-Z0-9!@#$%^&*()_+]+$/', $ind_password) || !preg_match('/\d/', $ind_password)) {
                                $formerror[] = "كلمة المرور يجب أن تحتوي على الأحرف الإنجليزية والأرقام والرموز الخاصة.";
                            }
                            // يسمح بالأحرف الإنجليزية (كبيرة وصغيرة) والأرقام
                            if (!preg_match('/^[a-zA-Z0-9!@#$%^&*()_+]+$/', $ind_password)) {
                                $formerror[] = "كلمة المرور يجب أن تحتوي على الأحرف الإنجليزية والأرقام والرموز الخاصة.";
                            }

                            if ($ind_password !== $confirm_password) {
                                $formerror[] = 'تاكيد كلمة المرور غير متطابق ';
                            }
                            if (!preg_match("/^[\p{Arabic}\p{Latin}\s]+$/u", $ind_nationality)) {
                                $formerror[] = 'من فضلك أدخل الجنسية بشكل صحيح';
                            }
                            // if (!is_numeric($ind_phone) || strlen($ind_phone) < 8 || strlen($ind_phone) > 20) {
                            //     $formerror[] = 'من فضلك، أدخل رقم هاتف صحيح بين 8 و 20 رقمًا.';
                            // }
                            // تحقق من أن القيمة هي رقم وأنها تحتوي على أحرف رقمية فقط
                            if (!is_numeric($ind_phone) || !ctype_digit($ind_phone)) {
                                $formerror[] = 'من فضلك، أدخل رقم هاتف صحيح.';
                            } else {
                                // تحقق من أن الرقم يتبع الصيغة السعودية (يبدأ بـ 05 ويكون طوله 10 أرقام)
                                if (!preg_match('/^05[0-9]{8}$/', $ind_phone)) {
                                    $formerror[] = 'من فضلك، أدخل رقم هاتف صحيح بصيغة سعودية.';
                                }
                            }

                            if (
                                empty($ind_username) || empty($ind_name) || empty($ind_birthdate) || empty($ind_email) || empty($ind_phone)
                                || empty($ind_nationality) || empty($ind_address) || empty($ind_gender) || empty($ind_transfer)
                                || empty($ind_english) || empty($ind_password)
                            ) {
                                $formerror[] = 'من فضلك ادخل جميع المعلومات بالشكل الصحيح';
                            }

                            $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_email=?");
                            $stmt->execute(array($ind_email));
                            $data = $stmt->fetch();
                            $count = $stmt->rowCount();
                            if ($count > 0) {
                                $formerror[] = "  البريد الالكتروني مستخدم بالفعل من فضلك ادخل بريد الكتروني جديد ";
                            }
                            $stmt = $connect->prepare("SELECT * FROM coshes WHERE co_email=?");
                            $stmt->execute(array($ind_email));
                            $data = $stmt->fetch();
                            $count_coash_email = $stmt->rowCount();
                            if ($count_coash_email > 0) {
                                $formerror[] = "  البريد الالكتروني مستخدم بالفعل من فضلك ادخل بريد الكتروني جديد ";
                            }
                            $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_phone=?");
                            $stmt->execute(array($ind_phone));
                            $data = $stmt->fetch();
                            $count = $stmt->rowCount();
                            if ($count > 0) {
                                $formerror[] = " رقم الهاتف مستخدم من قبل ";
                            }
                            $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_email=?");
                            $stmt->execute(array($ind_email));
                            $data = $stmt->fetch();
                            $count = $stmt->rowCount();
                            if ($count > 0) {
                                $formerror[] = "  البريد الالكتروني مستخدم بالفعل من فضلك ادخل بريد الكتروني جديد ";
                            }
                            $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_phone=?");
                            $stmt->execute(array($ind_phone));
                            $data = $stmt->fetch();
                            $count = $stmt->rowCount();
                            if ($count > 0) {
                                $formerror[] = " رقم الهاتف مستخدم من قبل ";
                            }
                            $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_username=?");
                            $stmt->execute(array($ind_username));
                            $data = $stmt->fetch();
                            $count = $stmt->rowCount();
                            if ($count > 0) {
                                $formerror[] = " اسم المستخدم موجود بالفعل من فضلك ادخل اسم مستخدم جديد ";
                            }
                            $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_username=?");
                            $stmt->execute(array($ind_username));
                            $data = $stmt->fetch();
                            $count_com_username = $stmt->rowCount();
                            if ($count_com_username > 0) {
                                $formerror[] = " اسم المستخدم موجود بالفعل من فضلك ادخل اسم مستخدم جديد ";
                            }
                            if (empty($formerror)) {
                                // Generate a unique activation code 
                                $activationCode = rand(1, 55555);
                                $stmt = $connect->prepare("INSERT INTO ind_register
                                    (ind_username,ind_password,ind_name,
                                    ind_birthdate,ind_email,ind_phone,ind_nationality,ind_address,ind_gender,ind_transfer,
                                    ind_english,active_status_code) VALUES 
                                    (:zusername,:zpassword,:zname,:zbirthdate,
                                    :zemail,:zphone,:znationality,:zaddress,:zgender,:ztransfer,
                                    :zenglish,:zstatus_code)");
                                $stmt->execute(
                                    array(
                                        "zusername" => $ind_username,
                                        "zpassword" => $ind_password,
                                        "zname" => $ind_name,
                                        "zbirthdate" => $ind_birthdate,
                                        "zemail" => $ind_email,
                                        "zphone" => $ind_phone,
                                        "znationality" => $ind_nationality,
                                        "zaddress" => $ind_address,
                                        "zgender" => $ind_gender,
                                        "ztransfer" => $ind_transfer,
                                        "zenglish" => $ind_english,
                                        "zstatus_code" => $activationCode
                                    )
                                );
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
                                        $mail->addAddress($ind_email, $ind_name);
                                        $mail->Subject = 'تفعيل الحساب الخاص بك  ';
                                        $mail->Body = " <p style='font-size:18px; font-family:inherit'>مرحبا " . $ind_username . ",</p>
                                                    <p style='font-size:18px; font-family:inherit'>شكرا لك على تسجيلك في انتقاء.</p>
                                                    <a  style='font-size:18px; font-family:inherit' href='https://entiqa.online/test4/ind/activate?active_code=$activationCode' class='btn btn-primary'> أضغط هنا لتفعيل الحساب الخاص بك  </a>
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
                                    ?>
                                <?php
                                }
                            } else {
                                foreach ($formerror

                                    as $error) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <i class="fa fa-close"></i>
                                        <?php echo $error; ?>
                                    </div>
                        <?php
                                }
                            }
                        }
                        ?>
                        <form class="login register_new" id="my_formss" method="POST" action="" enctype="multipart/form-data" autocomplete="off">

                            <div class="row">
                                <h2> حساب فرد جديد </h2>
                                <div class="col-lg-6">
                                    <div class="box">
                                        <input pattern="[a-zA-Z]+" minlength="5" maxlength="50" oninvalid="setCustomValidityArabic(this,'يجب ان تكون الحروف المستخدمة فى اسم المتخدم حروف انجليزية فقط')" oninput="resetCustomValidity(this)" placeholder="اسم المستخدم * " required class="form-control" id="ind_username" type="text" name="ind_username" value="<?php if (isset($_REQUEST['ind_username'])) {
                                                                                                                                                                                                                                                                                                                                                                        echo $_REQUEST['ind_username'];
                                                                                                                                                                                                                                                                                                                                                                    } ?>">
                                        <small class="ind_username text-danger"> </small>
                                    </div>
                                    <div class="box">
                                        <input maxlength="100" oninvalid="setCustomValidityArabic(this,'من فضلك ادخل البريد الألكتروني')" oninput="resetCustomValidity(this)" placeholder="البريد الالكتروني * " required autocomplete="off" class="form-input" id="ind_email" type="email" name="ind_email" value="<?php if (isset($_REQUEST['ind_email'])) {
                                                                                                                                                                                                                                                                                                                        echo $_REQUEST['ind_email'];
                                                                                                                                                                                                                                                                                                                    } ?>">

                                        <small class="ind_email text-danger"> </small>
                                    </div>
                                    <div class="box password_eye">
                                        <input pattern="^[a-zA-Z0-9!@#$%^&*()_+]+$" oninvalid="setCustomValidityArabic(this,'  كلمه المرور يجب ان لا تقل عن 8 احرف وارقام وعلامات خاصه  ')" oninput="resetCustomValidity(this)" placeholder="كلمة المرور * " required class="form-control" type="password" id="password" name="ind_password" value="<?php if (isset($_REQUEST['ind_password'])) {
                                                                                                                                                                                                                                                                                                                                                        echo $_REQUEST['ind_password'];
                                                                                                                                                                                                                                                                                                                                                    } ?>">

                                        <span onclick="togglePasswordVisibility('password', this)" class="fa fa-eye-slash show_eye password_show_icon"></span>

                                        <small class="ind_password text-danger"> </small>
                                    </div>
                                    <div class="box password_eye">
                                        <input oninvalid="setCustomValidityArabic(this,'اكد كلمة المرور')" oninput="resetCustomValidity(this)" placeholder=" تاكيد كلمة المرور * " required class="form-control" id="password2" type="password" name="confirm_password" value="<?php if (isset($_REQUEST['confirm_password'])) {
                                                                                                                                                                                                                                                                                    echo $_REQUEST['confirm_password'];
                                                                                                                                                                                                                                                                                } ?>">
                                        <span onclick="togglePasswordVisibility('password2', this)" class="fa fa-eye-slash show_eye password_show_icon"></span>
                                    </div>
                                    <div class="box" id="birthdate">
                                        <?php $tenYearsAgo = date('Y-m-d', strtotime('-15 years')); ?>
                                        <input required placeholder="تاريخ الميلاد *" class="form-control" id="ind_birthdate" type="date" name="ind_birthdate" min="1900-01-01" max="<?php echo $tenYearsAgo; ?>" value="<?php if (isset($_REQUEST['ind_birthdate'])) {
                                                                                                                                                                                                                                echo $_REQUEST['ind_birthdate'];
                                                                                                                                                                                                                            } ?>" oninvalid="setCustomValidityArabic(this,'ادخل تاريخ الميلاد')" oninput="resetCustomValidity(this)">
                                    </div>
                                    <div class="box">
                                        <input oninvalid="setCustomValidityArabic(this,'من فضلك ادخل الجنسية')" oninput="resetCustomValidity(this)" required placeholder=" الجنسية * " class="form-control" id="ind_nationality" type="text" name="ind_nationality" value="<?php if (isset($_REQUEST['ind_nationality'])) {
                                                                                                                                                                                                                                                                                echo $_REQUEST['ind_nationality'];
                                                                                                                                                                                                                                                                            } ?>">
                                    </div>

                                </div>
                                <div class="col-lg-6">

                                    <div class="box">
                                        <select required id="ind_address" class="form-control select2" name="ind_address">
                                            <option value=""> -- منطقة السكن الحالي * --</option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'الرياض')
                                                        echo "selected"; ?> value="الرياض">الرياض
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'جدة')
                                                        echo "selected"; ?> value="جدة">جدة
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'مكة')
                                                        echo "selected"; ?> value="مكة">مكة
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'المدينة المنورة')
                                                        echo "selected"; ?> value="المدينة المنورة">المدينة المنورة
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'الطائف')
                                                        echo "selected"; ?> value="الطائف">الطائف
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'تبوك')
                                                        echo "selected"; ?> value="تبوك">تبوك
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'خميس مشيط')
                                                        echo "selected"; ?> value="خميس مشيط">خميس مشيط
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'عفيف')
                                                        echo "selected"; ?> value="عفيف">عفيف
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'عرعر')
                                                        echo "selected"; ?> value="عرعر">عرعر
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'أبها')
                                                        echo "selected"; ?> value="أبها">أبها
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'عسير')
                                                        echo "selected"; ?> value="عسير">عسير
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'بلجرشي')
                                                        echo "selected"; ?> value="بلجرشي">بلجرشي
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'بيشة')
                                                        echo "selected"; ?> value="بيشة">بيشة
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'بريدة')
                                                        echo "selected"; ?> value="بريدة">بريدة
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'القصيم')
                                                        echo "selected"; ?> value="القصيم">القصيم
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'الباحة')
                                                        echo "selected"; ?> value="الباحة">الباحة
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'الدمام')
                                                        echo "selected"; ?> value="الدمام">الدمام
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'الظهران')
                                                        echo "selected"; ?> value="الظهران">الظهران
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'الدوادمي')
                                                        echo "selected"; ?> value="الدوادمي">الدوادمي
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'جزر فرسان')
                                                        echo "selected"; ?> value="جزر فرسان">جزر فرسان
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'القريات')
                                                        echo "selected"; ?> value="القريات">القريات
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'القويعية')
                                                        echo "selected"; ?> value="القويعية">القويعية
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'حرمة')
                                                        echo "selected"; ?> value="حرمة">حرمة
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'حائل')
                                                        echo "selected"; ?> value="حائل">حائل
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'حوطة بني تميم')
                                                        echo "selected"; ?> value="حوطة بني تميم">حوطة بني تميم
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'الهفوف')
                                                        echo "selected"; ?> value="الهفوف">الهفوف
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'حفر الباطن')
                                                        echo "selected"; ?> value="حفر الباطن">حفر الباطن
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'جبل أم الرؤوس')
                                                        echo "selected"; ?> value="جبل أم الرؤوس">جبل أم الرؤوس
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'الجوف')
                                                        echo "selected"; ?> value="الجوف">الجوف
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'جيزان')
                                                        echo "selected"; ?> value="جيزان">جيزان
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'الجبيل')
                                                        echo "selected"; ?> value="الجبيل">الجبيل
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'الخفجي')
                                                        echo "selected"; ?> value="الخفجي">الخفجي
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'الخرج')
                                                        echo "selected"; ?> value="الخرج">الخرج
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'الخبر')
                                                        echo "selected"; ?> value="الخبر">الخبر
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'أملج')
                                                        echo "selected"; ?> value="أملج">أملج
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'القطيف')
                                                        echo "selected"; ?> value="القطيف">القطيف
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'القنفذة')
                                                        echo "selected"; ?> value="القنفذة">القنفذة
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'رأس التنورة')
                                                        echo "selected"; ?> value="رأس التنورة">رأس التنورة
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'سكاكا')
                                                        echo "selected"; ?> value="سكاكا">سكاكا
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'شرورة')
                                                        echo "selected"; ?> value="شرورة">شرورة
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'شقرا')
                                                        echo "selected"; ?> value="شقرا">شقرا
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'العلا')
                                                        echo "selected"; ?> value="العلا">العلا
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'عنيزة')
                                                        echo "selected"; ?> value="عنيزة">عنيزة
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'وادي الدواسر')
                                                        echo "selected"; ?> value="وادي الدواسر">وادي الدواسر
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'ينبع')
                                                        echo "selected"; ?> value="ينبع">ينبع
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'زلفي')
                                                        echo "selected"; ?> value="زلفي">زلفي
                                            </option>
                                        </select>
                                    </div>


                                    <div class="box">
                                        <input pattern="\d+" title="يجب أن يحتوي هذا الحقل على أرقام فقط" oninvalid="setCustomValidityArabic(this,'من فضلك ادخل رقم الهاتف')" oninput="resetCustomValidity(this)" placeholder="رقم الهاتف *" required class="form-control" id="ind_phone" type="number" minlength="8" maxlength="20" name="ind_phone" value="<?php if (isset($_REQUEST['ind_phone'])) {
                                                                                                                                                                                                                                                                                                                                                                    echo $_REQUEST['ind_phone'];
                                                                                                                                                                                                                                                                                                                                                                } ?>">
                                    </div>

                                    <div class="box">
                                        <select required id="ind_transfer2" class="form-control select" name="ind_transfer">
                                            <option value="">- أمكانية التنقل للعمل في مدينة أخرى ؟ * -</option>
                                            <option <?php if (isset($_REQUEST['ind_transfer']) && $_REQUEST['ind_transfer'] == 'نعم')
                                                        echo "selected"; ?> value="نعم">نعم
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_transfer']) && $_REQUEST['ind_transfer'] == 'لا')
                                                        echo "selected"; ?> value="لا">لا
                                            </option>
                                        </select>
                                    </div>
                                    <div class="box">
                                        <input required oninvalid="setCustomValidityArabic(this,'من فضلك ادخل اسمك بالعربي رباعي')" oninput="resetCustomValidity(this)" placeholder="اسمك بالعربي رباعي *" class="form-control" id="ind_name" type="text" name="ind_name" value="<?php if (isset($_REQUEST['ind_name'])) {
                                                                                                                                                                                                                                                                                        echo $_REQUEST['ind_name'];
                                                                                                                                                                                                                                                                                    } ?>">
                                    </div>
                                    <div class="box">
                                        <select required id="ind_english2" class="form-control select" name="ind_english">
                                            <option value=""> -- مهارة اللغة الأنجليزية * --</option>
                                            <option <?php if (isset($_REQUEST['ind_english']) && $_REQUEST['ind_english'] == 'متوسط')
                                                        echo "selected"; ?> value="متوسط">متوسط
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_english']) && $_REQUEST['ind_english'] == 'متقدم')
                                                        echo "selected"; ?> value="متقدم">متقدم
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_english']) && $_REQUEST['ind_english'] == 'مبتدئ')
                                                        echo "selected"; ?> value="مبتدئ">مبتدئ
                                            </option>
                                        </select>
                                    </div>
                                    <div class="box">
                                        <select oninvalid="setCustomValidityArabic(this,'من فضلك حدد الجنس')" oninput="resetCustomValidity(this)" required id="ind_gender2" class="form-control select" name="ind_gender">
                                            <option value=""> -- الجنس *--</option>
                                            <option <?php if (isset($_REQUEST['ind_gender']) && $_REQUEST['ind_gender'] == 'ذكر')
                                                        echo "selected"; ?> value="ذكر">ذكر
                                            </option>
                                            <option <?php if (isset($_REQUEST['ind_gender']) && $_REQUEST['ind_gender'] == 'انثي')
                                                        echo "selected"; ?> value="انثي">انثي
                                            </option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-check accept_privacy">
                                    <label class="form-check-label" for="flexCheckDefault"> بتسجيلك في منصة انتقاء فإنك
                                        توافق علي <a target="_blank" href="terms">شروط الاستخدام</a> و <a target="_blank" href="privacy_policy"> سياسة الخصوصية</a>
                                    </label>
                                    <input required oninvalid="setCustomValidityArabic(this,'يجب الموافقه علي شروط واحكام المنصة')" oninput="resetCustomValidity(this)" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div>
                            </div>
                            <div class="row">
                                <div class="submit_button">
                                    <button class="btn btn-primary" type="" name="send_information">فتح حساب</button>
                                </div>
                            </div>
                            
                            <div class="have_accout">
                                <p class="text-center">
                                    لديك حساب ؟ <a href="login">سجل دخول الان </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <script>
            function goBack() {
                // تنفيذ العودة إلى الصفحة السابقة
                window.history.back();
            }
        </script>
<?php
        include $tem . "footer.php";
    } else {
        header('Location:index');
        exit();
    }
} else {
    header("Location:index");
}
?>
<script>
    function togglePasswordVisibility(inputId, iconElement) {
        var passwordInput = document.getElementById(inputId);
        var icon = iconElement.classList;
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.remove("fa-eye-slash");
            icon.add("fa-eye");
        } else {
            passwordInput.type = "password";
            icon.remove("fa-eye");
            icon.add("fa-eye-slash");
        }
    }
</script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>