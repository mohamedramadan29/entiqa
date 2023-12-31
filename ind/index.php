<?php
$pagetitle = '  الرئيسية - الأفراد  ';
ob_start();
session_start();
$ind_navabar = 'ind';
include 'init.php'; ?>
<div class="contact_hero ind_heroo">
    <div class="overlay">
        <div class="container">
            <div class="data">
                <h2> انتقاء </h2>
                <?php
                if (!isset($_SESSION['ind_id'])) { ?>
                    <a href="register" class="btn btn-primary" style="background-color: #F16583;border-color: #F16583; border-radius: 40px;" type="button"> سجل
                        الان </a>
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
                اهداف انتقاء للافراد
            </h2>
            <div class="col-lg-6">
                <div class="info"> <!-- animate__animated animate__backInRight -->
                    <h3 class="text-center"> فرصة للمتدرب لاختيار أفضل شركة تناسبه </br> في هذا المجال </h3>
                    <p> إنتقاء منصة توفر للمتدربين مجموعة من الفرص الوظيفيه و التعليمية من خلال أكتساب المعرفة في قطاعي التجزئة والخدمات في مجال المبيعات , من خلال تقديم مجموعة متنوعة من التدريب مع أفضل الخبراء في هذا المجال للتمهيدك للنجاح في مسارك المهني . يعمل فريقنا بتأهيلك وتدريبك وتقييمك وإبراز نقاط قوتك لتستفيد منها في حياتك المهنية لتزيد مستوى كفائتك و إمكانياتك لتضمن نجاحك ، ونساعد الشركات في العثور عليك للتفاوض معك لتتيح لك إنتقاء الفرصة في أختيار الأفضل لك . </p>
                </div>
            </div>
            <div class="col-lg-6 animate__animated animate__backInLeft">
                <img src="../images/entiqa_goal1.webp" alt="">
            </div>
        </div>
    </div>
</section>

<!-- Our Mission-->
<section class="section bg-default section-md our_goals">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 animate__animated animate__backInRight">
                <img src="../images/entiqa_goal2.webp" alt="">
            </div>
            <div class="col-lg-6">
                <div class="info">
                    <h3 class="text-center"> أبواب فرص العمل متاحة للجميع </h3>
                    <p> إنتقاء تؤمن بأن للجميع يستحق فرصة للتعلم والعمل ونؤمن بأن هؤلاء المحبين لخوض التحديات والطموحين هم من سيصنعون الفارق لمستقبل في الوطن لذا فأن للجميع يستحق بغض النظرعن مستوى خبرته أو خلفيته معنا بما في ذلك الطلاب والعاطلين عن العمل وأولئك الذين ليس لديهم الخبرة والمهارات الكافية في سيرتهم الذاتية . فقد تم تصميم برنامجنا التدريبي لتلبية احتياجات وبناء مهارات التي تطمح بها الشركات لصنع الفارق لها , نحن نقدم تدريبًا شاملاً يزود المتدربين بالمهارات والمعرفة اللازمة للنجاح في الصناعة في المبيعات ، فإنتقاء تساهم في بناء مهارة مميزة تعود بالنفع على الشركات والمجتمعات على حدٍ سوا.
                    </p>
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
                    <h3 class="text-center"> مساعدة المتدربين في الحصول على عمل </h3>
                    <p> نؤمن بأن التدريب والتعليم أساسيان لخفض معدل البطالة وتعزيز النمو الاقتصادي. تم تصميم برنامجنا التدريبي لتزويد المتدربين بالمهارات والمعرفة اللازمة للتميز من خلال ربط المتدربين المؤهلين و بأصحاب العمل الذين يبحثون عن موظفين مهرة ، نساعد في خلق اقتصاد أكثر ازدهارًا وازدهارًا للجميع. لذا يعمل فريقنا لضمان استعداد المتدربين جيدًا لسوق العمل ومجهزين بالمهارات والمعرفة التي يبحث عنها أصحاب العمل. </p>
                </div>
            </div>
            <div class="col-lg-6 animate__animated animate__backInLeft">
                <img src="../images/entiqa_goal3.webp" alt="">
            </div>
        </div>
    </div>
</section>
<!-- START NEW TESTMONAILS  -->
<?php
 $stmt = $connect->prepare('SELECT * FROM ind_review 
 INNER JOIN ind_register ON ind_review.ind_id = ind_register.ind_id ');
 $stmt->execute();
$allrev = $stmt->fetchAll();
$count_rev = $stmt->rowCount();
if ($count_rev > 0) {
?>
    <div class="testmonails">
        <div class='overlay' style="background-color: rgba(0, 0, 0, 0.3);">
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
                                                <h4 style="color: #111;font-size: 18px;"> <?php echo $rev['ind_name']; ?></h4>
                                                <p style="color: #F16583;font-size: 14px;margin-top:0;"> <?php echo $rev['ind_address']; ?></p>
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
            الأسئلة الشائعة للافراد
        </h2>
        <div class="data">
            <div class="accordion">
                <div class="accordion-item">
                    <a> كم سعر الدورة ؟ </a>
                    <div class="content">
                        <p> 760 ريال فقط
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل هناك شروط للتسجيل ؟ </a>
                    <div class="content">
                        <p> لا يوجد , لأننا نؤمن بأن للجميع حق للتعلم والخوض في سوق العمل ليس له عمر معين ولكن نؤمن بأن المهارة وحب التعلم هو الفارق المهم
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل ستكون الدورة تسجيل أم حضور مباشر ؟ </a>
                    <div class="content">
                        <p> حضور الدورة مباشر على الزوم لا يوجد تسجيل أو ارسال دورات مسجله
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> كم عدد ساعات الحضور للدورة ؟ </a>
                    <div class="content">
                        <p> 40 دقيقة الى 60 دقيقة لمدة أسبوعين .

                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> أذا لم أستطع الحضور في أحد الأيام أو أضطررت للتغيب ؟ </a>
                    <div class="content">
                        <p> التغيب عن المحاضرة تؤثر على كفائه المتدرب بنسبة ( 10% ) يتم خصمها من الدرجة النهائية .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> ماهي النسبة لتخطي الأختبار ؟ </a>
                    <div class="content">
                        <p> لأجتياز الدورة يجب أن يحصل الطالب على ٨٠ ٪على الأقل من التقييم النهائي
                            يتم تقسيم النسبة الى 60% للاختبار النهائي و الاختبارات القصيرة 20% , الأداء و الحضور 20%
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل ستكون هنالك شهادة مُثبته لاجتياز الدورة ؟ </a>
                    <div class="content">
                        <p>نعم سيتم أرسال شهادتك عبر الموقع .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> في حال عدم التخطي للأختبار هل يوجد فرصة لأعادة الأختبار ؟
                    </a>
                    <div class="content">
                        <p> مرة واحدة فقط برسوم 250 ريال ولكن نتيح للمتدرب فرصة لأعادة الدورة بالكامل لأعادة التقييم الشامل ب310 بخصم 40% من سعر الدورة الأصليه مع الاختبار النهائي بدون رسوم .
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a>في حال عدم رغبتي في استكمال الدورة واستعادة أموالي ؟</a>
                    <div class="content">
                        <p> تستطيع استرداد مالك عند أبلاغنا قبل بدء الدورة بـ24 ساعه ولكن خلال 24 ساعه سيتم خصم 15% قيمة رسوم تكاليف للمقعد وسيتم أزالة اشتراك عضويتك من الموقع , ولا يمكن استرداد القيمة بعد بدء الدورة وبعد حضور الدورات.
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
                        <p> حالياً فقط داخل السعودية.
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل يشترط جنسية معينه للتسجيل ؟ </a>
                    <div class="content">
                        <p> هل يشترط جنسية معينه للتسجيل ؟
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> هل هنالك مكافئة للمتدرب المتفوق ؟ </a>
                    <div class="content">
                        <p> للطلاب المتفوقين الحاصلين على نسبة ما بين 91% الى 100% سيحصلون على العضويات الذهبية و يتم وضع أسمائهم في مقدمة الموقع كأفضل المتدربين وذلك لمساعدة المتدرب في زيادة فرص عروض التوظيفية له من جميع الشركات
                        </p>
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <a> في حال عدم حصولي على هذه الفرصة هل هنالك طريقة أخرى لأبراز عضويتي بالموقع ؟ </a>
                    <div class="content">
                        <p> نعم , تستطيع تحديث عضويتك بعد كل مرور 24 ساعه في خانة المتدربين المجتازين
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
                        <p> نعم , ولكن يتم اثبات بالحصول على الشهادة أولاً ومن ثم بدفع رسوم مقدره بـ 300 ريال لتنشيط أشتراك العضوية مجدداً
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