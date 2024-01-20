<?php

ob_start();
session_start();
$pagetitle = ' عرض الاشعارات ';
$ind_navabar = 'ind';
if (isset($_SESSION['ind_id'])) {
    include 'init.php';
?>
    <div class="all_message">
        <div class="container">
            <div class="data">
                <h2> جميع الأشعارات </h2>
                <?php
                /// المقابلات الشخصية 
                $stmt = $connect->prepare("SELECT * FROM interview_notificaion WHERE noti_person_link=?");
                $stmt->execute(array($_SESSION['ind_id']));
                $alldatainterview = $stmt->fetchAll();
                $interview_noti_count = $stmt->rowCount();
                if ($interview_noti_count > 0) {
                ?>
                    <h6 style="color: #6a6868;font-size: 19px;padding: 20px;"> المقابلات الشخصية </h6>
                    <?php
                    foreach ($alldatainterview as $interview) {
                        $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
                        $stmt->execute(array($interview['noti_com_link']));
                        $com_data = $stmt->fetch();
                    ?>
                        <a href="ind_message.php?other=<?php echo $com_data['com_username']; ?>" class="message_link">
                            <div class="message_data">
                                <div class="image">
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
                                </div>
                                <div class="info">
                                    <p> <?php echo $com_data['com_username']; ?> </p>
                                    <p> طلب مقابلة شخصية </p>
                                    <span> <i class="fa fa-clock-o"></i>
                                        <?php
                                        // استلام التاريخ والوقت من الداتا بيز أو أي مصدر آخر
                                        $dateTimeString = $interview['interview_date'];

                                        // تحويل السلسلة إلى كائن DateTime
                                        $dateTime = new DateTime($dateTimeString);

                                        // تحديد تنسيق التاريخ والوقت
                                        $dateFormat = "Y-m-d";
                                        $timeFormat = "h:i A";

                                        // الحصول على التاريخ والوقت بالتنسيق المطلوب
                                        $date = $dateTime->format($dateFormat);
                                        $time = $dateTime->format($timeFormat);

                                        // تحديد ما إذا كانت الساعة تقع في فترة الصباح أم المساء
                                        $period = $dateTime->format("A"); // AM أو PM

                                        // تحديد مساءً أو صباحًا
                                        $amOrPm = ($period == "AM") ? "صباحًا" : "مساءً";
                                        // عرض التاريخ والوقت والفترة (صباحًا أو مساءًا)
                                        echo "في تاريخ: $date $time $amOrPm";
                                        ?> </span>
                                </div>
                            </div>
                        </a>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
                <!--//////////////////////// End Interview Notification ///////////////////-->
                <!--//////////////////////// Start Compelete Contract //////////////////// -->
                <?php
                $stmt = $connect->prepare("SELECT * FROM contract_complete WHERE ind_id=?");
                $stmt->execute(array($_SESSION['ind_id']));
                $alldatacompele_contract = $stmt->fetchAll();
                $compelete_contract_noti_count = $stmt->rowCount();
                if ($compelete_contract_noti_count > 0) {
                    $message = "  رااائع !! تم اتمام التعاقد .. ";
                }
                if ($compelete_contract_noti_count > 0) {
                ?>
                    <h6 style="color: #6a6868;font-size: 19px;padding: 20px;"> التعاقدات </h6>
                    <?php
                    foreach ($alldatacompele_contract as $contract_compelete) {
                        $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
                        $stmt->execute(array($contract_compelete['company_id']));
                        $com_data = $stmt->fetch();
                    ?>
                        <a href="company_profile?com_username=<?php echo $com_data['com_username']; ?>" class="message_link">
                            <div class="message_data">
                                <div class="image">
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
                                </div>
                                <div class="info">
                                    <p> <?php echo $com_data['com_username']; ?> </p>
                                    <p> تم اتمام التعاقد بنجاح </p>
                                    <span> <i class="fa fa-clock-o"></i>
                                        <?php
                                        // استلام التاريخ والوقت من الداتا بيز أو أي مصدر آخر
                                        $dateTimeString = $contract_compelete['con_com_date'];

                                        // تحويل السلسلة إلى كائن DateTime
                                        $dateTime = new DateTime($dateTimeString);

                                        // تحديد تنسيق التاريخ والوقت
                                        $dateFormat = "Y-m-d";
                                        $timeFormat = "h:i A";

                                        // الحصول على التاريخ والوقت بالتنسيق المطلوب
                                        $date = $dateTime->format($dateFormat);
                                        $time = $dateTime->format($timeFormat);

                                        // تحديد ما إذا كانت الساعة تقع في فترة الصباح أم المساء
                                        $period = $dateTime->format("A"); // AM أو PM

                                        // تحديد مساءً أو صباحًا
                                        $amOrPm = ($period == "AM") ? "صباحًا" : "مساءً";
                                        // عرض التاريخ والوقت والفترة (صباحًا أو مساءًا)
                                        echo "في تاريخ : $date $time $amOrPm";
                                        ?> </span>
                                </div>
                            </div>
                        </a>
                    <?php
                    }
                    ?>
                <?php
                } ?>

                <!--//////////////////////// Start cancel Contract //////////////////// -->
                <?php
                $stmt = $connect->prepare("SELECT * FROM contract_cancel WHERE ind_id=?");
                $stmt->execute(array($_SESSION['ind_id']));
                $alldatacompele_cancel = $stmt->fetchAll();
                $cancel_contract_noti_count = $stmt->rowCount();
                if ($cancel_contract_noti_count > 0) {
                    $message = " تم الغاء الاتفاق مع الشركه  .. ";
                }
                if ($cancel_contract_noti_count > 0) {
                ?>
                    <h6 style="color: #6a6868;font-size: 19px;padding: 20px;"> الغاء التعاقدات </h6>
                    <?php
                    foreach ($alldatacompele_cancel as $contract_compelete) {
                        $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
                        $stmt->execute(array($contract_compelete['company_id']));
                        $com_data = $stmt->fetch();
                    ?>
                        <a href="company_profile?com_username=<?php echo $com_data['com_username']; ?>" class="message_link">
                            <div class="message_data">
                                <div class="image">
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
                                </div>
                                <div class="info">
                                    <p> <?php echo $com_data['com_username']; ?> </p>
                                    <p> تم الغاء الاتفاق مع الشركه </p>
                                    <span> <i class="fa fa-clock-o"></i>
                                        <?php
                                        // استلام التاريخ والوقت من الداتا بيز أو أي مصدر آخر
                                        $dateTimeString = $contract_compelete['con_com_date'];

                                        // تحويل السلسلة إلى كائن DateTime
                                        $dateTime = new DateTime($dateTimeString);

                                        // تحديد تنسيق التاريخ والوقت
                                        $dateFormat = "Y-m-d";
                                        $timeFormat = "h:i A";

                                        // الحصول على التاريخ والوقت بالتنسيق المطلوب
                                        $date = $dateTime->format($dateFormat);
                                        $time = $dateTime->format($timeFormat);

                                        // تحديد ما إذا كانت الساعة تقع في فترة الصباح أم المساء
                                        $period = $dateTime->format("A"); // AM أو PM

                                        // تحديد مساءً أو صباحًا
                                        $amOrPm = ($period == "AM") ? "صباحًا" : "مساءً";
                                        // عرض التاريخ والوقت والفترة (صباحًا أو مساءًا)
                                        echo "في تاريخ : $date $time $amOrPm";
                                        ?> </span>
                                </div>
                            </div>
                        </a>
                    <?php
                    }
                    ?>
                <?php
                }
                /////////////////////////// END COMPELETE CONTRACT  ////////////
                /////////////////////////// START REGISTER IN NEW NOTIFICATION  ////////////
                $stmt = $connect->prepare("SELECT * FROM batches_notification WHERE ind = ?");
                $stmt->execute(array($_SESSION['ind_id']));
                $allbatchnoti = $stmt->fetch();
                $batch_noti = $stmt->rowCount();
                if ($batch_noti > 0) {
                ?>
                    <h6 style="color: #6a6868;font-size: 19px;padding: 20px;"> التسجيل في دفعه </h6>
                    <?php

                    $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_id = ?");
                    $stmt->execute(array($allbatchnoti['batch']));
                    $batch_data = $stmt->fetch();
                    ?>
                    <a href="profile?batch_noti=<?php echo $allbatchnoti['id']; ?>" class="message_link">
                        <div class="message_data">
                            <div class="image">

                                <img src="../images/avatar.png" alt="">

                            </div>
                            <div class="info">

                                <p> تم
                                    تسجيلك في دفعه (<?php echo $batch_data['batch_name']; ?>) </p>

                            </div>
                        </div>
                    </a>

                <?php
                }
                /////////////////////////// END REGISTER IN NEW NOTIFICATION  ////////////
                //////////////// تغير حالة المتدرب الي مؤهل او افضل المؤهلين او مؤهلين تم تو ظيفهم ///  
                /////////////////////////// START REGISTER IN NEW NOTIFICATION  ////////////
                $stmt = $connect->prepare("SELECT * FROM change_status_notification WHERE ind_id = ?");
                $stmt->execute(array($_SESSION['ind_id']));
                $ind_status = $stmt->fetch();
                $ind_status_count = $stmt->rowCount();
                if ($ind_status_count > 0) {
                    $new_status = $ind_status['change_status'];
                ?>
                    <h6 style="color: #6a6868;font-size: 19px;padding: 20px;"> تغير الحالة الخاصة بك </h6>

                    <a href="profile?status_show=new" class="message_link">
                        <div class="message_data">
                            <div class="image">

                                <img src="../images/avatar.png" alt="">

                            </div>
                            <div class="info">

                                <p> تم تغير
                                    الحالة الخاصة بك الي (
                                    <?php
                                    if (($new_status == 0)) {
                                        echo " غير مؤهل ";
                                    } elseif ($new_status == 1) {
                                        echo "مؤهل";
                                    } elseif ($new_status == 2) {
                                        echo 'أفضل المؤهلين';
                                    } elseif ($new_status == 3) {
                                        echo 'مؤهلين تم توظيفهم ';
                                    }
                                    ?>
                                    ) </p>

                            </div>
                        </div>
                    </a>

                <?php
                }
                /////////////////////////////// START EXAMS NOTIFICATION //////////////////
                $stmt = $connect->prepare("SELECT * FROM exam_noti WHERE ind_id = ? AND status = 0 ");
                $stmt->execute(array($_SESSION['ind_id']));
                $allexamnoti = $stmt->fetchAll();
                $countexamnoti = $stmt->rowCount();
                if ($countexamnoti > 0) {
                ?>
                    <h6 style="color: #6a6868;font-size: 19px;padding: 20px;"> الأختبارات علي المنصة </h6>
                    <?php

                    $exam_count2 = 1;

                    foreach ($allexamnoti as $examnoti) {
                        $stmt = $connect->prepare("SELECT * FROM exam WHERE ex_id=?");
                        $stmt->execute(array($examnoti['ex_id']));
                        //$allexam = $stmt->fetchAll();
                        $exam_data = $stmt->fetch();
                    ?>
                        <a href="exam" class="message_link">
                            <div class="message_data">
                                <div class="image">
                                    <img src="../images/avatar.png" alt="">
                                </div>
                                <div class="info">
                                    <p> <?php echo $exam_data['ex_type']; ?> </p>
                                    <p> <?php echo $exam_data['ex_title']; ?> </p>
                                    <span> <i class="fa fa-clock-o"></i>
                                        في تاريخ
                                        <?php
                                        echo  $exam_data['ex_date_publish'];
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </a>
                    <?php
                    }
                }

                /////////////////////////////// END EXAMS NOTIFICATION /////////////
                if (
                    $interview_noti_count == 0 && $end_contract_noti_count == 0 && $compelete_contract_noti_count == 0 &&
                    $exam_count == 0 && $batch_noti == 0 && $ind_status_count == 0 && $congrate_status_count == 0
                ) {
                    ?>
                    <div class="">
                        <p style="padding: 20px; font-size: 18px;"> لا يوجد لديك اشعارات جديدة في
                            الوقت الحالي </p>
                    </div>
                <?php
                }
                ?>

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