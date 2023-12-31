<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = sanitizeInput($_POST['name']);
    $email =  sanitizeInput($_POST['email']);
    $formerror = [];
    if (empty($email)) {
        $formerror[] = 'من فضلك ادخل البريد الألكتروني';
    }
    if (!empty($_POST['password'])) {
        $password = sanitizeInput($_POST['password']);
        $confirm_password = sanitizeInput($_POST['confirm_password']);
        if (strlen($password) < 8) {
            $formerror[] = 'كلمة المرور يجب ان تكون اكبر من او تساوي 8 احرف وارقام';
        }
        if ($password !== $confirm_password) {
            $formerror[] = 'يجب تاكيد كلمة المرور بشكل صحيح ';
        }
    }
    // check if email or user_name is used 
    $stmt = $connect->prepare("SELECT * FROM service_team WHERE email = ? AND id !=?");
    $stmt->execute(array($email, $id));
    $count_mails = $stmt->rowCount();
    if ($count_mails > 0) {
        $formerror[] = 'البريد الألكتروني مستخدم من قبل من فضلك استخدم بريد الكتروني جديد';
    }
    // check if email or user_name is used 
    $stmt = $connect->prepare("SELECT * FROM service_team WHERE name = ? AND id !=?");
    $stmt->execute(array($name, $id));
    $count_mails = $stmt->rowCount();
    if ($count_mails > 0) {
        $formerror[] = ' اسم المستخدم موجود من قبل من فضلك ادخل اسم مستخدم جديد';
    }
    // check the email in the coashes members
    $stmt = $connect->prepare("SELECT * FROM coshes WHERE co_email=?");
    $stmt->execute(array($email));
    $count_coash_mail = $stmt->rowCount();
    if ($count_coash_mail > 0) {
        $formerror[] = 'البريد الألكتروني مستخدم بالفعل في قسم المدربين من فضلك اختر بريد الكتروني جديد ';
    }
    // check the user name in the coashes members
    $stmt = $connect->prepare("SELECT * FROM coshes WHERE co_name=?");
    $stmt->execute(array($name));
    $count_coash_mail = $stmt->rowCount();
    if ($count_coash_mail > 0) {
        $formerror[] = 'اسم المستخدم مستخدم بالفعل في قسم المدربين من فضلك اختر اسم جديد ';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE service_team SET name=?,email=? WHERE id=?");
        $stmt->execute([$name, $email, $id]);
        if (!empty($password)) {
            $stmt = $connect->prepare("UPDATE service_team SET password=? WHERE id=?");
            $stmt->execute([$password, $id]);
        }
        if ($stmt) { ?>
            <div class="container">
                <div class="alert-success">
                    تم تعديل المدرب بنجاح
                    <?php
                    header('Location:main.php?dir=service_team&page=report');
                    ?>
                </div>
            </div>
<?php }
    } else {
        foreach ($formerror as $errors) {
            echo "<div class='alert alert-danger danger_message'>" .
                $errors .
                '</div>';
        }
    }
}
