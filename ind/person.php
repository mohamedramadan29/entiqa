<?php
$pagetitle = 'تواصل معنا';
ob_start();
session_start();
include 'init.php'; ?>
<div class="contact_hero">
    <div class="overlay">
        <div class="container">
            <div class="data">
                <h2> الافراد </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">الافراد</li>
                        <li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="section bg-gray-100 box-image-left about_us">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box-image-item box-image-video novi-background bg-image" style="background-image: url(images/about_section.svg)">
                    <div class="d-flex align-items-center pt-5 btn-pop">
                        <a class="btn-play" href="//www.youtube.com/embed/KFVUxSynSXc" data-lightgallery="item">
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 wow fadeInLeft">
                <div class="section-lg section-lg-top-100">
                    <h2 class="title-icon title-icon-2">
                        <span> عن <span class="text-light"> الافراد </span>
                        </span>
                        <span class="icon icon-default mercury-icon-touch"></span>
                    </h2>
                    <p class="big"> نعرف مشكلتك لما تاخذ الكثير من الوقت عشان تنتقي افضل المتقدمين لمؤسستك او شركتك في مجال المبيعات الي هو من أهم ركائز في أرباح شركتك أو مؤسستك نعرف شعورك لما تحاول تبحث عن ذوي الخبرة في مجال مبيعات وأكيد ممكن تتعب لما تحصلهم واذا ما حصلت بتضطر تدربهم و تهيأهم عشان يبدأون في العمل
                        لكن لا تخاف راح نساعدك تختصر هذي المشكلة وراح نقدم لك افضل متدربين في مجال المبيعات مع خبراء متمكنين , تدربوا ..


                    </p>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- Contacts-->
<section class="section section-md contact_us register_form">
    <div class="container">
        <h2 class="title-icon title-icon-2">
            <span> سجل معنا الان</span>

        </h2>
        <?php
        if (isset($_POST["send_data_person"])) {
            $name = $_POST["name"];
            $birth_date = $_POST["birth_date"];
            $email = $_POST["email"];
            $nationality = $_POST["nationality"];
            $place = $_POST["place"]; 
            $stmt = $connect->prepare("INSERT INTO personal (person_name, person_birthdate , person_email , person_nationality , person_address	) VALUES 
            (:zname,:zbirthdate,:zemail,:znationality,:zaddress)");
            $stmt->execute(array(
                "zname" => $name,
                "zbirthdate" => $birth_date,
                "zemail" => $email,
                "znationality" => $nationality,
                "zaddress" => $place,
            ));
            if ($stmt) { ?>
                <div class="alert alert-success"> تم تسجيلك بنجاح</div>
        <?php

            }
        }

        ?>
        <div class="row row-40">
            <!--RD Mailform-->
            <div class="com_register">
                <form class="" method="post" action="">
                    <div class="row row-10">
                        <div class="col-md-6">
                            <div class="form-wrap">
                                <input class="form-input" id="contact-first-name" type="text" name="birth_date" data-constraints="@Required">
                                <label class="form-label" for="contact-first-name"> تاريخ الميلاد </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-wrap">
                                <input class="form-input" id="contact-last-name" type="text" name="name" data-constraints="@Required">
                                <label class="form-label" for="contact-last-name"> الاسم الثلاثي </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-wrap">
                                <input class="form-input" id="contact-email" type="email" name="email" data-constraints="@Email @Required">
                                <label class="form-label" for="contact-email"> البريد الالكنروني </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-wrap">
                                <input class="form-input" id="contact-nationality" type="text" name="nationality" data-constraints="@Required">
                                <label class="form-label" for="contact-nationality"> الجنسية </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-wrap">
                                <input class="form-input" id="contact-place" type="text" name="place" data-constraints="@Required">
                                <label class="form-label" for="contact-place"> المنطقه </label>
                            </div>
                        </div>

                        <div class="col-md-7 col-xl-8">
                        </div>
                        <div class="col-12">
                            <button class="button button-size-1 button-block button-primary" name="send_data_person" type="submit">تسجيل</button>
                        </div>
                    </div>
                </form>
            </div>


        </div>
</section>

<!-- START FAQ SECTION -->
<div class="faq_section">
    <div class="container">
        <h2 class="title-icon title-icon-2">
            <span> الاسئلة الشائعه </span>

        </h2>
        <div class="accordion">
            <div class="accordion-item">
                <a> السوال الاول </a>
                <div class="content">
                    <p> كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.
                    </p>
                </div>
            </div>
        </div>
        <div class="accordion">
            <div class="accordion-item">
                <a> السوال الثاني </a>
                <div class="content">
                    <p> كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.
                    </p>
                </div>
            </div>
        </div>
        <div class="accordion">
            <div class="accordion-item">
                <a> السوال الثالث </a>
                <div class="content">
                    <p> كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.
                    </p>
                </div>
            </div>
        </div>
        <div class="accordion">
            <div class="accordion-item">
                <a> السوال الرابع </a>
                <div class="content">
                    <p> كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.
                    </p>
                </div>
            </div>
        </div>
        <div class="accordion">
            <div class="accordion-item">
                <a> السوال الخامس </a>
                <div class="content">
                    <p> كل هذه الأفكار المغلوطة حول استنكار النشوة وتمجيد الألم نشأت بالفعل، وسأعرض لك التفاصيل لتكتشف حقيقة وأساس تلك السعادة البشرية، فلا أحد يرفض أو يكره أو يتجنب الشعور بالسعادة، ولكن بفضل هؤلاء الأشخاص الذين لا يدركون بأن السعادة لا بد أن نستشعرها بصورة أكثر عقلانية ومنطقية فيعرضهم هذا لمواجهة الظروف الأليمة، وأكرر بأنه لا يوجد من يرغب في الحب ونيل المنال ويتلذذ بالآلام، الألم هو الألم ولكن نتيجة لظروف ما قد تكمن السعاده فيما نتحمله من كد وأسي.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- END FAQ SECTION -->
<!-- END TESTMONAILS -->
<?php

include $tem . "footer.php";


?>