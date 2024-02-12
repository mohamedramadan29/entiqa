<?php
$pagetitle = '  الرئيسية - الشركات   ';
ob_start();
session_start();
$com_navbar = 'com';
include 'init.php'; ?>
<div class="contact_hero ind_heroo company_index" style="background-image: url(../images/header_index2.jpg);">
    <div class="overlay" style="background-color: rgba(0, 0, 0, 0.1);">
        <div class="container">
            <div class="data">
                <h2 style="margin-bottom: 0;"> انتقاء </h2>
                <!--
                <p style="text-align: center; color:#F3F3F3;font-size: 20px;"> "فريق المبيعات الخاص بك يمكنه أن ينجح في
                    عملك أو يفسده. ثق في </br> انتقاء لمساعدتك على الاختيار بحكمة." </p>
-->
                <?php
                if (!isset($_SESSION['com_id'])) { ?>
                    <a href="stars" class="btn btn-primary" style="background-color: var(--main-color);border-color: var(--main-color); border-radius: 40px;" type="button"> اختر
                        فريقك </a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Download Our Tax Guide App-->
<section class="about_us company_index_about_us">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="">
                    <h2> من نحن </h2>
                    <p>
                        منصة انتقائية متخصصة في التدريب والترشيح في مجال المبيعات، نستهدف الشركات و الأفراد المتدربين والمحترفين لاختيار أفضل الفرص المتاحة والمناسبة للطرفين، نقوم بجذب الأفراد المهتمين والقادرين على الممارسة والعمل في مجال المبيعات ومساعدة الشركات على الاستقطاب الأفضل ..

                    </p>
                </div>
            </div>
            <div class="col-md-6 video_about_us">
                <div class="video-popup-content" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span> <i class="fa fa-play-circle"></i> </span>
                    <!-- 
                    <video style="border-radius:20px" id="video-frame" width="100%" height="100%" src="../uploads/entiqa.mp4" frameborder="0" controls></video>   -->
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="plyr__video-embed" id="player">
                                <iframe data-poster="uploads/poster.webp" src="https://www.youtube.com/watch?v=UEEzObfQm_0" allowfullscreen allowtransparency allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Start Berfect Employess  -->
<div class="berfect_employess">
    <div class="container">
        <div class="data">
            <h4> أحصل على البائعين </h4>
            <p>
                أحصل على أفضل موظفي المبيعات المحترفين مع إنتقاء عبر منصتنا فأنتقاء هي الطريقة السلسة للتفاوض مع الأفضل نحن نقدم لك المحترفين و المتدربين على مهارات البيع الحديث وفق أسس ومناهج عملية احترافية لنكون لك عوناً ونساعدك في تحقيق أهدافك بأفضل الطرق.
            </p>
        </div>
    </div>
</div>
<!-- End Berfect Employess   -->
<!-- Start Pick The Best  -->
<!-- <div class="the_best">
    <div class="container">
        <div class="data">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="img_info">

                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="info">
                        <h4> إنتقاء .. انتقي الأفضل </h4>
                        <p> نعمل لنكون جسراً يصل بين الأفراد والشركات من خلال ترشيح متدربينا لمختلف الشركات التي ترغب برفد كوادرها بموظفي مبيعات محترفين، وبالتالي تحقيق المنفعة لكلا الطرفين. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- End Bick The Best   -->
<!-- Start Why Entiqaa  -->
<!-- <div class="berfect_employess">
    <div class="container">
        <div class="data">
            <h4> لماذا إنتقاء ؟ </h4>
            <p> تضم انتقاء فريقاً محترفاً من المدربين ذوي الخبرة الواسعة الذين يتمتعون بمعرفة عميقة في مجال المبيعات وتطوير الأعمال <br> لنوفر لعملائنا تدريبات على مستوى عالٍ من الاحترافية والاتقان. </p>
            <p>
                كما نعمل على مد يد العون للشركات وتخليص أصحابها من عناء البحث عن موظفي مبيعات محترفين من خلال ترشيح خيرة متدربينا <br> لهم ليتسنى لهم انتقاء الأفضل والأنسب للمنصب الوظيفي المتوفر في شركاتهم.
            </p>
        </div>
    </div>
</div> -->
<!-- End why Entiqaa   -->
<!-- START NEW TESTMONAILS  -->
<?php
$stmt = $connect->prepare('SELECT * FROM company_review 
INNER JOIN company_register ON company_review.com_id = company_register.com_id WHERE rev_show = 1 ORDER BY rev_id DESC ');
$stmt->execute();
$allrev = $stmt->fetchAll();
$count_rev = $stmt->rowCount();
if ($count_rev > 0) {
?>
    <div class="testmonails company_testmonails">
        <div class='overlay'>
            <div class="container">
                <div class="data">
                    <h3> اراء عملائنا </h3>
                    <!-- Swiper -->
                    <div class="testmon">
                        <?php
                        foreach ($allrev as $rev) {
                        ?>
                            <div class="person_testmon">
                                <div class="card">
                                    <img src="images/image1.jpg" alt="" srcset="">
                                    <div class="info" style="display: flex; justify-content: space-between;align-items: center;">
                                        <div class="info1" style="display: flex; justify-content: flex-start;">
                                            <div>
                                                <img src="../images/com (1).png" style="width: 70px; height:70px" alt="">
                                            </div>
                                            <div>
                                                <h4 style="color: #111;font-size: 18px;"> <?php echo $rev['com_name']; ?></h4>
                                                <p style="color: #F16583;font-size: 14px;margin-top:0;"> <?php echo $rev['com_active']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-text" style=" width: 100%; word-wrap: break-word;">
                                        <p style="word-break: break-word;"> <?php echo $rev['com_review'] ?> </p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}

?>

<!-- END NEW TESTMONAILS -->
<!-- START FAQ SECTION -->
<div class="faq_section faq_question_company">
    <div class="container">
        <h2 class="text-center">
            الأسئلة الشائعة للشركات
        </h2>
        <div class="data">
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل استطيع اختيار اكثر من متدرب ؟ </a>
                    <div class="content">
                        <p> لا يوجد عدد معين تستطيع إنتقاء فريقك بالكامل.
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> كم قيمة الرسوم للحصول على خدماتكم ؟ </a>
                    <div class="content">
                        <p>
                            2650 ريال لكل مرشح يتم انتقائه و أختياره .

                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> كيف هي ضمانة خدماتكم ؟ </a>
                    <div class="content">
                        <p> إنتقاء هي حلقة وصل للطرفين نقدم لك مرشحين في مجال مبيعات بمختلف الخبرات تم انتقائهم وتقييمهم وترشيحهم , بأمكانك التواصل مع المرشح الأمثل لك حسب المعايير المطلوبة .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> كيف هو تقييمكم للمتدربين وتدريبهم ؟ </a>
                    <div class="content">
                        <p>
                            للمحترفين
                            - يتم التأكد من خبراتهم ومؤهلاتهم و تقييمهم مع الخبراء .
                            وللمبتدأين
                            - يتم انتقاء الموهوبين منهم و الراغبين بشغف التعليم في المبيعات ومن ثم نبدأ بتدريبهم مع خبراء , ومدة دراستهم من 40 دقيقة الى 60 دقيقة لمدة 3 اسابيع مع تقييم الأداء وأختبارهم .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل تستطيع الشركات خارج السعودية ان تستفيد من هذه الخدمة ؟ </a>
                    <div class="content">
                        <p> لا , فقط بالسعودية
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> كيف اختار أفضل المتدربين ؟
                    </a>
                    <div class="content">
                        <p> هناك عدة مرشحين موجودين لدينا ..بإمكانك الدخول على صفحته وقراءة كامل معلوماته ومن ثم بالضغط على زر التفاوض والتواصل بشكل مباشر مع المرشح من خلال المنصة .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a>
                        هل تستطيع الشركة بالتفاوض خارج الموقع مع المتدرب وعمل مقابلة شخصية قبل القرار النهائي لتوظيفه ؟
                    </a>
                    <div class="content">
                        <p>
                            طبعاً , ولكن يتم تحديد الموعد عبر المنصة بالنقر في خانة تحديد الموعد . وعند إتمام و الموافقه على التوظيف للمرشح يجب على الشركة أستكمال بقية خطوات التفاوض في الصفحة لدفع الرسوم المستحقة , في حال اخلاء الدفع أو التأخر فأن للمنصة لها الأحقية بسحب الرسوم خلال 5 أيام .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a>
                        كيف هي سياسة دفع الرسوم ؟
                    </a>
                    <div class="content">
                        <p>
                            عبر دفع أون لاين يتم شحن الرسوم في صفحتك الخاصة ليسمح لك بالتواصل المباشر مع المرشحين , و لا يحق للمنصة بسحبها مطلقاً , إلا بعد ابرام الاتفاق بينك وبين المرشح وبعد توظيفه حينها يحق للمنصة بسحب القيمة المدفوعة .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a>
                        كيف هي سياسة الاستبدال و الاسترجاع
                    </a>
                    <div class="content">
                        <p>
                            تستطيع الشركات استرداد المبلغ المدفوع في حال لم يجد الموظف المناسب له، وذلك عن طريق التواصل مع خدمة العملاء التابعة لنا، ويتم رد المبلغ المشحون في المنصة بعد التأكيد بعدم توظيف أي مرشح .

                            أما الاستبدال
                            - رفع طلب التبديل بالمنصة عبر الايميل الرسمي
                            - اثبات أوراق توظيف الموظف مختومة من الشركة ومثبته رسمياً
                            - يسمح للتبديل مرة واحدة فقط .
                            - بشرط أن لا تكون فترة توظيفه تجاوزت الشهر.
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a>

                        هل تقدمون خدمة تدريب موظفين مبيعات في شركتي ؟
                    </a>
                    <div class="content">
                        <p>
                            نعم , نقدم خدمة تدريب فريقك
                            بأمكانك رفع طلب الخدمة من خلال هذا الايميل info@entiqa.co
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END FAQ SECTION -->

<!-- END ENTQA ADVANTAGE  -->
<!-- START COMPANIES  -->
<div class="container companieeees">
    <h4> عملائنا </h4>
    <div class="responsive">
        <div>
            <img src="../images/company_logo/new_com.jpeg" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com1.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com2.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com3.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com4.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com5.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com6.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com7.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com81.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com9.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com10.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com11.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com12.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com13.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com14.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com15.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/com16.png" alt="">
        </div>

    </div>
</div>

<!--  END COMPANIES -->

<?php


include $tem . "footer.php";
?>

<script>
    $('.responsive').slick({
        dots: false,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        rtl: true,
        arrows: true,
        centerMode: true,
        autoplay: true,
        autoplaySpeed: 1000,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
</script>
<!-- to video -->
<script>
    const player = new Plyr('#player');
</script>