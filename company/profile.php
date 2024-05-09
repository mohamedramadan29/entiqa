<?php
ob_start();
session_start();
$pagetitle = ' حساب الشركة   ';
$com_navbar = 'com';
if (isset($_SESSION['com_id'])) {


    $price_amount = 100;
    include 'init.php';
    $stmt = $connect->prepare("UPDATE company_status_notification SET status_show = 1 WHERE com_id = ? AND status_show = 0");
    $stmt->execute(array($_SESSION['com_id']));

?>
    <div class="profile_hero">
        <div class="overlay">
            <div class="container">
                <div class="data">
                    <h2> حساب الشركة </h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"> حساب الشركة </li>
                            <li class="breadcrumb-item"><a href="index">الرئيسية</a></li>
                        </ol>
                    </nav>
                </div>
                <div class="profile_image">
                    <?php
                    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id = ?");
                    $stmt->execute(array($_SESSION['com_id']));
                    $ind_data_image = $stmt->fetch();
                    if ($ind_data_image['com_image'] != '') {
                    ?>
                        <img src="../ind_images_upload/<?php echo $ind_data_image['com_image'] ?>" alt="">
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
    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
    $stmt->execute(array($_SESSION['com_id']));
    $com_data = $stmt->fetch();

    ?>
    <br>
    <br>
    <br>
    <div class="profile_data">

        <div class="container-fluid">
            <!--
            <div class="alert alert-info">
                <?php
                if ($com_data['com_status'] == 1) { ?>
                    رااائع !! لقد تم تفعيل الحساب الخاص بك علي منصة انتقاء يمكنك الان تكوين الفريق الخاص بك
                <?php
                }
                ?>
            </div>
            -->
            <div class="data">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="info" style="background-color: #F3F3F3; border-radius: 20px;">
                            <div class="info_header">
                                <h2> نبذة عن الشركه </h2>
                                <a href="edit" style="background-color: var(--main-color);border-color: var(--main-color);border-radius: 20px;" class="btn btn-primary"> تعديل <i class="fa fa-pen-alt"></i></a>
                                </button>

                            </div>
                            <div class="info_data">
                                <div class="data1" style="background-color: #F3F3F3;">
                                    <p>
                                        <?php
                                        if (!empty($com_data['com_info'])) {
                                            echo $com_data['com_info'];
                                        } else { ?>
                                    <div class="alert alert-info" role="alert"> لا يوجد نبذة مختصرة عن الشركة</div>
                                <?php
                                        }
                                ?>
                                </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="document_section" style="background-color: #F3F3F3; border-radius: 20px;">
                            <!-- <?php
                                    if ($com_data['com_confirm'] == 0) { ?>
                                <a href="../uploads/file.docx" target="_blank" class="document_button btn btn-primary"> مشاهدة
                                    العقد </a>
                            <?php
                                    } ?> -->

                            <?php
                            if (isset($_POST['confirm'])) {
                                $send_confirm = $_POST["send_confirm"];
                                $stmt = $connect->prepare("UPDATE company_register SET com_confirm=? WHERE com_id=?");
                                $stmt->execute(array($send_confirm, $_SESSION['com_id']));
                                if ($stmt) { ?>
                                    <div class="alert alert-success"> رائع !! تمت الموافقه علي العقد يمكنك الان شحن الرصيد الخاص بك
                                        وبدء التعاقد مع الفريق الخاص بك </div>
                                    <?php
                                    header("refresh:7;url=profile");
                                    ?>
                            <?php

                                }
                            }
                            ?>
                            <div class="show_balance">
                                <?php
                                if (isset($_SESSION['suucess_paymob'])) {
                                ?>
                                    <div class="alert alert-info"> <?php echo $_SESSION['suucess_paymob']; ?> </div>
                                <?php
                                } elseif (isset($_SESSION['failed_paymob'])) {
                                ?>
                                    <div class="alert alert-danger"> <?php echo $_SESSION['failed_paymob']; ?> </div>
                                <?php
                                }
                                unset($_SESSION['suucess_paymob']);
                                unset($_SESSION['failed_paymob']);
                                ?>
                                <div class="info" style="background-color: #F3F3F3;">
                                    <div class="info_header">
                                        <h2>الرصيد الخاص بك </h2>
                                        <h2></h2>

                                    </div>
                                    <div class="info_data" style="background: var(--main-color);padding: 15px;border-radius: 5px;">
                                        <ul class="list-unstyled">
                                            <li> <span>
                                                    <?php echo $com_data['com_balance']; ?> <strong> ريال </strong>
                                                </span> <span> الرصيد المتاح الان </span> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($com_data['com_status'] == 1) { ?>
                                <form action="charge_balance.php" method="POST">
                                    <input type="hidden" name="price" id="price" value="100">
                                    <input type="hidden" name="payment_mode" value="COD">
                                </form>
                                <div class="send_money">
                                    <a href="payment_terms" class='btn btn-primary' style='background: var(--main-color);border-color: var(--main-color);'> الشروط وشحن الرصيد <i class='fa fa-paypal'></i></a>
                                </div>
                            <?php
                            } else { ?>
                                <div class="alert alert-info"> من فضلك انتظر التفعيل من المنصة حتي تتمكن من الدفع وتكوين الفريق
                                    الخاص بك </div>
                            <?php

                            }

                            ?>

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="info" style="background-color: #F3F3F3; border-radius: 20px;">
                            <div class="info_data">
                                <div class="info_data">
                                    <div class="data2" style="background-color: transparent;">
                                        <h4> معلومات عن الشركه </h4>
                                        <br>
                                        <table class="table">
                                            <tr>
                                                <th> اسم الشركه بالعربي</th>
                                                <th style="color:rgba(0, 0, 0, 0.5);">
                                                    <?php echo $com_data['com_name']; ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>اسم الشركه باللغه الانجليزية</th>
                                                <th style="color:rgba(0, 0, 0, 0.5);">
                                                    <?php echo $com_data['com_name_en']; ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>البريد الألكتروني</th>
                                                <th style="color:rgba(0, 0, 0, 0.5);">
                                                    <?php echo $com_data['com_email']; ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>رقم الهاتف</th>
                                                <th style="color:rgba(0, 0, 0, 0.5);">
                                                    <?php echo $com_data['com_phone']; ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>رقم السجل التجاري</th>
                                                <th>
                                                    <?php echo $com_data['com_num']; ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>نشاط الشركه</th>
                                                <th>
                                                    <?php echo $com_data['com_active']; ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th> مقر الشركه الرئيسي </th>
                                                <th>
                                                    <?php echo $com_data['com_place']; ?>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th> أفرعها </th>
                                                <th>
                                                    <?php echo $com_data['com_braches']; ?>
                                                </th>
                                            </tr>

                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info" style="background-color: #F3F3F3; border-radius: 20px;">
                            <div class="info_data">
                                <div class="info_data">
                                    <div class="data2" style="background-color: transparent;">
                                        <br>
                                        <table class="table">
                                            <tr>
                                                <th> سنة التأسيس </th>
                                                <th>
                                                    <?php echo $com_data['com_founded']; ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th> نوع العمل ميداني / مكتبي </th>
                                                <th>
                                                    <?php echo $com_data['com_work_type']; ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th> الراتب المقدر </th>
                                                <th>
                                                    <?php echo $com_data['com_salary']; ?> ريال سعودي
                                                </th>
                                            </tr>
                                            <tr>
                                                <th> العمولة المقدرة </th>
                                                <th>
                                                    <?php echo $com_data['com_commission']; ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th> أوقات ساعات العمل</th>
                                                <th>
                                                    <?php echo $com_data['com_work_h']; ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th> عدد الشفتات</th>
                                                <th>
                                                    <?php echo $com_data['com_work_libs']; ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th> عدد أيام الأجازة الأسبوعية </th>
                                                <th>
                                                    <?php echo $com_data['com_weekend_num']; ?>
                                                </th>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
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


?>