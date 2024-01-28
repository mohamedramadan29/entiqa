<?php
$pagetitle = '  تعديل المعلومات  ';
ob_start();
session_start();
$com_navbar = 'com';
if (isset($_SESSION['com_id'])) {
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
                            <li class="breadcrumb-item"><a href="companies.php">الرئيسية</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php
    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
    $stmt->execute(array($_SESSION['com_id']));
    $com_data = $stmt->fetch();

    ?>
    <div class="profile_data" style="margin-top: 0;">
        <?php
        if (isset($_POST["send_message"])) {
            $com_info = sanitizeInput($_POST["com_info"]);
            $com_email = sanitizeInput($_POST["com_email"]);
            $com_phone = sanitizeInput($_POST["com_phone"]);
            $com_num = sanitizeInput($_POST["com_num"]);
            $com_active = sanitizeInput($_POST["com_active"]);
            $com_place = sanitizeInput($_POST["com_place"]);
            $com_braches = sanitizeInput($_POST["com_braches"]);
            $com_work_h = sanitizeInput($_POST["com_work_h"]);
            $com_founded = sanitizeInput($_POST['com_founded']);
            $com_work_libs = sanitizeInput($_POST['com_work_libs']);
            $com_weekend_num = sanitizeInput($_POST['com_weekend_num']);
            $com_work_type = sanitizeInput($_POST['com_work_type']);
            $com_salary = sanitizeInput($_POST['com_salary']);
            $com_commission = sanitizeInput($_POST['com_commission']);
            // $ind_password = $_POST["ind_password"];
            // $confirm_password = $_POST["confirm_password"];
            $formerror = [];
            if (empty($com_info) || empty($com_email) || empty($com_phone) || empty($com_num) || empty($com_place) || empty($com_braches) || empty($com_work_h) || empty($com_work_libs)) {
                $formerror[] = " من فضلك ادخل جميع البيانات بشكل صحيح ";
            }
            if (empty($com_num)) {
                $formerror[] = "    فضلك ادخل  رقم السجل التجاري     ";
            }

            if (empty($com_email)) {
                $formerror[] = " يجب اضافة البريد الالكتروني  ";
            } elseif (!filter_var($com_email, FILTER_VALIDATE_EMAIL)) {
                $formerror[] = " يجب إدخال عنوان بريد إلكتروني صالح ";
            } elseif (strlen($com_email) > 100) {
                $formerror[] = "طول البريد الإلكتروني يجب أن لا يتجاوز 100 حرفًا";
            } elseif (!preg_match('/^[a-zA-Z0-9.@ـ\-\_\+\,\']+$/u', $com_email)) {
                $formerror[] = "البريد الإلكتروني يجب أن يحتوي على أحرف وأرقام ورموز صحيحة فقط";
            } elseif (strpos($com_email, '..') !== false) {
                $formerror[] = "البريد الإلكتروني يحتوي على أحرف غير صالحة";
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
            $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_email=? AND com_id !=?");
            $stmt->execute(array($com_email, $_SESSION['com_id']));
            $count_mails = $stmt->rowCount();
            if ($count_mails > 0) {
                $formerror[] = 'البريد الألكتروني مستخدم من قبل من فضلك ادخل بريد الكتروني جديد';
            }

            $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_phone=? AND com_id !=?");
            $stmt->execute(array($com_phone, $_SESSION['com_id']));
            $count_phones = $stmt->rowCount();
            if ($count_phones > 0) {
                $formerror[] = 'رقم الهاتف مستخدم من قبل ';
            }
            // check in individuals 
            $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_phone=?");
            $stmt->execute(array($com_phone));
            $data = $stmt->fetch();
            $count_phones = $stmt->rowCount();
            if ($count_phones > 0) {
                $formerror[] = " رقم الهاتف مستخدم من قبل ";
            }
            $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_email=?");
            $stmt->execute(array($com_email));
            $data = $stmt->fetch();
            $count_ind_mails = $stmt->rowCount();
            if ($count_ind_mails > 0) {
                $formerror[] = "  البريد الالكتروني مستخدم بالفعل من فضلك ادخل بريد الكتروني جديد ";
            }

            if (strlen($com_num) > 20 || strlen($com_num) < 5 || !is_numeric($com_num)) {
                $formerror[] = ' رقم السجل التجاري يجب ان يكون اكثر من 5 ارقام واقل من 20 رقم ويحتوي علي ارقام فقط  ';
            }
            if (strlen($com_active) > 200 || strlen($com_active) < 5) {
                $formerror[] = 'يجب ان يتم ادخال نشاط الشركه بشكل صحيح يجب ان يكون اكبر من 5 احرف واقل من 200 حرف';
            }
            if (strlen($com_braches) > 100) {
                $formerror[] = 'فروع الشركه يجب ان تكون اقل من 100 حرف';
            }

            $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_num=? AND com_id !=?");
            $stmt->execute(array($com_num, $_SESSION['com_id']));
            $data = $stmt->fetch();
            $count = $stmt->rowCount();
            if ($count > 0) {
                $formerror[] = " تم التسجيل برقم السجل التجاري من قبل  ";
            }
            if (empty($formerror)) {
                $stmt = $connect->prepare("UPDATE company_register SET
                com_email=?,com_phone=?,
                com_num=?,com_active=?,com_place=?,com_braches=?,com_founded=?,com_work_h=?,com_work_libs=?,com_weekend_num=?,com_work_type=?
                ,com_salary=?,com_commission=?
                ,com_info=? WHERE com_id=?");
                $stmt->execute(array(
                    $com_email, $com_phone, $com_num,  $com_active,  $com_place,  $com_braches,
                    $com_founded, $com_work_h,  $com_work_libs,   $com_weekend_num,  $com_work_type,
                    $com_salary,  $com_commission,  $com_info,  $_SESSION['com_id']
                ));
                if ($stmt) {

                    header("refresh:2;url=profile");
        ?>
                    <div class="alert alert-success">" تم تعديل معلوماتك بنجاح " </div>
                    <br>
                <?php
                }
            } else {
                foreach ($formerror as $error) { ?>
                    <div class="alert alert-danger"> <?php echo $error; ?> <i class="fa fa-close"></i> </div>

        <?php

                }
            }
        }

        ?>
        <div class="container-fluid">
            <div class="data">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="info" style="margin-top: 0;">
                            <div class="info_data">
                                <div class="data1 profile_edit_image">
                                    <?php
                                    if ($com_data['com_image'] != '') {
                                    ?>
                                        <img src="../ind_images_upload/<?php echo $com_data['com_image']; ?>" alt="">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="../images/avatar.png" alt="">
                                    <?php
                                    }
                                    ?>
                                    <br><br>
                                    <button type="button" class="btn btn-primary btn-sm" id="change_image" style="margin-right: 30px;"> تعديل الصورة </button>
                                    <br>
                                    <br>
                                    <form class="div_change_image" action="" method="post" enctype="multipart/form-data">
                                        <div class='upload_file' dir="ltr">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input required type="file" name="image" accept="image/*" class="custom-file-input form-control" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile"> رفع لوجو الشركة </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>
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

                                            $stmt = $connect->prepare("UPDATE company_register SET com_image=? WHERE com_id=?");
                                            $stmt->execute(array($pro_image_uploaded, $_SESSION['com_id']));
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
                                    ?>
                                </div>
                                <form action="" method="POST" class="form-group">
                                    <div class="data1">
                                        <h4> نبذة عن الشركة </h4>
                                        <textarea required name="com_info" class="form-control"><?php echo $com_data['com_info']; ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="data2">
                                                <h4> معلومات عن الشركه </h4>
                                                <div class="box">
                                                    <label for="">اسم الشركة <span> * </span></label>
                                                    <input disabled type="text" class="form-control" name="com_name" value="<?php echo $com_data['com_name']; ?>">
                                                </div>
                                                <div class="box">
                                                    <label for=""> رقم الهاتف <span> * </span></label>
                                                    <input required type="number" minlength="8" maxlength="20" class="form-control" name="com_phone" value="<?php echo $com_data['com_phone']; ?>">
                                                </div>
                                                <div class="box">
                                                    <label for=""> البريد الالكتروني <span> * </span></label>
                                                    <input required type="text" class="form-control" name="com_email" value="<?php echo $com_data['com_email']; ?>">
                                                </div>
                                                <div class="box">
                                                    <label for=""> رقم السجل التجاري <span> * </span></label>
                                                    <input required minlength="5" min="1" type="text" class="form-control" name="com_num" value="<?php echo $com_data['com_num']; ?>">
                                                </div>
                                                <div class="box">
                                                    <label for=""> نشاط الشركه <span> * </span></label>
                                                    <input required minlength="5" min="1" type="text" class="form-control" name="com_active" value="<?php echo $com_data['com_active']; ?>">
                                                </div>
                                                <div class="box">
                                                    <label for="">مقر الشركه الرئيسي <span> * </span></label>
                                                    <input required type="text" class="form-control" name="com_place" value="<?php echo $com_data['com_place']; ?>">
                                                </div>
                                                <div class="box">
                                                    <label for=""> فروع الشركة <span> * </span></label>
                                                    <input required type="text" class="form-control" name="com_braches" value="<?php echo $com_data['com_braches']; ?>">
                                                </div>
                                                <div class="box">
                                                    <label for=""> أوقات ساعات العمل <span> * </span></label>
                                                    <input required minlength="5" min="1" type="text" class="form-control" name="com_work_h" value="<?php echo $com_data['com_work_h']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="data2">
                                                <div class="box">
                                                    <label for=""> سنة التاسيس <span> * </span> </label>
                                                    <input min="1980" required oninvalid="setCustomValidityArabic(this,'ادخل سنة التأسيس')" oninput="resetCustomValidity(this)" class="form-control" id="com_founded" type="number" name="com_founded" placeholder="سنة التاسيس" value="<?php echo $com_data['com_founded']; ?>">
                                                </div>
                                                <div class="box">
                                                    <label for=""> عدد الشفتات <span> * </span> </label>
                                                    <input min="1" required oninvalid="setCustomValidityArabic(this,'من فضلك ادخل عدد الشفتات')" oninput="resetCustomValidity(this)" class="form-control" id="com_work_libs" type="number" name="com_work_libs" placeholder="عدد الشفتات " value="<?php echo $com_data['com_work_libs']; ?>">
                                                </div>
                                                <div class="box">
                                                    <label for=""> عدد أيام الأجازة الأسبوعية <span> * </span> </label>
                                                    <input min="0" max="7" required oninvalid="setCustomValidityArabic(this,'من فضلك حدد ايام الأجازة الأسبوعية')" oninput="resetCustomValidity(this)" class="form-control" id="com_weekend_num" type="number" placeholder="عدد أيام الأجازة الأسبوعية " name="com_weekend_num" value="<?php echo $com_data['com_weekend_num']; ?>">
                                                </div>
                                                <div class="box">
                                                    <label for=""> نوع العمل <span> * </span> </label>
                                                    <select required oninvalid="setCustomValidityArabic(this,'حدد نوع العمل ')" oninput="resetCustomValidity(this)" class="form-control select2" id="com_work_type" name="com_work_type">
                                                        <option value="">-- اختر نوع العمل --</option>
                                                        <option <?php if ($com_data['com_work_type'] == 'عمل ميداني') echo 'selected'; ?> value="عمل ميداني"> عمل ميداني </option>
                                                        <option <?php if ($com_data['com_work_type'] == 'عمل مكتبي') echo 'selected'; ?> value="عمل مكتبي"> عمل مكتبي </option>
                                                    </select>
                                                </div>
                                                <div class="box">
                                                    <label for=""> الراتب المقدر <span> * </span></label>
                                                    <input min="1" required oninvalid="setCustomValidityArabic(this,'من فضلك ادخل الراتب المقدر ')" oninput="resetCustomValidity(this)" class="form-control" id="com_salary" type="number" placeholder="الراتب المقدر " name="com_salary" value="<?php echo $com_data['com_salary']; ?>">
                                                </div>
                                                <div class="box">
                                                    <label for=""> العمولة المقدرة <span> * </span></label>
                                                    <input min="0" max="100" required oninvalid="setCustomValidityArabic(this,'من فضلك ادخل العمولة المقدرة')" oninput="resetCustomValidity(this)" class="form-control" id="com_commission" type="number" placeholder="العمولة المقدرة " name="com_commission" value="<?php echo $com_data['com_commission']; ?>">
                                                </div>
                                            </div>
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
    include  $tem . "footer.php";
} else {
    header('Location:index.php');
    exit();
}
?>