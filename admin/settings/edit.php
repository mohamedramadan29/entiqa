<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formerror = [];
    $admin_id = $_POST['admin_id'];
    $admin_email = sanitizeInput($_POST['admin_email']);
    $admin_name = sanitizeInput($_POST['admin_name']);
    if (!empty(sanitizeInput($_POST['admin_password']))) {
        $password = sanitizeInput($_POST['admin_password']);
        $confirm_password = sanitizeInput($_POST['confirm_password']);
        if (strlen($password) < 8) {
            $formerror[] = 'كلمة المرور يجب ان تكون اكبر من او تساوي 8 احرف وارقام';
        }
        if ($password !== $confirm_password) {
            $formerror[] = 'يجب تاكيد كلمة المرور بشكل صحيح ';
        }
    }
    if (empty($admin_email)) {
        $formerror[] = 'يجب ادخال البريد الألكتروني';
    } elseif (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
        $formerror[] = " يجب إدخال عنوان بريد إلكتروني صالح ";
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE admin SET admin_name=?,admin_email=? WHERE admin_id=?");
        $stmt->execute([$admin_name, $admin_email, $admin_id]);
        if (!empty($password)) {
            $stmt = $connect->prepare("UPDATE admin SET admin_password=? WHERE admin_id=?");
            $stmt->execute([$password, $admin_id]);
        }
        if ($stmt) {
            $newSessionToken = generateNewSessionToken();
            $stmt = $connect->prepare("UPDATE admin SET session_token = ? WHERE admin_id = ?");
            $stmt->execute(array($newSessionToken, $admin_id));
            $_SESSION['new_pass'] = $newSessionToken;
?>
            <div class="container">
                <div class="alert-success">
                    تم تعديل القسم بنجاح
                    <?php
                    header('LOCATION:main.php?dir=settings&page=report');
                    ?>
                </div>
            </div>
<?php }
    } else {
        foreach ($formerror as $error) {
            echo "<div class='alert alert-danger danger_message'>" .
                $error .
                '</div>';
        }
    }
}
