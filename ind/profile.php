<?php

ob_start();
session_start();
$pagetitle = '  حسابي  ';
if (isset($_SESSION['ind_id'])) {
    $ind_navabar = 'ind';
}
if (isset($_SESSION['ind_id']) || isset($_GET['ind_id'])) {
    include 'init.php';
    $ind_id = $_SESSION['ind_id'];
    if (isset($_GET['ind_id'])) {
        $ind_id = $_GET['ind_id'];
    }
    if (isset($_GET['batch_noti']) && is_numeric($_GET['batch_noti'])) {
        $batch_noti = $_GET['batch_noti'];
        $stmt = $connect->prepare("SELECT * FROM batches_notification WHERE id=?");
        $stmt->execute(array($batch_noti));
        $batch_data = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $stmt = $connect->prepare("UPDATE batches_notification SET status = 1 WHERE id = ? AND ind = ?");
            $stmt->execute(array($batch_data['id'], $_SESSION['ind_id']));
        }
    }
    if (isset($_GET['status_show']) == 'new') {
        $stmt = $connect->prepare("UPDATE ind_congrat SET status = 1 WHERE ind_id = ?");
        $stmt->execute(array($_SESSION['ind_id']));

        $stmt = $connect->prepare("UPDATE change_status_notification SET status_show = 1 WHERE ind_id = ? AND status_show = 0");
        $stmt->execute(array($_SESSION['ind_id']));
    }
