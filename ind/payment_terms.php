<?php
$pagetitle = ' مشاهدة العقد واتمام الدفع  ';
ob_start();
session_start();
$ind_navabar = 'ind';
include 'init.php'; ?>
<div class="contact_hero" style="background-image: url(../images/privacy.png);">
    <div class="overlay" style="background-color: rgba(0, 0, 0, 0.4);">
        <div class="container">
            <div class="data">
                <h2> مشاهدة العقد واتمام الدفع </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"> مشاهدة العقد واتمام الدفع </li>
                        <li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="privacy">
    <div class="container-fluid">
        <div class="data">
    <p> أنت تعقد هذه الاتفاقية مع منصة إنتقاء للتوظيف  </p>
    <p> فأنت تقر وتوافق على بنود الشروط والسياسة التي تعتبر جزءًا لا يتجزأ من هذا العقد ومتممًا ومكملاً له. </p>
    <p> اعلم وأوافق على استخدام المنصة في سبيل التدريب في مجال مبيعات وعرض سيرتي الذاتيه وبيانات التواصل في سبيل البحث عن فرص تفاوض من الشركات </p>
    <p> اعلم بان تكلفة التسجيل في المنصة شامل التدريب هو 750 ريال. </p>
    <p> اعلم بان المنصة مسؤولة فقط لاستعراض بياناتي للشركات ولا تملك ضمانات للوظيفة   </p>
    <p> أعلم ان نسبة اجتياز الورشة التدريبيه هي 80٪ </p>
    <p> اعلم واقر بشروط وسياسة الاسترجاع المذكورة في الشروط والسياسة . </p>
    <p> اتعهد بالالتزام للحضور للورشة التدريبية وان المنصة غير مسؤولة عن غياب الحضور وبان نسبة الغياب تكلف -10% من النسبة الشاملة للاجتياز . </p>
            <br>
            <a href="payment/payment" class='btn btn-primary text-center' style='background: var(--main-color);border-color: var(--main-color);margin: auto;display: block;max-width: 250px;'> الموافقه وشحن الرصيد <i class='fa fa-paypal'></i></a>
        </div>
    </div>
</div>

<!-- END TESTMONAILS -->
<?php

include $tem . "footer.php";


?>