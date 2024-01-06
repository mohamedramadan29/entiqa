<?php
if (isset($_GET['rev_id'])) {
    $rev_id = $_GET['rev_id'];
    $stmt = $connect->prepare('SELECT * FROM company_review 
    INNER JOIN company_register ON company_review.com_id = company_register.com_id  WHERE rev_id = ?');

    $stmt->execute(array($rev_id));
    $count_rev = $stmt->rowCount();
    if ($count_rev > 0) {
        $type = $stmt->fetch();
    } else {
        header("Location:main.php?dir=review&page=com_review");
    }
}
?>

<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page"> تعديل تقييم الشركة </li>
                </ol>
            </nav>
        </div>
        <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
        <!-- Content Row -->
        <!-- START MODEL VIEW  -->
        <div class="card">
            <div class="card-body">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $rev_id = $_POST['rev_id'];
                    $rev_show = $_POST['rev_show'];
                    $com_review = sanitizeInput($_POST['com_review']);
                    $formerror = [];
                    if (empty($com_review)) {
                        $formerror[] = 'من فضلك ادخل التقيم';
                    }
                    if (empty($formerror)) {
                        $stmt = $connect->prepare("UPDATE company_review SET com_review=?,rev_show=? WHERE rev_id=?");
                        $stmt->execute([$com_review, $rev_show, $rev_id]);
                        if ($stmt) { ?>
                            <div class="container">
                                <script src="plugins/jquery/jquery.min.js"></script>
                                <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
                                <script>
                                    $(function() {
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'success',
                                            title: 'تم التعديل بنجاح',
                                            showConfirmButton: false,
                                            timer: 2000
                                        }).then(function() {
                                            // Redirect using JavaScript after the success message
                                            window.location.href = 'main.php?dir=review&page=com_review';
                                        });
                                    });
                                </script>
                                <?php

                                ?>
                            </div>
                        <?php }
                    } else {
                        foreach ($formerror as $error) {
                        ?>
                            <div class="alert alert-danger"> <?php echo $error; ?> </div>
                <?php
                        }
                    }
                }
                ?>
                <div class="myform">
                    <form class="form-group insert ajax_form" action="" method="POST" autocomplete="on" enctype="multipart/form-data">
                        <input type="hidden" name="rev_id" value="<?php echo $type['rev_id'] ?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="box2">
                                    <label id="name"> عرض التقييم في الموقع
                                        <span> * </span> </label>
                                    <select required class="form-control" name="rev_show" id="">
                                        <option value=""> -- اختر -- </option>
                                        <option <?php if ($type['rev_show'] == 1) echo "selected"; ?> value="1"> نعم </option>
                                        <option <?php if ($type['rev_show'] == 0) echo "selected"; ?> value="0" value="0"> لا </option>
                                    </select>
                                </div>
                                <div class="box2">
                                    <label id="name"> الشركة
                                        <span> * </span> </label>
                                    <input disabled class="form-control" type="text" name="com_id" value="<?php echo $type['com_name']; ?>">
                                </div>
                                <div class="box2">
                                    <label id="name_en">التقييم <span> * </span></label>
                                    <textarea name="com_review" class="form-control"><?php echo $type['com_review']; ?></textarea>
                                </div>
                            </div>
                            <div class="box submit_box">
                                <input class="btn btn-outline-primary btn-sm" name="" type="submit" value=" تعديل التقييم ">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>



    </div>
</div>
</div>