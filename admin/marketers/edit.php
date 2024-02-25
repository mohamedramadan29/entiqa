<?php

if (isset($_SESSION['admin_session'])) {


    require '../ind/mail/vendor/autoload.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $formerror = [];
        $marketer_id = $_POST['marketer_id'];
        $name = sanitizeInput($_POST['name']);
        $code = sanitizeInput($_POST['code']);


        if (empty($name) || empty($code)) {
            $formerror[] = 'من فضلك ادخل المعلومات كاملة';
        }
        if (strlen($code) < 3) {
            $formerror[] = 'كود المسوق يجب ان يكون اكثر من ٣ ارقام';
        }

        $stmt = $connect->prepare("SELECT * FROM marketers WHERE name=? AND id !=?");
        $stmt->execute(array($name, $marketer_id));
        $name_count = $stmt->rowCount();
        if ($name_count > 0) {
            $formerror[] = ' اسم المسوق موجود من قبل  ';
        }
        $stmt = $connect->prepare("SELECT * FROM marketers WHERE code=? AND id !=?");
        $stmt->execute(array($code, $marketer_id));
        $code_count_ind = $stmt->rowCount();
        if ($code_count_ind > 0) {
            $formerror[] = ' هذا الكود موجود من قبل  ';
        }
        if (empty($formerror)) {
            $stmt = $connect->prepare("UPDATE marketers SET name=?,code=? WHERE id=?");
            $stmt->execute([$name, $code, $marketer_id]);
            if ($stmt) {
?>
                <div class="container">
                    <div class="alert-success">
                        تم تعديل المسوق بنجاح
                        <?php
                        $_SESSION['success_message'] = " تم التعديل بنجاح  ";
                        header("Location:main.php?dir=marketers&page=report");

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
            header("Location:main.php?dir=marketers&page=report");
        }
    }
} else {
    header("Location:index");
}
