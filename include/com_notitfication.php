<?php

$stmt = $connect->prepare("SELECT * FROM contract_cancel WHERE company_id=? AND update_at=''");
$stmt->execute(array($_SESSION['com_id']));
$alldataend_contract = $stmt->fetchAll();
$end_contract_noti_count = $stmt->rowCount();
if ($end_contract_noti_count > 0) {
    $message = "   تم الغاء الاتفاق بيك وبين المتدرب .... ";
}


// when change company status 

$stmt = $connect->prepare("SELECT * FROM company_status_notification WHERE com_id = ? AND status_show = 0 ORDER BY id DESC LIMIT 1 ");
$stmt->execute(array($_SESSION['com_id']));
$allchange_status = $stmt->fetch();
$all_count_status = $stmt->rowCount();

if ($all_count_status > 0) {
    $message = 'تم تغير الحاله الخاصه بك';
    $active_type = $allchange_status['status'];
    if ($active_type == 1) {
        $status = 'نشطه';
    } else {
        $status = 'غير نشطه';
    }
}
