<?php
require_once 'vendor/autoload.php';
$transport = (new Swift_SmtpTransport('smtp.entiqa.co', 587))
    ->setUsername('support@entiqa.co')
    ->setPassword('mohamedramadan2930');
$mailer = new Swift_Mailer($transport);
$body_message = '
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> انتقاء </title>
</head>
<body style="text-align:right;" dir="rtl">
    <div class="profile_page" style="background-color:#F0F5F0;">
        <div class="container">
            <div class="data">
                <div class="print_order" style="background-color: #fff;padding: 50px;border-radius: 30px;max-width: 75%;margin: auto;margin-top: 80px; margin-bottom:80px;">
                    <div class="print printable-content" id="print">
                        <div class="print_head">
                            <div class="logo" style="text-align: center;
                            padding: 20px;">
                                <img style="width: 160px; margin:auto;" src="https://entiqa.co/main_logo.png" alt="">
                            </div>
                            <div class="person_data">
                                <h2 style=" color: #1B1B1B; font-size: 25px; font-weight: bold; margin-bottom: 16px;">
                                    مرحبا 
                                </h2>
                                <p style="color: #585858;  font-size: 17px;  line-height: 1.8;">  
                                '. $message .'
                                </p>
                                
                            </div>
                             
                        </div>

                        <div class="order_totals">
                        <table cellpadding="0" cellspacing="0" border="1" style="border-collapse: collapse; border: 1px solid #a2a2a2;width:100%">
                        <tr>
                            <th style="padding: 7px;font-size: 17px;font-family: cairo;"><span> البريد الالكتروني : </span></th>
                            <th style="padding: 7px;font-size: 17px;font-family: cairo;"> info@entiqa.co </th>
                        </tr>
                        <tr>
                            <th style="padding: 7px;font-size: 17px;font-family: cairo;"><span> رقم الهاتف : </span></th>
                            <th style="padding: 7px;font-size: 17px;font-family: cairo;">  +966597319189 </th>
                        </tr>
                        <tr>
                            <th style="padding: 7px;font-size: 17px;font-family: cairo;"><span> العنوان : </span></th>
                            <th style="padding: 7px;font-size: 17px;font-family: cairo;">  الرياض - الملقا - طريق الامام سعود بن فيصل </th>
                        </tr>
                    </table>
                            <p class="thanks" style="margin-top: 25px;color: #1b1b1b; font-size:18px;"> مع اطيب الامنيات  <a href="https://entiqa.co/" style="text-decoration: none; color:#5c8e00;"> انتقاء </a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
';
$title = ' Entiqa ';

// Create a message
$message = (new Swift_Message('entiqa Information'))
    ->setFrom(['support@entiqa.co' => 'entiqa'])
    ->setTo($email)
    ->setBody($body_message, 'text/html');
$result = $mailer->send($message);
if ($result) {
    ?>
    <div class="alert alert-success bg-success" style="text-align: center; margin:auto"> تم الارسال بنجاح  </div>
    <?php  
} else {
    ?>
    
    <div class="alert alert-danger bg-danger"  style="text-align: center; margin:auto">  لم يتم الارسال  </div>
    <?php 
}
