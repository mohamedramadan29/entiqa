<div class="section section-md contact_us login_page" style='background-color:#f1f1f1'>
    <div class="container">
        <?php
        ob_start();
        session_start();
        $pagetitle = '  حسابي  ';
        include '../../connect.php';
        if (isset($_GET['id']) && isset($_GET['pending']) && isset($_GET['success']) && isset($_GET['order'])) {
            $transaction_id = $_GET['id'];
            $pending = $_GET['pending'];
            $success = $_GET['success'];
            $order_id = $_GET['order'];
            $hmac = $_GET['hmac'];

            if ($pending == 'false' && $success == 'true') {
                $stmt = $connect->prepare("SELECT * FROM subscribe LIMIT 1");
                $stmt->execute();
                $sub_data = $stmt->fetch();
                $ind_sub_amount = $sub_data['company_subscribe'];
                $com_id = $_SESSION['com_id'];
                $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
                $stmt->execute(array($_SESSION['com_id']));
                $com_info = $stmt->fetch();
                $com_balance = $com_info['com_balance'];

                $price = $ind_sub_amount + $com_balance;
                $stmt = $connect->prepare("UPDATE company_register SET com_balance=? , order_id = ?,transaction_id = ? WHERE com_id=?");
                $stmt->execute(
                    array(
                        $price,$order_id, $transaction_id,$com_id
                    )
                );
                $_SESSION['suucess_paymob'] = ' تم الدفع والاشتراك بنجاح في منصة انتقاء  ';
        ?>
                <div class='alert alert-success'> تم الدفع والاشتراك بنجاح في منصة انتقاء </div>
            <?php
                //header("refresh:2;URL=../profile");
                header("Location:../profile");
            } else {
                $_SESSION['failed_paymob'] = 'لم تتم عملية الدفع بنجاح من فضلك حاول في وقت لاحق ';
            ?>
                <div class='alert alert-danger'> لم تتم عملية الدفع بنجاح من فضلك حاول في وقت لاحق </div>
        <?php
                //header("refresh:2;URL=../profile");
                header("Location:../profile");
            }
        }

        ?>
    </div>
</div>