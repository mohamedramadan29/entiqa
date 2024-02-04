<?php
$pagetitle = '  حساب المتدرب  ';
ob_start();
session_start();
$com_navbar = 'com';
include 'init.php';
if (isset($_SESSION['com_id'])) {
    // get the company subscribe 
    $stmt = $connect->prepare("SELECT * FROM subscribe");
    $stmt->execute();
    $subscribe_balance = $stmt->fetch();
    $company_sub = $subscribe_balance['company_subscribe'];
    // check if this company active or not active 
    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id = ?");
    $stmt->execute(array($_SESSION['com_id']));
    $company_data = $stmt->fetch();
    $com_status = $company_data['com_status'];
    $com_balance = $company_data['com_balance'];
    $active_status = $company_data['active_status'];
    if ($com_status == 0 || $com_balance < $company_sub || $active_status == 0) {
        header('Location:index');
        exit();
    }
    if (isset($_GET['username'])) {
        $username = $_GET['username'];
?>
        <div class="profile_hero">
            <div class="overlay">
                <div class="container">
                    <div class="data">
                        <h2> حساب المتدرب </h2>
                    </div>
                    <div class="profile_image">
                        <?php
                        $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_username = ?");
                        $stmt->execute(array($username));
                        $ind_data_image = $stmt->fetch();
                        if ($ind_data_image['ind_image'] != '') {
                        ?>
                            <img src="../ind_images_upload/<?php echo $ind_data_image['ind_image'] ?>" alt="">
                        <?php
                        } else {
                        ?>
                            <img src="../images/avatar.png" alt="">
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_username=?");
        $stmt->execute(array($username));
        $ind_data = $stmt->fetch();
        ///////////////

        // end contract 

        $stmt = $connect->prepare("UPDATE contract_cancel SET update_at=? WHERE 
company_id=? AND ind_id=?");
        $stmt->execute(array(date('y-m-d'), $_SESSION['com_id'], $ind_data['ind_id']));
        ?>
        <div class="profile_data">
            <div class="container-fluid">
                <div class="data">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="info">
                                <div class="info_header d-none">
                                    <h2> معلومات عن المتدرب </h2>
                                </div>
                                <div class="info_data">
                                    <div class="data1 d-none">
                                        <h4> نبذة عن المتدرب </h4>
                                        <p>
                                            <?php
                                            if (!empty($ind_data['ind_info'])) {
                                                echo $ind_data['ind_info'];
                                            } else { ?>

                                        <div class="alert alert-info" role="alert"> لا يوجد نبذة مختصرة عن المتدرب</div>
                                    <?php
                                            }
                                    ?>
                                    </p>
                                    </div>
                                    <!-- --------------------------------------------------------------------------------------------------------------------- -->
                                    <!-- --------------------------------------------------------------------------------------------------------------------- -->
                                    <!-- --------------------------------------------------------------------------------------------------------------------- -->
                                    <?php

                                    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_username=?");
                                    $stmt->execute(array($username));
                                    $batch_data = $stmt->fetch();
                                    if (!empty($ind_data['video'])) {
                                        //     echo "<video src=../ind/porfile_videos/" . $ind_data['video'] . "  width='100%' height='300' 
                                        // style='border:1px solid black;border-radius:20px;' controls/></video>";
                                    ?>
                                        <a target="_blank" href="../ind/user_cv/<?php echo $ind_data['video'] ?>" class="btn btn-warning btn-sm"> مشاهده السيره الذاتيه </a>
                                        <br>
                                        <br><?php
                                        }
                                            ?>


                                    <!-- --------------------------------------------------------------------------------------------------------------------- -->
                                    <!-- --------------------------------------------------------------------------------------------------------------------- -->
                                    <!-- --------------------------------------------------------------------------------------------------------------------- -->
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
                                            <h4> معلومات عن المتدرب </h4>
                                            <br>
                                            <table class="table">
                                                <tr>
                                                    <th> الاسم ثلاثي</th>
                                                    <th> <?php echo $ind_data['ind_name']; ?> </th>
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
                                                    <th> تاريخ الميلاد</th>
                                                    <th> <?php echo $ind_data['ind_birthdate']; ?> </th>
                                                </tr>
                                                <tr>
                                                    <th> الجنسية</th>
                                                    <th> <?php echo $ind_data['ind_nationality']; ?> </th>
                                                </tr>
                                                <tr>
                                                    <th> منطقة السكن الحالي</th>
                                                    <th> <?php echo $ind_data['ind_address']; ?> </th>
                                                </tr>
                                                <tr>
                                                    <th> امكانية التنقل</th>
                                                    <th> <?php echo $ind_data['ind_transfer']; ?> </th>
                                                </tr>
                                                <tr>
                                                    <th> مهارة اللغه الأنجليزية</th>
                                                    <th>
                                                        <?php echo $ind_data['ind_english']; ?>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th> الجنس</th>
                                                    <th>
                                                        <?php echo $ind_data['ind_gender']; ?>
                                                    </th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="document_section d-none">
                                <button class=" btn btn-primary">حالة المتدرب</button>
                                <div class="user_status">

                                    <p class="alert alert-primary" role="alert">
                                        تم تفعيل المتدرب علي المنصة بنجاح
                                    </p>
                                </div>

                            </div>
                            <?php
                            if (isset($_SESSION['com_id'])) {
                            ?>
                                <div class="document_section document_section2">
                                    <button style=" margin-top:70px" class="start_chat btn btn-primary" class="btn btn-success"><a href="com_message.php?other=<?php echo $username ?>"> طلب التفاوض مع
                                            المتدرب </a> <i class="fa fa-paper-plane"></i></button>
                                </div>
                                <!-- <?php
                                        if (isset($ind_data['ind_certificate']) && $ind_data['ind_certificate'] != null) { ?>
                                    <div class="document_section document_certificate">
                                        <h6> شهادة المتدرب المعتمدة من المنصة </h6>

                                        <a target="_blank" href="../admin/uploads/<?php echo $ind_data['ind_certificate'] ?>" class="btn btn-warning btn-sm"> مشاهدة الشهادة </a>
                                    </div>
                                <?php
                                        }
                                ?> -->
                            <?php
                            }
                            ?>
                            <!-- <div class="data2">
                                <h4 style="color:#000; font-size:25px; margin-top:80px">الاختبارات</h4>
                                <div>
                                    <p style="color: #000; font-size:18px; margin-bottom:10px;margin-top:10px;">درجة
                                        تقييم
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
                                    <p style="color: #000; font-size:18px; margin-bottom:10px;margin-top:10px;"> درجة
                                        الأختبارات
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
                                    <p style="color: #000; font-size:18px; margin-bottom:10px;margin-top:10px;"> درجة
                                        الأداء و
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
                                    <p style="color: #000; font-size:18px; margin-bottom:10px;margin-top:10px;"> درجة
                                        الحضور
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
                                    <p style="color: #000; font-size:18px; margin-bottom:10px;margin-top:10px;"> النسبة
                                        النهائية
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

        include $tem . "footer.php";
    } else {
        header('Location:../index.php');
        exit();
    }
} else {
    header('Location:login');
    exit();
}
?>