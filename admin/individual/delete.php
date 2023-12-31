<?php
if (isset($_GET['ind_id']) && is_numeric($_GET['ind_id'])) {
    $ind_id = $_GET['ind_id'];

    $stmt = $connect->prepare('SELECT * FROM ind_register WHERE ind_id= ?');
    $stmt->execute([$ind_id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare('DELETE FROM ind_register WHERE ind_id=?');
        $stmt->execute([$ind_id]);
        if ($stmt) { ?>
<div class="alert-success">
    <?php echo $lang['delete_message']; ?>
    <?php header('LOCATION:main.php?dir=individual&page=report'); ?>
    <?php }
    }
}