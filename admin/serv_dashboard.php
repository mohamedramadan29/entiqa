<?php
ob_start();
$pagetitle = 'الرئيسية';
if (isset($_SESSION['serv_name'])) {


?>
    <div class="container dashboard">
        <div class="bread bread_dasha">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <i class="fa fa-heart"></i> <a href="main.php?dir=dashboard&page=serv_dashboard"> لوحة تحكم فريق الخدمة </a> <i class="fa fa-chevron-left"></i> </li>
                    <li class="breadcrumb-item active" aria-current="page"> <?php echo $lang['dashboard']; ?> </li>
                </ol>
            </nav>
        </div>
        <div class="dashboard_data">
            <div class="row">
                <div class="col-lg-4">
                    <a href="main.php?dir=company&page=report">
                        <div class="info info2">
                            <div class="alert_notification">
                                <h3> عدد الشركات المسجلة</h3>
                                <?php
                                $stmt = $connect->prepare(
                                    'SELECT * FROM company_register WHERE com_updated =0'
                                );
                                $stmt->execute();
                                $new_count = $stmt->RowCount();
                                ?>
                                <p> <?php echo $new_count;  ?></p>
                            </div>
                            <?php
                            $stmt = $connect->prepare(
                                'SELECT COUNT(com_id) FROM company_register'
                            );
                            $stmt->execute();
                            $count = $stmt->fetchcolumn();
                            ?>
                            <span> <?php echo $count; ?> </span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="main.php?dir=individual&page=report">
                        <div class="info info1">
                            <div class="alert_notification">
                                <h3> عدد الافراد المسجلين </h3>
                                <?php
                                $stmt = $connect->prepare(
                                    'SELECT * FROM ind_register WHERE ind_updated =0'
                                );
                                $stmt->execute();
                                $new_count = $stmt->RowCount();

                                ?>
                                <p> <?php echo $new_count;  ?></p>
                            </div>

                            <?php
                            $stmt = $connect->prepare(
                                'SELECT COUNT(ind_id) FROM ind_register'
                            );
                            $stmt->execute();
                            $count = $stmt->fetchcolumn();
                            ?>
                            <span> <?php echo $count; ?></span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4">
                    <a href="main.php?dir=services_section&page=report">
                        <div class="info info3">
                            <div class="">
                                <h3> عدد الافراد لم يتم تسجيلهم في دفعات </h3>
                            </div>

                            <?php
                            $stmt = $connect->prepare(
                                'SELECT COUNT(ind_id) FROM ind_register WHERE ind_batch=0'
                            );
                            $stmt->execute();
                            $count = $stmt->fetchcolumn();
                            ?>
                            <span> <?php echo $count; ?></span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4">
                    <a href="main.php?dir=batches&page=report">
                        <div class="info info3">
                            <div class="">
                                <h3> عدد الدفعات </h3>
                            </div>

                            <?php
                            $stmt = $connect->prepare(
                                'SELECT COUNT(batch_id) FROM batches'
                            );
                            $stmt->execute();
                            $count = $stmt->fetchcolumn();
                            ?>
                            <span> <?php echo $count; ?></span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4">
                    <a href="main.php?dir=coashes&page=report">
                        <div class="info info4">
                            <div class="">
                                <h3> عدد المدربين </h3>
                            </div>

                            <?php
                            $stmt = $connect->prepare(
                                'SELECT COUNT(co_id) FROM coshes'
                            );
                            $stmt->execute();
                            $count = $stmt->fetchcolumn();
                            ?>
                            <span> <?php echo $count; ?></span>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4">
                    <a href="main.php?dir=contact&page=report">
                        <div class="info info9">
                            <div class="alert_notification">
                                <h3> رسائل الصفحة </h3>
                                <?php
                                $stmt = $connect->prepare(
                                    'SELECT * FROM contact WHERE admin_noti =0'
                                );
                                $stmt->execute();
                                $new_count = $stmt->RowCount();

                                ?>
                                <p> <?php echo $new_count;  ?></p>
                            </div>

                            <?php
                            $stmt = $connect->prepare(
                                'SELECT COUNT(con_id) FROM contact'
                            );
                            $stmt->execute();
                            $count = $stmt->fetchcolumn();
                            ?>
                            <span> <?php echo $count; ?></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>


    </div>


<?php ob_end_flush();
} else {
    header("Location:signout");
}
?>