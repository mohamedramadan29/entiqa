<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"> أضافة اختبار جديد </li>
                </ol>
            </nav>
        </div>

        <div class="card">
            <div class="card-body">
                <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['add_car'])) {
                        if (isset($_SESSION['coash_id'])) {
                            $coash_id = $_SESSION['coash_id'];
                        } else {
                            $coash_id = null;
                        }
                        $ex_title = sanitizeInput($_POST['ex_title']);
                        $ex_total_question = sanitizeInput($_POST['ex_total_question']);
                        $ex_time = $_POST["ex_time"];
                        $ex_date_publish = $_POST["ex_date_publish"];

                        $ex_type = $_POST["ex_type"];
                        $ex_batch_num =  '-- اختر رقم الدفعه --';

                        /// More Validation To Show Error
                        $formerror = [];
                        if (empty($ex_title)) {
                            $formerror[] = '  من فضلك ادخل عنوان الاختبار  ';
                        }
                        if (!preg_match("/^[\p{Arabic}\p{Latin}\s]+$/u", $ex_title)) {
                            $formerror[] = ' من فضلك ادخل العنوان بالشكل الصحيح ';
                        }
                        if (empty($formerror)) {
                            $stmt = $connect->prepare("INSERT INTO exam (ex_title,ex_total_question,
                ex_time,ex_date_publish,
                ex_type,ex_batch_num,coash_id)
                VALUES (:zex_title,:zex_total_question,
                :zex_time,:zex_date_publish,
                :zex_type,:zex_batch_num,:zcoash_id)");
                            $stmt->execute([
                                'zex_title' => $ex_title,
                                'zex_total_question' => $ex_total_question,
                                'zex_time' => $ex_time,
                                'zex_date_publish' => $ex_date_publish,
                                'zex_type' => $ex_type,
                                'zex_batch_num' => $ex_batch_num,
                                'zcoash_id' => $coash_id,
                            ]);
                            if ($stmt) {
                ?>
                                <?php
                                ?>
                                <script src="plugins/jquery/jquery.min.js"></script>
                                <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
                                <script>
                                    $(function() {
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'success',
                                            title: 'تمت الاضافه بنجاح',
                                            showConfirmButton: false,
                                            timer: 2000
                                        }).then(() => {
                                            window.location.href = 'main.php?dir=exam&page=report';
                                        });
                                    })
                                </script>
                            <?php }
                        } else {
                            foreach ($formerror as $error) {
                            ?>
                                <div class="alert alert-danger"> <?php echo $error; ?> </div>
                <?php
                            }
                        }
                    }
                }
                ?>
                <div class="myform">
                    <form class="form-group insert ajax_form" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="box2">
                                    <label id="name">عنوان الاختبار
                                        <span> * </span> </label>
                                    <input required maxlength="50" class="form-control" type="text" name="ex_title">
                                </div>
                                <div class="box2">
                                    <label id="name"> ادخل عدد الاسئلة
                                        <span> * </span> </label>
                                    <input required min="1" max="50" class="form-control" type="number" name="ex_total_question">
                                </div>
                                <div class="box2">
                                    <label id="name"> ادخل زمن الاختبار
                                        <span> * </span> </label>
                                    <input required class="form-control" type="number" min="5" max="180" name="ex_time">
                                </div>
                                <div class="box2">
                                    <label id="name"> تاريخ نشر الاختبار علي المنصة
                                        <span> * </span> </label>
                                    <input min="<?php echo date('Y-m-d'); ?>" required class="form-control" type="date" name="ex_date_publish">
                                </div>
                                <div class="box2">
                                    <label id="name_en"> نوع الاختبار <span> * </span></label>
                                    <select required class="form-control" name="ex_type">
                                        <option> -- اختر توع الاختبار -- </option>
                                        <option value="قصير"> قصير </option>
                                        <option value="نهائي"> نهائي </option>
                                        <option value="تحديد المستوي"> تحديد المستوي </option>
                                    </select>
                                </div>

                                <div class="box submit_box">
                                    <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value=" اضافه اختبار جديد ">
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class='status'></div>
                </div>
            </div>
        </div>


    </div>
</div>