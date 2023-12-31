<?php
if (isset($_GET['batch'])) {
    $batch_id = $_GET['batch'];
    $stmt = $connect->prepare('SELECT * FROM batches
        INNER JOIN coshes ON co_id WHERE coshes.co_id = batches.batch_coach AND  batch_id = ?');
    $stmt->execute(array($batch_id));
    $count_batch = $stmt->rowCount();
    if ($count_batch > 0) {
        $type = $stmt->fetch();
        $batch_status = $type['batch_status'];
    } else {
        header("Location:main.php?dir=batches&page=report");
    }
}
?>

<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page"> تعديل الدفعه </li>
                </ol>
            </nav>
        </div>
        <!-- END RECORD TO EDIT NEW RECORD  -->
        <div class="card">
            <div class="card-body">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $batch_id = $_POST['batch_id'];
                    $batch_name = $_POST['batch_name'];
                    $batch_coash =  $_POST['batch_coash'];
                    $batch_start = $_POST['batch_start']; // 2023-11-25
                    $batch_min = $_POST['batch_min'];
                    $batch_max = $_POST['batch_max'];
                    $batch_status = $_POST['batch_status'];
                    $formerror = [];
                    if (empty($batch_name) || empty($batch_coash) || empty($batch_status) || empty($batch_start) || empty($batch_min) || empty($batch_max)) {
                        $formerror[] = 'من فضلك ادخل المعلومات كاملة';
                    }
                    if ($batch_min >= $batch_max) {
                        $formerror[] = 'يجب ان يكون اكثر عدد اكبر من اقل عدد للدفعه ';
                    }
                    if (strlen($batch_name) > 50) {
                        $formerror[] = 'يجب ان يكون الاسم اقل من 50 حرف ';
                    }
                    $date_now = date("Y-m-d");
                    if ($batch_start < $date_now) {
                        $formerror[]  = ' لا يجب ان يكون تاريخ بداية الدفعة اقل من تاريخ اليوم  ';
                    }
                    if (empty($formerror)) {
                        $stmt = $connect->prepare("UPDATE batches SET batch_name=?,batch_coach=?,batch_start=?,
        batch_min=?,batch_max=?,batch_status=? WHERE batch_id =?");
                        $stmt->execute([$batch_name, $batch_coash, $batch_start, $batch_min, $batch_max, $batch_status, $batch_id]);
                        if ($stmt) { ?>
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
                                        <?php echo "window.location.href = 'main.php?dir=batches&page=edit&batch=$batch_id';"; ?>
                                    });
                                });
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
                ?>
                <div class="myform">
                    <form class="form-group" action="" method="POST" autocomplete="on" enctype="multipart/form-data">
                        <input type="hidden" name="batch_id" value="<?php echo $type['batch_id'] ?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="box2">
                                    <label id="name"> اسم الدفعه
                                        <span> * </span> </label>
                                    <input required class="form-control" type="text" name="batch_name" value="<?php echo $type['batch_name']; ?>">
                                </div>
                                <div class="box2">
                                    <label id="name_en"> المدرب <span> * </span></label>
                                    <select class="form-control" name="batch_coash">
                                        <?php
                                        $stmt = $connect->prepare("SELECT * FROM coshes");
                                        $stmt->execute();
                                        $allcoa = $stmt->fetchAll();
                                        foreach ($allcoa as $coa) {
                                        ?>
                                            <option <?php if ($type['batch_coach'] == $coa['co_id'])  echo 'selected'; ?> value="<?php echo $coa['co_id'] ?>"><?php echo $coa['co_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                        <option> </option>
                                    </select>
                                </div>
                                <div class="box2">
                                    <label id="name"> بداية انطلاق الدفعه
                                        <span> * </span> </label>
                                    <input required class="form-control" type="date" name="batch_start" value="<?php echo $type['batch_start']; ?>">
                                </div>
                                <div class="box2">
                                    <label id="name"> اقل عدد
                                        <span> * </span> </label>
                                    <input required class="form-control" type="number" name="batch_min" value="<?php echo $type['batch_min']; ?>">
                                </div>

                                <div class="box2">
                                    <label id="name"> اكثر عدد
                                        <span> * </span> </label>
                                    <input required class="form-control" type="number" name="batch_max" value="<?php echo $type['batch_max']; ?>">
                                </div>
                                <div class="box2">
                                    <select required class="form-control select" name="batch_status">
                                        <option value=""> -- حالة الدفعة -- </option>
                                        <option <?php if ($type['batch_status'] == 'استقطاب') echo "selected" ?> value="استقطاب">استقطاب</option>
                                        <?php
                                        $date_now = date("Y-m-d");
                                        if (($date_now > $type['batch_start']) && ($type['ind_num'] > $type['batch_min'])) { ?>
                                            <option <?php if ($type['batch_status'] == 'قيد التدريب') echo "selected" ?> value="قيد التدريب">قيد التدريب </option>
                                            <option <?php if ($type['batch_status'] == 'تم التأهيل بنجاح') echo "selected" ?> value="تم التأهيل بنجاح">تم التأهيل بنجاح </option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                                <?php
                                if ($batch_status != 'تم التأهيل بنجاح') {
                                ?>
                                    <div class="box submit_box">
                                        <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value="تعديل الدفعه">
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>

                    </form>
                    <!-- START RESPONSE SPACE  -->
                    <!-- area to display a message after completion of upload -->

                    <br>
                    <div class='status'></div>
                    <!-- END RESPONSE SPACE  -->
                </div>
            </div>
        </div>

    </div>

</div>
</div>
</div>