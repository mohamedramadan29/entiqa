<?php
$pagetitle = ' ارسال ايميلات  ';
ob_start();
session_start();
include 'init.php';
?>
<!-- Contacts-->
<section class="section section-md contact_us ind_contact_section">
    <div class="container">
        <h2 style="color: #1F2839; font-size:20px;line-height: 1.8; text-align:center;"> ارسال بريد الكتروني الي عملائنا
        </h2>
        <?php
        if (isset($_POST['send_message'])) {
            try {
                $formerror = [];
                $email = sanitizeInput($_POST["email"]);
                $message = sanitizeInput($_POST["message"]);
                if (empty($email) || empty($message)) {
                    $formerror[] = 'من فضلك ادخل المعلومات كاملة';
                }
                if (empty($formerror)) {
                    include "send_mail/entiqa_mail.php";
                } else {
                    foreach ($formerror as $error) {
        ?>
                        <div class="alert alert-danger"> <?php echo $error; ?> </div>
        <?php
                    }
                }
            } catch (\Exception $e) {
                echo $e;
            }
        }

        ?>
        <div class="row row-40 register_form register_form2">
            <div class="col-md-10 col-lg-12">
                <!--RD Mailform-->
                <div class="login">
                    <form class="" method="post" action="" id="send_form">
                        <div class="row row-10">
                            <div class="col-12">
                                <div class="form-wrap">
                                    <label for=""> البريد الالكتروني <span class="badge badge-danger bg-danger"> افصل بين كل ايميل والاخر ب (,) </span> </label>
                                    <input required class="form-input form-control" id="contact-email" type="email" name="email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-wrap">
                                    <label for=""> رسالتك </label>
                                    <textarea required class="form-input form-control" id="contact-message" name="message"></textarea>
                                </div>
                            </div>
                            <button class="button button-size-1 button-block button-primary" type="submit" id="send_message" name="send_message">ارسال</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- END TESTMONAILS -->
<?php
include $tem . "footer.php";
?>

<!-- to insert message -->
 
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>