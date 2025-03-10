<?php
$pagetitle = 'تواصل معنا';
ob_start();
session_start();
$com_navbar = 'com';
include 'init.php'; ?>
<div class="contact_hero">
  <div class="overlay">
    <div class="container">
      <div class="data">
        <h2 style="margin:60px;"> تواصل معنا </h2>
      </div>
    </div>
  </div>
</div>
<!-- Contacts-->
<section class="section section-md contact_us ind_contact_section">
  <div class="container">
    <h2 style="color: #1F2839; font-size:20px;line-height: 1.8;"> نحن متواجدون دوما للرد على استفساراتك، كل ما عليك
      هو ترك بياناتك .بالاسفل وسنقوم بالتواصل معك في اقرب وقت
    </h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $formerror = [];
      $first_name = sanitizeInput($_POST["first_name"]);
      $last_name = sanitizeInput($_POST["last_name"]);
      $email = sanitizeInput($_POST["email"]);
      $mobile = sanitizeInput($_POST["mobile"]);
      $message = sanitizeInput($_POST["message"]);
      if (empty($first_name) || empty($last_name) || empty($email) || empty($mobile) || empty($message)) {
        $formerror[] = 'من فضلك ادخل المعلومات كاملة';
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formerror[] = " يجب إدخال عنوان بريد إلكتروني صالح ";
      } elseif (strlen($email) > 50) {
        $formerror[] = "طول البريد الإلكتروني يجب أن لا يتجاوز 50 حرفًا";
      } elseif (!preg_match('/^[a-zA-Z0-9.@]+$/', $email)) {
        $formerror[] = "البريد الإلكتروني يجب أن يحتوي على أحرف وأرقام ورموز صحيحة فقط";
      } elseif (strpos($email, '..') !== false) {
        $formerror[] = "البريد الإلكتروني يحتوي على أحرف غير صالحة";
      }

      if (strlen($mobile) > 20 || !is_numeric($mobile)) {
        $formerror[] = ' رقم الهاتف يجب أن يكون أقل من 20 رقم ويحتوي على أرقام فقط ';
      }
      if (!is_numeric($mobile) || strlen($mobile) < 8 || strlen($mobile) > 20) {
        $formerror[] = 'من فضلك، أدخل رقم هاتف صحيح بين 8 و 20 رقمًا.';
      }
      if (strlen($first_name) > 50) {
        $formerror[] = 'الاسم الاول يجب ان يكون اقل من  50 حرف ';
      }
      if (strlen($last_name) > 50) {
        $formerror[] = 'الاسم الاخير يجب ان يكون اقل من  50 حرف ';
      }
      if (empty($formerror)) {
        $stmt = $connect->prepare("INSERT INTO contact (first_name, last_name , email , mobile , message ,date ) VALUES 
        (:zfname,:zlname,:zemail,:zmobile,:zmessage,:zdate)");
        $stmt->execute(
          array(
            "zfname" => $first_name,
            "zlname" => $last_name,
            "zemail" => $email,
            "zmobile" => $mobile,
            "zmessage" => $message,
            'zdate' => date("Y-m-d"),
          )
        );
        if ($stmt) { ?>
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
          <script>
            new swal({
              title: " شكرا لك   !",
              text: " تم ارسال رسالتك بنجاح   سوف نتواصل معك في اقرب وقت ممكن ",
              icon: "success",
              button: "اغلاق",
            });
          </script>
          <?php header('refresh:1;url=contact'); ?>
          <!-- <div class="alert alert-success"> تم ارسال رسالتك بنجاح ,
            سوف نتواصل معك في اقرب وقت ممكن </div> -->
        <?php
        }
      } else {
        foreach ($formerror as $error) {
        ?>
          <div class="alert alert-danger"> <?php echo $error; ?> </div>
    <?php
        }
      }
    }

    ?>
    <div class="row row-40 register_form register_form2">
      <div class="col-md-10 col-lg-6">
        <!--RD Mailform-->
        <div class="login">
          <form class="" method="post" action="" id="send_form">
            <div class="row row-10">
              <div class="col-md-6">
                <div class="form-wrap">
                  <input required oninvalid="setCustomValidityArabic(this,'من فضلك ادخل  الاسم الاول ')" oninput="resetCustomValidity(this)" minlength="2" maxlength="50" class="form-input form-control" type="text" name="first_name" placeholder="الاسم الاول *">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-wrap">
                  <input required oninvalid="setCustomValidityArabic(this,'من فضلك ادخل رقم  الاسم الاخير ')" oninput="resetCustomValidity(this)" minlength="2" maxlength="50" class="form-input form-control" type="text" name="last_name" placeholder="الاسم الاخير *">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-wrap">
                  <input required oninvalid="setCustomValidityArabic(this,' من فضلك ادخل البريد الالكتروني بشكل صحيح  ')" oninput="resetCustomValidity(this)" maxlength="50" class="form-input form-control" id="contact-email" type="email" name="email" placeholder="البريد الألكتروني *">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-wrap">
                  <input required minlength="8" maxlength="20" class="form-input form-control" id="contact-phone" type="number" name="mobile" placeholder=" رقم الهاتف * ">
                </div>
              </div>
              <div class="col-12">
                <div class="form-wrap">
                  <textarea required oninvalid="setCustomValidityArabic(this,' يجب ان يكون اقل عدد من الاحرف ٢٠ حرف واكثر عدد هو  ٤٠٠  حرف')" oninput="resetCustomValidity(this)" minlength="20" maxlength="400" class="form-input form-control" id="contact-message" name="message" placeholder=" رسالتك *"></textarea>
                </div>
              </div>
              <button class="button button-size-1 button-block button-primary" type="submit" id="send_message" name="send_message">ارسال</button>

            </div>
          </form>
        </div>
      </div>
      <div class="col-md-10 col-lg-6">
        <div class="address_data">
          <h2> معلوماتنا </h2>
          <div class="address_section">
            <a href="#location">
              <span> <i class="fa fa-map-marker"></i> </span>
              <p> الرياض - الملقا - طريق الامام سعود بن فيصل   </p>
            </a>
          </div>
          <div class="address_section">
            <a href="tel://+966597319189">
              <span> <i class="fa fa-phone"></i> </span>
              <p> +966597319189 </p>
            </a>
          </div>
          <div class="address_section">
            <span> <i class="fa fa-envelope"></i> </span>
            <p> <a style='color:#3a3737;' href="mailto:info@entiqa.co"> info@entiqa.co </a>
            </p>

          </div>
        </div>
        <!--Please, add the data attribute data-key="YOUR_API_KEY" in order to insert your own API key for the Google map.-->
        <!--Please note that YOUR_API_KEY should replaced with your key.-->
        <!--Example: <div class="google-map-container" data-key="YOUR_API_KEY">-->
      </div>



    </div>
  </div>
</section>

<!-- START MAP  -->
<div class="map_section" id="location">
  <div class="data">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3622.3822545788066!2d46.60556102481633!3d24.78236104837854!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2ee39ceb4dff7b%3A0x6c53689789aec723!2z2LfYsdmK2YIg2KfZhNin2YXYp9mFINiz2LnZiNivINio2YYg2YHZiti12YTYjCDYp9mE2YXZhNmC2KfYjCDYp9mE2LHZitin2LYg2KfZhNiz2LnZiNiv2YrYqQ!5e0!3m2!1sar!2seg!4v1707671234280!5m2!1sar!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
</div>

<!-- END TESTMONAILS -->
<?php
include $tem . "footer.php";
?>

<!-- to insert message -->
<script>
  $(document).ready(function($) {
    // قائمة لتخزين معلومات الملفات المختارة
    let selectedFiles = [];
    $('#send_form').submit(function() {
      var submitButton = document.getElementById('send_message');
      submitButton.setAttribute('disabled', 'disabled');
    });
  });
</script>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>