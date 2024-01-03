<?php
$pagetitle = 'تواصل معنا';
ob_start();
if (isset($_SESSION['com_id'])) {
    include 'init.php';
    if (isset($_GET["other"])) {
        $other_person = $_GET["other"];
    } else {
        $other_person = 'admin';
    }
    if ($other_person == "admin") {
        $stmt = $connect->prepare("SELECT * FROM admin WHERE admin_name=?");
        $stmt->execute(array($other_person));
        $user_data = $stmt->fetch();
    } else {
        $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_username=?");
        $stmt->execute(array($other_person));
        $user_data = $stmt->fetch();
    }

    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
    $stmt->execute(array($_SESSION["com_id"]));
    $com_data = $stmt->fetch();
}
?>
<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة جميع الرسائل بين الافراد والشركات </li>
                </ol>
            </nav>
        </div>

        <!-- End Update Company View Allllert -->
        <div class="all_message">
            <div class="container">
                <div class="data">
                    <form action="main.php?dir=all_chats&page=report" method="post">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="box" style="width: 40%;">
                                <select class="form-control select2" name="company_name" id="">
                                    <option value=""> اختر الشركة </option>
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM company_register");
                                    $stmt->execute();
                                    $allcompany = $stmt->fetchAll();
                                    foreach ($allcompany as $company) {
                                    ?>
                                        <option <?php if (isset($_POST['company_name']) && $company['com_username'] == $_POST['company_name']) echo 'selected'; ?> value="<?php echo $company['com_username']; ?>"> <?php echo $company['com_username']; ?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="box" style="width: 40%;">
                                <select class="form-control select2" name="ind_name" id="">
                                    <option value=""> اختر المتدرب </option>
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM ind_register");
                                    $stmt->execute();
                                    $allusers = $stmt->fetchAll();
                                    foreach ($allusers as $user) {
                                    ?>
                                        <option <?php if (isset($_POST['ind_name']) && $user['ind_username'] == $_POST['ind_name']) echo 'selected'; ?> value="<?php echo $user['ind_username']; ?>"> <?php echo $user['ind_username']; ?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="box">
                                <button type="submit" name="search" class="btn btn-warning btn-sm"> <i class="fa fa-search"></i> بحث </button>
                            </div>
                        </div>
                    </form>
                    <h2> الرسائل </h2>
                    <?php
                    if (isset($_POST['search'])) {
                        $companyName = isset($_POST['company_name']) ? $_POST['company_name'] : '';
                        $indName = isset($_POST['ind_name']) ? $_POST['ind_name'] : '';
                        // استعلام SQL
                        $sql = "
                            SELECT t1.to_person, t1.from_person, t1.chat_id, t1.msg, t1.send_type, t1.date,t1.admin_noti,
                            com.com_image as com_img  
                            FROM chat t1
                            LEFT JOIN company_register com ON (t1.to_person = com.com_username or t1.from_person = com.com_username)
                            WHERE t1.chat_id IN (
                                SELECT MAX(chat_id)
                                FROM chat
                                WHERE to_person != 'admin' AND from_person != 'admin' AND from_person !='coash' AND to_person !='coash'
                                GROUP BY LEAST(to_person, from_person), GREATEST(to_person, from_person)
                            )
                            ";

                        // إضافة شروط البحث إذا تم تحديد
                        if (!empty($companyName)) {
                            $sql .= " AND com.com_username = :companyName";
                        }

                        if (!empty($indName)) {
                            $sql .= " AND t1.from_person = :indName";
                            $sql .= " OR t1.to_person = :indName";
                        }

                        $sql .= " ORDER BY t1.chat_id DESC";

                        // تحضير الاستعلام
                        $stmt = $connect->prepare($sql);

                        // ربط قيم البحث إذا تم تحديد
                        if (!empty($companyName)) {
                            $stmt->bindParam(':companyName', $companyName, PDO::PARAM_STR);
                        }

                        if (!empty($indName)) {
                            $stmt->bindParam(':indName', $indName, PDO::PARAM_STR);
                        }
                        //  header("Location:main.php?dir=all_chats&page=report");
                    } else {
                        $stmt = $connect->prepare("
                        SELECT t1.to_person, t1.from_person, t1.chat_id, t1.msg, t1.send_type, t1.date,t1.admin_noti,
                         com.com_image as com_img  
                        FROM chat t1
                        LEFT JOIN company_register com ON
                    (t1.to_person = com.com_username or t1.from_person = com.com_username)
                        WHERE t1.chat_id IN (
                            SELECT MAX(chat_id)
                            FROM chat
                            WHERE to_person != 'admin' AND from_person != 'admin' AND from_person !='coash' AND to_person !='coash'
                            GROUP BY LEAST(to_person, from_person), GREATEST(to_person, from_person)
                        )
                        ORDER BY t1.chat_id DESC
                    ");
                    }

                    $stmt->execute();
                    $allmessage = $stmt->fetchAll();
                    $count = $stmt->rowCount();
                    if ($count > 0) {
                        foreach ($allmessage as $message) {
                            $admin_show = $message['admin_noti'];
                            if ($admin_show == 0) {
                    ?>
                                <i class="fa fa-message" style="color: red;"></i>
                            <?php
                            } else {
                            ?>
                                <i class="fa fa-message" style="color: #ccc;"></i>
                            <?php
                            }
                            ?>

                            <?php
                            $c_p = '';
                            $i_p = '';
                            if ($message['send_type'] == 'ind') {
                                $c_p = $message['to_person'];
                                $i_p = $message['from_person'];
                            ?>
                                <h6 style="display: inline-block; padding:5px; color:#646363;background-color: #e4e7eb;border-radius: 10px;">
                                    ( المتدرب:<?php echo $message['from_person']; ?>) ( الشركة :<?php echo $message['to_person']; ?>) </h6>
                            <?php
                            } elseif ($message['send_type'] == 'com') {
                                $i_p = $message['to_person'];
                                $c_p = $message['from_person'];
                            ?>
                                <h6 class='<?php if ($admin_show == 0) echo 'bg_red'; ?>' style="display: inline-block; padding:5px; color:#646363;background-color: #e4e7eb;border-radius: 6px;">
                                    ( المتدرب :<?php echo $message['to_person']; ?>) ( الشركة :<?php echo $message['from_person']; ?>) </h6>
                            <?php
                            }
                            ?>
                            <a href="main.php?dir=all_chats&page=chat_details&from=<?php echo $c_p; ?>&to=<?php echo $i_p; ?>" class="message_link">
                                <div class="message_data">
                                    <div class="image">
                                        <?php
                                        $i_src  = "../images/avatar.png";
                                        if ($message['com_img'] != '') {
                                            $i_src  = "../ind_images_upload/" . $message['com_img'];
                                        } ?>
                                        <img src="<?php echo $i_src; ?>" alt="">
                                    </div>
                                    <div class="info">
                                        <!-- ------------------------------------------------------------------------------------------------------------------------->
                                        <div>
                                            <?php echo $message['msg']; ?></div>
                                        <span> <i class="fa fa-clock-o"></i> <?php echo $message['date']; ?> </span>
                                    </div>
                                </div>
                            </a>
                        <?php
                        }
                    } else {
                        ?>
                        <p style="font-size: 18px;"> لا يوجد رسائل لديك الان </p>
                    <?php
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>