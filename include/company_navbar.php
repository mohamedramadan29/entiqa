<div class="page">
    <header class="section page-header rd-navbar-transparent-wrap" id="large_screen">
        <!--RD Navbar-->
        <div class="rd-navbar-wrap">
            <nav class="rd-navbar rd-navbar-transparent company_navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="20px" data-xl-stick-up-offset="20px" data-xxl-stick-up-offset="20px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
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
                                        <li id="index" class="rd-nav-item"><a class="rd-nav-link" href="index">الرئيسية</a>
                                        </li>
                                        <?php if (isset($_SESSION['com_id'])) { ?>
                                            <li id="stars" class="rd-nav-item"><a class="rd-nav-link" href="stars"> بائع  </a>
                                            </li>
                                            <li id="fav" class="rd-nav-item"><a class="rd-nav-link" href="fav_stars"> مدير مبيعات  </a>
                                            </li>
                                        <?php
                                        } ?>
                                        <li id="emp" class="rd-nav-item"><a class="rd-nav-link" href="emp_stars"> مؤهلين تم توظيفهم </a>
                                        </li>
                                        <li id="contacts" class="rd-nav-item"><a class="rd-nav-link" href="contact">تواصل معنا</a>
                                        </li>
                                        <?php
                                        if (isset($_SESSION['com_id'])) { ?>
                                            <?php
                                            $old_count = 0;
                                            $i = 0;
                                            $message = "";

                                            include 'com_notitfication.php';
                                            include 'com_notitfication_msg.php';
                                            ?>
                                            <!-- START MESSAGE NOTITFICATION -->
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-envelope"></i> <span style="position: relative;top: -13px;font-size: 18px;font-weight: bold;"> <?php
                                                                                                                                                                    if (
                                                                                                                                                                        $new_count == 0 && $new_count_entiqa_message == 0
                                                                                                                                                                    ) {
                                                                                                                                                                        $new_count_msg = "";
                                                                                                                                                                    } else {
                                                                                                                                                                        $new_count_msg = $new_count + $new_count_entiqa_message;
                                                                                                                                                                    }
                                                                                                                                                                    echo $new_count_msg ?> </span>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <?php
                                                    if ($new_count > 0) {
                                                        foreach ($alldatamsg as $msg) {
                                                    ?>
                                                            <li> <a class="dropdown-item" href="com_message.php?other=<?php echo $msg['from_person']; ?>"> لديك رسالة تفاوض جديدة </a> </li>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                    }
                                                    if ($new_count_entiqa_message > 0) {
                                                        foreach ($alldatamsgentiqa as $entiqa_message) {
                                                        ?>
                                                            <li> <a class="dropdown-item" href="com_message.php?other=<?php echo $entiqa_message['from_person']; ?>"> لديك رسالة جديدة من منصة انتقاء </a> </li>
                                                        <?php
                                                        }
                                                        ?>
                                                    <?php
                                                    }
                                                    if ($new_count == 0 && $new_count_entiqa_message == 0) { ?>
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
                                            <!-- end message notitifcation -->
                                            <!-- START ALL NOTITFICATION -->
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-bell"></i> <span style="position: relative;top: -13px;font-size: 18px;font-weight: bold;">
                                                        <?php
                                                        if (
                                                            $end_contract_noti_count == 0 && $all_count_status == 0
                                                        ) {
                                                            $new_count_notification = "";
                                                        } else {
                                                            $new_count_notification = $end_contract_noti_count + $all_count_status;
                                                        }
                                                        echo $new_count_notification ?> </span>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <?php

                                                    if ($end_contract_noti_count > 0) {
                                                        foreach ($alldataend_contract as $data_contract) {
                                                    ?>
                                                            <li> <a href="ind_profile.php?ind_id=<?php echo $data_contract['ind_id']; ?>"> تم الغاء الاتفاق بيك وبين المتدرب .... </a> </li>
                                                        <?php
                                                        }
                                                        ?>

                                                    <?php
                                                    }
                                                    if ($all_count_status > 0) {

                                                    ?>
                                                        <li> <a href="profile"> تم تغير الحاله الخاصه بك الي [ <?php echo $status; ?> ] </a> </li>
                                                    <?php

                                                    }
                                                    if ($end_contract_noti_count == 0 && $all_count_status == 0) {
                                                    ?>
                                                        <li> <a href="#" class="dropdown-item"> لا يوجد لديك اشعارات جديدة في الوقت الحالي </a> </li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <hr>
                                                    <li> <a class="dropdown-item" href="all_notification"> عرض كل الأشعارات </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class=" profile_item">
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
                                                <ul class="profile_links">
                                                    <li> <a href="profile"> <i class="fa fa-user"></i> حساب الشركة </a> </li>
                                                    <li> <a href="all_message"> <i class="fa fa-envelope"></i> الرسائل </a> </li>
                                                    <!-- <li> <a href="balance"> <i class="fa fa-money"></i> الرصيد </a> </li> -->
                                                    <li> <a href="logout"><i class="fa fa-sign-in"></i> تسجيل خروج </a> </li>
                                                </ul>

                                            </li>

                                        <?php
                                        } else { ?>
                                            <li id="login" class="rd-nav-item">
                                                <a class="rd-nav-link login_link" href="login"> دخول </a>
                                            </li>
                                            <li id="register" class="rd-nav-item">
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


    <!--------------------------------------- Small Screen -------------------------------->

    <header class="section page-header rd-navbar-transparent-wrap" id="small_screen">
        <!--RD Navbar-->
        <div class="rd-navbar-wrap">
            <nav class="rd-navbar rd-navbar-transparent company_navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="20px" data-xl-stick-up-offset="20px" data-xxl-stick-up-offset="20px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
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
                                if (isset($_SESSION['com_id'])) {
                                    $old_count = 0;
                                    $i = 0;
                                    $message = "";

                                    include 'com_notitfication.php';
                                    include 'com_notitfication_msg.php';
                                ?>
                                    <!-- START MESSAGE NOTITFICATION -->
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-envelope"></i> <span style="position: relative;top: -13px;font-size: 18px;font-weight: bold;"> <?php
                                                                                                                                                            if (
                                                                                                                                                                $new_count == 0 && $new_count_entiqa_message == 0
                                                                                                                                                            ) {
                                                                                                                                                                $new_count_msg = "";
                                                                                                                                                            } else {
                                                                                                                                                                $new_count_msg = $new_count + $new_count_entiqa_message;
                                                                                                                                                            }
                                                                                                                                                            echo $new_count_msg ?> </span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <?php
                                            if ($new_count > 0) {
                                                foreach ($alldatamsg as $msg) {
                                            ?>
                                                    <li> <a class="dropdown-item" href="com_message.php?other=<?php echo $msg['from_person']; ?>"> لديك رسالة تفاوض جديدة </a> </li>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                            }
                                            if ($new_count_entiqa_message > 0) {
                                                foreach ($alldatamsgentiqa as $entiqa_message) {
                                                ?>
                                                    <li> <a class="dropdown-item" href="com_message.php?other=<?php echo $entiqa_message['from_person']; ?>"> لديك رسالة جديدة من منصة انتقاء </a> </li>
                                                <?php
                                                }
                                                ?>
                                            <?php
                                            }
                                            if ($new_count == 0 && $new_count_entiqa_message == 0) { ?>
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
                                    <!-- end message notitifcation -->
                                    <!-- START ALL NOTITFICATION -->
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-bell"></i> <span style="position: relative;top: -13px;font-size: 18px;font-weight: bold;">
                                                <?php
                                                if (
                                                    $end_contract_noti_count == 0 && $all_count_status == 0
                                                ) {
                                                    $new_count_notification = "";
                                                } else {
                                                    $new_count_notification = $end_contract_noti_count + $all_count_status;
                                                }
                                                echo $new_count_notification ?> </span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <?php

                                            if ($end_contract_noti_count > 0) {
                                                foreach ($alldataend_contract as $data_contract) {
                                            ?>
                                                    <li> <a href="ind_profile.php?ind_id=<?php echo $data_contract['ind_id']; ?>"> تم الغاء الاتفاق بيك وبين المتدرب .... </a> </li>
                                                <?php
                                                }
                                                ?>

                                            <?php
                                            }
                                            if ($all_count_status > 0) {

                                            ?>
                                                <li> <a href="profile"> تم تغير الحاله الخاصه بك الي [ <?php echo $status; ?> ] </a> </li>
                                            <?php

                                            }
                                            if ($end_contract_noti_count == 0 && $all_count_status == 0) {
                                            ?>
                                                <li> <a href="#" class="dropdown-item"> لا يوجد لديك اشعارات جديدة في الوقت الحالي </a> </li>
                                            <?php
                                            }
                                            ?>
                                            <hr>
                                            <li> <a class="dropdown-item" href="all_notification"> عرض كل الأشعارات </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class=" profile_item">
                                        <?php
                                        $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id = ?");
                                        $stmt->execute(array($_SESSION['com_id']));
                                        $ind_data_image = $stmt->fetch();
                                        if ($ind_data_image['com_image'] != '') {
                                        ?>
                                            <img width="55px" src="../ind_images_upload/<?php echo $ind_data_image['com_image'] ?>" alt="">
                                        <?php
                                        } else {
                                        ?>
                                            <img width="55px" src="../images/avatar.png" alt="">
                                        <?php
                                        }
                                        ?>
                                        <ul class="profile_links">
                                            <li> <a href="profile"> <i class="fa fa-user"></i> حساب الشركة </a> </li>
                                            <li> <a href="all_message"> <i class="fa fa-envelope"></i> الرسائل </a> </li>
                                            <!-- <li> <a href="balance"> <i class="fa fa-money"></i> الرصيد </a> </li> -->
                                            <li> <a href="logout"><i class="fa fa-sign-in"></i> تسجيل خروج </a> </li>
                                        </ul>

                                    </li>
                                <?php
                                }
                                ?>

                            </div>
                            <div class="rd-navbar-main-element">
                                <div class="rd-navbar-nav-wrap">
                                    <ul class="rd-navbar-nav">
                                        <li id="index" class="rd-nav-item"><a class="rd-nav-link" href="index">الرئيسية</a>
                                        </li>
                                        <?php if (isset($_SESSION['com_id'])) { ?>
                                            <li id="stars" class="rd-nav-item"><a class="rd-nav-link" href="stars"> المؤهلين </a>
                                            </li>
                                            <li id="fav" class="rd-nav-item"><a class="rd-nav-link" href="fav_stars"> أفضل المؤهلين </a>
                                            </li>
                                        <?php
                                        } ?>
                                        <li id="emp" class="rd-nav-item"><a class="rd-nav-link" href="emp_stars"> مؤهلين تم توظيفهم </a>
                                        </li>
                                        <li id="contacts" class="rd-nav-item"><a class="rd-nav-link" href="contact">تواصل معنا</a>
                                        </li>
                                        <?php
                                        if (isset($_SESSION['com_id'])) { ?>

                                        <?php
                                        } else { ?>
                                            <li id="login" class="rd-nav-item">
                                                <a class="rd-nav-link login_link" href="login"> دخول </a>
                                            </li>
                                            <li id="register" class="rd-nav-item">
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