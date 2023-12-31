<?php

$stmt = $connect->prepare("SELECT * FROM contract_cancel WHERE company_id=? AND update_at=''");
$stmt->execute(array($_SESSION['com_id']));
$alldataend_contract = $stmt->fetchAll();
$end_contract_noti_count = $stmt->rowCount();
if ($end_contract_noti_count > 0) {
    $message = "   تم الغاء الاتفاق بيك وبين المتدرب .... ";
}
