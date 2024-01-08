<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $formerror = [];
    $sub_id = sanitizeInput($_POST['sub_id']);
    $ind_subscribe = sanitizeInput($_POST['ind_subscribe']);
    $company_subscribe = sanitizeInput($_POST['company_subscribe']);


    if (empty($ind_subscribe) || empty($company_subscribe)) {
        $formerror[] = 'من فضلك ادخل المعلومات كاملة';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE subscribe SET ind_subscribe=?,company_subscribe=?");
        $stmt->execute([$ind_subscribe, $company_subscribe]);
        if ($stmt) {
?>
            <div class="container">
                <div class="alert-success">
                    تم التعديل بنجاح
                    <?php
                    $_SESSION['success_message'] = " تم التعديل بنجاح  ";
                    header("Location:main.php?dir=subscribe_payment&page=report");

                    ?>
                </div>
            </div>
<?php }
    } else {
        foreach ($formerror as $errors) {
            $_SESSION['error_messages'] = $formerror;

            echo "<div class='alert alert-danger danger_message'>" .
                $errors .
                '</div>';
        }
        header("Location:main.php?dir=subscribe_payment&page=report");
    }
}
