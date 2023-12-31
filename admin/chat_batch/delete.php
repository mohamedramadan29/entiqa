<?php
if (isset($_GET['chat_id']) && is_numeric($_GET['chat_id'])) {
    $chat_id = $_GET['chat_id'];
    $batch_id = $_GET['batch_id'];
    $stmt = $connect->prepare('SELECT * FROM chat WHERE chat_id= ?');
    $stmt->execute([$chat_id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare('DELETE FROM chat WHERE chat_id=?');
        $stmt->execute([$chat_id]);
        if ($stmt) { ?>
            <div class="alert-success">
                <?php echo $lang['delete_message']; ?>
                <?php header('LOCATION:main.php?dir=chat_batch&page=chat&batch_id=' . $batch_id); ?>
    <?php }
    }
}
