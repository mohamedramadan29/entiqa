<?php

ob_start();
session_start();
$pagetitle = ' عرض الاشعارات ';
$com_navbar = 'com';
if (isset($_SESSION['com_id'])) {
    include 'init.php';
?>
    <div class="all_message">
        <div class="container">
            <div class="data">


                <!--//////////////////////// Start cancel Contract //////////////////// -->
                <?php
                $stmt = $connect->prepare("SELECT * FROM contract_cancel WHERE company_id=?");
                $stmt->execute(array($_SESSION['com_id']));
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
                        $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id=?");
                        $stmt->execute(array($contract_compelete['ind_id']));
                        $com_data = $stmt->fetch();
                    ?>
                        <a href="ind_profile?username=<?php echo $com_data['ind_username']; ?>" class="message_link">
                            <div class="message_data">
                                <div class="image">
                                    <?php
                                    if ($com_data['com_image'] != '') {
                                    ?>
                                        <img src="../ind_images_upload/<?php echo $com_data['ind_image']; ?>" alt="">
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
                                    <p> تم الغاء الاتفاق مع المتدرب </p>
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
                /////////////////////////// END cancel CONTRACT  ////////////
                /////////////////////////// START Change status  ////////////

                $stmt = $connect->prepare("SELECT * FROM company_status_notification WHERE com_id = ? ORDER BY id DESC LIMIT 1 ");
                $stmt->execute(array($_SESSION['com_id']));
                $allchange_status = $stmt->fetchall();
                $all_count_status = $stmt->rowCount();
                if ($all_count_status > 0) {
                ?>
                    <h6 style="color: #6a6868;font-size: 19px;padding: 20px;"> تغير الحاله الخاصه بك </h6>
                    <?php
                    foreach ($allchange_status as $change_status) {
                    ?>
                        <a href="profile" class="message_link">
                            <div class="message_data">
                                <div class="image">

                                    <img src="../images/avatar.png" alt="">

                                </div>
                                <div class="info">
                                    <?php 
                                    if($change_status['status'] == 1){
                                        $status = 'نشطه';
                                    }else{
                                        $status = 'غير نشطه';
                                    }
                                    ?>
                                    <p> تم تغير الحاله الخاصه بك الي (<?php echo $status; ?>) </p>

                                </div>
                            </div>
                        </a>
                    <?php
                    }
                    ?>


                <?php
                }

                /////////////////////////////// END EXAMS NOTIFICATION /////////////
                if (
                    $all_count_status == 0 &&  $cancel_contract_noti_count == 0
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