?>
    <div class="profile_hero">
        <div class="overlay">
            <div class="container">
                <div class="data">
                    <h2> حسابي </h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"> حسابي </li>
                            <li class="breadcrumb-item"><a href="index">الرئيسية</a></li>
                        </ol>
                    </nav>
                </div>
                <div class="profile_image">
                    <?php
                    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id = ?");
                    $stmt->execute(array($_SESSION['ind_id']));
                    $ind_data_image = $stmt->fetch();
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
                </div>
            </div>
        </div>
    </div>
    <?php
    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id=?");
    $stmt->execute(array($ind_id));
    $ind_data = $stmt->fetch();
    ?>
    <?php
    //if (!empty($ind_data['ind_sub_exam']) && !empty($ind_data['ind_final_exam']) && !empty($ind_data['ind_exer_exam']) && !empty($ind_data['ind_attend']) && !empty($ind_data['ind_degree_percen'])) {
    ?>
    <div class="profile_data">
        <div class="container-fluid">
            <div class="data">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="info">
                            <?php
                            if (isset($_POST['update_profile_status'])) {
                                $stmt = $connect->prepare("UPDATE ind_register SET order_number = 1 WHERE ind_id=?");
                                $stmt->execute(array($_SESSION['ind_id']));
                                $stmt = $connect->prepare("UPDATE ind_register SET order_number = order_number + 1 WHERE ind_id != ?");
                                $stmt->execute(array($_SESSION['ind_id']));
                                if ($stmt) {
                            ?>
                                    <div class='alert alert-success'> تم تحديث ترتيب الحساب بنجاح </div>
                            <?php
                                }
                            }
                            ?>
                            <div class="info_header">
                                <?php
                                $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id=?");
                                $stmt->execute(array($_SESSION['ind_id']));
                                $ind_data = $stmt->fetch();
                                if (isset($_SESSION['ind_id'])) {
                                    if ($ind_data['ind_status'] != null && $ind_data['ind_status'] != 0) {
                                ?>
                                        <form action="" method="post">
                                            <button name="update_profile_status" type="submit" class="btn btn-outline-danger"> تحديث حالة </button>
                                        </form>

                                    <?php
                                    }
                                    ?>
                                    <a href="edit" class="btn btn-primary"> تعديل <i class="fa fa-edit"></i></a>
                                <?php
                                }
                                ?>
                                <!-- -------------------------------------------------------------------------------------------------------------------------->
                            </div>
                            <?php

                            if (!empty($ind_data['video'])) {
                                // echo "<video src=../ind/porfile_videos/" . $ind_data['video'] . "  width='100%' height='300' 
                                //     style='border:1px solid black;border-radius:20px;' controls/></video>";
                            ?>
                                <a target="_blank" href="user_cv/<?php echo $ind_data['video'] ?>" class="btn btn-warning btn-sm"> مشاهده السيره الذاتيه </a>
                            <?php
                            }
                            ?>
                            <button type="button" class="btn btn-primary btn-sm" id="change_image" style="margin-right: 20px;"> اضافه السيره الذاتيه </button>
                            <br>
                            <br>
                                                
                            <form class="div_change_image" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">

                                <!-- <input type="file" id="videoFile" name="img" class="form-control" required style="margin-right:5px;"   onchange="checkFileSize()"> -->
                                <div class='upload_file' dir="ltr">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                               
                                                <!-- <input id="videoFile" required type="file" name="img" accept="video/*" onchange="checkFileSize()" class="custom-file-input form-control" id="exampleInputFile"> -->
                                                <input id="videoFile" required type="file" name="img" accept="application/pdf, .doc, .docx" onchange="checkFileSize()" class="custom-file-input form-control">

                                                <label class="custom-file-label" for="exampleInputFile"> رفع السيره الذاتيه </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" name="add_video" class="btn btn-primary btn-sm" style="margin-right: 5px;"> حفظ </button>
                            </form>
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                if (!empty($_FILES['img']['name'])) {
                                    $allowed_extensions =  array('pdf', 'doc', 'docx'); // قائمة بالامتدادات المسموح بها للفيديو

                                    $pro_image_name = $_FILES['img']['name'];
                                    $pro_image_name = str_replace(' ', '', $pro_image_name);
                                    $pro_image_temp = $_FILES['img']['tmp_name'];
                                    $pro_image_type = $_FILES['img']['type'];
                                    $pro_image_size = $_FILES['img']['size'];
                                    $pro_image_uploaded = time() . '_' . $pro_image_name;

                                    // حصول على الامتداد
                                    $file_extension = strtolower(pathinfo($pro_image_uploaded, PATHINFO_EXTENSION));

                                    // التحقق من أن الامتداد مسموح به
                                    if (in_array($file_extension, $allowed_extensions)) {
                                        move_uploaded_file(
                                            $pro_image_temp,
                                            'user_cv/' . $pro_image_uploaded
                                        );

                                        $stmt = $connect->prepare("UPDATE ind_register SET video='$pro_image_uploaded' WHERE ind_id = ?");
                                        $stmt->execute(array($_SESSION['ind_id']));
                                        header('location:profile');
                                    } else {
                            ?>
                                        <script>
                                            alert("  من فضلك اختر السيره الذاتيه بشكل صحيح  من نوع ['pdf', 'doc', 'docx' ]");
                                        </script>
                            <?php

                                    }
                                }
                            }
                            ?>


                            <br>
                            <!-- -------------------------------------------------------------------------------------------------------------------------->

                            <h2 style="margin-bottom: 15px; font-size:20px"> معلومات عن المتدرب </h2>
                            <div class="info_data">
                                <div class="data1" style="background-color: #F3F3F3;">
                                    <p>
                                        <?php
                                        if (!empty($ind_data['ind_info'])) {
                                            echo $ind_data['ind_info'];
                                        } else { ?>
                                    <div class="alert alert-info" role="alert"> لا يوجد نبذه عن المتدرب </div>
                                <?php
                                        }
                                ?>
                                </p>
                                </div>
                            </div>
                            <br>
                            <div class="info_data">
                                <div class="data2">
                                    <br>
                                    <table class="table">
                                        <tr>
                                            <th> اسم المستخدم </th>
                                            <th style="color:rgba(0, 0, 0, 0.5);">
                                                <?php echo $ind_data['ind_username']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> الأسم بالعربي رباعي </th>
                                            <th style="color:rgba(0, 0, 0, 0.5);">
                                                <?php echo $ind_data['ind_name']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> رقم الهاتف</th>
                                            <th style="color:rgba(0, 0, 0, 0.5);">
                                                <?php echo $ind_data['ind_phone']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> البريد الألكتروني </th>
                                            <th style="color:rgba(0, 0, 0, 0.5);">
                                                <?php echo $ind_data['ind_email']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> رقم الدفعه</th>
                                            <th style="color:rgba(0, 0, 0, 0.5);">
                                                <?php
                                                if ($ind_data['ind_batch'] == 0) { ?>
                                                    لم يتم التسجيل في دفعه الي الان
                                                <?php
                                                } else {
                                                    $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_id = ?");
                                                    $stmt->execute(array($ind_data['ind_batch']));
                                                    $batch_data = $stmt->fetch();
                                                    echo $batch_data['batch_name'];
                                                }
                                                ?>
                                            </th>
                                        </tr>

                                        <tr>
                                            <th> تاريخ الميلاد </th>
                                            <th style="color:rgba(0, 0, 0, 0.5);">
                                                <?php echo $ind_data['ind_birthdate']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> الجنسية </th>
                                            <th style="color:rgba(0, 0, 0, 0.5);">
                                                <?php echo $ind_data['ind_nationality']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> منطقة السكن الحالي </th>
                                            <th style="color:rgba(0, 0, 0, 0.5);">
                                                <?php echo $ind_data['ind_address']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> امكانية التنقل </th>
                                            <th style="color:rgba(0, 0, 0, 0.5);">
                                                <?php echo $ind_data['ind_transfer']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> مهارة اللغه الأنجليزية </th>
                                            <th style="color:rgba(0, 0, 0, 0.5);">
                                                <?php echo $ind_data['ind_english']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> الجنس </th>
                                            <th style="color:rgba(0, 0, 0, 0.5);">
                                                <?php echo $ind_data['ind_gender']; ?>
                                            </th>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="document_section">
                            <p style="color:#000; font-size:25px; margin-bottom:10px; "> حالة المتدرب </p>
                            <div class="user_status">
                                <?php
                                if ($ind_data['ind_payment_charge'] == null) {
                                ?>
                                    <p class='alert alert-danger'> تنوية : أنت غير مشترك بعد , يرجى قراءة العقد واتمام عملية الدفع

                                    </p>

                                    <a href="payment_terms" class='btn btn-primary' style='background: var(--main-color);border-color: var(--main-color);'>الدفع<i class='fa fa-paypal'></i></a>
                                <?php
                                } elseif ($ind_data['ind_payment_charge'] === 'CAPTURED') {
                                ?>
                                    <p class="alert alert-info" role="alert">

                                        <?php
                                        if ($ind_data['ind_status'] == null && $ind_data['ind_batch'] == 0) {
                                            echo "جاري انضمامك الي دفعة ";
                                        } elseif ($ind_data['ind_status'] == null && $ind_data['ind_batch'] != 0) {
                                            $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_id=?");
                                            $stmt->execute(array($ind_data['ind_batch']));
                                            $batch_data_name = $stmt->fetch();
                                        ?>
                                            <span> اسم دفعتك هو :: <?php echo $batch_data_name['batch_name']; ?> </span>
                                    <?php
                                        } elseif ($ind_data['ind_status'] == 0) {
                                            echo " انت قيد التدريب في الوقت الحالي   ";
                                        } else {
                                            echo " تم تأهيلك  ";
                                        }
                                    }

                                    ?>
                                    </p>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['com_id'])) {
                        ?>
                            <div class="document_section">
                                <button class="start_chat btn btn-primary" class="btn btn-success"> طلب التفاوض مع المتدرب <i class="fa fa-paper-plane"></i> </button>
                            </div>
                        <?php
                        }
                        ?>
                        <!-- <?php
                                if (isset($ind_data['ind_certificate']) && $ind_data['ind_certificate'] != null) { ?>
                            <div class="document_section document_certificate">
                                <h6> شهادة المتدرب المعتمدة من المنصة </h6>

                                <a target="_blank" href="../admin/uploads/<?php echo $ind_data['ind_certificate'] ?>" class="btn btn-warning btn-sm"> مشاهدة الشهادة </a>
                            </div>
                        <?php
                                }
                        ?> -->
                        <!-- <div class="data2">
                            <h4 style="color:#000; font-size:25px; margin-bottom:20px">الاختبارات</h4>
                            <div>
                                <p style="color: #000; font-size:18px; margin-bottom:10px;margin-top:10px;">درجة تقييم
                                    الأختبار النهائي </p>

                                <div class="progress1" style="display: flex;">
                                    <?php if (!empty($ind_data['ind_final_exam'])) {
                                    ?>
                                        <meter type="range" style="width: 500px;height: 30px;border-radius: 30px;background-color: white;-shadow: 3px 4px 5px 0px rgba(204 185 185 / .75);" min="0" max="100" id="customRange2" value="<?php echo $ind_data['ind_final_exam']; ?>"></meter>
                                        <label style="font-weight: bold;color: #000;margin-right: 10px;" for=""> <?php echo $ind_data['ind_final_exam']; ?> </label>
                                    <?php
                                    } else { ?>
                                        <span class="badge badge-info" style="background-color: #626274;"> لم يتم الاختبار </span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div>
                                <p style="color: #000; font-size:18px; margin-bottom:10px;margin-top:10px;"> درجة الأختبارات
                                    القصيرة </p>
                                <div class="progress1" style="display: flex;">
                                    <?php if (!empty($ind_data['ind_sub_exam'])) {
                                    ?>
                                        <meter type="range" style="width: 500px;height: 30px;border-radius: 30px;background-color: white;-shadow: 3px 4px 5px 0px rgba(204 185 185 / .75);" min="0" max="100" id="customRange2" value="<?php echo $ind_data['ind_sub_exam']; ?>"></meter>
                                        <label style="font-weight: bold;color: #000;margin-right: 10px;" for=""> <?php echo $ind_data['ind_sub_exam']; ?> </label>
                                    <?php
                                    } else { ?>
                                        <span class="badge badge-info" style="background-color: #626274;"> لم يتم الاختبار </span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div>
                                <p style="color: #000; font-size:18px; margin-bottom:10px;margin-top:10px;"> درجة الأداء و
                                    التطبيق </p>

                                <div class="progress1" style="display: flex;">
                                    <?php if (!empty($ind_data['ind_exer_exam'])) {
                                    ?>
                                        <meter type="range" style="width: 500px;height: 30px;border-radius: 30px;background-color: white;-shadow: 3px 4px 5px 0px rgba(204 185 185 / .75);" min="0" max="100" id="customRange2" value="<?php echo $ind_data['ind_exer_exam']; ?>"></meter>
                                        <label style="font-weight: bold;color: #000;margin-right: 10px;" for=""> <?php echo $ind_data['ind_exer_exam']; ?> </label>
                                    <?php
                                    } else { ?>
                                        <span class="badge badge-info" style="background-color: #626274;"> لم يتم الاختبار </span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div>
                                <p style="color: #000; font-size:18px; margin-bottom:10px;margin-top:10px;"> درجة الحضور
                                </p>

                                <div class="progress1" style="display: flex;">
                                    <?php if (!empty($ind_data['ind_attend'])) {
                                    ?>
                                        <meter type="range" style="width: 500px;height: 30px;border-radius: 30px;background-color: white;-shadow: 3px 4px 5px 0px rgba(204 185 185 / .75);" min="0" max="100" id="customRange2" value="<?php echo $ind_data['ind_attend']; ?>"></meter>
                                        <label style="font-weight: bold;color: #000;margin-right: 10px;" for=""> <?php echo $ind_data['ind_attend']; ?> </label>
                                    <?php
                                    } else { ?>
                                        <span class="badge badge-info" style="background-color: #626274;"> لم يتم الاختبار </span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div>
                                <p style="color: #000; font-size:18px; margin-bottom:10px;margin-top:10px;"> النسبة النهائية
                                </p>

                                <div class="progress1" style="display: flex;">
                                    <?php if (!empty($ind_data['ind_degree_percen'])) {
                                    ?>
                                        <meter type="range" style="width: 500px;height: 30px;border-radius: 30px;background-color: white;-shadow: 3px 4px 5px 0px rgba(204 185 185 / .75);" min="0" max="100" id="customRange2" value="<?php echo $ind_data['ind_degree_percen']; ?>"></meter>
                                        <label style="font-weight: bold;color: #000;margin-right: 10px;" for=""> <?php echo $ind_data['ind_degree_percen']; ?> </label>
                                    <?php
                                    } else { ?>
                                        <span class="badge badge-info" style="background-color: #626274;"> لم يتم الاختبار </span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <br>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    // } else {
    ?>

    <?php
    // }

    ?>


<?php

    include $tem . "footer.php";
} else {
    header('Location:../index.php');
    exit();
}
?>

<script>
    function checkFileSize() {
        var fileInput = document.getElementById('videoFile');
        if (fileInput.files.length > 0) {
            var fileSize = fileInput.files[0].size; // حجم الملف بالبايت
            var maxSize = 5 * 1024 * 1024; // 50 ميجابايت بالبايت
            if (fileSize > maxSize) {
                alert('حجم الملف يجب ألا يتجاوز 5 ميجابايت');
                fileInput.value = ''; // إعادة تعيين قيمة الملف المختار
            }
        }
    }
</script>