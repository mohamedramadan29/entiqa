 <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['add_car'])) {

            $image_image1_name = $_FILES['image1']['name'];
            $image_image1_tem = $_FILES['image1']['tmp_name'];
            $image_image1_type = $_FILES['image1']['type'];
            $image_image1_size = $_FILES['image1']['size'];
            $image_allowed_extention = ['jpg', 'jpeg', 'png'];
            $cou_name = filter_var(
                $_POST['cou_name'],
                FILTER_SANITIZE_STRING
            );
            $cou_name_en = filter_var(
                $_POST['cou_name_en'],
                FILTER_SANITIZE_STRING
            );
            $cou_info = filter_var(
                $_POST['cou_info'],
                FILTER_SANITIZE_STRING
            );
            $cou_info_en = filter_var(
                $_POST['cou_info_en'],
                FILTER_SANITIZE_STRING
            );

            /// More Validation To Show Error
            $formerror = [];
            if (empty($cou_name)) {
                $formerror[] = 'Please Insert Name';
            }
            foreach ($formerror as $errors) {
                echo "<div class='alert alert-danger danger_message'>" .
                    $errors .
                    '</div>';
            }

            if (empty($formerror)) {
                if (!empty($_FILES['image1']['name'])) {
                    $image_uploaded = time() . '_' . $image_image1_name;
                    move_uploaded_file($image_image1_tem, 'uploads/' . $image_uploaded);
                } else {
                    $image_uploaded = "";
                }
                $stmt = $connect->prepare("INSERT INTO country (cou_name,cou_name_en,cou_info,cou_info_en,cou_image)
                VALUES (:zname,:zname_en,:zinfo,:zinfo_en,:zimage)");
                $stmt->execute([
                    'zname' => $cou_name,
                    'zname_en' => $cou_name_en,
                    'zinfo' => $cou_info,
                    'zinfo_en' => $cou_info_en,
                    'zimage' => $image_uploaded,
                ]);
                if ($stmt) { ?>
                 <div class="alert-success ">
                     تم اضافة دولة جديدة بنجاح
                     <?php // header('refresh:3;url=main.php?dir=city&page=report'); 
                        ?>
                 </div>

 <?php }
            }
        }
    }
