<?php
$pagetitle = ' شكرا لك  ';
ob_start();
session_start();
$com_navbar = 'com';
include 'init.php'; ?>

<div class="thank_you">
    <div class="container">
        <div class="info">
            <h3>رائع !! لقد تم شحن رصيدك بنجاح </h3>
            <a href="company_profile.php" class="btn btn-success"> مشاهدة الرصيد </a>
        </div>
    </div>
</div>
<?php

include $tem . "footer.php";


?>