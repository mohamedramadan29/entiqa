
<?php
$pagetitle = 'تواصل معنا';
ob_start();
if (isset($_SESSION['com_id'])) {
    include 'init.php';
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
}
$c_un = $_GET["from"];

$stmt = $connect->prepare(" SELECT com_image from company_register  WHERE com_username = '$c_un'  ");
$stmt->execute();
$cc_image = $stmt->fetch();
$com_img = $cc_image['com_image'];
//if ($com_img==''){$com_img='../images/avatar.png';}


$i_un = $_GET["to"];

$stmt = $connect->prepare(" SELECT ind_image from ind_register  WHERE ind_username = '$i_un'  ");
$stmt->execute();
$ii_image = $stmt->fetch();
$ind_img = $ii_image['ind_image'];

/// Start Update Company View Allllert  

$stmt = $connect->prepare("UPDATE chat SET admin_noti=1 WHERE admin_noti=0 AND (from_person = ? AND to_person = ?) OR (from_person = ? AND to_person = ?)");
$stmt->execute(array($c_un, $i_un, $i_un, $c_un));

?>

<?php
$from_person = $_GET['from'];
$to_person = $_GET['to'];
$stmt = $connect->prepare("SELECT * FROM chat WHERE to_person = ? AND from_person = ? OR to_person= ?  AND from_person= ?  ORDER BY chat_id");
$stmt->execute(array($to_person, $from_person, $from_person, $to_person));
$getdata = $stmt->fetch();
if ($getdata['send_type']) {
}
/*$stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id=?");
$stmt->execute(array($ind_id));
$ind_data = $stmt->fetch();*/
?>
<div class="chat_section">
    <div class="container">
        <div class="data" id="chat">
            <div class="bread">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item active" aria-current="page"> الرسائل الخاصة بين الفرد والشركة </li>
                    </ol>
                </nav>
            </div>
            <?php
            $stmt = $connect->prepare("SELECT * FROM chat WHERE to_person = ? AND from_person = ? OR to_person= ?  AND from_person= ?  ORDER BY chat_id");
            $stmt->execute(array($to_person, $from_person, $from_person, $to_person));
            $allmessage = $stmt->fetchAll();
            foreach ($allmessage as $message) {
                if ($message['send_type'] == 'com') { ?>
                    <div class="send_message sender_message">
                        <div>

                            <?php
                            $i_src  = "uploads/avatar.png";
                            if ($com_img != '') {
                                $i_src  = "../ind_images_upload/" . $com_img;
                            } ?>
                            <img src="<?php echo $i_src; ?>" alt="">




                        </div>
                        <div class="message_info">
                            <p class="sender_name"> <a href="main.php?dir=com_chat&page=chat&com_username=<?php echo $message['from_person'] ?>"> <?php echo $message["from_person"]; ?></a></p>
                            <p class="sender_time"> <?php echo $message['date']; ?> </p>
                            <p class="sender_m_data"> <?php echo $message['msg']; ?>
                            </p>
                            <p class="sender_m_data"> <a target="_blank" href="uploads/<?php echo $message['msg_files'] ?>"><?php echo $message['msg_files'] ?></a> </p>
                        </div>
                    </div>
                <?php
                } else { ?>
                    <div class="send_message recever_message">
                        <div>

                            <?php
                            $i_src2  = "uploads/logo.png";
                            if ($ind_img != '') {
                                $i_src2  = "../ind_images_upload/" . $ind_img;
                            } ?>
                            <img src="<?php echo $i_src2; ?>" alt="">


                        </div>
                        <div class="message_info">
                            <p class="sender_name"> <a href="main.php?dir=chat&page=chat&ind_username=<?php echo $message['from_person'] ?>"> <?php echo $message["from_person"]; ?></a></p>
                            <p class="sender_time"> <?php echo date("h:i:sa"); ?> </p>
                            <p class="sender_m_data"> <?php echo $message['msg'];  ?>
                            </p>
                            <p class="sender_m_data"> <a target="_blank" href="uploads/<?php echo $message['msg_files'] ?>"><?php echo $message['msg_files'] ?></a> </p>
                        </div>
                    </div>
                <?php
                }
                ?>
            <?php
            }
            ?>
        </div>
    </div>
</div>
 