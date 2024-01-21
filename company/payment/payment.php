<?php
ob_start();
session_start();
$pagetitle = '  حسابي  ';
if (isset($_SESSION['com_id'])) {
    include '../../connect.php';
    /* get the subsciption payment */
    $stmt = $connect->prepare("SELECT * FROM subscribe LIMIT 1");
    $stmt->execute();
    $sub_data = $stmt->fetch();
    $ind_sub_amount = $sub_data['company_subscribe'];
    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id = ?");
    $stmt->execute(array($_SESSION['com_id']));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $ind_data = $stmt->fetch();
        $name = $ind_data['com_name'];
        $email = $ind_data['com_email'];
        $phone = $ind_data['com_phone'];
        require_once('vendor/autoload.php');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.tap.company/v2/charges', [
            'json' => [
                "amount" => $ind_sub_amount,
                "currency" => "SAR",
                "threeDSecure" => true,
                "save_card" => false,
                "description" => " شحن رصيد الشركة علي منصة انتقاء ",
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
                    "url" => "http://entiqa.online/test3/company/payment/payment"
                ],
                "redirect" => [
                    "url" => "http://entiqa.online/test3/company/payment/callback"
                ],
                "metadata" => [
                    "udf1" => "Metadata 1"
                ]
            ],
            'headers' => [
                'Authorization' => 'Bearer sk_test_nsgFzA1ulL5432S8YfeENq9U',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);

        // ...

        $output = $response->getBody();
        $output = json_decode($output);
        header("location:" . $output->transaction->url);
    } else {
        header('Location:../index');
    }
} else {
    header('Location:../index');
}
