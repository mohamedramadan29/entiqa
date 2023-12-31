<?php

$stmt = $connect->prepare("SELECT DISTINCT from_person, to_person FROM chat WHERE to_person=? AND from_person !='admin' AND com_noti=0");
$stmt->execute(array($_SESSION['com_username']));
$alldatamsg = $stmt->fetchAll();
$new_count = $stmt->rowCount();
if ($new_count > 0) {
    $message = "لديك رسالة جديدة";
}


////////////////////////////////////////////////////////////////////

// message from admin 
$stmt = $connect->prepare("SELECT DISTINCT from_person, to_person FROM chat WHERE to_person=? AND from_person ='admin' AND com_noti=0");
$stmt->execute(array($_SESSION['com_username']));
$alldatamsgentiqa = $stmt->fetchAll();
$new_count_entiqa_message = $stmt->rowCount();
if ($new_count_entiqa_message > 0) {
    $message = "  لديك رسالة جديدة منصة انتقاء   ";
}
