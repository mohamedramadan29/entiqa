<?php
$pagetitle = '  الرئيسية - الشركات   ';
ob_start();
session_start();
$com_navbar = 'com';
include 'init.php'; ?>
<div class="contact_hero ind_heroo" style="background-image: url(../images/company_back.jpeg);">
    <div class="overlay" style="background-color: rgba(0, 0, 0, 0.3);">
        <div class="container">
            <div class="data">
                <h2 style="margin-bottom: 0;"> انتقاء </h2>
                <!--
                <p style="text-align: center; color:#F3F3F3;font-size: 20px;"> "فريق المبيعات الخاص بك يمكنه أن ينجح في
                    عملك أو يفسده. ثق في </br> انتقاء لمساعدتك على الاختيار بحكمة." </p>
-->
                <?php
                if (!isset($_SESSION['com_id'])) { ?>
                    <a href="stars" class="btn btn-primary" style="background-color: #F16583;border-color: #F16583; border-radius: 40px;" type="button"> اختر
                        فريقك </a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Download Our Tax Guide App-->
<section class="about_us">
    <div class="container">
        <div class="row">
            <h2 class="text-center"> عن انتقاء </h2>
            <div class="col-md-6">
                <div class="">
                    <p> هناك تنافس للمنظمات وللشركات في تطوير فريق المبيعات والخدمات لزيادة الإنتاجية ، الا ان انتقاء هو
                        الطريق المختصر و الأكفأ لجميع القطاعات .
                        نعرف لك انتقاء على انها منصة لعملية انتقائية للشركات و للمتدربين أيضا لاختيار افضل فرص متاحه و
                        مناسبه للطرفين
                        نقوم بجذب الأفراد المهتمين والقادرين على الممارسة و الخوض بالعمل في عالم المبيعات
                        ولكي يكون المتدرب مؤهلاً و فعالا لابد من وضع استراتيجيات له في تعلم أسس التدريس لهذه المهنة ,
                        فالمتدربين يتم أنشائهم وتدريبهم وتطويرهم و تأهيلهم من قبل خبراء حاصلين على شهادات عالمية في مجال
                        المبيعات .
                        ونعتبر كنقطة وصل بين الطرفين لرفع جودة العمل و مساهمة في تخفيض نسبة البطالة أيضاً .
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="video-popup-content">
                    <video style="border-radius:20px" id="video-frame" width="100%" height="100%" src="../uploads/entiqa.mp4" frameborder="0" controls></video> <!--allowfullscreen-->
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Our Mission-->
<section class="section bg-default section-md our_goals">
    <div class="container">
        <div class="row">
            <h2 class="text-center" style="color: #F16583;">
                اهداف انتقاء للشركات
            </h2>
            <div class="col-lg-6">
                <div class="info">
                    <h3 class="text-center" style="font-size:11px"> للحصول على إنتاج أعلى </h3>
                    <p> الهدف الأساسي لمنصتنا هو مساعدة الشركات على زيادة معدلات إنتاجها. ندرك بأن الإنتاج يمثل جانبًا مهمًا لأي عمل تجاري ، ويمكن أن تؤدي مستويات الإنتاج المرتفعة إلى زيادة الإيرادات وتحسين رضا العملاء وتعزيز سمعة العلامة التجارية. و لتحقيق هذا الهدف ، نقدم خدمات تعليميه و استشارية لمساعدة الشركات على إنتقاء أفضل فريق مبيعات تم تدريبهم وتأسيسهم تحت أيدي خبراء ، ونقوم بتطوير استراتيجيات التدريب لتحسين عمليات الإنتاج الخاصة بهم. هدفنا هو مساعدة عملائنا على تحقيق النمو والنجاح المستدام من خلال إنتقاء الأفضل دائماً </p>
                </div>
            </div>
            <div class="col-lg-6 ">
                <img src="../images/entiqa_goal1.png" alt="">
            </div>
        </div>
    </div>
</section>

<!-- Our Mission-->
<section class="section bg-default section-md our_goals">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 ">
                <img src="../images/entiqa_goal2.png" alt="">
            </div>
            <div class="col-lg-6">
                <div class="info">
                    <h3 class="text-center"> العثور على المؤهل المطلوب </h3>
                    <p> العثور على الموهبة المناسبة أمر ضروري لأي عمل تجاري. تقدم منصتنا خدمات ظهور تقييم المؤهلين لمساعدة الشركات على تحديد مستويات المتدربين المميزة في المبيعات . نحن نتفهم أن توظيف الشخص المناسب للوظيفة أمر بالغ الأهمية لضمان سير العمل بسلاسة وكفاءة. لذا تساعدك خدمات تقييم المؤهلين لدينا على اتخاذ قرارات مستنيره . </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Our Mission-->
<section class="section bg-default section-md our_goals">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="info">
                    <h3 class="text-center"> تطوير الفريق الخاص بك </h3>
                    <p> منصة إنتقاء تتفهم أهمية الاستثمار في تطوير الموظفين. لذا نقدم برامج تدريبية متخصصة للموظفين الذين يحتاجون إلى دعم إضافي في أدوارهم لتحسين كفاءتهم والمساهمة في نجاح الأعمال. تغطي برامجنا التدريبية مجموعة من الموضوعات وهي مصممة من خبرائنا المميزين.
                        نحن نعمل عن كثب مع عملائنا لتحديد المهارات التي يحتاج فيها موظفوهم إلى الدعم لتلبية هذه الاحتياجات. هدفنا هو مساعدة عملائنا على بناء فرق قوية قادرة على دفع نجاح الأعمال من خلال تحسين كفاءة موظفيهم.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="../images/entiqa_goal3.png" alt="">
            </div>
        </div>
    </div>
</section>
<!-- START NEW TESTMONAILS  -->
<?php
$stmt = $connect->prepare('SELECT * FROM company_review 
INNER JOIN company_register ON company_review.com_id = company_register.com_id WHERE rev_show = 1 ORDER BY rev_id DESC ');
$stmt->execute();
$allrev = $stmt->fetchAll();
$count_rev = $stmt->rowCount();
if ($count_rev > 0) {
?>
    <div class="testmonails">
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
        <h2 class="text-center" style="color: #F16583;">
            الأسئلة الشائعة للشركات
        </h2>
        <div class="data">
            <div class="accordion">
                <div class="accordion-item">
                    <a>هل استطيع اختيار اكثر من متدرب ؟</a>
                    <div class="content">
                        <p> لا يوجد عدد معين تستطيع إنتقاء فريقك بالكامل
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a>كيف هو تدريبكم للمتدربين ؟ </a>
                    <div class="content">
                        <p> 1 - يتم انتقاء أولاً المؤهلين الراغبين بشغف التعليم ومن ثم نبدأ بتدريبهم مع خبراء , ومدة دراستهم من 40 دقيقة الى 60 دقيقة لمدة أسبوعين مع تقييم الأداء التطبيقي .

                        </p>
                        <p>
                            2- لاجتياز الدورة يجب أن يحصل المتدرب على ٨٠ ٪على الأقل من التقييم النهائي
                            يتم تقسيم النسبة الى 60% للاختبار النهائي و الاختبارات القصيرة 20% , التطبيق و الحضور 20% .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a>هل تستطيع الشركات خارج السعودية ان تستفيد من هذه الخدمة ؟</a>
                    <div class="content">
                        <p> لا فقط حالياً داخل السعودية وقريباً سيكون للخارج
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a>كيف اختار أفضل المتدربين ؟</a>
                    <div class="content">
                        <p> هنالك درجة تقييم المتدرب بجانب العضوية وقائمة للمتفوقين الحاصلين على اعلى نسبة ما بين 91% الى 100% في اعلى الصفحة تستطيع الشركات التفاوض معهم .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> كيف هي سياسة دفع الرسوم ؟ </a>
                    <div class="content">
                        <p> عبر دفع أون لاين بشحن الرسوم في صفحتك الخاصة أثناء توقيع العقد , و لا يحق للمنصة بسحبها مطلقاً , فبعد ابرام موافقة التوظيف بينك وبين المتدرب يتم الدفع من خلالها الى المنصة .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> كيف هي سياسة الاستبدال و الاسترجاع
                    </a>
                    <div class="content">
                        <p> تستطيع الشركات استرداد المبلغ المدفوع في حال لم يجد الموظف المناسب له، وذلك عن طريق التواصل مع خدمة العملاء التابعة لنا، ويتم رد المبلغ المشحون في المنصة , بعد التأكد من عدم توظيف المتدرب .
                        </p>
                        <p>

                            أما الاستبدال يكون برفع طلب تبديل الموظف بالمنصة عبر الايميل الرسمي وذلك في حالة قيام المتدرب الذي تعاقدت معه هو الذي فسخ العقد خلال الثلاثة أشهر الأولى من إتمام التعاقد عبر المنصة وثبوت ذلك بشكل رسمي، أما إذا كان فسخ العقد من جانب الشركة لا يتم الاستبدال المتدرب .

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
                            بالتأكيد ولكن يتم تحديد الموعد عبر المنصة بالنقر في خانة تحديد الموعد . وعند إتمام و الموافقه على التوظيف للمتدرب يجب على الشركة أستكمال بقية خطوات التفاوض في الصفحة لدفع الرسوم المستحقة , في حال اخلاء الدفع أو التأخر فأن للمنصة لها الأحقية بسحب الرسوم خلال 5 أيام .

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END FAQ SECTION -->

<!-- END ENTQA ADVANTAGE  -->



<?php


include $tem . "footer.php";
?>