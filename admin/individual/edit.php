<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ind_id = $_POST['ind_id'];
    $ind_batch = $_POST['ind_batch'];
    $ind_status = $_POST['ind_status'];
    if (!empty($_FILES['ind_certificate']['name'])) {
        $ind_certificate_name = $_FILES['ind_certificate']['name'];
        $ind_certificate_temp = $_FILES['ind_certificate']['tmp_name'];
        $ind_certificate_type = $_FILES['ind_certificate']['type'];
        $ind_certificate_uploaded = time() . '_' . $ind_certificate_name;
        move_uploaded_file(
            $ind_certificate_temp,
            'uploads/' . $ind_certificate_uploaded
        );
    }
    // check if it the same batch or not
    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id = ?");
    $stmt->execute(array($ind_id));
    $user_data = $stmt->fetch();
    $user_batch = $user_data['ind_batch'];
    if ($user_batch != $ind_batch) {
        $stmt = $connect->prepare("UPDATE ind_register SET ind_batch=?,ind_status=? WHERE ind_id=?");
        $stmt->execute([$ind_batch, $ind_status, $ind_id]);
        // باقي انقص واحد من الدفعه القديمة 
        $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_id=?");
        $stmt->execute(array($user_batch));
        $batch_data = $stmt->fetch();
        $ind_num_minus = $batch_data['ind_num'] - 1;
        $stmt = $connect->prepare("UPDATE batches SET ind_num=? WHERE batch_id=?");
        $stmt->execute(array($ind_num_minus, $user_batch));
        // ازود واحد علي الدفعه الجديدة 

        $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_id=?");
        $stmt->execute(array($ind_batch));
        $batch_data = $stmt->fetch();
        $ind_num = $batch_data['ind_num'] + 1;
        $stmt = $connect->prepare("UPDATE batches SET ind_num=? WHERE batch_id=?");
        $stmt->execute(array($ind_num, $ind_batch));
    } else {
        $stmt = $connect->prepare("UPDATE ind_register SET ind_status=? WHERE ind_id=?");
        $stmt->execute([$ind_status, $ind_id]);
    }

    if (!empty($_FILES['ind_certificate']['tmp_name'])) {
        $ind_certificate_uploaded = time() . '_' . $ind_certificate_name;
        move_uploaded_file(
            $ind_certificate_temp,
            'uploads/' . $ind_certificate_uploaded
        );
        $stmt = $connect->prepare("UPDATE ind_register SET ind_certificate=? WHERE ind_id=?");
        $stmt->execute([$ind_certificate_uploaded, $ind_id]);
    }
    if ($stmt) {
        if (isset($ind_batch)) {
            // check if this user in batches and inserted in  batch notification
            $stmt = $connect->prepare("SELECT * FROM batches_notification WHERE ind = ?");
            $stmt->execute(array($ind_id));
            $count_ind_batch = $stmt->rowCount();
            $notification_data = $stmt->fetch();
            $ind_batch_notifaction = $notification_data['batch'];
            if ($count_ind_batch > 0) {
                if ($ind_batch_notifaction != $ind_batch) {
                    $stmt = $connect->prepare("UPDATE batches_notification SET batch = ? WHERE ind = ?");
                    $stmt->execute(array($ind_batch, $ind_id));
                }
            } else {
                $stmt = $connect->prepare("INSERT INTO batches_notification (batch,ind) VALUES (:zbatch,:zind)");
                $stmt->execute(array(
                    "zbatch" => $ind_batch,
                    "zind" => $_POST['ind_id'],
                ));
            }
        }
        if (isset($ind_status)) {
            // First Check User Insertd In Change Status Notification
            $stmt = $connect->prepare("SELECT * FROM change_status_notification WHERE ind_id = ?");
            $stmt->execute(array($ind_id));
            $count_ind_status = $stmt->rowCount();
            $changes_data = $stmt->fetch();
            if ($count_ind_status) {
                $ind_status_old = $changes_data['change_status'];
                if ($ind_status_old != $ind_status) {
                    // update ind status
                    $stmt = $connect->prepare("UPDATE change_status_notification SET change_status = ?, status_show = 0 ,date=? WHERE ind_id = ?");
                    $stmt->execute(array($ind_status, date("Y-m-d"),$ind_id));
                }
            } else {
                // Insert New Notification
                $stmt = $connect->prepare("INSERT INTO change_status_notification (ind_id, change_status,status_show,date)
                 VALUES (:zind_id,:zchange_stats,:zstatus,:zdate)");
                $stmt->execute(array(
                    'zind_id' => $ind_id,
                    'zchange_stats' => $ind_status,
                    'zstatus' => 0,
                    'zdate' => date('Y-m-d'),
                ));
            }
        }

?>
        <div class="container">
            <div class="alert-success">
                تم تعديل المتدرب بنجاح
                <?php
                header("Location:main.php?dir=individual&page=report");
                ?>
            </div>
        </div>
<?php }
}
