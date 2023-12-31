<?php
$pagetitle = 'تواصل معنا';
ob_start();
session_start();
$ind_navabar = 'ind';
include 'init.php'; ?>

<div class="thank_you">
    <div class="container">
        <div class="info">
            <h3>رائع !! لقد تم تسجيلك بنجاح علي منصة انتقاء  </h3>
            <p> يمكنك تسجيل الدخول الان  </p>
            <a href="ind_login.php" class="btn btn-success"> تسجيل دخول </a>
        </div>
    </div>
</div>
<?php

include $tem . "footer.php";


?>
