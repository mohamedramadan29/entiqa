<?php
$com_username = $_GET['com_username'];
$admin_name = $_GET['admin_name'];
$stmt = $connect->prepare("SELECT * FROM company_register WHERE com_username=?");
$stmt->execute(array($com_username));
$com_data = $stmt->fetch();
$com_img = $com_data['com_image'];
$stmt = $connect->prepare("SELECT * FROM chat WHERE to_person = ? AND from_person = ? OR to_person= ?  AND from_person= ?  ORDER BY chat_id");
$stmt->execute(array($admin_name, $com_username, $com_username, $admin_name));
$allmessage = $stmt->fetchAll();
foreach ($allmessage as $message) {
    if ($message["from_person"] == $admin_name) { ?>
        <div class="send_message sender_message">
            <div>
                <img src="uploads/message_logo.png" alt="">
            </div>
            <div class="message_info">
                <p class="sender_name"><?php echo $message['from_person']; ?></p>
                <p class="sender_time" style="font-size: 16px;"> <?php echo formatTimeDifference($message['date']); ?> <a href="main.php?dir=com_chat&page=delete&chat_id=<?php echo $message['chat_id']; ?>&user_name=<?php echo $message['to_person']; ?>" style="text-decoration: none; color: #fff; padding:5px;" class="badge badge-danger"> <i style=" margin:auto; padding:0; text-align:center;font-size:14px" class="fa fa-trash"></i> </a> </p>
                <p class="sender_m_data"> <?php echo $message['msg']; ?>
                </p>
                <?php
                if ($message['msg_files'] != null && $message['msg_files'] !== ',') {
                    $uploaded_files = explode(',', $message['msg_files']);
                    array_pop($uploaded_files);
                    foreach ($uploaded_files as $file) {
                        $file_data = $file;
                ?>
                        <p class="sender_m_data"> <a target="_blank" href="../ind_upload_files/<?php echo $file; ?>"><?php echo $file ?></a> </p>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    <?php
    } else { ?>
        <div class="send_message recever_message">
            <div>
                <?php
                $i_src  = "uploads/avatar.png";
                if ($com_img != '') {
                    $i_src  = "../ind_images_upload/" . $com_img;
                } ?>
                <img src="<?php echo $i_src; ?>" alt="">
            </div>
            <div class="message_info">
                <p class="sender_name"> <?php echo $com_data["com_name"]; ?> </p>
                <p class="sender_time"> <?php echo formatTimeDifference($message['date']); ?> </p>
                <p class="sender_m_data"> <?php echo $message['msg'];  ?>
                </p>
                <?php
                if ($message['msg_files'] != null && $message['msg_files'] !== ',') {
                    $uploaded_files = explode(',', $message['msg_files']);
                    array_pop($uploaded_files);
                    foreach ($uploaded_files as $file) {
                        $file_data = $file;
                ?>
                        <p class="sender_m_data"> <a target="_blank" href="../ind_upload_files/<?php echo $file; ?>"><?php echo $message['msg_files'] ?></a> </p>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
<?php
}
?>