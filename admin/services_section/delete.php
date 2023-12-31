<?php
if (isset($_GET['cou_id']) && is_numeric($_GET['cou_id'])) {
    $cou_id = $_GET['cou_id'];

    $stmt = $connect->prepare('SELECT * FROM country WHERE cou_id= ?');
    $stmt->execute([$cou_id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare('DELETE FROM country WHERE cou_id=?');
        $stmt->execute([$cou_id]);
        if ($stmt) { ?>
<div class="alert-success">
    <?php echo $lang['delete_message']; ?>
    <?php header('LOCATION:main.php?dir=country&page=report'); ?>
    <?php }
    }
}