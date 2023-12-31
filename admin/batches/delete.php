<?php
if (isset($_GET['batch_id']) && is_numeric($_GET['batch_id'])) {
    $batch_id = $_GET['batch_id'];

    $stmt = $connect->prepare('SELECT * FROM batches WHERE batch_id= ?');
    $stmt->execute([$batch_id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare('DELETE FROM batches WHERE batch_id=?');
        $stmt->execute([$batch_id]);
        if ($stmt) { ?>
<div class="alert-success">
    <?php echo $lang['delete_message']; ?>
    <?php header('LOCATION:main.php?dir=batches&page=report'); ?>
    <?php }
    }
}