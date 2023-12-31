<?php
// message from company 
// $stmt = $connect->prepare("SELECT DISTINCT from_person, * FROM chat WHERE to_person=? AND from_person != 'admin' AND from_person != 'coash' AND ind_noti = 0");
// $stmt->execute(array($_SESSION['ind_username']));
// $alldatamsg = $stmt->fetchAll();
// $new_count_chat = $stmt->rowCount();
// if ($new_count_chat > 0) {
//     $message = "لديك رسالة جديدة";
// }
$stmt = $connect->prepare("SELECT DISTINCT from_person, to_person FROM chat WHERE to_person=? AND from_person != 'admin' AND from_person != 'coash' AND ind_noti = 0");
$stmt->execute(array($_SESSION['ind_username']));
$alldatamsg = $stmt->fetchAll();
$new_count_chat = $stmt->rowCount();
if ($new_count_chat > 0) {
    $message = "لديك رسالة جديدة";
}
////////////////////////////////////////////////////////////////////
// message from admin 
$stmt = $connect->prepare("SELECT DISTINCT from_person,to_person FROM chat WHERE to_person=? AND from_person = 'admin' AND ind_noti=0");
$stmt->execute(array($_SESSION['ind_username']));
$alldatamsgentiqa = $stmt->fetchAll();
$new_count_entiqa_message = $stmt->rowCount();
if ($new_count_entiqa_message > 0) {
    $message = "  لديك رسالة جديدة منصة انتقاء   ";
}
////////////////////////////////////////////////////////////////////
// message from coash
$stmt = $connect->prepare("SELECT DISTINCT from_person,to_person,coash_id FROM chat WHERE to_person=? AND from_person = 'coash' AND ind_noti=0 AND send_type='coash'");
$stmt->execute(array($_SESSION['ind_username']));
$alldatamsgcoash = $stmt->fetchAll();
$new_count_coash_message = $stmt->rowCount();
if ($new_count_coash_message > 0) {
    $message = "  لديك رسالة جديدة من المدرب    ";
}
