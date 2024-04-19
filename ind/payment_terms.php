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
            <p> أنت تعقد هذه الاتفاقية مع منصة إنتقاء للتوظيف </p>
            <p>فأنت تقر وتوافق على بنود الشروط والسياسة التي تعتبر جزءًا لا يتجزأ من هذا العقد ومتممًا ومكملاً له</p>
            <p> أعلم بان يحق للمنصة بتقييمي في المبيعات قبل تفعيل العضوية و أنني سوف أنضم للورشة التعليمية في حال لا أملك الخبرة والمهارة الكافية في المبيعات . </p>
            <p> اعلم وأوافق انا كمحترف في المبيعات على استخدام المنصة في سبيل عرض سيرتي الذاتيه وبيانات التواصل في مجال المبيعات للبحث عن فرص التفاوض من الشركات </p>
            <p> اعلم بان المنصة مسؤولة فقط لاستعراض بياناتي للشركات ولا تملك ضمانات للوظيفة </p>
            <p> أعلم بان الشركات ملزمة بالتواصل معي عبر الرسائل داخل المنصة </p>
            <p> وفي حال عدم التواصل من خلال المنصة فأني ملزم بالأبلاغ مع فريق الخدمة عبر الايميل
                او بالاتصال على فريق الخدمة 0597319189 support@entiqa.co
            </p>
            <p> وانا أعلم في حال عدم الإبلاغ فإن المنصة تخلي مسؤوليتها لحدوث أي ضرر نتائج اتفاق خارج المنصة .   </p>
            <p> أنا أتعهد بدفع رسوم التوظيف في حال تم التوظيف من خلال المنصة وقدرها 1150 ريال شامل الضريبة خلال أول شهر من بدء الوظيفة وهي مرة واحدة فقط تستحقها المنصة وأعلم أنها غير قابلة للأسترداد. </p>
            <p> أعلم بأن تكلفة تنشيط العضوية لأول مرة هي 15 ريال لأتمام الانضمام للمنصة . </p>
            <br>
            <a href="payment/payment" class='btn btn-primary text-center' style='background: var(--main-color);border-color: var(--main-color);margin: auto;display: block;max-width: 250px;'> الموافقه وشحن الرصيد <i class='fa fa-paypal'></i></a>
        </div>
    </div>
</div>

<!-- END TESTMONAILS -->
<?php

include $tem . "footer.php";


?>