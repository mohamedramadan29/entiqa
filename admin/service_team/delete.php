<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $connect->prepare('SELECT * FROM service_team WHERE id= ?');
    $stmt->execute([$id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare('DELETE FROM service_team WHERE id=?');
        $stmt->execute([$id]);
        if ($stmt) { ?>
<div class="alert-success">
    <?php echo $lang['delete_message']; ?>
    <?php header('Location:main.php?dir=service_team&page=report'); ?>
    <?php }
    }
}