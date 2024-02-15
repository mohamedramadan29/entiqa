<?php
$batch_id = $_GET['batch_id'];
$admin_id = $_SESSION['coash_id'];
$admin_name = 'admin';
$stmt = $connect->prepare("SELECT * FROM chat WHERE from_person = 'coash' AND send_type = 'coash' AND coash_id = ? AND batch_id = ?");
$stmt->execute(array($admin_id, $batch_id));
$allmessage = $stmt->fetchAll();
foreach ($allmessage as $message) {
    if ($message["from_person"] == 'coash') { ?>
        <div class="send_message sender_message">
            <div>
                <img src="uploads/message_logo.png" alt="">
            </div>
            <div class="message_info">
                <p class="sender_name">موسسة انتقاء</p>
                <p class="sender_time" style="font-size: 16px;"> <?php echo formatTimeDifference($message['date']); ?> <a href="main.php?dir=chat_batch&page=delete&chat_id=<?php echo $message['chat_id']; ?>&batch_id=<?php echo $batch_id; ?>" style="text-decoration: none; color: #fff; padding:5px;" class="badge badge-danger"> <i style=" margin:auto; padding:0; text-align:center;font-size:14px" class="fa fa-trash"></i> </a> </p>
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
    }
}
?>