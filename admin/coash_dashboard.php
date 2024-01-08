<?php
ob_start();
$pagetitle = ' الرئيسية  ';
if(isset($_SESSION['coash_id'])){

$stmt = $connect->prepare("SELECT * FROM coshes WHERE co_id = ?");
$stmt->execute(array($_SESSION['coash_id']));
$coash_count = $stmt->rowCount();
if ($coash_count > 0) {
} else {
    header("Location:index");
    exit();
}
?>
<div class="container dashboard">
    <div class="bread bread_dasha">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <i class="fa fa-heart"></i> <a href="main.php?dir=dashboard&page=coash_dashboard"> لوحة تحكم المدربين </a> <i class="fa fa-chevron-left"></i> </li>
                <li class="breadcrumb-item active" aria-current="page"> <?php echo $lang['dashboard']; ?> </li>
            </ol>
        </nav>
    </div>
    <div class="dashboard_data">
        <div class="row">
            <div class="col-lg-4">
                <a href="main.php?dir=batches&page=report">
                    <div class="info info3">
                        <div class="">
                            <h3> الدفعات </h3>
                        </div>
                        <?php
                        $stmt = $connect->prepare(
                            'SELECT COUNT(batch_id) FROM batches WHERE batch_coach = ?'
                        );
                        $stmt->execute(array($_SESSION['coash_id']));
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