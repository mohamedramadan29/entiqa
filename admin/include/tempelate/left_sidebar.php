<?php
$stmt = $connect->prepare("SELECT * FROM admin WHERE admin_id = ?");
$stmt->execute(array($_SESSION['admin_id']));
$count_Admin = $stmt->rowCount();
if ($count_Admin > 0) {
    $admin = $stmt->fetch();
    $session_token = $admin['session_token'];
    if ($session_token != $_SESSION['token_compare']) {
        if ($_SESSION['new_pass'] != $session_token) {
            header("Location:signout");
            exit();
        }
    }
}
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light"> <?php echo $website_title ?> </span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3" style="line-height:0">
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item" id="lnk-expenses">
                    <a href="main.php?dir=dashboard&page=dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            الرئيسية
                        </p>
                    </a>
                </li>

                <!-- START EDUCATION WEBSITE  -->

                <!-- START WHATSAPP -->
                <li class="nav-item" id="lnk-whatsapp">
                    <a href="#" class="nav-link nav-link2">
                        <i class="fa fa-building color2"></i>
                        <p>
                            الشركات
                            <i class="right fas fa-angle-left "></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="lnk-rep-whatsapp">
                            <a href="main.php?dir=company&page=report" class="nav-link">
                                <i class="far fa-circle nav-icon color3"></i>
                                <p> مشاهدة الشركات</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- END WHATSAPP -->

                <!--   START COUNTRY -->
                <li class="nav-item" id="lnk-country">
                    <a href="#" class="nav-link nav-link2">
                        <i class="fa-solid fa-users color2"></i>
                        <p>
                            الافراد
                            <i class="right fas fa-angle-left "></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="lnk-rep-country">
                            <a href="main.php?dir=individual&page=report" class="nav-link">
                                <i class="far fa-circle nav-icon color3"></i>
                                <p> قائمة جميع المتدربين</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- END   COUNTRY -->

                <!--   START Coashes Section -->
                <li class="nav-item" id="lnk-coash">
                    <a href="#" class="nav-link nav-link2">
                        <i class="fa-solid fa-images color2"></i>
                        <p>
                            المدربين
                            <i class="right fas fa-angle-left "></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="lnk-rep-coash">
                            <a href="main.php?dir=coashes&page=report" class="nav-link">
                                <i class="far fa-circle nav-icon color3"></i>
                                <p> مشاهدة المدربين </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- END Coashes Section -->
                <!--   START Coashes Section -->
                <li class="nav-item" id="lnk-batches">
                    <a href="#" class="nav-link nav-link2">
                        <i class="fa-solid fa-images color2"></i>
                        <p>
                            الدفعات
                            <i class="right fas fa-angle-left "></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="lnk-rep-batch">
                            <a href="main.php?dir=batches&page=report" class="nav-link">
                                <i class="far fa-circle nav-icon color3"></i>
                                <p> مشاهدة الدفعات </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- END Coashes Section -->
                <!--   START services Section -->
                <li class="nav-item" id="lnk-university">
                    <a href="#" class="nav-link nav-link2">
                        <i class="fa-solid fa-images color2"></i>
                        <p>
                            متدربين جدد
                            <i class="right fas fa-angle-left "></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="lnk-rep-university">
                            <a href="main.php?dir=services_section&page=report" class="nav-link">
                                <i class="far fa-circle nav-icon color3"></i>
                                <p> مشاهدة اخر التسجيلات </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- END Services Section -->

                <!--   START services Section -->
                <li class="nav-item" id="lnk-exam">
                    <a href="#" class="nav-link nav-link2">
                        <i class="fa-solid fa-images color2"></i>
                        <p>
                            الاختبارات
                            <i class="right fas fa-angle-left "></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="lnk-rep-exam">
                            <a href="main.php?dir=exam&page=report" class="nav-link">
                                <i class="far fa-circle nav-icon color3"></i>
                                <p> مشاهدة الاختبارات </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- END Services Section -->
                <li class="nav-item" id="lnk-message">
                    <a href="#" class="nav-link nav-link2">
                        <i class="fa-solid fa-envelope color2"></i>
                        <p>
                            رسائل الافراد والشركات
                            <i class="right fas fa-angle-left "></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item" id="lnk-contact">
                            <a href="main.php?dir=all_chats&page=report" class="nav-link">
                                <i class="far fa-circle nav-icon color3"></i>
                                <p> مشاهدة جميع الرسائل </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item" id="lnk-message">
                    <a href="#" class="nav-link nav-link2">
                        <i class="fa-solid fa-envelope color2"></i>
                        <p>
                            رسائل صفحه تواصل معنا
                            <i class="right fas fa-angle-left "></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="lnk-contact">
                            <a href="main.php?dir=contact&page=report" class="nav-link">
                                <i class="far fa-circle nav-icon color3"></i>
                                <p> مشاهدة جميع الرسائل </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" id="lnk-review">
                    <a href="#" class="nav-link nav-link2">
                        <i class="fa-solid fa-images color2"></i>
                        <p>
                            أراء وتقييمات العملاء
                            <i class="right fas fa-angle-left "></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="lnk-rep-review">
                            <a href="main.php?dir=review&page=com_review" class="nav-link">
                                <i class="far fa-circle nav-icon color3"></i>
                                <p> تقييمات الشركات </p>
                            </a>
                        </li>
                        <li class="nav-item" id="lnk-rep-review2">
                            <a href="main.php?dir=review&page=ind_review" class="nav-link">
                                <i class="far fa-circle nav-icon color3"></i>
                                <p> تقييمات المتدربين </p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item" id="lnk-review">
                    <a href="#" class="nav-link nav-link2">
                        <i class="fa fa-dashboard color2"></i>
                        <p>
                            فريق الخدمة
                            <i class="right fas fa-angle-left "></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="lnk-rep-review">
                            <a href="main.php?dir=service_team&page=report" class="nav-link">
                                <i class="far fa-circle nav-icon color3"></i>
                                <p> الاعضاء </p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item" id="lnk-review">
                    <a href="#" class="nav-link nav-link2">
                        <i class="fa fa-dashboard color2"></i>
                        <p>
                            الاعدادات
                            <i class="right fas fa-angle-left "></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="lnk-rep-review">
                            <a href="main.php?dir=settings&page=report" class="nav-link">
                                <i class="far fa-circle nav-icon color3"></i>
                                <p>تعديل بيانات الأدمن </p>
                            </a>
                            <a href="main.php?dir=subscribe_payment&page=report" class="nav-link">
                                <i class="far fa-circle nav-icon color3"></i>
                                <p> اشتركات الفرد والشركه </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item" id="lnk-message">
                    <a href="#" class="nav-link nav-link2">
                        <i class="fa-solid fa-envelope color2"></i>
                        <p>
                            المسوقين
                            <i class="right fas fa-angle-left "></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="lnk-marketer">
                            <a href="main.php?dir=marketers&page=report" class="nav-link">
                                <i class="far fa-circle nav-icon color3"></i>
                                <p> مشاهدة جميع المسوقين </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="signout.php" class="nav-link">
                        <i class="fa-solid fa-arrow-right-from-bracket color11"></i>
                        <p>
                            تسجيل خروج
                            <i class=""></i>
                        </p>
                    </a>
                </li>
                <!-- END EDUCATION WEBSITE -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>