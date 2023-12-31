<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cou_id = $_POST['cou_id'];
    $cou_name = $_POST['cou_name'];
    $cou_name_en = $_POST['cou_name_en'];
    $cou_info = $_POST['cou_info'];
    $cou_info_en = $_POST['cou_info_en'];
    if (isset($_FILES['image'])) {
        $image_image1_name = $_FILES['image']['name'];
        $imageType = $_FILES['image']['type'];
        $image_image1_tem  = $_FILES['image']['tmp_name'];
        $image_uploaded = time() . '_' . $image_image1_name;
        move_uploaded_file($image_image1_tem, 'uploads/' . $image_uploaded);
    } else {
        $image_image1_tem = "";
        $image_image1_name = "";
    }

    $stmt = $connect->prepare("UPDATE country SET cou_name=?,cou_name_en=?,
            cou_info=?,cou_info_en=? WHERE cou_id=?");
    $stmt->execute([
        $cou_name, $cou_name_en,
        $cou_info, $cou_info_en, $cou_id
    ]);

    if ($image_image1_tem != '') {
        $stmt = $connect->prepare("UPDATE country SET cou_image=? WHERE cou_id=?");
        $stmt->execute(array(
            $image_uploaded,
            $cou_id,
        ));
    }
    if ($stmt) { ?>
        <div class="container">
            <div class="alert-success">
                تم تعديل الدولة بنجاح

                <?php
                header("Location:main.php?dir=services_section&page=report");
                // header('refresh:3,url=main.php?dir=city&page=report'); 
                ?>
            </div>
        </div>

<?php }
}
