<footer class="section footer-classic">
    <div class="footer-inner-1">
        <div class="container">
            <div class="row row-40">
                <div class="col-lg-4">
                    <center><a href="https://entiqa.online/company/index"><img src="../images/main_logo.png" width="30%" height="30%" alt=""></a></center>
                    <p class="footer_about">منصة مختصة بتدريب المتقدمين في مجال الأهم في جميع الشركات لقطاعات التجزئة او
                        الخدمات وهو فريق المبيعات مع الخبراء يتم تدريبهم لتأهيل المتدربين للوظيفة</p>
                </div>
                <div class="col-lg-4 col-6">
                    <h5>عن انتقاء </h5>
                    <ul class="footer-list big">
                        <li><a href="contact">تواصل معنا</a></li>
                        <li><a href="privacy_policy">سياسة الخصوصية </a></li>
                        <li><a href="terms"> الشروط والاحكام </a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-6">
                    <h5> تواصل معنا </h5>
                    <ul class='list-unstyled social_icon'>
                        <li> <a href="https://twitter.com/Entiqa_"><i class='fa fa-twitter'></i></a> </li>
                        <li> <a href="https://www.instagram.com/_entiqa_/"><i class='fa fa-instagram'></i></a></li>
                    </ul>
                    <ul class="contact-list font-weight-bold">
                        <li><i class="fa fa-map-marker"></i> السعودية , جدة</li>
                        <li><i class="fa fa-phone"></i> 966597319189+ </li>
                        <li><i class="fa fa-envelope"></i>info@entiqa.online</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-inner-2 copy">
        <div class="container">
            <p class=""> جميع الحقوق محفوظة <span class="copyright-year"></span><span>&copy;&nbsp;</span><span class="color"> موسسة انتقاء </span> <strong class="text-bold color"> </strong></p>
        </div>
    </div>
</footer>
<p class="customer_support">
    <a href="<?php if (isset($_SESSION['ind_id'])) {
                ?>
        ind_message.php?other=admin
        <?php
                } elseif (isset($_SESSION['com_id'])) {
        ?>
                    com_message.php?other=admin
                    <?php
                } else {
                    ?>
                    login
                    <?php
                } ?>"> الدعم الفني <i class="fa fa-support"></i> </a>
</p>


</div>
<div class="snackbars" id="form-output-global"></div>
<script src="<?php echo $js; ?>jquery.min.js"></script>
<script src="<?php echo $js; ?>select2.min.js"></script>
<script src="<?php echo $js; ?>bootstrap.bundle.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="<?php echo $js; ?>core.min.js"></script>
<script src="<?php echo $js; ?>script.js"></script>
<script src="<?php echo $js; ?>TimeCircles.js"></script>
<script src="<?php echo $js; ?>sweetalert.min.js"></script>

<!-- Custome File   -->
<script src="<?php echo $js; ?>/bs-custom-file-input.min.js"></script>
<!-- USe Flat picker To Select Time -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="<?php echo $js; ?>main.js"></script>
<script src="<?php echo $js; ?>slick.min.js"></script>
<script src="<?php echo $js; ?>slick-custom.js"></script>
<!-- 
<script>
    $(function() {
        $(document).ready(function() {
            var percent = $('#percent');
            var status = $('.status');
            $('.ajax_form').ajaxForm({
                beforeSend: function() {
                    status.empty();
                    var percentVal = '0%';
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    percent.html(percentVal);

                    $("#percent").html(percentVal);
                    $("#percent").width(percentVal);
                },
                complete: function(xhr) {
                    status.html(xhr.responseText);
                    setTimeout(() => {
                        document.location.reload();
                    }, 0);
                }
            });
        });
    });
</script> -->
 
<script>
    $(document).ready(function() {
        $('.testmon').slick({
            rtl: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1000,
            infinite: true,
            prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-right"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-left"></i></button>',
            centerMode: true,
            variableWidth: false,
            responsive: [{
                breakpoint: 900,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 2,
                }
            }]

        });
    });
</script>
<script>
      $(".select").select2();
</script>
<!-- Use FlatPicker -->
<script>
    flatpickr("#interviewDate", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "today",
        time_24hr: true
    });
</script>

<!--  Customize Required Message -->
<script>
    function setCustomValidityArabic(element, message) {
        element.setCustomValidity(message);
    }

    function resetCustomValidity(element) {
        element.setCustomValidity('');
    }
</script>
<script>
    function checkFileSize() {
        var fileInput = document.getElementById('customFile');
        var fileLabel = document.getElementById('fileLabel');

        // Get the selected files
        var files = fileInput.files;

        // Max file size in megabytes
        var maxSize = 5; // 5 MB

        // Check each selected file
        for (var i = 0; i < files.length; i++) {
            var fileSizeMB = files[i].size / (1024 * 1024); // Convert to megabytes
            if (fileSizeMB > maxSize) {
                alert('حجم الملف يجب أن يكون أقل من 5 ميجابايت.');
                // Clear the file input
                fileInput.value = '';
                // Reset the label text
                fileLabel.innerHTML = 'اختيار ملفات';
                return;
            }
        }

        // Update the label with selected file names
        if (files.length > 0) {
            fileLabel.innerHTML = files.length + ' ملف مختار';
        } else {
            fileLabel.innerHTML = 'اختيار ملفات';
        }
    }
    $(function () {
  bsCustomFileInput.init();
});
</script>

</body>

</html>