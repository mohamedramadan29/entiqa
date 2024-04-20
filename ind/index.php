<?php
$pagetitle = '  الرئيسية - الافراد   ';
ob_start();
session_start();
$ind_navabar = 'ind';
include 'init.php'; ?>
<div class="contact_hero ind_heroo company_index" style="background-image: url(../images/ind_background.jpeg);">
    <div class="overlay" style="background-color: rgba(0, 0, 0, 0.1);">
        <div class="container">
            <div class="data">
                <h2 style="margin-bottom: 0;"> انتقاء </h2>
                <!--
                <p style="text-align: center; color:#F3F3F3;font-size: 20px;"> "فريق المبيعات الخاص بك يمكنه أن ينجح في
                    عملك أو يفسده. ثق في </br> انتقاء لمساعدتك على الاختيار بحكمة." </p>
-->
                <?php
                if (!isset($_SESSION['ind_id'])) { ?>
                    <a href="register" class="btn btn-primary" style="background-color: var(--main-color);border-color: var(--main-color); border-radius: 40px;" type="button"> سجل
                        الان </a>
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
                        منصة انتقائية متخصصة في ترشيح محترفي في مجال المبيعات، نستهدف الشركات و الأفراد الموهوبين والمحترفين لاختيار أفضل الفرص المتاحة والمناسبة للطرفين، نقوم بجذب الأفراد المهتمين والقادرين على الممارسة والعمل في مجال المبيعات ومساعدة الشركات على الاستقطاب الأفضل .
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
            <h4> أحصل على فرصة عمل في المبيعات </h4>
            <p>
                نوفر لك مجموعة من الفرص الوظيفية في مجال مبيعات من خلال تقديم مجموعة متنوعة من الشركات المنضمة إلينا للتمهيدك لأفضل عرض وظيفي مناسب لك في مسارك المهني بحيث نساعد الشركات في العثور عليك للتفاوض معك لتتيح لك إنتقاء الفرصة في أختيار الأفضل لك .
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
<div class="faq_section">
    <div class="container">
        <h2 class="text-center" style="color: var(--main-color);">
            الأسئلة الشائعة للافراد
        </h2>
        <div class="data">

            <div class="accordion">
                <div class="accordion-item">
                    <a>
                        ماهي شروط للتسجيل ؟ </a>
                    <div class="content">
                        <p>
                            1/ أن يكون العمر 18 سنه و أعلى .
                        </p>
                        <p>
                            2/ أن يكون سليم ذهنياً وبدنياً . </p>
                        <p>
                            3/ أن يكون محترفاً في المبيعات أو مديراً للمبيعات . </p>
                        <p>
                            4/ ان يجتاز الاختبار التقييمي الأولي </p>
                    </div>
                </div>
            </div>


            <div class="accordion">
                <div class="accordion-item">
                    <a> هل استطيع ان يكون خياري متاحاً بالتوظيف في جميع المناطق المدن الأخرى أم يشترط فقط في مدينتي ؟ </a>
                    <div class="content">
                        <p>
                            تستطيع اختيار خانة القدرة على النقل من مدينتك الى منطقة الشركة و أثناء تفاوضك مع الشركة الخيار متاحاً لك .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل الشركات للتوظيف متاحة داخل وخارج السعودية ؟ </a>
                    <div class="content">
                        <p> فقط داخل السعودية.
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل يشترط جنسية معينه للتسجيل ؟ </a>
                    <div class="content">
                        <p>
                            لا , متاح لجميع الجنسيات .
                        </p>

                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل يشترط عمر معين ؟ </a>
                    <div class="content">
                        <p>
                            لا يشترط عمر معين .
                        </p>
                    </div>
                </div>
            </div>

            <div class="accordion">
                <div class="accordion-item">
                    <a> ماهي نسبة التوظيف في المنصة ؟ </a>
                    <div class="content">
                        <p> نسبة التوظيف عالية لدينا ونمكن الشركات بالعثور عليك بسهولة حيث انه سيكون لديك فرصة لإنتقاء انسب عرض وظيفي لك .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a>
                        كيف استطيع ان احصل على نسبة عالية في التوظيف ؟ </a>
                    <div class="content">
                        <p>
                            هناك زر تحديث عضويتك بعد كل مرور 24 ساعه تساعدك لتكون في أوائل الصفوف للمرشحين ظاهره للشركات.
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل يحق لي رفض عرض من شركة للتوظيف اثناء التفاوض؟
                    </a>
                    <div class="content">
                        <p> نعم, تستطيع رفض و الموافقة حسب رغبتك بعد التفاوض مع الشركة , في حال تم الاتفاق يتم بالضغط على زر تم الاتفاق .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> بعد الاتفاق بأتمام التوظيف ولكن عند عدم اكمالي بالعمل مع الشركة هل يحق لي بأعادة العضوية للبحث عن عمل عبر طريق المنصة ؟ </a>
                    <div class="content">
                        <p> نعم , ولكن يتم اثبات ذلك بمعلومات العضوية أولاً ومن ثم بدفع رسوم مقدره بـ 100 ريال لتنشيط أشتراك العضوية
                        </p>
                    </div>
                </div>
            </div>
            <!-- <div class="accordion">
                <div class="accordion-item">
                    <a> في حال عدم التخطي للأختبار هل يوجد فرصة لأعادة الأختبار ؟ </a>
                    <div class="content">
                        <p> نعم يوجد إعادة .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> في حال عدم رغبتي في استكمال الدورة واستعادة أموالي ؟ </a>
                    <div class="content">
                        <p>
                            - عند أبلاغنا قبل بدء الورشة بـ24 ساعه سيتم استعادتها بالكامل.
                            - خلال 24 ساعه سيتم خصم 15% قيمة رسوم تكاليف للمقعد وسيتم أزالة اشتراك عضويتك من الموقع .
                            - بعد حضور الورشة لا يمكن استرداد القيمة .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل استطيع ان يكون خياري متاحاً بالتوظيف في جميع المناطق المدن الأخرى أم يشترط فقط في مدينتي ؟ </a>
                    <div class="content">
                        <p> تستطيع اختيار خانة القدرة على النقل من مدينتك الى منطقة الشركة و أثناء تفاوضك مع الشركة الخيار متاحاً لك .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل الشركات للتوظيف متاحة داخل وخارج السعودية ؟ </a>
                    <div class="content">
                        <p> فقط داخل السعودية.
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل يشترط جنسية معينه للتسجيل ؟ </a>
                    <div class="content">
                        <p> لا , متاح لجميع الجنسيات .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل يشترط عمر معين ؟ </a>
                    <div class="content">
                        <p> لا يشترط عمر معين .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> ماهي نسبة التوظيف في المنصة ؟ </a>
                    <div class="content">
                        <p> نسبة التوظيف عالية لدينا ونمكن الشركات بالعثور عليك بسهولة حيث انه سيكون لديك فرصة لإنتقاء انسب عرض وظيفي لك .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a>
                        كيف استطيع ان احصل على نسبة عالية في التوظيف ؟ </a>
                    <div class="content">
                        <p> هناك زر تحديث عضويتك بعد كل مرور 24 ساعه تساعدك لتكون في أوائل الصفوف للمرشحين ظاهره للشركات.
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل يحق لي رفض عرض من شركة للتوظيف اثناء التفاوض؟ </a>
                    <div class="content">
                        <p> نعم, تستطيع رفض و الموافقة حسب رغبتك بعد التفاوض مع الشركة , في حال تم الاتفاق يتم بالضغط على زر تم الاتفاق .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> بعد الاتفاق بأتمام التوظيف ولكن عند عدم اكمالي بالعمل مع الشركة هل يحق لي بأعادة العضوية للبحث عن عمل عبر طريق المنصة ؟ </a>
                    <div class="content">
                        <p> نعم , ولكن يتم اثبات ذلك بمعلومات العضوية أولاً ومن ثم بدفع رسوم مقدره بـ 400 ريال لتنشيط أشتراك العضوية.
                        </p>
                    </div>
                </div>
            </div> -->
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
        <div>
            <img src="../images/company_logo/new_com1.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/new_com2.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/new_com3.png" alt="">
        </div>
        <div>
            <img src="../images/company_logo/new_com4.png" alt="">
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


<style>
    .companieeees .slick-slide img{
        max-width:240px !important;
        max-height:130px !important;
    }
</style>