<?php
ob_start();
session_start();
$pagetitle = '  سحب الرصيد  ';
$com_navbar = 'com';
if (isset($_SESSION['com_id'])) {
    // $price_amount = 100;
    include 'init.php';

    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
    $stmt->execute(array($_SESSION['com_id']));
    $com_data = $stmt->fetch();
?>

    <div class="company_balance">
        <div class="container">
            <div class="data">
                <div class="info">
                    <h4> رصيد الحساب </h4>
                    <button class="btn btn-primary"> سحب الرصيد </button>
                </div>
                <div>
                    <div class="show_balance_info">
                        <h4>الرصيد الكلي </h4>
                        <p> (دولار) <?php echo $com_data['com_balance']; ?> </p>
                    </div>
                </div>
                <div class="balance_form">
                    <form class="login" action="" method="POST" enctype="multipart/form-data">
                        <div class="box">
                            <label for="">(اقل مبلغ سحب 20 دولار) مبلغ السحب </label>
                            <input required min="20" type="number" class="form-control" name="withdraw_price">

                        </div>
                        <div class="box">
                            <label for=""> وسيلة السحب </label>
                            <select required name="method_withdrow" class="form-control select" id="com_work_type">
                                <option value=""> -- اختر وسيلة الدفع -- </option>
                                <option value="باي بال"> باي بال </option>
                            </select>
                        </div>
                        <div class="box">
                            <label for=""> ادخل البريد الالكتروني </label>
                            <input required type="email" class="form-control" name="balance_email">
                        </div>
                        <div class="box">
                            <div class="submit_button">
                                <button class="button button-size-1 button-block button-primary" type="submit" name="request_withdraw">سحب الرصيد</button>
                            </div>
                        </div>
                    </form>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['request_withdraw'])) {
                            $company_balance =  $com_data['com_balance'];
                            $withdraw_price = $_POST['withdraw_price'];
                            $with_method = $_POST['method_withdrow'];
                            $balance_email = $_POST['balance_email'];
                            if (empty($withdraw_price)) {
                                $formerror[] = 'من فضلك ادخل المبلغ المطلوب';
                            }
                            if ($withdraw_price < 20) {
                                $formerror[] = '    اقل مبلغ للحسب هو 20 دولار      ';
                            }
                            if (empty($balance_email)) {
                                $formerror[] = 'من فضلك ادخل البريد الالكتروني';
                            }
                            if (empty($with_method)) {
                                $formerror[] = 'من فضلك ادخل وسيلة السحب';
                            }

                            $formerror = [];

                            if ($withdraw_price > $company_balance) {
                                $formerror[] = " '$company_balance' رصيدك لا يسمح من فضلك ادخل رقم يساوي او اقل من ";
                            }
                            if (empty($formerror)) {
                                $stmt = $connect->prepare("INSERT INTO withdraw 
                                (com_id,with_method,with_price,with_email) VALUES
                                (:zcom_id,:zwith_method,:zwith_price,:zwith_email)");
                                $stmt->execute(array(
                                    'zcom_id' => $_SESSION['com_id'],
                                    'zwith_method' => $with_method,
                                    'zwith_price' => $withdraw_price,
                                    'zwith_email' => $balance_email,
                                ));
                                if ($stmt) {
                    ?>
                                    <div class="alert alert-success"> تم طلب السحب بنجاح </div>
                                <?php
                                    $new_balance = $com_data['com_balance'] - $_POST['withdraw_price'];
                                    $stmt = $connect->prepare("UPDATE company_register SET com_balance=?");
                                    $stmt->execute(array($new_balance));

                                    header('refresh:2;url:balance.php');
                                }
                            } else {
                                foreach ($formerror as $error) { ?>
                                    <div class="alert alert-danger"> <?php echo $error; ?> </div>
                    <?php
                                }
                            }
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
<?php

    include $tem . "footer.php";
} else {
    header('Location:../index.php');
    exit();
}
