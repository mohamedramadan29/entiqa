<?php
$old_count = 0;
$i = 0;
$message = "";
//////////////////////////////// المقابلات الشخصية ///////////////////////////////////////
$stmt = $connect->prepare("SELECT * FROM interview_notificaion WHERE noti_person_link=? AND update_at=0");
$stmt->execute(array($_SESSION['ind_id']));
$alldatainterview = $stmt->fetchAll();
$interview_noti_count = $stmt->rowCount();
if ($interview_noti_count > 0) {
    $message = "   لديك طلب مقابلة شخصية جديد  ";
}
/////////////////// START COMPELETE CONTRACT  /////////////////////////////////
$stmt = $connect->prepare("SELECT * FROM contract_complete WHERE ind_id=? AND update_at=0");
$stmt->execute(array($_SESSION['ind_id']));
$alldatacompele_contract = $stmt->fetchAll();
$compelete_contract_noti_count = $stmt->rowCount();
if ($compelete_contract_noti_count > 0) {
    $message = "  رااائع !! تم اتمام التعاقد .. ";
}

////////////////////////////  Register in New Batches   ////////////////
$stmt = $connect->prepare("SELECT * FROM batches_notification WHERE ind = ? AND status = 0");
$stmt->execute(array($_SESSION['ind_id']));
$allbatchnoti = $stmt->fetch();
$batch_noti = $stmt->rowCount();
if ($batch_noti > 0) {
}

//////////////// تغير حالة المتدرب الي مؤهل او افضل المؤهلين او مؤهلين تم تو ظيفهم ///  
$stmt = $connect->prepare("SELECT * FROM change_status_notification WHERE ind_id = ? AND status_show = 0");
$stmt->execute(array($_SESSION['ind_id']));
$ind_status = $stmt->fetch();
$ind_status_count = $stmt->rowCount();
if ($ind_status_count > 0) {
    $message = " تم تغير الحالة الخاصة بك الي  ";
}

// get ind batch_id
$stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id=?");
$stmt->execute(array($_SESSION['ind_id']));
$ind_data = $stmt->fetch();
$batch_id = $ind_data['ind_batch'];

// check if has exam in this day
// $date_now = date("Y-m-d");
// $stmt = $connect->prepare("SELECT * FROM exam WHERE ex_batch_num=? AND ex_date_publish=?");
// $stmt->execute(array($batch_id, $date_now));
// $allexam = $stmt->fetchAll();
// $exam_data = $stmt->fetch();
// if ($allexam > 0) {
//     $exam_count = 0;
//     foreach ($allexam as $exam) {
//         $exam_type = $exam['ex_type'];
//         // check if it examination or not 
//         $stmt = $connect->prepare("SELECT * FROM question_answer WHERE user_id =? AND exam_id = ?");
//         $stmt->execute(array($_SESSION['ind_id'], $exam['ex_id']));
//         $alluserexam = $stmt->fetchAll();
//         $countexam = $stmt->rowCount();
//         if ($countexam > 0) {
//             $exam_count = 0;
//         } else {
//             $exam_count = 1;
//         }
//     }
// }
$stmt = $connect->prepare("SELECT * FROM exam_noti WHERE ind_id = ? AND status = 0 ");
$stmt->execute(array($_SESSION['ind_id']));
$allexamnoti = $stmt->fetchAll();
$countexamnoti = $stmt->rowCount();
if ($countexamnoti > 0) {
    $exam_count2 = 1;
    foreach ($allexamnoti as $examnoti) {
        $stmt = $connect->prepare("SELECT * FROM exam WHERE ex_id=?");
        $stmt->execute(array($examnoti['ex_id']));
        //$allexam = $stmt->fetchAll();
        $exam_data = $stmt->fetch();
        $exam_type = $exam_data['ex_type'];
    }
}
// تغير حالة المتدرب سواء كان متاهل او افضل المؤهلين او تم التعين 
$stmt = $connect->prepare("SELECT * FROM ind_congrat WHERE ind_id = ? AND status = 0 ");
$stmt->execute(array($_SESSION['ind_id']));
$congrate_status = $stmt->fetch();
$congrate_status_count = $stmt->rowCount();
if ($congrate_status_count > 0) {
    $message = " تم تأهيلك  ";
}


$stmt = $connect->prepare("SELECT * FROM contract_cancel WHERE ind_id=? AND sender !=? AND update_at=0");
$stmt->execute(array($_SESSION['ind_id'], $_SESSION['ind_id']));
$end_contract_noti_count = $stmt->rowCount();
$alldataend_contract = $stmt->fetchAll();

if ($end_contract_noti_count > 0) {
    $message = "لديك طلب الغاء اتفاق  ";
}
