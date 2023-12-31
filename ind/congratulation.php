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
                    <p> فريق إنتقاء يهنأك بأهليتك لسوق العمل.. </p>
                    <p> ما ضيعت جهدك وتعبك هباء , كانت رغبتك بالنجاح هو اقوى حافز للمحاولة والتقدم </p>
                    <p> فخورين بالجهد والعطاء والتعلم خلال الأيام الماضية معنا </p>
                    <p> ثقتك في إنتقاء كان شرف كبير لنا. </p>
                    <p> و الآن بعد تأهيلك نذكرك بأنك قادر على رؤية النتائج في صفحتك الخاصة . </p>
                    <p> و في حال الرغبة في طلب نسخة من الشهادة يتم التواصل مع فريق الخدمة لطلب نسخة من الشهادة لوضعها في حسابك </p>
                    <p> ولا تنس صديقنا ميزة تحديث الحالة الموجودة في صفحتك كل 24 ساعه لمساعدتك و وضع اسمك في مقدمة المتدربين لزيادة نسبة ظهورك للشركات . </p>
                    <p class="small"> للتنوية / يحق للمتدرب في طلب إعادة الاختبار النهائي و لمرة واحده فقط , في حال الرغبة في زيادة نسبة النتيجة لتتميز بين بقية المتدربين وزيادة فرص التفاوض الشركات معك يرجى التواصل مع فريق الخدمة لمزيد من الاستفسارات . </p>
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