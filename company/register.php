<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mail/vendor/autoload.php';

$mail = new PHPMailer(true);
$pagetitle = '  حساب شركة جديد ';
ob_start();
session_start();
if (!isset($_SESSION['com_id']) && !isset($_SESSION['ind_id'])) {


    include 'init.php';
    if (!isset($_SESSION['com_id'])) {
?>

        <!-- Contacts-->
        <section class="section section-md contact_us">
            <div class="container">
                <?php
                if (isset($_POST["send_message"])) {
                    $com_name = sanitizeInput($_POST["com_name"]);
                    $com_name_en = sanitizeInput($_POST["com_name_en"]);
                    $com_username = sanitizeInput($_POST["com_username"]);
                    $com_phone = sanitizeInput($_POST['com_phone']);
                    $com_email = sanitizeInput($_POST["com_email"]);
                    $com_active = sanitizeInput($_POST["com_active"]);
                    $com_place = sanitizeInput($_POST["com_place"]);
                    $com_braches = sanitizeInput($_POST["com_braches"]);
                    $com_founded = sanitizeInput($_POST["com_founded"]);
                    $com_work_h = sanitizeInput($_POST["com_work_h"]);
                    $com_work_libs = sanitizeInput($_POST["com_work_libs"]);
                    $com_weekend_num = sanitizeInput($_POST["com_weekend_num"]);
                    $com_work_type = sanitizeInput($_POST["com_work_type"]);
                    $com_salary = sanitizeInput($_POST["com_salary"]);
                    $com_commission = sanitizeInput($_POST["com_commission"]);
                    $password = sanitizeInput($_POST["password"]);
                    $confirm_password = sanitizeInput($_POST["confirm_password"]);
                    $com_num = sanitizeInput($_POST["com_num"]);
                    $formerror = [];

                    if (strlen($com_username) > 50) {
                        $formerror[] = 'اسم المستخدم يجب ان يكون اقل من 50 حرف';
                    }
                    if (!preg_match('/^[a-zA-Z]+$/', $com_username)) {
                        $formerror[] = ' يجب ان تكون الحروف المستخدمة فى اسم المستخدم حروف انجليزية فقط ';
                    }
                    if (empty($com_name)) {
                        $formerror[] = " يجب اضافة اسم الشركه  ";
                    }
                    if (empty($com_email)) {
                        $formerror[] = " يجب اضافة البريد الالكتروني  ";
                    } elseif (!filter_var($com_email, FILTER_VALIDATE_EMAIL)) {
                        $formerror[] = " يجب إدخال عنوان بريد إلكتروني صالح ";
                    } elseif (strlen($com_email) > 100) {
                        $formerror[] = "طول البريد الإلكتروني يجب أن لا يتجاوز 100 حرفًا";
                    } elseif (!preg_match('/^[a-zA-Z0-9.@]+$/', $com_email)) {
                        $formerror[] = "البريد الإلكتروني يجب أن يحتوي على أحرف وأرقام ورموز صحيحة فقط";
                    } elseif (strpos($com_email, '..') !== false) {
                        $formerror[] = "البريد الإلكتروني يحتوي على أحرف غير صالحة";
                    }
                    if (empty($com_active)) {
                        $formerror[] = "  من فضلك ادخل نشاط الشركه  ";
                    }
                    if (empty($com_place)) {
                        $formerror[] = "  من فضلك ادخل مكان الشركه ";
                    }
                    if (empty($password)) {
                        $formerror[] = " يجب اضافة  كلمة المرور    ";
                    }
                    if (strlen($password) < 8 || !preg_match('/^[a-zA-Z0-9!@#$%^&*()_+]+$/', $password) || !preg_match('/\d/', $password)) {
                        $formerror[] = "  كلمه المرور يجب ان لا تقل عن 8 احرف وارقام وعلامات خاصه  ";
                    }
                    // يسمح بالأحرف الإنجليزية (كبيرة وصغيرة) والأرقام

                    if (!preg_match('/^[a-zA-Z0-9!@#$%^&*()_+]+$/', $password)) {
                        $formerror[] = "كلمة المرور يجب أن تحتوي على الأحرف الإنجليزية والأرقام والرموز الخاصة.";
                    }
                    if ($password !== $confirm_password) {
                        $formerror[] = 'تاكيد كلمة المرور غير متطابق ';
                    }
                    if (empty($com_num)) {
                        $formerror[] = " يجب ادخال السجل التجاري الخاص بالشركه ";
                    }
                    if (strlen($com_num) > 20 || strlen($com_num) < 5 || !is_numeric($com_num) || $com_num < 1) {
                        $formerror[] = ' رقم السجل التجاري يجب ان يكون اكثر من 5 ارقام واقل من 20 رقم ويحتوي علي ارقام صحيحه فقط  ';
                    }
                    if (strlen($com_active) > 200 || strlen($com_active) < 5) {
                        $formerror[] = 'يجب ان يتم ادخال نشاط الشركه بشكل صحيح يجب ان يكون اكبر من 5 احرف واقل من 200 حرف';
                    }
                    if (strlen($com_braches) > 100) {
                        $formerror[] = 'فروع الشركه يجب ان تكون اقل من 100 حرف';
                    }
                    // if (!is_numeric($com_phone) || strlen($com_phone) < 8 || strlen($com_phone) > 20) {
                    //     $formerror[] = 'من فضلك، أدخل رقم هاتف صحيح بين 8 و 20 رقمًا.';
                    // }
                    if (!is_numeric($com_phone) || !ctype_digit($com_phone)) {
                        $formerror[] = 'من فضلك، أدخل رقم هاتف صحيح.';
                    } else {
                        // تحقق من أن الرقم يتبع الصيغة السعودية (يبدأ بـ 05 ويكون طوله 10 أرقام)
                        if (!preg_match('/^05[0-9]{8}$/', $com_phone)) {
                            $formerror[] = 'من فضلك، أدخل رقم هاتف صحيح بصيغة سعودية.';
                        }
                    }
                    if (
                        empty($com_name) || empty($com_name_en) || empty($com_username) || empty($com_email) ||
                        empty($com_active) || empty($com_place) || empty($com_braches) || empty($com_founded) ||
                        empty($com_work_h) || empty($com_work_libs) || empty($com_weekend_num) ||
                        empty($com_work_type) || empty($com_salary) || empty($com_commission) || empty($password) || empty($com_num)
                    ) {
                        $formerror[] = 'من فضلك ادخل جميع المعلومات بالشكل الصحيح';
                    }
                    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_username=?");
                    $stmt->execute(array($com_username));
                    $data = $stmt->fetch();
                    $count = $stmt->rowCount();
                    if ($count > 0) {
                        $formerror[] = " اسم المستخدم للشركة مستخدم بالفعل من فضلك ادخل اسم جديد ";
                    }
                    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_username=?");
                    $stmt->execute(array($com_username));
                    $data = $stmt->fetch();
                    $count_com_username = $stmt->rowCount();
                    if ($count_com_username > 0) {
                        $formerror[] = " اسم المستخدم للشركة مستخدم بالفعل من فضلك ادخل اسم جديد ";
                    }
                    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_email=?");
                    $stmt->execute(array($com_email));
                    $data = $stmt->fetch();
                    $count = $stmt->rowCount();
                    if ($count > 0) {
                        $formerror[] = " البريد الالكتروني مستخدم بالفعل من فضلك ادخل بريد الكتروني جديد  ";
                    }
                    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_phone=?");
                    $stmt->execute(array($com_phone));
                    $data = $stmt->fetch();
                    $count = $stmt->rowCount();
                    if ($count > 0) {
                        $formerror[] = " رقم الهاتف مستخدم من قبل  ";
                    }
                    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_email=?");
                    $stmt->execute(array($com_email));
                    $data = $stmt->fetch();
                    $count = $stmt->rowCount();
                    if ($count > 0) {
                        $formerror[] = " البريد الالكتروني مستخدم بالفعل من فضلك ادخل بريد الكتروني جديد  ";
                    }
                    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_phone=?");
                    $stmt->execute(array($com_phone));
                    $data = $stmt->fetch();
                    $count = $stmt->rowCount();
                    if ($count > 0) {
                        $formerror[] = " رقم الهاتف مستخدم من قبل  ";
                    }
                    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_num=?");
                    $stmt->execute(array($com_num));
                    $data = $stmt->fetch();
                    $count = $stmt->rowCount();
                    if ($count > 0) {
                        $formerror[] = " تم التسجيل برقم السجل التجاري من قبل  ";
                    }
                    if (empty($formerror)) {
                        $activationCode = rand(1, 55555);
                        $stmt = $connect->prepare("INSERT INTO company_register
                (com_name,com_name_en,com_username,
                com_email,com_phone,com_password ,com_num,com_active, com_place,
                com_braches,com_founded,com_work_h,com_work_libs,com_weekend_num,
                com_work_type,com_salary,com_commission,active_status_code) VALUES 
                (:zcom_name,:zcom_name_en,:zcom_username,:zcom_email,:zcom_phone,
                :zcom_password,:zcom_num,:zcom_active,:zcom_place,
                :zcom_braches,:zcom_founded,:zcom_work_h,:zcom_work_libs,
                :zcom_weekend_num,:zcom_work_type,:zcom_salary,:zcom_commission,:zstatus_code)");
                        $stmt->execute(
                            array(
                                "zcom_name" => $com_name,
                                "zcom_name_en" => $com_name_en,
                                "zcom_username" => $com_username,
                                "zcom_email" => $com_email,
                                "zcom_phone" => $com_phone,
                                "zcom_password" => $password,
                                "zcom_num" => $com_num,
                                "zcom_active" => $com_active,
                                "zcom_place" => $com_place,
                                "zcom_braches" => $com_braches,
                                "zcom_founded" => $com_founded,
                                "zcom_work_h" => $com_work_h,
                                "zcom_work_libs" => $com_work_libs,
                                "zcom_weekend_num" => $com_weekend_num,
                                "zcom_work_type" => $com_work_type,
                                "zcom_salary" => $com_salary,
                                "zcom_commission" => $com_commission,
                                "zstatus_code" => $activationCode
                            )
                        );
                        if ($stmt) {
                            $_SESSION['mail'] = $com_email;
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

                                $mail->Port = 587;

                                // مُحتوى الرسالة

                                $mail->setFrom('test@entiqa.online', 'انتقاء');
                                $mail->addAddress($com_email, $com_name);
                                $mail->Subject = 'تفعيل الحساب الخاص بك  ';
                                $mail->Body = " <p style='font-size:18px; font-family:inherit'>مرحبا " . $com_name . ",</p>
                                                <p style='font-size:18px; font-family:inherit'>شكرا لك على تسجيلك في انتقاء.</p>
                                                <a  style='font-size:18px; font-family:inherit' href='http://entiqa.online/test4/company/activate?active_code=$activationCode' class='btn btn-primary'> أضغط هنا لتفعيل الحساب الخاص بك  </a>
                                            ";
                                $mail->AltBody = 'This is the plain text message body for non-HTML mail clients.';
                                // إرسال البريد الإلكتروني
                                $mail->send();
                                //                                header('Location:activate');
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
                            <div class="alert alert-danger">
                                <?php echo $error; ?>
                            </div>
                <?php
                        }
                    }
                }
                ?>
                <div class="register_form">
                    <a href="index" class="btn btn-primary" style='background-color:#f16583;
                 border-color:#f16583;width: 100px;border-radius: 5px;'><i class="fa fa-arrow-right"></i> رجوع
                    </a>
                    <div class="row">
                        <h2> حساب شركة جديد </h2>
                        <div class="col-12">
                            <!--RD Mailform-->
                            <form class="login register_new" method="post" action="" autocomplete="off">
                                <div class="row row-10">
                                    <div class="col-lg-6">
                                        <div class="box">
                                            <input pattern="[a-zA-Z]+" minlength="5" maxlength="50" required oninvalid="setCustomValidityArabic(this,'يجب ان تكون الحروف المستخدمة فى اسم المستخدم حروف انجليزية فقط')" oninput="resetCustomValidity(this)" class="form-input" id="com_username" type="text" placeholder="   اسم المستخدم  (مطابق لاسم الشركه)  *   " name="com_username" value="<?php if (isset($_REQUEST['com_username'])) {
                                                                                                                                                                                                                                                                                                                                                                                                        echo $_REQUEST['com_username'];
                                                                                                                                                                                                                                                                                                                                                                                                    } ?>">
                                        </div>
                                        <div class="box">
                                            <input required oninvalid="setCustomValidityArabic(this,'من فضلك ادخل البريد الألكتروني')" oninput="resetCustomValidity(this)" autocomplete="off" class="form-control" id="contact-email" placeholder="البريد الالكتروني * " type="email" name="com_email" value="<?php if (isset($_REQUEST['com_email'])) {
                                                                                                                                                                                                                                                                                                                    echo $_REQUEST['com_email'];
                                                                                                                                                                                                                                                                                                                } ?>">
                                        </div>
                                        <div class="box">

                                            <input pattern="\d+" title="يجب أن يحتوي هذا الحقل على أرقام فقط" required oninvalid="setCustomValidityArabic(this,' من فضلك ادخل رقم الهاتف بشكل صحيح  ')" oninput="resetCustomValidity(this)" class="form-control" id="com_phone" type="number" minlength="8" maxlength="20" name="com_phone" placeholder=" *  رقم الهاتف  " value="<?php if (isset($_REQUEST['com_phone'])) {
                                                                                                                                                                                                                                                                                                                                                                                        echo $_REQUEST['com_phone'];
                                                                                                                                                                                                                                                                                                                                                                                    } ?>">
                                        </div>
                                        <div class="box password_eye">
                                            <input required pattern="^[a-zA-Z0-9!@#$%^&*()_+]+$" oninvalid="setCustomValidityArabic(this,'  كلمه المرور يجب ان لا تقل عن 8 احرف وارقام وعلامات خاصه   ')" oninput="resetCustomValidity(this)" class="form-input" id="password" type="password" placeholder="كلمة المرور * " name="password" value="<?php if (isset($_REQUEST['password'])) {
                                                                                                                                                                                                                                                                                                                                                        echo $_REQUEST['password'];
                                                                                                                                                                                                                                                                                                                                                    } ?>">
                                            <span onclick="togglePasswordVisibility('password', this)" class="fa fa-eye-slash show_eye password_show_icon"></span>
                                        </div>

                                        <div class="box password_eye ">
                                            <input required oninvalid="setCustomValidityArabic(this,'اكد كلمة المرور')" oninput="resetCustomValidity(this)" class="form-input" id="password2" type="password" placeholder=" تاكيد كلمة المرور * " name="confirm_password" value="<?php if (isset($_REQUEST['confirm_password'])) {
                                                                                                                                                                                                                                                                                        echo $_REQUEST['confirm_password'];
                                                                                                                                                                                                                                                                                    } ?>">
                                            <span onclick="togglePasswordVisibility('password2', this)" class="fa fa-eye-slash show_eye password_show_icon"></span>
                                        </div>

                                        <div class="box">
                                            <input min="1" required oninvalid="setCustomValidityArabic(this,'من فضلك ادخل رقم السجل التجاري  بشكل صحيح')" oninput="resetCustomValidity(this)" class="form-control" id="com_num" type="number" placeholder="* رقم السجل التجاري  " name="com_num" value="<?php if (isset($_REQUEST['com_num'])) {
                                                                                                                                                                                                                                                                                                            echo $_REQUEST['com_num'];
                                                                                                                                                                                                                                                                                                        } ?>">
                                        </div>
                                        <div class="box">
                                            <select required oninvalid="setCustomValidityArabic(this,' من فضلك حدد نوع العمل ')" oninput="resetCustomValidity(this)" class="form-control" id="com_work_type" name="com_work_type">
                                                <option value="">-- اختر نوع العمل * --</option>
                                                <option <?php if (isset($_REQUEST['com_work_type']) && $_REQUEST['com_work_type'] == 'عمل ميداني')
                                                            echo "selected"; ?> value="عمل ميداني"> عمل ميداني
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_work_type']) && $_REQUEST['com_work_type'] == 'عمل مكتبي')
                                                            echo "selected"; ?> value="عمل مكتبي"> عمل مكتبي
                                                </option>
                                            </select>
                                        </div>
                                        <div class="box">
                                            <input min="1" required oninvalid="setCustomValidityArabic(this,'من فضلك ادخل الراتب المقدر بشكل صحيح')" oninput="resetCustomValidity(this)" class="form-control" id="com_salary" type="number" placeholder=" [ريال سعودي] * الراتب المقدر  " name="com_salary" value="<?php if (isset($_REQUEST['com_salary'])) {
                                                                                                                                                                                                                                                                                                                        echo $_REQUEST['com_salary'];
                                                                                                                                                                                                                                                                                                                    } ?>">
                                        </div>
                                        <div class="box">
                                            <input max="100" min="0" required oninvalid="setCustomValidityArabic(this,'   من فضلك ادخل العمولة المقدرة  بشكل صحيح ')" oninput="resetCustomValidity(this)" class="form-control" id="com_commission" type="number" placeholder=" [ % ]  *   العمولة المقدرة " name="com_commission" value="<?php if (isset($_REQUEST['com_commission'])) {
                                                                                                                                                                                                                                                                                                                                                echo $_REQUEST['com_commission'];
                                                                                                                                                                                                                                                                                                                                            } ?>">
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="box">
                                            <input required oninvalid="setCustomValidityArabic(this,'من فضلك ادخل اسم الشركة ')" oninput="resetCustomValidity(this)" class="form-control" id="com_name" type="text" name="com_name" placeholder="  اسم الشركه باللغه العربيه * " value="<?php if (isset($_REQUEST['com_name'])) {
                                                                                                                                                                                                                                                                                            echo $_REQUEST['com_name'];
                                                                                                                                                                                                                                                                                        } ?>">
                                        </div>
                                        <div class="box">
                                            <input required oninvalid="setCustomValidityArabic(this,'من فضلك ادخل اسم الشركة باللغه الأنجليزية')" oninput="resetCustomValidity(this)" class="form-control" id="com_name_en" type="text" name="com_name_en" placeholder=" اسم الشركه باللغه الانجليزية * " value="<?php if (isset($_REQUEST['com_name_en'])) {
                                                                                                                                                                                                                                                                                                                        echo $_REQUEST['com_name_en'];
                                                                                                                                                                                                                                                                                                                    } ?>">
                                        </div>
                                        <div class="box">
                                            <textarea required oninvalid="setCustomValidityArabic(this,'من فضلك حدد نشاط الشركة ')" oninput="resetCustomValidity(this)" class="form-control" id="com_active" type="text" placeholder=" نشاط الشركه * " name="com_active"><?php if (isset($_REQUEST['com_active'])) {
                                                                                                                                                                                                                                                                                echo $_REQUEST['com_active'];
                                                                                                                                                                                                                                                                            } ?></textarea>
                                        </div>
                                        <div class="box">
                                            <select required oninvalid="setCustomValidityArabic(this,' من فضلك حدد مقر الشركه ')" oninput="resetCustomValidity(this)" id="com_place" class="form-control" name="com_place">
                                                <option value=""> -- مقر الشركة--*</option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'الرياض')
                                                            echo "selected"; ?> value="الرياض">الرياض
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'جدة')
                                                            echo "selected"; ?> value="جدة">جدة
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'مكة')
                                                            echo "selected"; ?> value="مكة">مكة
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'المدينة المنورة')
                                                            echo "selected"; ?> value="المدينة المنورة">المدينة المنورة
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'الطائف')
                                                            echo "selected"; ?> value="الطائف">الطائف
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'تبوك')
                                                            echo "selected"; ?> value="تبوك">تبوك
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'خميس مشيط')
                                                            echo "selected"; ?> value="خميس مشيط">خميس مشيط
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'عفيف')
                                                            echo "selected"; ?> value="عفيف">عفيف
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'عرعر')
                                                            echo "selected"; ?> value="عرعر">عرعر
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'أبها')
                                                            echo "selected"; ?> value="أبها">أبها
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'عسير')
                                                            echo "selected"; ?> value="عسير">عسير
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'بلجرشي')
                                                            echo "selected"; ?> value="بلجرشي">بلجرشي
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'بيشة')
                                                            echo "selected"; ?> value="بيشة">بيشة
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'بريدة')
                                                            echo "selected"; ?> value="بريدة">بريدة
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'القصيم')
                                                            echo "selected"; ?> value="القصيم">القصيم
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'الباحة')
                                                            echo "selected"; ?> value="الباحة">الباحة
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'الدمام')
                                                            echo "selected"; ?> value="الدمام">الدمام
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'الظهران')
                                                            echo "selected"; ?> value="الظهران">الظهران
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'الدوادمي')
                                                            echo "selected"; ?> value="الدوادمي">الدوادمي
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'جزر فرسان')
                                                            echo "selected"; ?> value="جزر فرسان">جزر فرسان
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'القريات')
                                                            echo "selected"; ?> value="القريات">القريات
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'القويعية')
                                                            echo "selected"; ?> value="القويعية">القويعية
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'حرمة')
                                                            echo "selected"; ?> value="حرمة">حرمة
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'حائل')
                                                            echo "selected"; ?> value="حائل">حائل
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'حوطة بني تميم')
                                                            echo "selected"; ?> value="حوطة بني تميم">حوطة بني تميم
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'الهفوف')
                                                            echo "selected"; ?> value="الهفوف">الهفوف
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'حفر الباطن')
                                                            echo "selected"; ?> value="حفر الباطن">حفر الباطن
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'جبل أم الرؤوس')
                                                            echo "selected"; ?> value="جبل أم الرؤوس">جبل أم الرؤوس
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'الجوف')
                                                            echo "selected"; ?> value="الجوف">الجوف
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'جيزان')
                                                            echo "selected"; ?> value="جيزان">جيزان
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'الجبيل')
                                                            echo "selected"; ?> value="الجبيل">الجبيل
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'الخفجي')
                                                            echo "selected"; ?> value="الخفجي">الخفجي
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'الخرج')
                                                            echo "selected"; ?> value="الخرج">الخرج
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'الخبر')
                                                            echo "selected"; ?> value="الخبر">الخبر
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'أملج')
                                                            echo "selected"; ?> value="أملج">أملج
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'القطيف')
                                                            echo "selected"; ?> value="القطيف">القطيف
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'القنفذة')
                                                            echo "selected"; ?> value="القنفذة">القنفذة
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'رأس التنورة')
                                                            echo "selected"; ?> value="رأس التنورة">رأس التنورة
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'سكاكا')
                                                            echo "selected"; ?> value="سكاكا">سكاكا
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'شرورة')
                                                            echo "selected"; ?> value="شرورة">شرورة
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'شقرا')
                                                            echo "selected"; ?> value="شقرا">شقرا
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'العلا')
                                                            echo "selected"; ?> value="العلا">العلا
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'عنيزة')
                                                            echo "selected"; ?> value="عنيزة">عنيزة
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'وادي الدواسر')
                                                            echo "selected"; ?> value="وادي الدواسر">وادي الدواسر
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'ينبع')
                                                            echo "selected"; ?> value="ينبع">ينبع
                                                </option>
                                                <option <?php if (isset($_REQUEST['com_place']) && $_REQUEST['com_place'] == 'زلفي')
                                                            echo "selected"; ?> value="زلفي">زلفي
                                                </option>
                                            </select>
                                        </div>
                                        <div class="box">
                                            <textarea required oninvalid="setCustomValidityArabic(this,'من فضلك ادخل افرع الشركة')" oninput="resetCustomValidity(this)" class="form-control" id="com_braches" type="text" placeholder="افرع الشركه * " name="com_braches"><?php if (isset($_REQUEST['com_braches'])) {
                                                                                                                                                                                                                                                                                echo $_REQUEST['com_braches'];
                                                                                                                                                                                                                                                                            } ?></textarea>
                                        </div>
                                        <div class="box">
                                            <input required min="1800" pattern="\d+" title="يجب أن يحتوي هذا الحقل على أرقام فقط" oninvalid="setCustomValidityArabic(this,'ادخل سنة التأسيس')" oninput="resetCustomValidity(this)" class="form-control" id="com_founded" type="number" name="com_founded" placeholder=" * سنة التاسيس " value="<?php if (isset($_REQUEST['com_founded'])) {
                                                                                                                                                                                                                                                                                                                                                    echo $_REQUEST['com_founded'];
                                                                                                                                                                                                                                                                                                                                                } ?>">
                                        </div>
                                        <div class="box">
                                            <input required oninvalid="setCustomValidityArabic(this,'من فضلك ادخل اوقات ساعات العمل')" oninput="resetCustomValidity(this)" class="form-control" id="com_work_h" type="text" name="com_work_h" placeholder="أوقات ساعات العمل *" value="<?php if (isset($_REQUEST['com_work_h'])) {
                                                                                                                                                                                                                                                                                            echo $_REQUEST['com_work_h'];
                                                                                                                                                                                                                                                                                        } ?>">
                                        </div>
                                        <div class="box">
                                            <input min="1" required oninvalid="setCustomValidityArabic(this,' من فضلك ادخل عدد الشفتات بشكل صحيح  ')" oninput="resetCustomValidity(this)" class="form-control" id="com_work_libs" type="number" name="com_work_libs" placeholder="* عدد الشفتات " value="<?php if (isset($_REQUEST['com_work_libs'])) {
                                                                                                                                                                                                                                                                                                                echo $_REQUEST['com_work_libs'];
                                                                                                                                                                                                                                                                                                            } ?>">
                                        </div>
                                        <div class="box">
                                            <input min='1' max="7" pattern="\d+" title="يجب أن يحتوي هذا الحقل على أرقام فقط" required oninvalid="setCustomValidityArabic(this,' من فضلك حدد ايام الأجازة الأسبوعية بشكل صحيح')" oninput="resetCustomValidity(this)" class="form-control" id="com_weekend_num" type="number" placeholder="* عدد أيام الأجازة الأسبوعية " name="com_weekend_num" value="<?php if (isset($_REQUEST['com_weekend_num'])) {
                                                                                                                                                                                                                                                                                                                                                                                                            echo $_REQUEST['com_weekend_num'];
                                                                                                                                                                                                                                                                                                                                                                                                        } ?>">
                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-check accept_privacy">
                                        <label class="form-check-label" for="flexCheckDefault"> بتسجيلك في منصة انتقاء
                                            فإنك
                                            توافق علي <a target="_blank" href="terms">شروط الاستخدام</a> و
                                            <a target="_blank" href="privacy_policy"> سياسة الخصوصية</a>
                                        </label>
                                        <input required oninvalid="setCustomValidityArabic(this,'يجب الموافقه علي شروط واحكام المنصة')" oninput="resetCustomValidity(this)" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="submit_button">
                                        <button class="button button-size-1 button-block button-primary" type="submit" name="send_message"> فتح حساب شركة
                                        </button>
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
        header("Location:index");
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