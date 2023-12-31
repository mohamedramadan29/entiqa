<?php

ob_start();
session_start();
$pagetitle = '  رسائل التواصل ';
$ind_navabar = 'ind';
if (isset($_SESSION['ind_id'])) {
    include 'init.php';
?>
    <div class="all_message">
        <div class="container">
            <div class="data">
                <h2> الرسائل </h2>
                <?php
                $stmt = $connect->prepare("
           SELECT t1.to_person, t1.from_person, t1.chat_id, t1.msg, t1.send_type, t1.date,t1.coash_id,
           com.com_image as c_img  
           FROM chat t1
           LEFT JOIN chat t2 ON
               (t1.to_person = t2.to_person AND t1.from_person = t2.from_person AND t1.chat_id < t2.chat_id)
               LEFT JOIN company_register  com ON
               (t1.to_person = com.com_username or t1.from_person = com.com_username)
			      
           WHERE (t1.to_person = ? OR t2.from_person = ?) AND t2.chat_id IS NULL
           GROUP BY t1.chat_id, t1.to_person, t1.from_person, t1.msg, t1.send_type, t1.date
           ORDER BY t1.chat_id DESC
       ");
                $stmt->execute(array($_SESSION['ind_username'], $_SESSION['ind_username']));
                $allmessage = $stmt->fetchAll();
                $count = $stmt->rowCount();

                if ($count > 0) {
                    foreach ($allmessage as $message) {
                        if ($message['from_person'] != $_SESSION['ind_username']) {
                            $other_person = $message['from_person'];
                        } else {
                            $other_person = $message['to_person'];
                        }


                ?>
                        <?php
                        if ($other_person == 'coash') { ?>
                            <a href="ind_message.php?other=<?php echo $other_person; ?>&coash_id=<?php echo $message['coash_id']; ?>" class="message_link">
                            <?php
                        } else {
                            ?>
                                <a href="ind_message.php?other=<?php echo $other_person; ?>" class="message_link">
                                <?php
                            }
                                ?>
                                <div class="message_data">
                                    <div class="image">
                                        <?php
                                        $i_src  = "../images/an.jpg";
                                        if ($message['c_img'] != '') {
                                            $i_src  = "../ind_images_upload/" . $message['c_img'];
                                        } ?>
                                        <img src="<?php echo $i_src; ?>" alt="">

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