<?php
session_start();
include "../connect.php";
$stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
$stmt->execute(array($_SESSION['com_id']));
$com_info = $stmt->fetch();
$com_balance = $com_info['com_balance'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $com_id = $_SESSION['com_id'];
    $price = $_POST["price"] + $com_balance;
    $payment_mode = $_POST['payment_mode'];
    $trasnaction_id = $_POST['transaction_id'];
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE company_register SET transaction_id=?,payment_mode=?,com_balance=? WHERE com_id=?");
        $stmt->execute(
            array(
                $trasnaction_id,
                $payment_mode,
                $price,
                $com_id
            )
        );
        if ($stmt) {
            echo "201";
            ?>

            <!--<div class="alert alert-success">" تم ارسال طلبك بنجاح " </div>
            <br>
        -->
            <?php
        }
    } else {
        foreach ($formerror as $error) { ?>
            <div class="alert alert-danger">
                <?php echo $error; ?> <i class="fa fa-close"></i>
            </div>
            <?php

        }
    }
}
?>