<?php
if (isset($_GET['com_id']) && is_numeric($_GET['com_id'])) {
    $com_id = $_GET['com_id'];

    $stmt = $connect->prepare('SELECT * FROM company_register WHERE com_id= ?');
    $stmt->execute([$com_id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare('DELETE FROM company_register WHERE com_id=?');
        $stmt->execute([$com_id]);
        if ($stmt) { ?>
<div class="alert-success">
    <?php echo $lang['delete_message']; ?>
    <?php header('LOCATION:main.php?dir=company&page=report'); ?>
    <?php }
    }
}