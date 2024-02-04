<?php
$pagetitle = ' تعديل البيانات   ';
ob_start();
session_start();
$ind_navabar = 'ind';
if (isset($_SESSION['ind_id'])) {
    include 'init.php';
?>
    <div class="profile_hero">
        <div class="overlay">
            <div class="container">
                <div class="data">
                    <h2>تحديث الحساب </h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">تحديث الحساب</li>
                            <li class="breadcrumb-item"><a href="individuals">الرئيسية</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php
    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id=?");
    $stmt->execute(array($_SESSION['ind_id']));
    $ind_data = $stmt->fetch();
    ?>
    <div class="profile_data" style="margin-top: 0;">
        <?php
        if (isset($_POST["send_message"])) {
            //   $ind_username = $_POST["ind_username"];
            $ind_name = sanitizeInput($_POST["ind_name"]);
            $ind_birthdate = sanitizeInput($_POST["ind_birthdate"]);
            $ind_email = sanitizeInput($_POST["ind_email"]);
            $ind_phone = sanitizeInput($_POST["ind_phone"]);
            $ind_nationality = sanitizeInput($_POST["ind_nationality"]);
            $ind_address = sanitizeInput($_POST["ind_address"]);
            $ind_transfer = sanitizeInput($_POST["ind_transfer"]);
            $ind_english = sanitizeInput($_POST["ind_english"]);
            $ind_gender = sanitizeInput($_POST['ind_gender']);
            $ind_info = sanitizeInput($_POST['ind_info']);
            $formerror = [];
            if (strlen($ind_info) > 500) {
                $formerror[] = 'النبذة التعريفية يجب أن تكون أقل من ٥٠٠ حرف';
            }
            if (empty($ind_name) || empty($ind_birthdate) || empty($ind_email) || empty($ind_phone) || empty($ind_nationality)) {
                $formerror[] = " من فضلك ادخل المعلومات كاملة ";
            }
            if (!preg_match("/^[\p{Arabic}\p{Latin}\s]+$/u", $ind_nationality)) {
                $formerror[] = 'من فضلك أدخل الجنسية بشكل صحيح';
            }
            if (empty($ind_name)) {
                $formerror[] = "  من فضلك ادخل الاسم الخاص بك ";
            }
            // if (!is_numeric($ind_phone) || strlen($ind_phone) < 8 || strlen($ind_phone) > 20) {
            //     $formerror[] = 'من فضلك، أدخل رقم هاتف صحيح بين 8 و 20 رقمًا.';
            // }
            if (!is_numeric($ind_phone) || !ctype_digit($ind_phone)) {
                $formerror[] = 'من فضلك، أدخل رقم هاتف صحيح.';
            } else {
                // تحقق من أن الرقم يتبع الصيغة السعودية (يبدأ بـ 05 ويكون طوله 10 أرقام)
                if (!preg_match('/^05[0-9]{8}$/', $ind_phone)) {
                    $formerror[] = 'من فضلك، أدخل رقم هاتف صحيح بصيغة سعودية.';
                }
            }
            if (empty($ind_email)) {
                $formerror[] = " يجب اضافة البريد الالكتروني  ";
            } elseif (!filter_var($ind_email, FILTER_VALIDATE_EMAIL)) {
                $formerror[] = " يجب إدخال عنوان بريد إلكتروني صالح ";
            }
            $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_email=? AND ind_id !=?");
            $stmt->execute(array($ind_email, $_SESSION['ind_id']));
            $count_mails = $stmt->rowCount();
            if ($count_mails > 0) {
                $formerror[] = 'البريد الألكتروني مستخدم من قبل من فضلك ادخل بريد الكتروني جديد';
            }

            $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_phone=? AND ind_id !=?");
            $stmt->execute(array($ind_phone, $_SESSION['ind_id']));
            $count_phones = $stmt->rowCount();
            if ($count_phones > 0) {
                $formerror[] = ' رقم الهاتف مستخدم من قبل  ';
            }
            // check in company
            $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_email=?");
            $stmt->execute(array($ind_email));
            $count_mails = $stmt->rowCount();
            if ($count_mails > 0) {
                $formerror[] = 'البريد الألكتروني مستخدم من قبل من فضلك ادخل بريد الكتروني جديد';
            }

            $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_phone=?");
            $stmt->execute(array($ind_phone));
            $count_phones = $stmt->rowCount();
            if ($count_phones > 0) {
                $formerror[] = 'رقم الهاتف مستخدم من قبل ';
            }
            if (empty($formerror)) {
                $stmt = $connect->prepare("UPDATE ind_register SET
                ind_name=?,
                ind_birthdate=?,ind_email=?,ind_phone=?,ind_nationality=?,ind_address=?,ind_gender=?,ind_transfer=?,
                ind_english=?,ind_info=? WHERE ind_id=?");
                $stmt->execute(
                    array(
                        $ind_name,
                        $ind_birthdate,
                        $ind_email,
                        $ind_phone,
                        $ind_nationality,
                        $ind_address,
                        $ind_gender,
                        $ind_transfer,
                        $ind_english,
                        $ind_info,
                        $_SESSION['ind_id']
                    )
                );
                if ($stmt) { ?>
                    <div class="alert alert-success">" تم تعديل معلوماتك بنجاح " </div>
                    <?php
                    header('refresh:2;url=profile');
                    ?>
                    <br>
                <?php
                }
            } else {
                foreach ($formerror as $error) { ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?> <i class="fa fa-close"></i>
                    </div>
        <?php
                }
            }
        }
        ?>
        <div class="container-fluid">
            <div class="data">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="info">
                            <div class="info_data">
                                <div class="profile_edit_image">
                                    <?php
                                    if ($ind_data_image['ind_image'] == "") {
                                        if ($ind_data_image['ind_gender'] == 'ذكر') {
                                    ?>
                                            <img src="../images/avatar.png" alt="">
                                        <?php
                                        } elseif ($ind_data_image['ind_gender'] == 'انثي') { ?>
                                            <img src="../images/girl_avatar.png" alt="">
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    } else { ?>
                                        <img src="../ind_images_upload/<?php echo $ind_data_image['ind_image']; ?>" alt="">
                                    <?php
                                    }
                                    ?>
                                    <br><br>
                                    <button type="button" class="btn btn-primary btn-sm" id="change_image" style="margin-right: 30px;"> تعديل الصورة </button>
                                    <br>
                                    <br>
                                    <form class="div_change_image" action="" method="post" enctype="multipart/form-data">
                                        <br>
                                        <div class='upload_file' dir="ltr">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="image" accept="image/*" class="custom-file-input form-control" id="customFile" onchange="checkFileTypeIMage()">
                                                        <label class="custom-file-label" for="exampleInputFile"> رفع </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button name="save_image" type="submit" class="btn btn-primary btn-sm" style="margin-right: 30px;"> حفظ </button>
                                    </form>
                                    <?php
                                    if (isset($_POST['save_image'])) {
                                        if (!empty($_FILES['image']['name'])) {
                                            $allowed_extensions = array('jpg', 'png', 'jpeg', 'webp'); // قائمة بالامتدادات المسموح بها للفيديو

                                            $pro_image_name = $_FILES['image']['name'];
                                            $pro_image_name = str_replace(' ', '', $pro_image_name);
                                            $pro_image_temp = $_FILES['image']['tmp_name'];
                                            $pro_image_type = $_FILES['image']['type'];
                                            $pro_image_size = $_FILES['image']['size'];
                                            $pro_image_uploaded = time() . '_' . $pro_image_name;
                                            // حصول على الامتداد
                                            $file_extension = strtolower(pathinfo($pro_image_uploaded, PATHINFO_EXTENSION));
                                            move_uploaded_file(
                                                $pro_image_temp,
                                                '../ind_images_upload/' . $pro_image_uploaded
                                            );
                                        } else {
                                            $pro_image_uploaded = '';
                                        }
                                        // التحقق من أن الامتداد مسموح به
                                        if (in_array($file_extension, $allowed_extensions)) {
                                            move_uploaded_file(
                                                $pro_image_temp,
                                                '../ind_images_upload/' . $pro_image_uploaded
                                            );

                                            $stmt = $connect->prepare("UPDATE ind_register SET ind_image=? WHERE ind_id=?");
                                            $stmt->execute(array($pro_image_uploaded, $_SESSION['ind_id']));
                                            if ($stmt) {
                                                header("Location:edit");
                                            }
                                        } else {
                                    ?>
                                            <script>
                                                alert("  يرجي اختيار صوره فقط من نوع  [ jpg,png,jpeg,webp ] ");
                                            </script>
                                    <?php

                                        }
                                    }
                                    ?>
                                </div>
                                <form action="" method="POST" class="form-group">
                                    <div class="data2">
                                        <div class="box">
                                            <label for="">اسم المستخدم <span> * </span> </label>
                                            <input disabled type="text" class="form-control" name="ind_username" value="<?php echo $ind_data['ind_username']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for=""> نبذه مختصره </label>
                                            <textarea max='500' required name="ind_info" class="form-control"><?php echo $ind_data['ind_info']; ?></textarea>
                                        </div>
                                        <div class="box">
                                            <label for=""> البريد الالكتروني <span> * </span></label>
                                            <input type="text" class="form-control" name="ind_email" value="<?php echo $ind_data['ind_email']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for=""> رقم الهاتف <span> * </span></label>
                                            <input type="number" minlength="8" maxlength="20" class="form-control" name="ind_phone" value="<?php echo $ind_data['ind_phone']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for=""> الأسم بالعربي رباعي <span> * </span></label>
                                            <input type="text" class="form-control" name="ind_name" value="<?php echo $ind_data['ind_name']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="">تاريخ الميلاد <span> * </span></label>
                                            <?php $tenYearsAgo = date('Y-m-d', strtotime('-15 years')); ?>
                                            <input type="date" min="1900-01-01" max="<?php echo $tenYearsAgo; ?>" class="form-control" name="ind_birthdate" value="<?php echo $ind_data['ind_birthdate']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="">الجنسية <span> * </span></label>
                                            <input type="text" class="form-control" name="ind_nationality" value="<?php echo $ind_data['ind_nationality']; ?>">
                                        </div>
                                        <div class="box">
                                            <label for="">منطقة السكن الحالي <span> * </span></label>
                                            <select required id="ind_address" class="form-control select2" name="ind_address">
                                                <option value=""> -- منطقة السكن الحالي * --</option>
                                                <option <?php if ($ind_data['ind_address'] == 'الرياض')
                                                            echo "selected"; ?> value="الرياض">الرياض
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'جدة')
                                                            echo "selected"; ?> value="جدة">جدة
                                                </option>
                                                <option <?php if (isset($_REQUEST['ind_address']) && $_REQUEST['ind_address'] == 'مكة')
                                                            echo "selected"; ?> value="مكة">مكة
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'المدينة المنورة')
                                                            echo "selected"; ?> value="المدينة المنورة">المدينة المنورة
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'الطائف')
                                                            echo "selected"; ?> value="الطائف">الطائف
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'تبوك')
                                                            echo "selected"; ?> value="تبوك">تبوك
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'خميس مشيط')
                                                            echo "selected"; ?> value="خميس مشيط">خميس مشيط
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'عفيف')
                                                            echo "selected"; ?> value="عفيف">عفيف
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'عرعر')
                                                            echo "selected"; ?> value="عرعر">عرعر
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'أبها')
                                                            echo "selected"; ?> value="أبها">أبها
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'عسير')
                                                            echo "selected"; ?> value="عسير">عسير
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'بلجرشي')
                                                            echo "selected"; ?> value="بلجرشي">بلجرشي
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'بيشة')
                                                            echo "selected"; ?> value="بيشة">بيشة
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'بريدة')
                                                            echo "selected"; ?> value="بريدة">بريدة
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'القصيم')
                                                            echo "selected"; ?> value="القصيم">القصيم
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'الباحة')
                                                            echo "selected"; ?> value="الباحة">الباحة
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'الدمام')
                                                            echo "selected"; ?> value="الدمام">الدمام
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'الظهران')
                                                            echo "selected"; ?> value="الظهران">الظهران
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'الدوادمي')
                                                            echo "selected"; ?> value="الدوادمي">الدوادمي
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'جزر فرسان')
                                                            echo "selected"; ?> value="جزر فرسان">جزر فرسان
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'القريات')
                                                            echo "selected"; ?> value="القريات">القريات
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'القويعية')
                                                            echo "selected"; ?> value="القويعية">القويعية
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'حرمة')
                                                            echo "selected"; ?> value="حرمة">حرمة
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'حائل')
                                                            echo "selected"; ?> value="حائل">حائل
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'حوطة بني تميم')
                                                            echo "selected"; ?> value="حوطة بني تميم">حوطة بني تميم
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'الهفوف')
                                                            echo "selected"; ?> value="الهفوف">الهفوف
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'حفر الباطن')
                                                            echo "selected"; ?> value="حفر الباطن">حفر الباطن
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'جبل أم الرؤوس')
                                                            echo "selected"; ?> value="جبل أم الرؤوس">جبل أم الرؤوس
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'الجوف')
                                                            echo "selected"; ?> value="الجوف">الجوف
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'جيزان')
                                                            echo "selected"; ?> value="جيزان">جيزان
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'الجبيل')
                                                            echo "selected"; ?> value="الجبيل">الجبيل
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'الخفجي')
                                                            echo "selected"; ?> value="الخفجي">الخفجي
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'الخرج')
                                                            echo "selected"; ?> value="الخرج">الخرج
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'الخبر')
                                                            echo "selected"; ?> value="الخبر">الخبر
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'أملج')
                                                            echo "selected"; ?> value="أملج">أملج
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'القطيف')
                                                            echo "selected"; ?> value="القطيف">القطيف
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'القنفذة')
                                                            echo "selected"; ?> value="القنفذة">القنفذة
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'رأس التنورة')
                                                            echo "selected"; ?> value="رأس التنورة">رأس التنورة
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'سكاكا')
                                                            echo "selected"; ?> value="سكاكا">سكاكا
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'شرورة')
                                                            echo "selected"; ?> value="شرورة">شرورة
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'شقرا')
                                                            echo "selected"; ?> value="شقرا">شقرا
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'العلا')
                                                            echo "selected"; ?> value="العلا">العلا
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'عنيزة')
                                                            echo "selected"; ?> value="عنيزة">عنيزة
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'وادي الدواسر')
                                                            echo "selected"; ?> value="وادي الدواسر">وادي الدواسر
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'ينبع')
                                                            echo "selected"; ?> value="ينبع">ينبع
                                                </option>
                                                <option <?php if ($ind_data['ind_address'] == 'زلفي')
                                                            echo "selected"; ?> value="زلفي">زلفي
                                                </option>
                                            </select>

                                        </div>
                                        <div class="box">
                                            <label for=""> مهارة اللغة الأنجليزية <span> * </span></label>
                                            <select required class="form-control select2" name="ind_english">
                                                <option value=""> -- مهارة اللغة الأنجليزية -- </option>
                                                <option <?php if ($ind_data["ind_english"] == "متوسط")
                                                            echo "selected"; ?> value="متوسط">متوسط </option>
                                                <option <?php if ($ind_data["ind_english"] == "متقدم")
                                                            echo "selected"; ?> value="متقدم">متقدم </option>
                                                <option <?php if ($ind_data["ind_english"] == "مبتدئ")
                                                            echo "selected"; ?> value="مبتدئ">مبتدئ </option>
                                            </select>
                                        </div>
                                        <div class="box">
                                            <label for="">امكانية التنقل <span> * </span></label>
                                            <select required class="form-control select2" name="ind_transfer">
                                                <option value="">-- أمكانية التنقل للعمل في مدينة أخرى ؟ --</option>
                                                <option <?php if ($ind_data["ind_transfer"] == "نعم")
                                                            echo "selected"; ?> value="نعم">نعم </option>
                                                <option <?php if ($ind_data["ind_transfer"] == "لا")
                                                            echo "selected"; ?> value="لا">لا</option>
                                            </select>
                                        </div>
                                        <div class="box">
                                            <label for=""> الجنس <span> * </span></label>
                                            <select oninvalid="setCustomValidityArabic(this,'من فضلك حدد الجنس')" oninput="resetCustomValidity(this)" required id="ind_gender2" class="form-control select" name="ind_gender">
                                                <option value=""> -- الجنس *--</option>
                                                <option <?php if ($ind_data["ind_gender"] == "ذكر")
                                                            echo "selected"; ?> value="ذكر">ذكر
                                                </option>
                                                <option <?php if ($ind_data["ind_gender"] == "انثي")
                                                            echo "selected"; ?> value="انثي">انثي
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="box text-center">
                                        <button class="btn btn-primary" type="submit" name="send_message"> تعديل <i class="fa fa-edit"></i> </button>
                                    </div>
                            </div>
                        </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>

<?php

    include $tem . "footer.php";
} else {
    header('Location:index.php');
    exit();
}


?>

<!-- <script>
    function checkFileTypeIMage() {
        var fileInput = document.getElementById('customFile');
        var allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        for (var i = 0; i < fileInput.files.length; i++) {
            var fileType = fileInput.files[i].type;

            if (allowedTypes.indexOf(fileType) === -1) {
                // نوع الملف غير مسموح
                alert(' يرجي اختيار صوره فقط من نوع  [ jpg,png,jpeg,webp ] ');

                // إعادة تعيين قيمة الملف بعد تأخير قصير
                setTimeout(function() {
                    fileInput.value = '';
                }, 100);

                return;
            }
        }

    }
</script> -->