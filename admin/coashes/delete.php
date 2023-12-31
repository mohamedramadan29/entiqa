<?php
if (isset($_GET['co_id']) && is_numeric($_GET['co_id'])) {
    $co_id = $_GET['co_id'];

    $stmt = $connect->prepare('SELECT * FROM coshes WHERE co_id= ?');
    $stmt->execute([$co_id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare('DELETE FROM coshes WHERE co_id=?');
        $stmt->execute([$co_id]);
        if ($stmt) { ?>
            <div class="alert-success">
                <?php echo $lang['delete_message']; ?>
                <?php header('LOCATION:main.php?dir=coashes&page=report'); ?>
    <?php }
    }
}
