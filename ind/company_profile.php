<?php

ob_start();
session_start();
$pagetitle = ' معلومات الشركة  ';
$ind_navabar = 'ind';
if (isset($_GET['com_username'])) {
    $com_username = $_GET['com_username'];
    $price_amount = 100;
    include 'init.php'; ?>

    <?php
    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_username=?");
    $stmt->execute(array($com_username));
    $com_data = $stmt->fetch();


    $stmt = $connect->prepare("UPDATE contract_complete SET update_at=? WHERE 
    ind_id=? AND company_id=?");
    $stmt->execute(array(date('y-m-d'), $_SESSION['ind_id'], $com_data['com_id']));

    /* Cancel Contract  */

    $stmt = $connect->prepare("UPDATE contract_cancel SET update_at=? WHERE 
    ind_id=? AND company_id=?");
    $stmt->execute(array(date('y-m-d'), $_SESSION['ind_id'], $com_data['com_id']));
    ?>
    <br>
    <br>
    <br>
    <div class="profile_data">
        <div class="container-fluid">
            <div class="data">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="info">
                            <div class="info_header">
                                <h2 class="text-right"> معلومات الشركة </h2>
                            </div>
                            <div class="info_data">
                                <div class="data1">
                                    <h4> نبذة عن الشركه </h4>
                                    <p>
                                        <?php
                                        if (!empty($com_data['com_info'])) {
                                            echo $com_data['com_info'];
                                        } else { ?>

                                        <div class="alert alert-info" role="alert"> لا يوجد نبذة مختصرة عن الشركة</div>
                                        <?php
                                        }
                                        ?>
                                    </p>

                                </div>
                                <div class="data2">
                                    <h4> معلومات عن الشركه </h4>
                                    <br>
                                    <table class="table ">
                                        <tr>
                                            <th> اسم الشركه بالعربي</th>
                                            <th>
                                                <?php echo $com_data['com_name']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>اسم الشركه باللغه الانجليزية</th>
                                            <th>
                                                <?php echo $com_data['com_name_en']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>رقم السجل التجاري</th>
                                            <th>
                                                <?php echo $com_data['com_num']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>نشاط الشركه</th>
                                            <th>
                                                <?php echo $com_data['com_active']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> مقر الشركه الرئيسي </th>
                                            <th>
                                                <?php echo $com_data['com_place']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> أفرعها </th>
                                            <th>
                                                <?php echo $com_data['com_braches']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> سنة التأسيس </th>
                                            <th>
                                                <?php echo $com_data['com_founded']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> نوع العمل ميداني / مكتبي </th>
                                            <th>
                                                <?php echo $com_data['com_work_type']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> الراتب المقدر </th>
                                            <th>
                                                <?php echo $com_data['com_salary']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> العمولة المقدرة </th>
                                            <th>
                                                <?php echo $com_data['com_commission']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> أوقات ساعات العمل</th>
                                            <th>
                                                <?php echo $com_data['com_work_h']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> عدد الشفتات</th>
                                            <th>
                                                <?php echo $com_data['com_work_libs']; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> عدد أيام الأجازة الأسبوعية </th>
                                            <th>
                                                <?php echo $com_data['com_weekend_num']; ?>
                                            </th>


                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

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


?>

<script
    src="https://www.paypal.com/sdk/js?client-id=Aa6xGlT7CdEYFS463meNhvyq6Tovq_rlYBK0U2pEMalXKRMy-1GxSFwAd6_UrMFQkaYxQRn-Dop6Gk61&currency=USD"></script>
<script>
    paypal.Buttons({

        onClick() {
            var price = $("#price").val();
        },
        onCancel: function (data) {
            alert(" لم تكتمل عملية الدفع");

        },
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= $price_amount; ?>' // Can also reference a variable or function
                    }
                }]
            });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
            return actions.order.capture().then(function (orderData) {
                // Successful capture! For dev/demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                var price = $("#price").val();
                var data = {
                    'price': price,
                    'payment_mode': 'pay with paypal',
                    'transaction_id': transaction.id
                }
                $.ajax({
                    method: "POST",
                    url: "charge_balance.php",
                    data: data,
                    datatype: "datatype",
                    success: function (response) {

                        actions.redirect('http://localhost/entiqa/company/thank-you.php');


                    }
                });
            });
        }
    }).render('#paypal-button-container');
</script>