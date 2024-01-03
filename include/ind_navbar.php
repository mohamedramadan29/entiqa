<div class="page">
    <header class="section page-header rd-navbar-transparent-wrap" id="large_screen">
        <!--RD Navbar-->
        <div class="rd-navbar-wrap">
            <nav class="rd-navbar rd-navbar-transparent" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="20px" data-xl-stick-up-offset="20px" data-xxl-stick-up-offset="20px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
                <div class="rd-navbar-main-outer">
                    <div class="rd-navbar-main-inner">
                        <div class="rd-navbar-main">
                            <!--RD Navbar Panel-->
                            <div class="rd-navbar-panel">
                                <!--RD Navbar Toggle-->
                                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                                <!--RD Navbar Brand-->
                                <div class="rd-navbar-brand">
                                    <!--Brand--><a class="brand" href="../index"><img class="brand-logo-dark" src="../images/main_logo.png" alt="" width="146" height="22" /><img class="brand-logo-light" src="../images/main_logo.png" alt="" width="155" height="22" /></a>
                                </div>
                            </div>
                            <div class="rd-navbar-main-element">
                                <div class="rd-navbar-nav-wrap">
                                    <ul class="rd-navbar-nav">
                                        <li id="individuals" class="rd-nav-item">
                                            <a class="rd-nav-link" href="index">الرئيسية</a>
                                        </li>
                                        <?php
                                        if (isset($_SESSION['ind_id'])) {
                                        ?>
                                            <li id="stars" class="rd-nav-item">
                                                <a class="rd-nav-link" href="stars"> المؤهلين </a>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                        <li id="contacts" class="rd-nav-item">
                                            <a class="rd-nav-link" href="contact">تواصل معنا</a>
                                        </li>
                                        <?php

                                        if (isset($_SESSION['ind_id'])) {
                                        ?>
                                            <li id="exam_link" class="rd-nav-item">
                                                <a class="rd-nav-link login_link" href="exam"> الاختبارات </a>
                                            </li>
                                            <?php
                                            include 'ind_notification_msg.php';
                                            include 'ind_notitfication.php';
                                            ?>
                                            <!-- START MESSAGE NOTITFICATION -->
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-envelope"></i> <span style="position: relative;top: -13px;font-size: 18px;font-weight: bold;">
                                                        <?php
                                                        if (
                                                            $new_count_chat == 0 && $new_count_entiqa_message == 0 && $new_count_coash_message == 0
                                                        ) {
                                                            $new_count_msg = "";
                                                        } else {
                                                            $new_count_msg = $new_count_chat + $new_count_entiqa_message + $new_count_coash_message;
                                                        }
                                                        echo $new_count_msg ?>
                                                    </span>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <?php
                                                    if ($new_count_chat > 0) {
                                                        foreach ($alldatamsg as $msg) {
                                                    ?>
                                                            <hr>
                                                            <li> <a class="dropdown-item" href="ind_message.php?other=<?php echo $msg['from_person']; ?>">
                                                                    رساله تفاوض من [ <?php echo $msg['from_person'] ?> ] </a> </li>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                    }
                                                    if ($new_count_entiqa_message > 0) {

                                                        foreach ($alldatamsgentiqa as $entiqa_message) {
                                                        ?>
                                                            <hr>
                                                            <li> <a class="dropdown-item" href="ind_message.php?other=<?php echo $entiqa_message['from_person']; ?>">
                                                                    لديك رسالة جديدة من منصة انتقاء </a> </li>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                    }
                                                    if ($new_count_coash_message > 0) {
                                                        foreach ($alldatamsgcoash as $coash_message) {
                                                        ?>
                                                            <hr>
                                                            <li> <a class="dropdown-item" href="ind_message.php?other=<?php echo $coash_message['from_person']; ?>&coash_id=<?php echo $coash_message['coash_id']; ?>">
                                                                    لديك رسالة جديدة من المدرب الخاص بك </a> </li>
                                                        <?php
                                                        }
                                                        ?>
                                                    <?php
                                                    }
                                                    if ($new_count_chat == 0 && $new_count_entiqa_message == 0 && $new_count_coash_message == 0) { ?>
                                                        <hr>
                                                        <li> <a class="dropdown-item" href=""> لا يوجد رسائل جديدة </a>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <hr>
                                                    <li> <a class="dropdown-item" href="all_message"> مشاهدة كل الرسائل </a>
                                                    </li>

                                                </ul>
                                            </li>
                                            <!-- end message notitifcation ////////////////////-->
                                            <!-- START ALL NOTITFICATION -->
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-bell"></i> <span style="position: relative;top: -13px;font-size: 18px;font-weight: bold;">
                                                        <?php
                                                        if (
                                                            $interview_noti_count == 0 &&
                                                            $end_contract_noti_count == 0 && $compelete_contract_noti_count == 0 &&
                                                            $exam_count2 == 0 && $batch_noti == 0 && $ind_status_count == 0 && $congrate_status_count == 0
                                                        ) {
                                                            $new_count_notification = "";
                                                        } else {
                                                            $new_count_notification = $interview_noti_count + $end_contract_noti_count +
                                                                $compelete_contract_noti_count + $exam_count2 + $batch_noti + $ind_status_count + $congrate_status_count;
                                                        }
                                                        echo $new_count_notification ?>
                                                    </span>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <?php
                                                    if ($interview_noti_count > 0) {
                                                        foreach ($alldatainterview as $interview) {
                                                            $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
                                                            $stmt->execute(array($interview['noti_com_link']));
                                                            $com_data = $stmt->fetch();
                                                    ?>
                                                            <li> <a class="dropdown-item" href="ind_message.php?other=<?php echo $com_data['com_username']; ?>">
                                                                    طلب مقابلة شخصية جديدة من [<?php echo $com_data['com_username']; ?>]</a> </li>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                    }
                                                    if ($compelete_contract_noti_count > 0) {
                                                        foreach ($alldatacompele_contract as $contract_compelete) {
                                                            $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
                                                            $stmt->execute(array($contract_compelete['company_id']));
                                                            $com_data = $stmt->fetch();
                                                        ?>
                                                            <li> <a class="dropdown-item" href="company_profile?com_username=<?php echo $com_data['com_username']; ?>">..
                                                                    رااائع !! تم اتمام التعاقد </a> </li>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                    }
                                                    if ($end_contract_noti_count > 0) {
                                                        foreach ($alldataend_contract as $end_contract) {
                                                            $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
                                                            $stmt->execute(array($end_contract['company_id']));
                                                            $com_data = $stmt->fetch();
                                                        ?>
                                                            <li> <a class="dropdown-item" href="company_profile?com_username=<?php echo $com_data['com_username']; ?>">
                                                                    تم الغاء الاتفاق بينك وبين شركة ... </a> </li>
                                                        <?php
                                                        }
                                                        ?>
                                                    <?php
                                                    }


                                                    if ($exam_count2 > 0) {
                                                    ?>
                                                        <li> <a class="dropdown-item" href="exam"> لديك اختبار جديد اليوم علي المنصة [<?php echo $exam_type; ?>]
                                                            </a> </li>
                                                        <?php
                                                        ?>
                                                    <?php
                                                    }
                                                    if ($batch_noti > 0) {
                                                        $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_id = ?");
                                                        $stmt->execute(array($allbatchnoti['batch']));
                                                        $batch_data = $stmt->fetch();
                                                    ?>
                                                        <li> <a class="dropdown-item" href="profile?batch_noti=<?php echo $allbatchnoti['id']; ?>"> تم
                                                                تسجيلك في دفعه (<?php echo $batch_data['batch_name']; ?>) </a>
                                                        </li>
                                                    <?php
                                                    }
                                                    if ($ind_status_count > 0) {
                                                        $new_status = $ind_status['change_status'];
                                                    ?>
                                                        <li> <a class="dropdown-item" href="profile?status_show=new"> تم تغير
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
                                                                )
                                                            </a> </li>
                                                    <?php
                                                    }
                                                    if ($congrate_status_count > 0) {
                                                    ?>
                                                        <li> <a class="dropdown-item" href="congratulation?status_show=new">
                                                                رسالة تهنئة
                                                            </a> </li>
                                                    <?php
                                                    }
                                                    if (
                                                        $interview_noti_count == 0 && $end_contract_noti_count == 0 && $compelete_contract_noti_count == 0 &&
                                                        $exam_count == 0 && $batch_noti == 0 && $ind_status_count == 0 && $congrate_status_count == 0
                                                    ) {
                                                    ?>
                                                        <li> <a class="dropdown-item">
                                                                لا يوجد لديك اشعارات جديدة في
                                                                الوقت الحالي
                                                            </a> </li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <hr>
                                                    <li> <a class="dropdown-item" href="all_notification"> عرض كل الأشعارات </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="profile_item">
                                                <?php
                                                $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id = ?");
                                                $stmt->execute(array($_SESSION['ind_id']));
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
                                                <ul class="profile_links">
                                                    <li> <a href="profile"> <i class="fa fa-user"></i> حسابي الشخصي </a>
                                                    </li>
                                                    <li> <a href="all_message"> <i class="fa fa-envelope"></i> الرسائل </a>
                                                    </li>
                                                    <li> <a href="exam"> <i class="fa fa-chain"></i> الاختبارات </a> </li>
                                                    <li> <a href="logout"><i class="fa fa-sign-in"></i> تسجيل خروج </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        <?php
                                        } else { ?>
                                            <li id="login" class="rd-nav-item" style='margin:5px '>
                                                <a class="rd-nav-link login_link" href="login"> دخول </a>
                                            </li>
                                            <li id="register" class="rd-nav-item" style="margin-right: 10px;">
                                                <a class="rd-nav-link register_link" href="register">حساب جديد</a>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!------------------------------------------ Small Screen ---------------------------->

    <header class="section page-header rd-navbar-transparent-wrap" id="small_screen">
        <!--RD Navbar-->
        <div class="rd-navbar-wrap">
            <nav class="rd-navbar rd-navbar-transparent" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="20px" data-xl-stick-up-offset="20px" data-xxl-stick-up-offset="20px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
                <div class="rd-navbar-main-outer">
                    <div class="rd-navbar-main-inner">
                        <div class="rd-navbar-main">
                            <!--RD Navbar Panel-->
                            <div class="rd-navbar-panel">
                                <!--RD Navbar Toggle-->
                                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                                <!--RD Navbar Brand-->
                                <div class="rd-navbar-brand">
                                    <!--Brand--><a class="brand" href="../index"><img class="brand-logo-dark" src="../images/main_logo.png" alt="" width="146" height="22" /><img class="brand-logo-light" src="../images/main_logo.png" alt="" width="155" height="22" /></a>
                                </div>
                                <?php
                                if (isset($_SESSION['ind_id'])) {
                                    include 'ind_notification_msg.php';
                                    include 'ind_notitfication.php';
                                ?>
                                    <!-- START MESSAGE NOTITFICATION -->
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-envelope"></i> <span style="position: relative;top: -13px;font-size: 18px;font-weight: bold;">
                                                <?php
                                                if (
                                                    $new_count_chat == 0 && $new_count_entiqa_message == 0 && $new_count_coash_message == 0
                                                ) {
                                                    $new_count_msg = "";
                                                } else {
                                                    $new_count_msg = $new_count_chat + $new_count_entiqa_message + $new_count_coash_message;
                                                }
                                                echo $new_count_msg ?>
                                            </span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <?php
                                            if ($new_count_chat > 0) {
                                                foreach ($alldatamsg as $msg) {
                                            ?>
                                                    <hr>
                                                    <li> <a class="dropdown-item" href="ind_message.php?other=<?php echo $msg['from_person']; ?>">
                                                            رساله تفاوض من [ <?php echo $msg['from_person'] ?> ] </a> </li>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                            }
                                            if ($new_count_entiqa_message > 0) {

                                                foreach ($alldatamsgentiqa as $entiqa_message) {
                                                ?>
                                                    <hr>
                                                    <li> <a class="dropdown-item" href="ind_message.php?other=<?php echo $entiqa_message['from_person']; ?>">
                                                            لديك رسالة جديدة من منصة انتقاء </a> </li>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                            }
                                            if ($new_count_coash_message > 0) {
                                                foreach ($alldatamsgcoash as $coash_message) {
                                                ?>
                                                    <hr>
                                                    <li> <a class="dropdown-item" href="ind_message.php?other=<?php echo $coash_message['from_person']; ?>&coash_id=<?php echo $coash_message['coash_id']; ?>">
                                                            لديك رسالة جديدة من المدرب الخاص بك </a> </li>
                                                <?php
                                                }
                                                ?>
                                            <?php
                                            }
                                            if ($new_count_chat == 0 && $new_count_entiqa_message == 0 && $new_count_coash_message == 0) { ?>
                                                <hr>
                                                <li> <a class="dropdown-item" href=""> لا يوجد رسائل جديدة </a>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                            <hr>
                                            <li> <a class="dropdown-item" href="all_message"> مشاهدة كل الرسائل </a>
                                            </li>

                                        </ul>
                                    </li>
                                    <!-- START ALL NOTITFICATION -->

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-bell"></i> <span style="position: relative;top: -13px;font-size: 18px;font-weight: bold;">
                                                <?php
                                                if (
                                                    $interview_noti_count == 0 &&
                                                    $end_contract_noti_count == 0 && $compelete_contract_noti_count == 0 &&
                                                    $exam_count2 == 0 && $batch_noti == 0 && $ind_status_count == 0 && $congrate_status_count == 0
                                                ) {
                                                    $new_count_notification = "";
                                                } else {
                                                    $new_count_notification = $interview_noti_count + $end_contract_noti_count +
                                                        $compelete_contract_noti_count + $exam_count2 + $batch_noti + $ind_status_count + $congrate_status_count;
                                                }
                                                echo $new_count_notification ?>
                                            </span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <?php
                                            if ($interview_noti_count > 0) {
                                                foreach ($alldatainterview as $interview) {
                                                    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
                                                    $stmt->execute(array($interview['noti_com_link']));
                                                    $com_data = $stmt->fetch();
                                            ?>
                                                    <li> <a class="dropdown-item" href="ind_message.php?other=<?php echo $com_data['com_username']; ?>">
                                                            طلب مقابلة شخصية جديدة من [<?php echo $com_data['com_username']; ?>]</a> </li>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                            }
                                            if ($compelete_contract_noti_count > 0) {
                                                foreach ($alldatacompele_contract as $contract_compelete) {
                                                    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
                                                    $stmt->execute(array($contract_compelete['company_id']));
                                                    $com_data = $stmt->fetch();
                                                ?>
                                                    <li> <a class="dropdown-item" href="company_profile?com_username=<?php echo $com_data['com_username']; ?>">..
                                                            رااائع !! تم اتمام التعاقد </a> </li>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                            }
                                            if ($end_contract_noti_count > 0) {
                                                foreach ($alldataend_contract as $end_contract) {
                                                    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
                                                    $stmt->execute(array($end_contract['company_id']));
                                                    $com_data = $stmt->fetch();
                                                ?>
                                                    <li> <a class="dropdown-item" href="company_profile?com_username=<?php echo $com_data['com_username']; ?>">
                                                            تم الغاء الاتفاق بينك وبين شركة ... </a> </li>
                                                <?php
                                                }
                                                ?>
                                            <?php
                                            }

                                            if ($exam_count2 > 0) {
                                            ?>
                                                <li> <a class="dropdown-item" href="exam"> لديك اختبار جديد اليوم علي المنصة [<?php echo $exam_type; ?>]
                                                    </a> </li>
                                                <?php
                                                ?>
                                            <?php
                                            }
                                            if ($batch_noti > 0) {
                                                $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_id = ?");
                                                $stmt->execute(array($allbatchnoti['batch']));
                                                $batch_data = $stmt->fetch();
                                            ?>
                                                <li> <a class="dropdown-item" href="profile?batch_noti=<?php echo $allbatchnoti['id']; ?>"> تم
                                                        تسجيلك في دفعه (<?php echo $batch_data['batch_name']; ?>) </a>
                                                </li>
                                            <?php
                                            }
                                            if ($ind_status_count > 0) {
                                                $new_status = $ind_status['change_status'];
                                            ?>
                                                <li> <a class="dropdown-item" href="profile?status_show=new"> تم تغير
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
                                                        )
                                                    </a> </li>
                                            <?php
                                            }
                                            if ($congrate_status_count > 0) {
                                            ?>
                                                <li> <a class="dropdown-item" href="congratulation?status_show=new">
                                                        رسالة تهنئة
                                                    </a> </li>
                                            <?php
                                            }
                                            if (
                                                $interview_noti_count == 0 && $end_contract_noti_count == 0 && $compelete_contract_noti_count == 0 &&
                                                $exam_count2 == 0 && $batch_noti == 0 && $ind_status_count == 0 && $congrate_status_count == 0
                                            ) {
                                            ?>
                                                <li> <a class="dropdown-item">
                                                        لا يوجد لديك اشعارات جديدة في
                                                        الوقت الحالي
                                                    </a> </li>
                                            <?php
                                            }
                                            ?>
                                            <hr>
                                            <li> <a class="dropdown-item" href="all_notification"> عرض كل الأشعارات </a>
                                            </li>
                                        </ul>
                                    </li>


                                    <li class="profile_item">
                                        <?php
                                        $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id = ?");
                                        $stmt->execute(array($_SESSION['ind_id']));
                                        $ind_data_image = $stmt->fetch();
                                        if ($ind_data_image['ind_image'] != '') {
                                        ?>
                                            <img width="55px" src="../ind_images_upload/<?php echo $ind_data_image['ind_image'] ?>" alt="">
                                        <?php
                                        } else {
                                        ?>
                                            <img width="55px" src="../images/avatar.png" alt="">
                                        <?php
                                        }
                                        ?>
                                        <ul class="profile_links">
                                            <li> <a href="profile"> <i class="fa fa-user"></i> حسابي الشخصي </a>
                                            </li>
                                            <li> <a href="all_message"> <i class="fa fa-envelope"></i> الرسائل </a>
                                            </li>
                                            <li> <a href="exam"> <i class="fa fa-chain"></i> الاختبارات </a> </li>
                                            <li> <a href="logout"><i class="fa fa-sign-in"></i> تسجيل خروج </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- end message notitifcation -->
                                <?php
                                }
                                ?>
                            </div>
                            <div class="rd-navbar-main-element">
                                <div class="rd-navbar-nav-wrap">
                                    <ul class="rd-navbar-nav">
                                        <li id="individuals" class="rd-nav-item">
                                            <a class="rd-nav-link" href="index">الرئيسية</a>
                                        </li>
                                        <?php
                                        if (isset($_SESSION['ind_id'])) {
                                        ?>
                                            <li id="stars" class="rd-nav-item">
                                                <a class="rd-nav-link" href="stars"> المؤهلين </a>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                        <li id="contacts" class="rd-nav-item">
                                            <a class="rd-nav-link" href="contact">تواصل معنا</a>
                                        </li>
                                        <?php

                                        if (isset($_SESSION['ind_id'])) {
                                        ?>
                                            <li id="exam_link" class="rd-nav-item">
                                                <a class="rd-nav-link login_link" href="exam"> الاختبارات </a>
                                            </li>
                                        <?php
                                        } else { ?>
                                            <li id="login" class="rd-nav-item" style='margin:5px '>
                                                <a class="rd-nav-link login_link" href="login"> دخول </a>
                                            </li>
                                            <li id="register" class="rd-nav-item" style="margin-right: 10px;">
                                                <a class="rd-nav-link register_link" href="register">حساب جديد</a>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>