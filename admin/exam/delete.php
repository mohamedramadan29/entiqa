<?php
if (isset($_GET['ex_id']) && is_numeric($_GET['ex_id'])) {
    $ex_id = $_GET['ex_id'];
    $formerror = [];
    $stmt = $connect->prepare('SELECT * FROM exam WHERE ex_id= ?');
    $stmt->execute([$ex_id]);
    $count = $stmt->rowCount();
    $exam_data = $stmt->fetch();
    $exam_publish_date = $exam_data['ex_date_publish'];
    $batch_number = $exam_data['ex_batch_num'];
    // gett th batch data to check if ended or not
    $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_id =?");
    $stmt->execute(array($batch_number));
    $batch_data = $stmt->fetch();
    $count_batches = $stmt->rowCount();
    if ($count_batches > 0) {
        $batch_status = $batch_data['batch_status'];
        $data_now = date("Y-m-d");
        if (($exam_publish_date < $data_now) && $batch_status != 'تم التأهيل بنجاح') {
            $formerror[] = 'لا  يمكن هذا الاختبار لانه تم نشرة وايضا الدفعه لم تنتهي بعد ';
        }
    }
    if ($count > 0) {
        if (empty($formerror)) {
            $stmt = $connect->prepare('DELETE FROM exam WHERE ex_id=?');
            $stmt->execute([$ex_id]);
            if ($stmt) {
                $_SESSION['success_message'] = " تمت الحذف بنجاح  ";
                header('Location:main?dir=exam&page=report');

?>
                <div class="alert-success">
                    <?php echo $lang['delete_message']; ?>
                    <?php header('LOCATION:main.php?dir=exam&page=report'); ?>
                <?php }
        } else {
            foreach ($formerror as $error) {
                ?>
                    <div class="alert alert-danger"> <?php echo $error; ?> </div>
    <?php
            }
        }
    }
}
