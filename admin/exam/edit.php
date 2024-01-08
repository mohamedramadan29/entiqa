<?php

if (!isset($_SESSION['admin_session']) && !isset($_SESSION['coash_id'])) {
    header("Location:index");
}


if (isset($_GET['exam_id'])) {
    $exam_id = $_GET['exam_id'];
    $stmt = $connect->prepare("SELECT * FROM exam WHERE ex_id = ?");
    $stmt->execute(array($exam_id));
    $count_exam = $stmt->rowCount();
    if ($count_exam > 0) {
        $type = $stmt->fetch();
    } else {
        header("Location:main.php?dir=exam&page=report");
    }
}
if (isset($_POST['add_car'])) {
    $formerror = [];
    $ex_id = sanitizeInput($_POST['ex_id']);
    $ex_title = sanitizeInput($_POST['ex_title']);
    $ex_total_question = sanitizeInput($_POST['ex_total_question']);
    $ex_time = sanitizeInput($_POST["ex_time"]);
    $ex_date_publish = sanitizeInput($_POST["ex_date_publish"]);
    $ex_type = sanitizeInput($_POST["ex_type"]);
    $ex_batch_num = sanitizeInput($_POST["ex_batch_num"]);
    $data_now = date("Y-m-d");
    /////// get the batch data to check if the ex publish data > batch start or not
    $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_id = ?");
    $stmt->execute(array($ex_batch_num));
    $batch_data = $stmt->fetch();
    $batch_start_data = $batch_data['batch_start'];
    if ($ex_date_publish < $batch_start_data) {
        $formerror[] = 'يجب ان يكون نشر الامتحان بعد انطلاق بدء الدفعه ';
    }
    if ($ex_date_publish < $data_now) {
        $formerror[] = 'لا يمكنك التعديل علي هذا الأختبار لأنه تم نشرة بالفعل';
    }
    if (!preg_match("/^[\p{Arabic}\p{Latin}\s]+$/u", $ex_title)) {
        $formerror[] = ' من فضلك ادخل العنوان بالشكل الصحيح ';
    }

    if (isset($_SESSION['coash_id'])) {
        $coash_id = $_SESSION['coash_id'];
    } else {
        $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_id = ?");
        $stmt->execute(array($ex_batch_num));
        $batch_data = $stmt->fetch();
        $coash_id = $batch_data['batch_coach'];
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE exam SET ex_title=?,ex_total_question=?,
        ex_time=?,ex_date_publish=?,
        ex_type=?,ex_batch_num=?,coash_id=? WHERE ex_id =?");
        $stmt->execute([
            $ex_title, $ex_total_question,
            $ex_time, $ex_date_publish,
            $ex_type, $ex_batch_num, $coash_id, $ex_id
        ]);
        if ($stmt) { ?>
            <?php

            // header('refresh:2;url=main.php?dir=exam&page=edit&exam_id=' . $exam_id);
            header('refresh:2000;url=main.php?dir=exam&page=report');

            ?>
            <script src="plugins/jquery/jquery.min.js"></script>
            <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
            <script>
                $(function() {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: ' تم التعديل بنجاح  ',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = 'main.php?dir=exam&page=report';
                    });
                })
            </script>
        <?php

        }
    } else {
        foreach ($formerror as $error) {
        ?>
            <div class="alert alert-danger"> <?php echo $error; ?> </div>
<?php
        }
    }
}
?>

<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page"> تعديل الأختبار </li>
                </ol>
            </nav>
        </div>

        <div class="card">

            <div class="card-body">
                <div class="myform">
                    <form class="form-group insert ajax_form" action="" method="POST" autocomplete="on" enctype="multipart/form-data">
                        <input type="hidden" name="ex_id" value="<?php echo $type['ex_id'] ?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="box2">
                                    <label id="name">عنوان الاختبار
                                        <span> * </span> </label>
                                    <input required maxlength="50" class="form-control" type="text" name="ex_title" value="<?php echo $type['ex_title'] ?>">
                                </div>
                                <div class="box2">
                                    <label id="name"> ادخل عدد الاسئلة
                                        <span> * </span> </label>
                                    <input required min="1" max="50" class="form-control" type="number" name="ex_total_question" value="<?php echo $type['ex_total_question'] ?>">
                                </div>
                                <div class="box2">
                                    <label id="name"> ادخل زمن الاختبار
                                        <span> * </span> </label>
                                    <input required class="form-control" type="number" min="5" max="180" name="ex_time" value="<?php echo $type['ex_time'] ?>">
                                </div>
                                <div class="box2">
                                    <label id="name"> تاريخ نشر الاختبار علي المنصة
                                        <span> * </span> </label>
                                    <input required class="form-control" type="date" name="ex_date_publish" value="<?php echo $type['ex_date_publish'] ?>">
                                </div>
                                <div class="box2">
                                    <label id="name_en"> نوع الاختبار <span> * </span></label>
                                    <select required class="form-control" name="ex_type">
                                        <option value=""> -- اختر توع الاختبار -- </option>
                                        <option <?php if ($type['ex_type'] == 'قصير') echo "selected"; ?> value="قصير"> قصير </option>
                                        <option <?php if ($type['ex_type'] == 'نهائي') echo "selected"; ?> value="نهائي"> نهائي </option>
                                        <option <?php if ($type['ex_type'] == 'تحديد المستوي') echo "selected"; ?> value="تحديد المستوي"> تحديد المستوي </option>
                                    </select>
                                </div>
                                <div class="box2">
                                    <label id="name_en"> اختر الدفعه <span> * </span></label>
                                    <select required class="form-control" name="ex_batch_num">
                                        <option value=""> -- اختر رقم الدفعه -- </option>
                                        <?php
                                        if (isset($_SESSION['coash_id'])) {
                                            $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_coach=?");
                                            $stmt->execute(array($_SESSION['coash_id']));
                                        } else {
                                            $stmt = $connect->prepare("SELECT * FROM batches");
                                            $stmt->execute();
                                        }
                                        $allcoa = $stmt->fetchAll();
                                        foreach ($allcoa as $coa) {
                                        ?>
                                            <option <?php if ($type['ex_batch_num'] == $coa['batch_id']) echo "selected"; ?> value="<?php echo $coa['batch_id'] ?>"><?php echo $coa['batch_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                        <option> </option>
                                    </select>
                                </div>
                                <div class="box submit_box">
                                    <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value="   تعديل الاختبار    ">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>

    </div>
</div>
</div>