<?php
ob_start();
$pagetitle = 'الرئيسية';
if(isset($_SESSION['admin_session'])){

?>
<div class="container dashboard">
    <div class="bread bread_dasha">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <i class="fa fa-heart"></i> <a href="main.php?dir=dashboard&page=dashboard">
                        <?php echo  $website_title; ?></a> <i class="fa fa-chevron-left"></i> </li>
                <li class="breadcrumb-item active" aria-current="page"> <?php echo $lang['dashboard']; ?> </li>
            </ol>
        </nav>
    </div>
    <div class="dashboard_data">
        <div class="row">
            <div class="col-lg-3 col-6">
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
            <div class="col-lg-3 col-6">
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

            <div class="col-lg-3 col-6">
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

            <div class="col-lg-3 col-6">
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
            <div class="col-lg-3 col-6">
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
            <div class="col-lg-3 col-6">
                <a href="main.php?dir=compelete_contract&page=report">
                    <div class="info info6">
                        <div class="alert_notification">
                            <h3> صفقات تمت الاتفاق عليها </h3>
                            <?php
                            $stmt = $connect->prepare(
                                'SELECT * FROM contract_complete WHERE con_com_admin =0'
                            );
                            $stmt->execute();
                            $new_count = $stmt->RowCount();

                            ?>
                            <p> <?php echo $new_count;  ?></p>
                        </div>
                        <?php
                        $stmt = $connect->prepare('SELECT COUNT(con_com_id) FROM contract_complete
                        INNER JOIN company_register ON company_register.com_id = contract_complete.company_id
                        INNER JOIN ind_register ON ind_register.ind_id = contract_complete.ind_id');
                        $stmt->execute();
                        $count = $stmt->fetchcolumn();
                        ?>
                        <span> <?php echo $count; ?></span>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="main.php?dir=cancel_contract&page=report">
                    <div class="info info7">
                        <div class="alert_notification">
                            <h3> صفقات تم الغاءها والاسباب </h3>
                            <?php
                            $stmt = $connect->prepare(
                                'SELECT * FROM contract_cancel WHERE cancel_com_admin =0'
                            );
                            $stmt->execute();
                            $new_count = $stmt->RowCount();

                            ?>
                            <p> <?php echo $new_count;  ?></p>
                        </div>

                        <?php 
                        $stmt = $connect->prepare('SELECT COUNT(con_cancel_id) FROM contract_cancel
                        INNER JOIN company_register ON company_register.com_id = contract_cancel.company_id
                        INNER JOIN ind_register ON ind_register.ind_id = contract_cancel.ind_id');
                        $stmt->execute();
                        $count = $stmt->fetchcolumn();
                        ?>
                        <span> <?php echo $count; ?></span>
                    </div>
                </a>
            </div>
            <!--
            <div class="col-lg-3 col-6">
                <a href="main.php?dir=withdraw&page=report">
                    <div class="info info8">
                        <div class="alert_notification">
                            <h3> طلبات السحب </h3>
                            <?php
                            $stmt = $connect->prepare(
                                'SELECT * FROM withdraw WHERE with_admin_noti =0'
                            );
                            $stmt->execute();
                            $new_count = $stmt->RowCount();

                            ?>
                            <p> <?php echo $new_count;  ?></p>
                        </div>

                        <?php
                        $stmt = $connect->prepare(
                            'SELECT COUNT(id) FROM withdraw'
                        );
                        $stmt->execute();
                        $count = $stmt->fetchcolumn();
                        ?>
                        <span> <?php echo $count; ?></span>
                    </div>
                </a>
            </div>
                    -->
            <div class="col-lg-3 col-6">
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
                            <p> <?php echo $new_count; ?></p>
                        </div>

                        <?php
                        $stmt = $connect->prepare(
                            'SELECT COUNT(con_id) FROM contact'
                        );
                        $stmt->execute();
                        $count = $stmt->fetchcolumn();
                        ?>
                        <span> <?php echo $count;  ?></span>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-3 col-6">
                <a href="main.php?dir=all_chats&page=report">
                    <div class="info info10">
                        <div class="alert_notification">
                            <h3> رسائل الافراد والشركات </h3>
                            <?php
                            $stmt = $connect->prepare("SELECT * FROM chat WHERE to_person !='admin' AND from_person !='admin' AND admin_noti=0 GROUP BY chat_id,to_person,from_person  ORDER BY chat_id DESC");
                            $stmt->execute();
                            $allmessage = $stmt->fetchAll();
                            $new_count = $stmt->rowCount();
                            ?>
                            <p> <?php echo $new_count;  ?></p>
                        </div>

                        <?php
                        $stmt = $connect->prepare("SELECT * FROM chat WHERE to_person !='admin' AND from_person !='admin' GROUP BY chat_id,to_person,from_person  ORDER BY chat_id DESC");
                        $stmt->execute();
                        $allmessage = $stmt->fetchAll();
                        $count = $stmt->rowCount();
                        ?>
                        <span> <?php echo $count; ?></span>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="main.php?dir=interview&page=report">
                    <div class="info info11">
                        <div class="alert_notification">
                            <h3> المقابلات الشخصية </h3>
                            <?php
                            $stmt = $connect->prepare(
                                'SELECT * FROM interview_notificaion WHERE inter_admin_noti =0'
                            );
                            $stmt->execute();
                            $new_count = $stmt->RowCount();

                            ?>
                            <p> <?php echo $new_count;  ?></p>
                        </div>

                        <?php
                        $stmt = $connect->prepare(
                            'SELECT COUNT(noti_id) FROM interview_notificaion'
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

}else{
    header("Location:signout");
}
?>

<script>
history.pushState(null, null, location.href);
window.onpopstate = function () {
  history.go(1);
};
</script>