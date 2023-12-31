<?php
session_start();
include "../connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // credit gallary 
    $file = '';
    $file_tmp = '';
    $location = "";
    $uploadplace = "../ind_upload_files/";
    if (isset($_FILES['message_attachment']['name'])) {
        foreach ($_FILES['message_attachment']['name'] as $key => $val) {
            $file = $_FILES['message_attachment']['name'][$key];
            $file = str_replace(' ', '', $file);
            $file_tmp = $_FILES['message_attachment']['tmp_name'][$key];
            move_uploaded_file($file_tmp, $uploadplace . $file);
            $location .= $file . ",";
        }
    } else {
        $location = '';
    }
    date_default_timezone_set('Asia/Riyadh');
    $currentDateTime = new DateTime();
    $date = $currentDateTime->format("Y-m-d H:i:s");
    $from_person = $_SESSION['com_username'];
    $to_person = $_POST['to_person'];
    $send_type = 'com';
    $message_content = $_POST['message_data'];
    $message_content = htmlspecialchars_decode($message_content);
    $message_content = preg_replace('/\b(https?|ftp|file):\/\/[^\s<>\[\]]+/', '<a href="$0" target="_blank">$0</a>', $message_content);

    $stmt = $connect->prepare("INSERT INTO chat (from_person,to_person, msg,msg_files,date,send_type)
                VALUES(:zfrom_person,:zto_person,:zmessage,:zmsg_files,:zdate,:zsend_type)");
    $stmt->execute(array(
        "zfrom_person" => $from_person,
        "zto_person" => $to_person,
        "zmessage" => $message_content,
        "zmsg_files" => $location,
        "zdate" => $date,
        "zsend_type" => $send_type,
    ));
    if ($stmt) {
        $stmt = $connect->prepare("INSERT INTO message_notification (noti_title,noti_person_link,noti_com_link,sender)
        VALUES(:znoti_title,:znoti_perspn,:znoti_com,:zsender)");
        $stmt->execute(array(
            "znoti_title" => "رسالة جديدة",
            "znoti_perspn" => $to_person,
            "znoti_com" => $_SESSION['com_id'],
            "zsender" => $_SESSION['com_id'],
        ));
?>
        <embed loop="false" hidden="true" src="sound.wav" autoplay="true">
<?php
    }
}
