<?php
ob_start();
session_start();
$pagetitle = '  حسابي  ';
if (isset($_SESSION['ind_id'])) {
    include '../../connect.php';
    /* get the subsciption payment */
    $stmt = $connect->prepare("SELECT * FROM subscribe");
    $stmt->execute();
    $sub_data = $stmt->fetch();
    $ind_sub_amount = $sub_data['ind_subscribe'];
    $stmt = $connect->prepare("SELECT * FROM  ind_register WHERE ind_id = ?");
    $stmt->execute(array($_SESSION['ind_id']));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $ind_data = $stmt->fetch();
        $name = $ind_data['ind_name'];
        $email = $ind_data['ind_email'];
        $phone = $ind_data['ind_phone'];
        $name = $ind_data['ind_name'];
        $url = "https://ksa.paymob.com/v1/intention/";

        $data = json_encode(array(

            "amount" => $ind_sub_amount * 100,

            "currency" => "SAR",

            "payment_methods" => array(2460),


            "items" => array(

                array(

                    "name" => "الاشتراك  في منصة انتقاء",

                    "amount" => $ind_sub_amount * 100,

                    "description" => "الاشتراك  في منصة انتقاء",

                    "quantity" => 1

                )

            ),

            "billing_data" => array(

                "apartment" => "6",

                "first_name" => $name,

                "last_name" => ".",

               // "street" => "938, Al-Jadeed Bldg",

                // "building" => "939",

                "phone_number" => $phone,

                "country" => "Suadi",

                "email" => $email,

                // "floor" => "1",

                // "state" => "Alkhuwair"

            ),

            "customer" => array(

                "first_name" => $name,

                "last_name" => ".",

                "email" => $email,

                "extras" => array(

                    "re" => "22"

                )

            ),

            "extras" => array(

                "ee" => 22

            )

        ));

        $headers = array(

            'Authorization: Token sau_sk_live_1198b232ccae7565914f53f704e8d84313dd946f538a178b2433fad7f207844a',

            'Content-Type: application/json'

        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {

            echo 'Curl error: ' . curl_error($ch);
        }
        // إغلاق الاتصال بخادم PayMob
        curl_close($ch);
        // معالجة الرد هنا، يمكنك استخدام $response كما تحتاج
        $response_data = json_decode($response, true);
        var_dump($response_data);
        // التأكد من وجود client_secret في الرد
        if (isset($response_data['client_secret'])) {
            // إعادة توجيه المستخدم إلى صفحة الدفع مع إضافة client_secret إلى الرابط
            $client_secret = $response_data['client_secret'];
            echo $client_secret;
            $public_key = 'sau_pk_live_zDq77J84z7h9EkC1LCSVJwbNEFDwEuz4'; // استبدل بالمفتاح العام الخاص بك
            $payment_link = "https://ksa.paymob.com/unifiedcheckout/?publicKey={$public_key}&clientSecret={$client_secret}";
            header("Location: {$payment_link}");
            exit();
        } else {
            echo 'Error: client_secret not found in response.';
        }
    } else {
        header('Location:../../index');
    }
} else {
    header('Location:../../index');
}
