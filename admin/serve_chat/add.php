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
    $date = date("Y-m-d");
    $from_person = $_SESSION['admin_name'];
    $to_person = $_POST['to_person'];
    $message_content = $_POST['message_data'];
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
        header('LOCATION:main.php?dir=chat&page=chat&ind_username=' . $to_person); ?>
        ?>
<?php
    }
}
?>