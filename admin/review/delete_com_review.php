<?php
if (isset($_GET['rev_id']) && is_numeric($_GET['rev_id'])) {
    $rev_id = $_GET['rev_id'];

    $stmt = $connect->prepare('SELECT * FROM company_review WHERE rev_id= ?');
    $stmt->execute([$rev_id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare('DELETE FROM company_review WHERE rev_id=?');
        $stmt->execute([$rev_id]);
        if ($stmt) { ?>
<div class="alert-success">
    <?php echo $lang['delete_message']; ?>
    <?php header('LOCATION:main.php?dir=review&page=com_review'); ?>
    <?php }
    }
}