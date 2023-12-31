<?php
ob_start();
session_start();
$pagetitle = 'الرسائل';
include "../connect.php";
include 'init.php';
$ind_id = $_SESSION['ind_id'];
$ind_username = $_SESSION['ind_username'];
if (isset($_GET['coash_id'])) {
    $coash_id = $_GET['coash_id'];
}
if (isset($_GET["other"])) {
    $other_person = $_GET["other"];
} else {
    $other_person = 'admin';
}
if ($other_person == 'admin') {
    $stmt = $connect->prepare("SELECT * FROM admin WHERE admin_name=?");
    $stmt->execute(array($other_person));
    $user_data = $stmt->fetch();

    /// Update Message Notification
    $stmt = $connect->prepare("UPDATE chat SET ind_noti=1 WHERE 
      ind_noti=0 AND from_person=?");
    $stmt->execute(array('admin'));
} elseif ($other_person != 'admin' && $other_person != 'coash') {
    $stmt = $connect->prepare("SELECT * FROM  company_register WHERE com_username=?");
    $stmt->execute(array($other_person));
    $com_data = $stmt->fetch();
    /// Update Message Notification
    $stmt = $connect->prepare("UPDATE chat SET ind_noti=1 WHERE 
    ind_noti=0 AND from_person=?");
    $stmt->execute(array($_GET["other"]));


    /// Update Inter view Notification
    $stmt = $connect->prepare("UPDATE interview_notificaion SET update_at=? WHERE 
noti_person_link=? AND noti_com_link=?");
    $stmt->execute(array(date('y-m-d'), $_SESSION['ind_id'], $com_data['com_id']));
} elseif ($other_person == 'coash') {
    $stmt = $connect->prepare("UPDATE chat SET ind_noti=1 WHERE 
    to_person=? AND from_person='coash'");
    $stmt->execute(array($_SESSION['ind_username']));
}
$stmt = $connect->prepare("SELECT * FROM chat WHERE to_person = ? AND from_person = ? OR to_person= ?  AND from_person= ?  ORDER BY chat_id");
$stmt->execute(array($ind_username, $other_person, $other_person, $ind_username));
$allmessage = $stmt->fetchAll();
foreach ($allmessage as $message) {
    if ($message["from_person"] == $other_person) { ?>
        <div class="send_message sender_message">
            <div>
                <?php
                if ($message['from_person'] != 'admin' && $message['from_person'] != 'coash') {
                    if ($com_data['com_image'] == "") { ?>
                        <a href="company_profile.php?com_username=<?php echo $other_person ?>">
                            <img src="../images/avatar.png" alt="">
                        </a>
                    <?php
                    } else { ?>
                        <a href="company_profile.php?com_username=<?php echo $other_person ?>">
                            <img src="../ind_images_upload/<?php echo $com_data['com_image']; ?>" alt="">
                        </a>
                    <?php
                    }
                } else {
                    ?>

                    <img src="../images/an.jpg" alt="">
                <?php
                }

                ?>
            </div>
            <div class="message_info">
                <?php
                if ($other_person == 'admin') { ?>
                    <p class="sender_name"> فريق انتقاء </p>

                <?php
                } elseif ($other_person == 'coash') {
                ?>
                    <p class="sender_name"> المدرب </p>
                <?php
                } else {
                ?>
                    <p class="sender_name"> <?php echo $com_data['com_name']; ?> </p>
                <?php
                }
                ?>
                <p class="sender_time"> <?php echo formatTimeDifference($message['date']); ?> </p>
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
                <a href="profile">
                    <?php
                    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id = ?");
                    $stmt->execute(array($_SESSION['ind_id']));
                    $ind_data_image = $stmt->fetch();
                    if ($ind_data_image['ind_image'] == "") {
                        if ($ind_data_image['ind_gender'] == 'ذكر') {
                    ?>
                            <img src="../images/avatar.png" alt="">
                        <?php
                        } elseif ($ind_data_image['ind_gender'] == 'انثي') { ?>
                            <img src="../images/girl_avatar.png" alt="">
                        <?php
                        }
                        ?>

                    <?php
                    } else { ?>
                        <img src="../ind_images_upload/<?php echo $ind_data_image['ind_image']; ?>" alt="">
                    <?php

                    }
                    ?>
                </a>

            </div>
            <div class="message_info">
                <div class="messagea">
                    <p class="sender_name"> <?php echo $ind_data_image["ind_name"]; ?> </p>
                    <p class="sender_time"><?php echo formatTimeDifference($message['date']); ?> </p>
                </div>
                <p class="sender_m_data"> <?php echo $message['msg'];  ?></p>
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