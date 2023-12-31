<!doctype html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login_form/fonts/icomoon/style.css">
    <link rel="stylesheet" href="login_form/css/owl.carousel.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="login_form/css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="login_form/css/style.css">
</head>

<body>
    <div class="d-md-flex half text-right">
        <div class="bg" style="background-image: url('login_form/images/bg_1.jpg');"></div>
        <div class="contents">
            <div class="container">
                <?php
                $pagetitle = 'Login To Company';
                ob_start();
                session_start();
                $Nonavbar = '';
                include 'init.php';
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['select_permision'] == 'admin') {
                    $name = $_POST['comname'];
                    $password = $_POST['password'];
                    $stmt = $connect->prepare(
                        'SELECT  * FROM admin WHERE (admin_name=? OR admin_email = ?) AND admin_password=? AND admin_prev = 1'
                    );
                    $stmt->execute([$name, $name, $password]);
                    $data = $stmt->fetch();
                    $admindata = $stmt->rowcount();
                    if ($admindata > 0) {
                        $_SESSION['admin_id'] = $data['admin_id'];
                        $_SESSION['admin_name'] = $data['admin_name'];
                        $_SESSION['admin_session'] = $data['admin_name'];
                        $_SESSION['token_compare'] = $data['session_token']; // inserted into db
                        

                        header('Location:main.php?dir=dashboard&page=dashboard');
                        exit();
                    } else {
                ?>
                        <div class="alert alert-danger"> لا يوجد سجل بهذة البيانات </div>
                    <?php
                    }
                } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['select_permision'] == 'services') {
                    $name = $_POST['comname'];
                    $password = $_POST['password'];
                    $stmt = $connect->prepare(
                        'SELECT  * FROM service_team WHERE (name=? OR email=?) AND password=?'
                    );
                    $stmt->execute([$name, $name, $password]);
                    $data = $stmt->fetch();
                    $admindata = $stmt->rowcount();
                    if ($admindata > 0) {
                        $_SESSION['admin_id'] = $data['admin_id'];
                        $_SESSION['admin_name'] = $data['name'];
                        $_SESSION['serv_name'] = $data['name'];
                        header('Location:main.php?dir=dashboard&page=serv_dashboard');
                        exit();
                    } else {
                    ?>
                        <div class="alert alert-danger"> لا يوجد سجل لخدمة العملاء بهذة البيانات </div>
                    <?php
                    }
                } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['select_permision'] == 'coash') {
                    $name = $_POST['comname'];
                    $password = $_POST['password'];
                    $stmt = $connect->prepare(
                        'SELECT  * FROM coshes WHERE (co_name=? OR co_email=?) AND co_password=?'
                    );
                    $stmt->execute([$name, $name, $password]);
                    $data = $stmt->fetch();
                    $admindata = $stmt->rowcount();
                    if ($admindata > 0) {
                        $_SESSION['coash_id'] = $data['co_id'];
                        $_SESSION['admin_name'] = $data['co_name'];
                        header('Location:main.php?dir=dashboard&page=coash_dashboard');
                        exit();
                    } else {
                    ?>
                        <div class="alert alert-danger"> لا يوجد سجل للمدربين بهذة البيانات </div>
                <?php
                    }
                } else {
                }
                ?>
                <div class="row align-items-center justify-content-center" style="margin-top: 5%;">
                    <div class="col-md-12">
                        <div class="form-block mx-auto">
                            <div class="text-center mb-5">
                                <h3 class="text-uppercase">لوحة الادمن<strong></strong></h3>
                            </div>
                            <form action="#" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="form-group first">
                                    <label for="username">اسم المستخدم او البريد الألكتروني</label>
                                    <input required name="comname" type="text" class="form-control" placeholder="  " id="username">
                                </div>
                                <div class="form-group last mb-3">
                                    <label for="password">كلمة المرور</label>
                                    <input required name="password" type="password" class="form-control" placeholder=" " id="password">
                                </div>
                                <div class="form-group last mb-3">
                                    <label for="password"> اختر الصلاحية </label>
                                    <select required name="select_permision" id="" class="form-control select2">
                                        <option value=""> -- اختر --</option>
                                        <option value="admin"> الادمن </option>
                                        <option value="services"> فريق الخدمة </option>
                                        <option value="coash"> المدرب </option>
                                    </select>
                                </div>
                                <div class="d-sm-flex mb-5 align-items-center">
                                    <label class="control mb-3 mb-sm-0"><span class="caption"> <a href="forget_password" style="text-decoration: none;"> نسيت كلمة المرور ؟ </a>
                                        </span>
                                    </label>
                                </div>
                                <input type="submit" value=" تسجيل دخول " class="btn btn-block py-2 btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="login_form/js/jquery-3.3.1.min.js"></script>
    <script src="login_form/js/popper.min.js"></script>
    <script src="login_form/js/bootstrap.min.js"></script>
    <script src="login_form/js/main.js"></script>
</body>

</html>

<?php

if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
}
if (isset($_SESSION['com_id'])) {
    unset($_SESSION['com_id']);
}
if (isset($_SESSION['coash_id'])) {
    unset($_SESSION['coash_id']);
}
if (isset($_SESSION['admin_session'])) {
    unset($_SESSION['admin_session']);
}
if (isset($_SESSION['serv_name'])) {
    unset($_SESSION['serv_name']);
}
session_destroy();

?>