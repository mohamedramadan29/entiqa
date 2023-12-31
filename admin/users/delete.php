<?php
if (isset($_GET['cus_id']) && is_numeric($_GET['cus_id'])) {
    $cus_id = $_GET['cus_id'];

    $stmt = $connect->prepare('SELECT * FROM customer WHERE cus_id= ?');
    $stmt->execute([$cus_id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare('DELETE FROM customer WHERE cus_id=?');
        $stmt->execute([$cus_id]);
        if ($stmt) { ?>
<div class="alert-success">
    <?php echo $lang['delete_message']; ?>
    <?php header('LOCATION:main.php?dir=users&page=report'); ?>
    <?php }
    }
}