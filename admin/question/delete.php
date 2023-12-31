<?php
if (isset($_GET['ques_id']) && is_numeric($_GET['ques_id'])) {
    $ques_id = $_GET['ques_id'];
    // DELET QUESTION OPTIONS

    $stmt = $connect->prepare('SELECT * FROM question_option WHERE question_id =?');
    $stmt->execute(array($ques_id));
    $countq = $stmt->rowCount();
    if ($countq > 0) {
        $stmt = $connect->prepare("DELETE FROM question_option WHERE question_id =?");
        $stmt->execute(array($ques_id));
    }

    $stmt = $connect->prepare('SELECT * FROM question WHERE ques_id= ?');
    $stmt->execute([$ques_id]);
    $question_data = $stmt->fetch();
    $exam_id = $question_data['exam_id'];
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare('DELETE FROM question WHERE ques_id=?');
        $stmt->execute([$ques_id]);
        if ($stmt) { ?>
            <div class="alert-success">
                <?php echo $lang['delete_message']; ?>
                <?php header('LOCATION:main.php?dir=question&page=report&ex_id=' . $exam_id); ?>
    <?php }
    }
}
