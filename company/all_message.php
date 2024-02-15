<?php
$pagetitle = 'تواصل معنا';
ob_start();
session_start();
$com_navbar = 'com';
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

?>

    <div class="all_message">
        <div class="container">
            <div class="data">
                <h2> الرسائل </h2>
                <?php
                $stmt = $connect->prepare("
           SELECT t1.to_person, t1.from_person, t1.chat_id, t1.msg, t1.send_type, t1.date,
		   ind.ind_image as i_img  
           FROM chat t1
           LEFT JOIN chat t2 ON
               (t1.to_person = t2.to_person AND t1.from_person = t2.from_person AND t1.chat_id < t2.chat_id)
			   
			  LEFT JOIN ind_register  ind ON
               (t1.to_person = ind.ind_username or t1.from_person = ind.ind_username)
			   
           WHERE (t1.to_person = ? OR t2.from_person = ?) AND t2.chat_id IS NULL
           GROUP BY t1.chat_id, t1.to_person, t1.from_person, t1.msg, t1.send_type, t1.date
           ORDER BY t1.chat_id DESC
       ");
                $stmt->execute(array($_SESSION['com_username'], $_SESSION['com_username']));
                $allmessage = $stmt->fetchAll();
                $count = $stmt->rowCount();

                if ($count > 0) {
                    foreach ($allmessage as $message) {
                        if ($message['from_person'] != $_SESSION['com_id']) {
                            $other_person = $message['from_person'];
                        } else {
                            $other_person = $message['to_person'];
                        }
                ?>
                        <a href="com_message.php?other=<?php echo $other_person; ?>" class="message_link">
                            <div class="message_data">
                                <div class="image">

							<?php 
							$i_src  ="../images/message_logo.png" ;
							if ( $message['i_img'] != '' ){ $i_src  ="../ind_images_upload/" . $message['i_img'] ; } ?>
                            <img src="<?php echo $i_src;?>" alt="">
                                               </div>
                                <div class="info">
                                    <p> <?php echo $message['from_person']; ?> </p>
                                    <p> <?php echo $message['msg']; ?> </p>
                                    <span> <i class="fa fa-clock-o"></i> <?php echo $message['date']; ?> </span>
                                </div>
                            </div>
                        </a>
                    <?php
                    }
                } else {
                    ?>
                    <p style="font-size: 18px;"> لا يوجد رسائل لديك الان </p>
                <?php
                }

                ?>
            </div>
        </div>
    </div>

<?php

    include $tem . "footer.php";
} else {
    header('Location:index.php');
    exit();
}


?>