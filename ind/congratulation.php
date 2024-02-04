<?php

ob_start();
session_start();
$pagetitle = '  رسائل التواصل ';
$ind_navabar = 'ind';
if (isset($_SESSION['ind_id'])) {
    include 'init.php';
    $stmt = $connect->prepare("SELECT * FROM ind_congrat WHERE ind_id = ?");
    $stmt->execute(array($_SESSION['ind_id']));
    $count = $stmt->rowCount();
    if ($count > 0) {
        if (isset($_GET['status_show']) == 'new') {

            $stmt = $connect->prepare("UPDATE ind_congrat SET status = 1 WHERE ind_id = ?");
            $stmt->execute(array($_SESSION['ind_id']));
        }
        $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id=?");
        $stmt->execute(array($_SESSION['ind_id']));
        $user_data = $stmt->fetch();
?>
        <style>
            .congratualtion {
                background-color: #f1f1f1;
                padding-top: 120px;
            }

            .congratualtion .data {
                background-color: #fff;
                padding: 15px;
                border-radius: 20px;
                padding-top: 30px;
                padding-bottom: 30px;
            }

            .congratualtion .data h2 {
                text-align: center;
                color: var(--main-color);
                font-size: 22px;
            }

            .congratualtion .data p {
                text-align: center;
                font-size: 16px;
                color: #383838;
            }

            .congratualtion .data .small {
                font-size: 15px;
                color: var(--second-color);
            }
        </style>
        <div class="congratualtion">
            <div class="container">
                <div class="data">
                    <h2> الى (<?php echo $user_data['ind_name'] ?>) </h2>
                    <p> ألف مبروك </p>
                    <p> فريق إنتقاء يهنأك بأهليتك لسوق العمل </p>
                    <p> الآن عضويتك في قائمة المرشحين في صفحة الشركات </p>
                    <p> تمنياتنا لك بالتوفيق والنجاح </p>
                    <p> للتنويه : لا تنسى يا صديقنا العزيز بأن تضغط على زر ( التحديث ) الموجود في صفحتك الشخصية
                        كل 24 ساعه لتتمكن للوصول في الصفحات الاولى وتساعد الشركات على رؤيتك من بين المرشحين
                        وتستقبل بالمزيد من الفرص .
                    </p>
                </div>
            </div>
        </div>
<?php
    }
    include $tem . "footer.php";
} else {
    header('Location:index.php');
    exit();
}


?>