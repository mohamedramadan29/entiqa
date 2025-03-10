<!DOCTYPE html>
<html class="wide wow-animation" lang="ar" dir="rtl">

<head>
  <title>
    <?php echo $pagetitle; ?>
  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="../images/main_logo.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">
  <link href="<?php echo $css; ?>bootstrap.rtl.min.css" rel="stylesheet">
  <link href="<?php echo $css; ?>select2.min.css" rel="stylesheet">
  <link href="<?php echo $css; ?>slick.css" rel="stylesheet">
  <link href="<?php echo $css; ?>slick-theme.css" rel="stylesheet">
  <link href="<?php echo $css; ?>animate.min.css" rel="stylesheet">
  <link href="<?php echo $css; ?>fonts.css" rel="stylesheet">
  <link href="<?php echo $css; ?>style.css" rel="stylesheet">
  <link href="<?php echo $css; ?>com.css" rel="stylesheet">
  <link href="<?php echo $css; ?>main.css" rel="stylesheet">
  <!-- Flat picker To time  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="<?php echo $css; ?>new_custome.css" rel="stylesheet">
  <link href="<?php echo $css; ?>TimeCircles.css" rel="stylesheet">


  <script type="text/javascript">
    window.history.forward();
  </script>

  <!-- JavaScript code to prevent page reload and exit -->
  <script>
    var canLeavePage = false;


    window.onbeforeunload = function() {
      if (!canLeavePage) {
        return "سيتم فقدان البيانات غير المحفوظة. هل أنت متأكد؟";
      }
    };

    // تحديث المتغير للسماح بمغادرة الصفحة بعد انتهاء الاختبار
    function finishTest() {
      canLeavePage = true;
    }
  </script>

</head>

<body>