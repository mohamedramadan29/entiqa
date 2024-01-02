<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page"> أضافة دفعه جديدة </li>
                </ol>
            </nav>
        </div>
        <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
        <div class="card">
            <div class="card-body">
                <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['add_car'])) {
                        $batch_name =   $_POST['batch_name'];
                        $batch_coash =  $_POST['batch_coash'];
                        $batch_status = $_POST['batch_status'];
                        $batch_start = $_POST['batch_start'];
                        $batch_min = $_POST['batch_min'];
                        $batch_max = $_POST['batch_max'];
                        $date = date("Y-m-d");
                        /// More Validation To Show Error
                        $formerror = [];
                        if ($batch_min >= $batch_max) {
                            $formerror[] = 'يجب ان يكون اكثر عدد اكبر من اقل عدد للدفعه ';
                        }
                        if (strlen($batch_name) > 50) {
                            $formerror[] = 'يجب ان يكون الاسم اقل من 50 حرف ';
                        }
                        if (empty($batch_name) || empty($batch_coash) || empty($batch_status) || empty($batch_start) || empty($batch_min) || empty($batch_max)) {
                            $formerror[] = 'من فضلك ادخل المعلومات كاملة';
                        }
                        if ($batch_start < $date) {
                            $formerror[]  = ' يجب اختيار تاريخ بداية الدفعه بالشكل الصحيح  ';
                        }
                        // check if the batch name found before ort not 
                        $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_name = ?");
                        $stmt->execute(array($batch_name));
                        $count = $stmt->rowCount();
                        if ($count > 0) {
                            $formerror[] = 'اسم الدفعه موجود من قبل من فضلك ادخل اسم جديد ';
                        }
                        if (empty($formerror)) {
                            $stmt = $connect->prepare("INSERT INTO batches (batch_name,batch_coach,batch_start,
                batch_min,batch_max,batch_created_at,batch_status)
                VALUES (:zname,:zcoahs,:zbatch_start,:zbatch_min,:zbatch_max,:zbatch_created_at,:zbatch_status)");
                            $stmt->execute([
                                'zname' => $batch_name,
                                'zcoahs' => $batch_coash,
                                'zbatch_start' => $batch_start,
                                'zbatch_min' => $batch_min,
                                'zbatch_max' => $batch_max,
                                'zbatch_created_at' => $date,
                                'zbatch_status' => $batch_status,
                            ]);
                            if ($stmt) { ?>
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
                                        })
                                    })
                                </script>
                                <?php
                                // header('refresh:2000;url=main.php?dir=batches&page=add');
                                ?>

                <?php }
                        } else {
                            foreach ($formerror as $errors) {
                                echo "<div class='alert alert-danger danger_message'>" .
                                    $errors .
                                    '</div>';
                            }
                        }
                    }
                }
                ?>

                <div class="myform">
                    <form class="form-group insert" action="" method="POST" autocomplete="on" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="box2">
                                    <label id="name"> اسم الدفعه
                                        <span> * </span> </label>
                                    <input maxlength="50" required class="form-control" type="text" name="batch_name">
                                </div>
                                <div class="box2">
                                    <label id="name_en"> المدرب <span> * </span></label>
                                    <select required class="form-control" name="batch_coash">
                                        <option value=""> -- من فضلك اختر المدرب -- </option>
                                        <?php
                                        $stmt = $connect->prepare("SELECT * FROM coshes");
                                        $stmt->execute();
                                        $allcoa = $stmt->fetchAll();
                                        foreach ($allcoa as $coa) {
                                        ?>
                                            <option value="<?php echo $coa['co_id'] ?>"><?php echo $coa['co_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="box2">
                                    <label id="name"> بداية انطلاق الدفعه
                                        <span> * </span> </label>
                                    <input required class="form-control" type="date" name="batch_start">
                                </div>
                                <div class="box2">
                                    <label id="name"> اقل عدد
                                        <span> * </span> </label>
                                    <input min="1" required class="form-control" type="number" name="batch_min">
                                </div>
                                <div class="box2">
                                    <label id="name"> اكثر عدد
                                        <span> * </span> </label>
                                    <input min="1" required class="form-control" type="number" name="batch_max">
                                </div>
                                <div class="box2">
                                    <select required class="form-control select" name="batch_status">
                                        <option value=""> -- حالة الدفعة -- </option>
                                        <option selected value="استقطاب">استقطاب</option>
                                    </select>
                                </div>
                                <div class="box submit_box">
                                    <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value=" اضافه دفعه جديد ">
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