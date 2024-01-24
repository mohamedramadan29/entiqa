<?php

ob_start();
session_start();
unset($_SESSION['start_time']); // إزالة متغير الوقت
$pagetitle = '  الاختبارات  ';
if (isset($_SESSION['ind_id'])) {
    $ind_navabar = 'ind';
}
if (isset($_SESSION['ind_id']) || isset($_GET['ind_id'])) {
    include 'init.php';
    $ind_id = $_SESSION['ind_id'];
    if (isset($_GET['ind_id'])) {
        $ind_id = $_GET['ind_id'];
    }

    // check if this user is graduate or not 

    $stmt = $connect->prepare("SELECT ind_id,ind_status,date_change_status FROM ind_register WHERE ind_id = ?");
    $stmt->execute(array($ind_id));
    $user_data = $stmt->fetch();
    $user_status = $user_data['ind_status'];
    $user_status_grad_date = $user_data['date_change_status'];

    $stmt = $connect->prepare("UPDATE exam_noti SET status = 1 WHERE ind_id = ?");
    $stmt->execute(array($_SESSION['ind_id']));
?>
    <div class="profile_hero" style="background-image: url(../images/exam.jpeg);">
        <div class="overlay" style="background-color: rgba(0, 0, 0, 0.4);">
            <div class="container">
                <div class="data">
                    <h2> الاختبارات الخاصة بك في انتقاء </h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"> الاختبارات </li>
                            <li class="breadcrumb-item"><a href="index">الرئيسية</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php
    // GET USER INFORMATION

    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id=?");
    $stmt->execute(array($ind_id));
    $ind_data = $stmt->fetch();
    $batch_id = $ind_data['ind_batch'];
    ?>
    <div class="exam_section" style="background-color: #fff;">
        <div class="container-fluid">
            <div class="data" style="background-color: #f1f1f1;">
                <div class="info">
                    <div class="row">
                        <h2>جدول الاختبارات </h2>
                        <?php
                        $date_now = date("Y-m-d");
                        if ($user_status == null || $user_status == -1 || $user_status == 0) {

                            $stmt = $connect->prepare("SELECT * FROM exam WHERE ex_batch_num=? AND ex_date_publish <= ?");
                            $stmt->execute(array($batch_id, $date_now));
                        } else {
                            $stmt = $connect->prepare("SELECT * FROM exam WHERE ex_batch_num=? AND ex_date_publish <= ? AND exam_date <= ?");
                            $stmt->execute(array($batch_id, $date_now, $user_status_grad_date));
                        }

                        $allexam = $stmt->fetchAll();
                        $count = $stmt->rowCount();
                        if ($count > 0) {
                            foreach ($allexam as $exam) {
                                $start_date = $exam['ex_date_publish'];
                                $exam_question_num = $exam['ex_total_question'];
                                $stmt = $connect->prepare("SELECT * FROM question WHERE exam_id = ?");
                                $stmt->execute(array($exam['ex_id']));
                                $allquestion = $stmt->rowCount();
                                if ($allquestion == $exam_question_num) {
                                    // check if this exam opened or not 
                                    $stmt = $connect->prepare("SELECT * FROM ind_exams_login WHERE ind_id = ? AND exam_id = ?");
                                    $stmt->execute(array($_SESSION['ind_id'], $exam['ex_id']));
                                    $countregister = $stmt->rowCount();
                        ?>
                                    <div class="col-lg-4">
                                        <div class="info" style="position: relative;">
                                            <div class="image">
                                                <img src="../images/exam.jpeg" alt="" style="max-width:100%;border-radius: 10px 10px 0 0;position: relative;">
                                                <?php
                                                $stmt = $connect->prepare("SELECT * FROM question_answer WHERE user_id =? AND exam_id = ?");
                                                $stmt->execute(array($_SESSION['ind_id'], $exam['ex_id']));
                                                $alluserexam = $stmt->fetchAll();
                                                $countexam = $stmt->rowCount();
                                                if ($countexam > 0) { ?>
                                                    <button class="exam_done btn" style="color:#fff;background-color: #F16583;position:absolute;top: 30%;left: 36%;"> تم الاختبار بنجاح </button>
                                                <?php
                                                } elseif ($countregister > 0) { ?>
                                                    <button class="exam_done btn" style="color:#fff;background-color: #F16583;position:absolute;top: 30%;left: 25%;"> تم مشاهده الاختبار من قبل </button>
                                                <?php
                                                } else {

                                                ?>
                                                    <button class="btn" style="color:#fff;background-color: #F16583;position:absolute;top: 30%;left: 36%;">
                                                        <a style="color: #fff;" href="start_exam.php?exam_id=<?php echo $exam['ex_id'];  ?>"> بدء الاختبار <i class="fa fa-play"></i></a>
                                                    </button>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="exam_info" style="color:#fff; background-color: #fff; padding:10px;border-radius: 0px 0px 10px 10px;">
                                                <h3> <?php echo $exam['ex_title'] ?> </h3>
                                                <span class="badge badge-primary bg-primary"> <?php echo $exam['ex_type']; ?> </span>
                                                <p style="color: #F16583; font-size: 18px;"> وقت الاخنبار : <span style="color:#000;"> <?php echo $exam['ex_time'] ?> دقائق </span> </p>
                                                <p style="color: #F16583; font-size: 18px;"> عدد الاسئلة : <span style="color:#000;"> <?php echo $exam['ex_total_question'] ?> </span> </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                            <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-success"> لا يوجد اختبارات لديك في الوقت الحالي </div>
                        <?php
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php
    include $tem . "footer.php";
} else {
    header('Location:../index');
    exit();
}
?>