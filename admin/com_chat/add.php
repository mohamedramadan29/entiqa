<?php
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
    $currentDateTime = new DateTime();
    $date = $currentDateTime->format("Y-m-d H:i:s");
    $from_person = 'admin';
    $to_person = $_POST['to_person'];
    $message_content = sanitizeInput($_POST['message_data']);
    $message_content = htmlspecialchars_decode($message_content);
    $message_content = preg_replace('/\b(https?|ftp|file):\/\/[^\s<>\[\]]+/', '<a href="$0" target="_blank">$0</a>', $message_content);

    $formerror = [];

    if (empty($message_content) && ($location == ',')) {
        $formerror[] = 'من فضلك ادخل محتوي الرساله أو قم بتحميل مرفق';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("INSERT INTO chat (from_person,to_person, msg,msg_files,date,send_type)
                VALUES(:zfrom_person,:zto_person,:zmessage,:zmsg_files,:zdate,:zsend_type)");
        $stmt->execute(array(
            "zfrom_person" => $from_person,
            "zto_person" => $to_person,
            "zmessage" => $message_content,
            "zmsg_files" => $location,
            "zdate" => $date,
            "zsend_type" => 'admin'
        ));
        if ($stmt) {
            header("LOCATION:main.php?dir=com_chat&page=chat&com_username=" . $_POST['to_person']); ?>
            ?>
<?php
        }
    }
}
?>