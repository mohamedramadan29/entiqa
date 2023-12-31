<?php
$ind_username = $_GET['ind_username'];
$admin_name = $_GET['admin_name'];
$ind_username = $_GET['ind_username'];
$admin_id = $_SESSION['coash_id'];
$stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_username=?");
$stmt->execute(array($ind_username));
$ind_data = $stmt->fetch();
$stmt = $connect->prepare("SELECT * FROM chat WHERE to_person = ? AND from_person = ? OR to_person= ?  AND from_person= ? AND coash_id=?  ORDER BY chat_id");
$stmt->execute(array($admin_name, $ind_data['ind_username'], $ind_data['ind_username'], $admin_name, $_SESSION['coash_id']));
$allmessage = $stmt->fetchAll();
foreach ($allmessage as $message) {
    if ($message["from_person"] == $admin_name) { ?>
        <div class="send_message sender_message">
            <div>
                <img src="uploads/logo.png" alt="">
            </div>
            <div class="message_info">
                <p class="sender_name">المدرب</p>
                <p class="sender_time" style="font-size: 16px;"> <?php echo formatTimeDifference($message['date']); ?> <a href="main.php?dir=coash_chat_batch&page=delete&chat_id=<?php echo $message['chat_id']; ?>&user_name=<?php echo $message['to_person']; ?>" style="text-decoration: none; color: #fff; padding:5px;" class="badge badge-danger"> <i style=" margin:auto; padding:0; text-align:center;font-size:14px" class="fa fa-trash"></i> </a> </p>
                <p class="sender_m_data"> <?php echo $message['msg']; ?>
                </p>
                </p>
                <?php
                if ($message['msg_files'] != null && $message['msg_files'] !== ',') {
                    $uploaded_files = explode(',', $message['msg_files']);
                    array_pop($uploaded_files);
                    foreach ($uploaded_files as $file) {
                        $file_data = $file;
                ?>
                        <p class="sender_m_data"> <a target="_blank" href="../ind_upload_files/<?php echo $file; ?>"><?php echo $file; ?></a> </p>
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
                <img src="uploads/avatar.png" alt="">
            </div>
            <div class="message_info">
                <p class="sender_name"> <?php echo $ind_data["ind_name"]; ?> </p>
                <p class="sender_time"> <?php echo formatTimeDifference($message['date']); ?> </p>
                <p class="sender_m_data"> <?php echo $message['msg'];  ?>
                </p>
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