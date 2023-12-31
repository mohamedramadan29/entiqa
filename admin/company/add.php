 
 <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['add_car'])) {

    $image_image1_name = $_FILES['image1']['name'];
    $image_image1_tem = $_FILES['image1']['tmp_name'];
    $image_image1_type = $_FILES['image1']['type'];
    $image_image1_size = $_FILES['image1']['size'];
    $image_allowed_extention = ['jpg', 'jpeg', 'png'];
            $wha_name = filter_var(
                $_POST['wha_name'],
                FILTER_SANITIZE_STRING
            );
            $wha_name_en = filter_var(
                $_POST['wha_name_en'],
                FILTER_SANITIZE_STRING
            );
            $wha_order = filter_var(
                $_POST['wha_order'],
                FILTER_SANITIZE_STRING
            );
            $wha_number = filter_var(
                $_POST['wha_number'],
                FILTER_SANITIZE_STRING
            );
    $wha_info = filter_var(
        $_POST['wha_info'],
        FILTER_SANITIZE_STRING
    );
    $wha_info_en = filter_var(
        $_POST['wha_info_en'],
        FILTER_SANITIZE_STRING
    );

            /// More Validation To Show Error
            $formerror = [];
            if (empty($wha_name)) {
                $formerror[] = 'Please Insert Name';
            }
            foreach ($formerror as $errors) {
                echo "<div class='alert alert-danger danger_message'>" .
                    $errors .
                    '</div>';
            }

            if (empty($formerror)) {
                if(!empty( $_FILES['image1']['name'])){
                    $image_uploaded = time().'_'.$image_image1_name;
                    move_uploaded_file($image_image1_tem,'uploads/'.$image_uploaded);
                }else{
                    $image_uploaded="";
                }
                $stmt = $connect->prepare("INSERT INTO whatsapp (wha_name,wha_name_en,wha_image,wha_order,wha_info,wha_info_en,wha_number)
                VALUES (:zname,:zname_en,:zimage,:zorder,:zinfo,:zinfo_en,:zwha_number)");
                $stmt->execute([
                    'zname' => $wha_name,
                    'zname_en' => $wha_name_en,
                    'zimage' => $image_uploaded ,
                    'zorder' => $wha_order,
                    'zinfo' => $wha_info,
                    'zinfo_en' => $wha_info_en,
                    'zwha_number'=>$wha_number
                ]);
                if ($stmt) { ?>
    <div class="alert-success ">
        تم اضافة مستشار جديد بنجاح
        <?php // header('refresh:3;url=main.php?dir=city&page=report'); ?>
    </div>

<?php }
            }
        }
    }