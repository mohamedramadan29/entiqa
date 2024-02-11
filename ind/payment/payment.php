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

        require_once('vendor/autoload.php');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.tap.company/v2/charges', [
            'json' => [
                "amount" => $ind_sub_amount,
                "currency" => "SAR",
                "threeDSecure" => true,
                "save_card" => false,
                "description" => "الاشتراك كمتدرب في منصة انتقاء",
                "reference" => [
                    "transaction" => "txn_01",
                    "order" => "ord_01"
                ],
                "receipt" => [
                    "email" => true,
                    "sms" => true
                ],
                "customer" => [
                    "first_name" => $name,
                    "email" => $email,
                    "phone" => [
                        "number" => $phone
                    ]
                ],
                "source" => [
                    "id" => "src_all"
                ],
                "post" => [
                    "url" => "https://entiqa.co/ind/payment/payment"
                ],
                "redirect" => [
                    "url" => "https://entiqa.co/ind/payment/callback"
                ],
                "metadata" => [
                    "udf1" => "Metadata 1"
                ]
            ],
            'headers' => [
                'Authorization' => 'Bearer sk_live_bhFLinpP5X2jNCc7dZM0ytqY',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);

        // ...

        $output = $response->getBody();
        $output = json_decode($output);
        header("location:" . $output->transaction->url);
    } else {
        header('Location:index');
    }
} else {
    header('Location:index');
}
