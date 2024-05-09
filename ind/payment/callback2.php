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

            // echo "id" . $id;
            // echo "</br>";
            // echo "pending" . $pending;
            // echo "</br>";
            // echo "success" . $success;
            // echo "</br>";
            // echo "order" . $order;
            // echo "</br>";
            // echo "hmac" . $hmac;
            // echo "</br>";

            if ($pending == 'false' && $success == 'true') {
                $ind_id = $_SESSION['ind_id'];
                $stmt = $connect->prepare("UPDATE ind_register SET ind_payment_charge = 'CAPTURED',order_id = ?,transaction_id = ? WHERE ind_id=?");
                $stmt->execute(array($order_id, $transaction_id, $ind_id));
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