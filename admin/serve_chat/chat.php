<?php
$ind_username = $_GET['ind_username'];
$admin_id = $_SESSION['admin_id'];
$admin_name = 'admin';
$stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_username=?");
$stmt->execute(array($ind_username));
$ind_data = $stmt->fetch();


// UPDATE MESSAGE NOTI 
$stmt = $connect->prepare("UPDATE chat SET admin_noti = 1 WHERE to_person='admin' AND admin_noti = 0");
$stmt->execute();
?>
<div class="chat_section">
    <div class="container">
        <div class="data" id="chat">
            <div class="bread">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                         
                        <li class="breadcrumb-item active" aria-current="page"> تواصل مع العملاء </li>
                    </ol>
                </nav>
            </div>
            <?php
            $stmt = $connect->prepare("SELECT * FROM chat WHERE to_person = ? AND from_person = ? OR to_person= ?  AND from_person= ?  ORDER BY chat_id");
            $stmt->execute(array($admin_name, $ind_data['ind_username'], $ind_data['ind_username'], $admin_name));
            $allmessage = $stmt->fetchAll();
            foreach ($allmessage as $message) {
                if ($message["from_person"] == $admin_name) { ?>
                    <div class="send_message sender_message">
                        <div>
                            <img src="uploads/logo.png" alt="">
                        </div>
                        <div class="message_info">
                            <p class="sender_name">موسسة انتقاء</p>
                            <p class="sender_time"> <?php echo $message['date']; ?> </p>
                            <p class="sender_m_data"> <?php echo $message['msg']; ?>
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
                } else { ?>
                    <div class="send_message recever_message">
                        <div>
                            <img src="uploads/avatar.png" alt="">
                        </div>
                        <div class="message_info">
                            <p class="sender_name"> <?php echo $ind_data["ind_name"]; ?> </p>
                            <p class="sender_time"> <?php echo date("h:i:sa"); ?> </p>
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
        </div>
        <div class="form">
            <form class="form-group insert ajax_form" action="main_ajax.php?dir=chat&page=add" method="POST" autocomplete="on" enctype="multipart/form-data">
                <div class="message_text">
                    <input type="hidden" name="to_person" value="<?php echo $ind_data['ind_username']; ?>">
                    <textarea name="message_data" id=""></textarea>
                    <input type="file" name="message_attachment[]" multiple class="form-control">
                    <button type="submit" class="btn btn-primary"> ارسال <i class="fa fa-paper-plane"></i></button>
                </div>
            </form>

        </div>
    </div>
</div>