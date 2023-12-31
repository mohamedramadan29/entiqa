<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $with_id = $_POST['with_id'];
    $with_status = filter_var(
        $_POST['with_status'],
        FILTER_SANITIZE_STRING
    );
    $stmt = $connect->prepare("UPDATE withdraw SET with_status=? WHERE id=?");
    $stmt->execute([$with_status, $with_id]);
    if ($stmt) { ?>
        <div class="container">
            <div class="alert-success">
                تم تعديل حالة الشركة بنجاح
                <?php
                ?>
            </div>
        </div>
<?php }
}
