<?php
$pagetitle = ' بائعين المرشحين ';
ob_start();
session_start();
$com_navbar = 'com';
include 'init.php';
if (isset($_SESSION['com_id'])) {
?>
    <div class="company">
        <div class="contact_hero" style="">
            <div class="overlay" style="background-color: rgba(0,0,0,0.3);">
                <div class="container">
                    <div class="data">
                        <h2>  بائعين المرشحين </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Get Company Information  -->
        <?php
        $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
        $stmt->execute(array($_SESSION['com_id']));
        $com_data = $stmt->fetch();

        // get the subscribe amount for company

        /* get the subsciption payment */
        $stmt = $connect->prepare("SELECT * FROM subscribe LIMIT 1");
        $stmt->execute();
        $sub_data = $stmt->fetch();
        $ind_sub_amount = $sub_data['company_subscribe'];

        ?>
        <div class="star_person" style="background-color:#fbfbfb;">
            <div class="container">
                <div class="data">
                    <div class="row">
                        <div class="topnav">
                            <style>
                                .topnav {}

                                .topnav a {
                                    float: right;
                                    display: block;
                                    color: black;
                                    text-align: center;
                                    padding: 14px 16px;
                                    text-decoration: none;
                                    font-size: 17px;
                                }

                                .topnav a:hover {
                                    background-color: #ddd;
                                    color: black;
                                }

                                .topnav a.active {
                                    background-color: #2196F3;
                                    color: white;
                                }

                                .topnav .search-container form {
                                    display: flex;

                                }

                                .topnav input[type=text] {
                                    padding: 6px;
                                    margin-top: 8px;
                                    font-size: 17px;
                                    border: 1px solid #989da7;
                                    width: 330px;
                                    border-radius: 15px;
                                    background-color: #f4f4f4;

                                }

                                label.fontess {
                                    font-size: 20px;
                                    margin-top: 10px;

                                }

                                .search_button {
                                    border-radius: 29px;
                                    padding: 10px 15px;
                                    position: relative;
                                    top: -2px;
                                }
                            </style>
                            <?php
                            $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_status = 1 ORDER BY order_number ASC");
                            $stmt->execute();
                            $alluser = $stmt->fetchAll();
                            $count = $stmt->rowCount();
                            if ($count > 0) {
                            ?>
                                <form action="stars" method="get">
                                    <div class="row">
                                        <div class="col-5">
                                            <label style="margin-bottom: 15px;" for=""> اختر الجنس </label>

                                            <select required class="form-control select2" name="ind_gender" placeholder='منطقه'>

                                                <option <?php if (isset($_GET['ind_gender']) && $_GET['ind_gender'] == 'الكل') echo 'selected'; ?> value="الكل">الكل</option>
                                                <option <?php if (isset($_GET['ind_gender']) && $_GET['ind_gender'] == 'ذكر') echo 'selected'; ?> value="ذكر">ذكر</option>
                                                <option <?php if (isset($_GET['ind_gender']) && $_GET['ind_gender'] == 'انثي') echo 'selected'; ?> value="انثي"> انثى </option>
                                            </select>
                                        </div>
                                        <div class="col-5">
                                            <label style="margin-bottom: 15px;" for=""> منطقة السكن الحالي </label>

                                            <select required id="ind_address" class="form-control select2" name="ind_address">

                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'الكل') echo 'selected'; ?> value="الكل">الكل</option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'الرياض') echo 'selected'; ?> value="الرياض">الرياض</option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'جدة') echo 'selected'; ?> value="جدة">جدة </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'مكة') echo 'selected'; ?> value="مكة">مكة </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'المدينة المنورة') echo 'selected'; ?> value="المدينة المنورة">المدينة المنورة </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'الطائف') echo 'selected'; ?> value="الطائف">الطائف </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'تبوك') echo 'selected'; ?> value="تبوك">تبوك </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'خميس مشيط') echo 'selected'; ?> value="خميس مشيط">خميس مشيط </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'عفيف') echo 'selected'; ?> value="عفيف">عفيف </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'عرعر') echo 'selected'; ?> value="عرعر">عرعر </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'أبها') echo 'selected'; ?> value="أبها">أبها </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'عسير') echo 'selected'; ?> value="عسير">عسير </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'بلجرشي') echo 'selected'; ?> value="بلجرشي">بلجرشي </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'بيشة') echo 'selected'; ?> value="بيشة">بيشة </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'بريدة') echo 'selected'; ?> value="بريدة">بريدة </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'القصيم') echo 'selected'; ?> value="القصيم">القصيم </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'الباحة') echo 'selected'; ?> value="الباحة">الباحة </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'الدمام') echo 'selected'; ?> value="الدمام">الدمام </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'الظهران') echo 'selected'; ?> value="الظهران">الظهران </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'الدوادمي') echo 'selected'; ?> value="الدوادمي">الدوادمي </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'جزر فرسان') echo 'selected'; ?> value="جزر فرسان">جزر فرسان </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'القريات') echo 'selected'; ?> value="القريات">القريات </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'القويعية') echo 'selected'; ?> value="القويعية">القويعية </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'حرمة') echo 'selected'; ?> value="حرمة">حرمة </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'حائل') echo 'selected'; ?> value="حائل">حائل </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'حوطة بني تميم') echo 'selected'; ?> value="حوطة بني تميم">حوطة بني تميم </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'الهفوف') echo 'selected'; ?> value="الهفوف">الهفوف </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'حفر الباطن') echo 'selected'; ?> value="حفر الباطن">حفر الباطن </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'جبل أم الرؤوس') echo 'selected'; ?> value="جبل أم الرؤوس">جبل أم الرؤوس </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'الجوف') echo 'selected'; ?> value="الجوف">الجوف </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'جيزان') echo 'selected'; ?> value="جيزان">جيزان </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'الجبيل') echo 'selected'; ?> value="الجبيل">الجبيل </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'الخفجي') echo 'selected'; ?> value="الخفجي">الخفجي </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'الخرج') echo 'selected'; ?> value="الخرج">الخرج </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'الخبر') echo 'selected'; ?> value="الخبر">الخبر </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'أملج') echo 'selected'; ?> value="أملج">أملج </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'القطيف') echo 'selected'; ?> value="القطيف">القطيف </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'القنفذة') echo 'selected'; ?> value="القنفذة">القنفذة </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'رأس التنورة') echo 'selected'; ?> value="رأس التنورة">رأس التنورة </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'سكاكا') echo 'selected'; ?> value="سكاكا">سكاكا </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'شرورة') echo 'selected'; ?> value="شرورة">شرورة </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'شقرا') echo 'selected'; ?> value="شقرا">شقرا </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'العلا') echo 'selected'; ?> value="العلا">العلا </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'عنيزة') echo 'selected'; ?> value="عنيزة">عنيزة </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'وادي الدواسر') echo 'selected'; ?> value="وادي الدواسر">وادي الدواسر </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'ينبع') echo 'selected'; ?> value="ينبع">ينبع </option>
                                                <option <?php if (isset($_GET['ind_address']) && $_GET['ind_address'] == 'زلفي') echo 'selected'; ?> value="زلفي">زلفي </option>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <!-- ------------------------------------------------------------------------ -->
                                            <button style="margin-top: 40px;" type="submit" name="search" class="btn btn-outline-primary search_button"> <i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            <?php
                            }

                            ?>

                        </div>
                        <!-- ------------------------------------------------------------------------             -->



                        <br><br>
                        <?php

                        $ind_gender_val = '';
                        $ind_address_val = '';

                        if (isset($_GET['ind_gender'])) {

                            $ind_gender_val = $_GET["ind_gender"];
                            $ind_address_val = $_GET["ind_address"];

                            if ($ind_gender_val != 'الكل' && $ind_address_val != 'الكل') {
                                $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_status =1 
                                AND ind_gender='$ind_gender_val' and ind_address='$ind_address_val' 
                                ORDER BY order_number ASC");
                            } elseif ($ind_gender_val == 'الكل' && $ind_address_val == 'الكل') {
                                $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_status =1 ORDER BY order_number ASC");
                            } elseif ($ind_gender_val != 'الكل' && $ind_address_val == 'الكل') {
                                $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_status =1 
                                AND ind_gender='$ind_gender_val'
                                ORDER BY order_number ASC");
                            } elseif ($ind_gender_val == 'الكل' && $ind_address_val != 'الكل') {
                                $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_status = 1
                                AND ind_address='$ind_address_val' 
                                ORDER BY order_number ASC");
                            }
                        }

                        //echo (  'search_val = ' . $search_val  );
                        else {
                            $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_status = 1 ORDER BY order_number ASC");
                        }
                        $stmt->execute();
                        $alluser = $stmt->fetchAll();
                        $count = $stmt->rowCount();
                        if ($count > 0) {
                            if ($com_data['com_status'] == 0) { ?>
                                <div class="alert alert-info col-12"> لا يمكنك مشاهدة تفاصيل المتدرب حتي يتم تفعيل حساب الشركة من
                                    الادارة </div>
                            <?php
                            }
                            if ($com_data['com_balance'] < $ind_sub_amount) { ?>
                                <div class="alert alert-info col-12"> لا يمكنك مشاهدة تفاصيل المتدرب حتي يتم شحن الرصيد الخاص بك اقل
                                    مبلغ هو <strong> <?php echo $ind_sub_amount ?> ريال </strong> </div>
                            <?php
                            }
                            foreach ($alluser as $user) { ?>
                                <div class="col-lg-3 col-6">
                                    <div class="info">
                                        <?php
                                        if ($user['ind_image'] == "") {
                                            if ($user['ind_gender'] == 'ذكر') {
                                        ?>
                                                <img src="../images/avatar.png" alt="">
                                            <?php
                                            } elseif ($user['ind_gender'] == 'انثي') { ?>
                                                <img src="../images/girl_avatar.png" alt="">
                                            <?php
                                            }
                                            ?>

                                        <?php
                                        } else { ?>
                                            <img src="../ind_images_upload/<?php echo $user['ind_image']; ?>" alt="">
                                        <?php

                                        }
                                        ?>

                                        <h2>
                                            <?php echo $user['ind_name']; ?>
                                        </h2>
                                        <div class="rate">
                                            <!-- <div class="review">
                                                <?php
                                                $rating = $user['rating_star']; // قيمة النجوم، يجب أن تأتي من مصدر البيانات
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i <= $rating) {
                                                        echo '<i class="fa fa-star" aria-hidden="true"></i>';
                                                    } else {
                                                        echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                                                    }
                                                }
                                                ?>
                                            </div> -->
                                            <div>
                                                <p> <span> الجنسية : </span>
                                                    <?php echo $user['ind_nationality']; ?><span> </span>
                                                </p>
                                            </div>
                                            <div>
                                                <p> <span> العنوان : </span>
                                                    <?php echo $user['ind_address']; ?> <span> </span>
                                                </p>
                                            </div>
                                        </div>
                                        <?php
                                        if ($com_data['com_status'] == 0 || $com_data['com_balance'] < 1) { ?>
                                            <button disabled class="btn btn-primary"> الملف الشخصى <i class="fa fa-user"></i></button>
                                        <?php
                                        } else { ?>
                                            <button class="btn btn-primary"><a href="ind_profile?username=<?php echo $user['ind_username']; ?>"> الملف الشخصى <i class="fa fa-user"></i></a></button>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-danger"> لا يوجد افراد مؤهلين في الوقت الحالي </div>
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
    header('Location:login');
    exit();
}
