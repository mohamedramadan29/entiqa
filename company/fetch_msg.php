<?php
ob_start();
session_start();
$pagetitle = 'الرسائل';
include "../connect.php";
include 'init.php';
$com_id = $_SESSION['com_id'];
$com_username = $_SESSION['com_username'];
if (isset($_GET["other"])) {
    $other_person = $_GET["other"];
} else {
    $other_person = 'admin';
}
if ($other_person == "admin") {
    $stmt = $connect->prepare("SELECT * FROM admin WHERE admin_name=?");
    $stmt->execute(array($other_person));
    $user_data = $stmt->fetch();
} else {
    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_username=?");
    $stmt->execute(array($other_person));
    $user_data = $stmt->fetch();
}
$stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
$stmt->execute(array($_SESSION["com_id"]));
$com_data = $stmt->fetch();
$stmt = $connect->prepare("SELECT * FROM chat WHERE (to_person = ? AND from_person = ?) OR (to_person = ? AND from_person = ?) ORDER BY chat_id");
$stmt->execute(array($com_username, $other_person, $other_person, $com_username));
$allmessage = $stmt->fetchAll();
foreach ($allmessage as $message) {
    if ($message["from_person"] == $other_person) { ?>
        <div class="send_message sender_message">
            <div>
                <?php
                if ($message['from_person'] != 'admin') {
                    if ($user_data['ind_image'] == "") { ?>
                        <a href="ind_profile.php?username=<?php echo $other_person ?>">
                            <img src="../images/avatar.png" alt="">
                        </a>
                    <?php
                    } else { ?>
                        <a href="ind_profile.php?username=<?php echo $other_person ?>">
                            <img src="../ind_images_upload/<?php echo $user_data['ind_image']; ?>" alt="">
                        </a>
                    <?php
                    }
                } else {
                    ?>
                    <img style="object-position: center; object-fit:cover;" src="../images/annn.jpg" alt="">
                <?php
                }

                ?>
            </div>
            <div class="message_info">
                <?php
                if ($other_person == 'admin') { ?>
                    <p class="sender_name"> فريق انتقاء </p>
                <?php
                } else {
                ?>
                    <p class="sender_name"> <?php echo $user_data['ind_name'] ?> </p>
                <?php
                }
                ?>
                <p class="sender_time"> <?php echo formatTimeDifference($message['date']); ?></p>
                <p class="sender_m_data"> <?php echo $message['msg']; ?>
                </p>
                <?php
                if ($message['msg_files'] != null && $message['msg_files'] != ',') {
                    $uploaded_files = explode(',', $message['msg_files']);
                    // array_pop($uploaded_files);
                    $uploaded_files = array_slice($uploaded_files, 0, -1);
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
                <?php
                if ($com_data['com_image'] == "") { ?>
                    <a href="profile">
                        <img src="../images/avatar.png" alt="">
                    </a>
                <?php
                } else { ?>
                    <a href="profile">
                        <img src="../ind_images_upload/<?php echo $com_data['com_image']; ?>" alt="">
                    </a>
                <?php
                }
                ?>
            </div>
            <div class="message_info">
                <p class="sender_name"> <?php echo $com_data["com_name"]; ?> </p>
                <p class="sender_time"> <?php echo formatTimeDifference($message['date']); ?> </p>
                <p class="sender_m_data"> <?php echo $message['msg'];  ?>
                </p>
                <?php
                if ($message['msg_files'] != null && $message['msg_files'] != ',') {
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