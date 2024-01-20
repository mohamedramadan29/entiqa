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
    // check if email or user_name is used in individual
    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_email = ?");
    $stmt->execute(array($email));
    $count_ind_mails = $stmt->rowCount();
    if ($count_ind_mails > 0) {
        $formerror[] = 'البريد الألكتروني مستخدم بالفعل في قسم المتدربين من فضلك اختر بريد الكتروني جديد ';
    }

    // check if email or user_name is used in company
    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_email = ?");
    $stmt->execute(array($email));
    $count_com_mails = $stmt->rowCount();
    if ($count_com_mails > 0) {
        $formerror[] = 'البريد الألكتروني مستخدم بالفعل في قسم الشركات من فضلك اختر بريد الكتروني جديد ';
    }
    // check the user name in the coashes members
    $stmt = $connect->prepare("SELECT * FROM coshes WHERE co_name=?");
    $stmt->execute(array($name));
    $count_coash_mail = $stmt->rowCount();
    if ($count_coash_mail > 0) {
        $formerror[] = 'اسم المستخدم مستخدم بالفعل في قسم المدربين من فضلك اختر اسم جديد ';
    }

    if (strlen($name) > 50) {
        $formerror[] = 'اسم المستخدم يجب ان يكون اقل من 50 حرف';
    }
    if (!preg_match('/^[a-zA-Z]+$/', $name)) {
        $formerror[] = ' يجب ان تكون الحروف المستخدمة فى اسم المستخدم حروف انجليزية فقط ';
    }

    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE service_team SET name=?,email=? WHERE id=?");
        $stmt->execute([$name, $email, $id]);
        if (!empty($password)) {
            $stmt = $connect->prepare("UPDATE service_team SET password=? WHERE id=?");
            $stmt->execute([$password, $id]);
        }
        if ($stmt) {
            $_SESSION['success_message'] = " تم التعديل بنجاح  ";
?>
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
            $_SESSION['error_messages'] = $formerror;
            echo "<div class='alert alert-danger danger_message'>" .
                $errors .
                '</div>';
        }
    }
}
?>

<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page"> تعديل العضو </li>
                </ol>
            </nav>
        </div>
        <?php
        $member_id = $_GET['member'];
        $stmt = $connect->prepare('SELECT * FROM service_team WHERE id = ?');
        $stmt->execute(array($member_id));
        $type = $stmt->fetch();
        ?>
        <div class="card">
            <div class="card-body">
                <div class="myform">
                    <form class="form-group insert ajax_form" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $type['id'] ?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="box2">
                                    <label id="name"> الاسم
                                        <span> * </span> </label>
                                    <input required minlength="5" maxlength="50" class="form-control" type="text" name="name" value="<?php echo $type['name']; ?>">
                                </div>
                                <div class="box2 show_hide_password">
                                    <label id="name"> كلمه المرور القديمه
                                        <span> * </span> </label>
                                    <input class="form-control" type="password" name="password" value="<?php echo $type['password']; ?>" id="password<?php echo $type['id'] ?>">
                                    <span onclick="togglePasswordVisibility('password<?php echo $type['id'] ?>', this)" class="fa fa-eye-slash show_eye eye_icon"></span>
                                </div>
                                <div class="box2 show_hide_password">
                                    <label id="name"> تعديل كلمة المرور
                                        <span> * </span> </label>
                                    <input class="form-control" type="password" name="password" value="" id="passwordedit1">
                                    <span onclick="togglePasswordVisibility('passwordedit1', this)" class="fa fa-eye-slash show_eye eye_icon"></span>
                                </div>
                                <div class="box2">
                                    <label id="name_en"> البريد الالكتروني <span> * </span></label>
                                    <input required class="form-control" type="email" name="email" value=" <?php echo $type['email']; ?>">
                                </div>
                                <div class="box2 show_hide_password">
                                    <label id="name"> تأكيد كلمة المرور
                                        <span> * </span> </label>
                                    <input class="form-control" type="password" name="confirm_password" value="" id="passwordedit2">
                                    <span onclick="togglePasswordVisibility('passwordedit2', this)" class="fa fa-eye-slash show_eye eye_icon"></span>
                                </div>
                            </div>

                        </div>

                </div>
                <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value="تعديل">
                </form>
            </div>
        </div>


        <!-- END RECORD TO EDIT NEW RECORD  -->


    </div>
</div>
</div>
</div>