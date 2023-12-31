<?php
include "../connect.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ind_username = $_POST["ind_username"];
    $ind_name = $_POST["ind_name"];
    $ind_birthdate = $_POST["ind_birthdate"];
    $ind_email = $_POST["ind_email"];
    $ind_phone = $_POST["ind_phone"];
    $ind_nationality = $_POST["ind_nationality"];
    $ind_address = $_POST["ind_address"];
    $ind_gender = $_POST["ind_gender"];
    $ind_transfer = $_POST["ind_transfer"];
    $ind_english = $_POST["ind_english"];
    $ind_password = $_POST["ind_password"];
    $payment_mode = $_POST['payment_mode'];
    $trasnaction_id = $_POST['transaction_id'];
    //$confirm_password = $_POST["confirm_password"];
    $formerror = [];
    if (empty($ind_username)) {
        $formerror[] = "  من فضلك ادخل الاسم الخاص بك ";
    }
    if (empty($ind_email)) {
        $formerror[] = " يجب اضافة البريد الالكتروني  ";
    }
    if (empty($ind_password)) {
        $formerror[] = " يجب اضافة  كلمة المرور    ";
    }
    if (strlen($ind_password) < 8) {
        $formerror[] = " كلمة المرور يجب ان تكون اكثر من 8 احرف وارقام ";
    }

    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_email=?");
    $stmt->execute(array($ind_email));
    $data = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
        $formerror[] = " البريد الالكتروني مستخدم بالفعل  ";
    }
    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_username=?");
    $stmt->execute(array($ind_username));
    $data = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
        $formerror[] = " اسم المستخدم موجود بالفعل ";
    }

    if (empty($formerror)) {
        $stmt = $connect->prepare("INSERT INTO ind_register
                (ind_username,ind_password,ind_name,
                ind_birthdate,ind_email,ind_phone,ind_nationality,ind_address,ind_gender,ind_transfer,
                ind_english,transaction_id,payment_mode) VALUES 
                (:zusername,:zpassword,:zname,:zbirthdate,
                :zemail,:zphone,:znationality,:zaddress,:zgender,:ztransfer,
                :zenglish,:ztransaction_id,:zpayment_mode)");
        $stmt->execute(
            array(
                "zusername" => $ind_username,
                "zpassword" => $ind_password,
                "zname" => $ind_name,
                "zbirthdate" => $ind_birthdate,
                "zemail" => $ind_email,
                "zphone" => $ind_phone,
                "znationality" => $ind_nationality,
                "zaddress" => $ind_address,
                "zgender" => $ind_gender,
                "ztransfer" => $ind_transfer,
                "zenglish" => $ind_english,
                "ztransaction_id" => $trasnaction_id,
                "zpayment_mode" => $payment_mode,
            )
        );
        if ($stmt) {
            echo "201";
        }
    } else {
    }
}