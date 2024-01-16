<?php

if (!isset($_SESSION['admin_session']) && !isset($_SESSION['coash_id'])) {
    header("Location:index");
}

?>

<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة الاختبارات </li>
                </ol>
            </nav>
        </div>

        <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
        <!-- Content Row -->
        <!-- END RECORD TO EDIT NEW RECORD  -->
        <?php
        if (isset($_SESSION['success_message'])) {
            $message = $_SESSION['success_message'];
            unset($_SESSION['success_message']);
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
                        title: '<?php echo $message; ?>',
                        showConfirmButton: false,
                        timer: 2000
                    })
                })
            </script>
            <?php
        } elseif (isset($_SESSION['error_messages'])) {
            $formerror = $_SESSION['error_messages'];
            foreach ($formerror as $error) {
            ?>
                <div class="alert alert-danger alert-dismissible" style="max-width: 800px; margin:20px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $error; ?>
                </div>
        <?php
            }
            unset($_SESSION['error_messages']);
        }
        ?>
        <div class="card">
            <div class="card-header">
                <?php
                if (isset($_SESSION['coash_id']) || isset($_SESSION['admin_session'])) {
                ?>
                    <a type="button" class="btn btn-primary btn-sm" href="main.php?dir=exam&page=add">
                        اضف اختبار جديد <i class="fa fa-plus"></i>
                    </a>
                <?php
                }
                ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="add_new_record">

                    </div>
                    <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th> عنوان الاختبار </th>
                                <th> عدد الاسئلة </th>
                                <th> اسم الدفعه </th>
                                <th> نوع الاختبار </th>
                                <th> زمن الاختبار </th>
                                <th> تاريخ نشر الاختبار </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody> <?php
                                if (isset($_SESSION['coash_id'])) {
                                    $stmt = $connect->prepare('SELECT * FROM exam WHERE coash_id = ? ORDER BY ex_id DESC');
                                    $stmt->execute(array($_SESSION['coash_id']));
                                } else {
                                    $stmt = $connect->prepare('SELECT * FROM exam  ORDER BY ex_id DESC');
                                    $stmt->execute();
                                }
                                $alltype = $stmt->fetchAll();
                                foreach ($alltype as $type) { ?>
                                <tr>
                                    <td><?php echo $type['ex_title']; ?> </td>
                                    <td><?php echo $type['ex_total_question']; ?> </td>
                                    <td> <?php
                                            if ($type['ex_batch_num'] != '-- اختر رقم الدفعه --') {
                                                $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_id =?");
                                                $stmt->execute(array($type['ex_batch_num']));
                                                $batch_data = $stmt->fetch();
                                                $batch_name = $batch_data['batch_name'];
                                                echo $batch_name;
                                            } else {
                                                echo $type['ex_batch_num'];
                                            }
                                            ?> </td>
                                    <td> <?php echo $type['ex_type']; ?> </td>
                                    <td> <?php echo $type['ex_time']; ?> </td>
                                    <td> <?php echo $type['ex_date_publish']; ?> </td>
                                    <?php
                                    ?>
                                    <td>
                                        <a href="main.php?dir=exam&page=edit&exam_id=<?php echo $type['ex_id']; ?>" type="button" class="btn btn-primary btn-sm">
                                            تعديل <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewexam<?php echo $type['ex_id']; ?>">
                                            مشاهدة <i class="fa fa-eye"></i>
                                        </button>
                                        <a class="btn btn-info btn-sm" href="main.php?dir=question&page=report&ex_id=<?php echo $type['ex_id']; ?> ">
                                            اسئلة الاختبار <i class="fa fa-dashboard"></i>
                                            <?php
                                            // check if the number question equal the numbers in exam question 
                                            $stmt = $connect->prepare("SELECT * FROM question WHERE exam_id = ?");
                                            $stmt->execute(array($type['ex_id']));
                                            $question_number = $stmt->rowCount();
                                          
                                            if (($type['ex_date_publish'] <= date("Y-m-d")) && ($question_number == $type['ex_total_question'])) {
                                            } else {
                                            ?>
                                                <a class="confirm btn btn-danger btn-sm" href="main.php?dir=exam&page=delete&ex_id=<?php echo $type['ex_id']; ?> ">
                                                    حذف <i class="fa fa-trash"></i>
                                                </a>
                                            <?php
                                            }

                                            ?>

                                    </td>
                                </tr>
                                <!-- END RECORD TO EDIT NEW RECORD  -->
                                <!-- START MODEL VIEW  -->
                                <div class="modal fade" id="viewexam<?php echo $type['ex_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">مشاهدة الأختبار</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="myform">
                                                    <form class="form-group insert ajax_form" action="main_ajax.php?dir=individual&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">

                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="box2">
                                                                    <label id="name">عنوان الاختبار
                                                                        <span> * </span> </label>
                                                                    <input disabled class="form-control" type="text" name="ex_title" value="<?php echo $type['ex_title'] ?>">
                                                                </div>
                                                                <div class="box2">
                                                                    <label id="name"> ادخل عدد الاسئلة
                                                                        <span> * </span> </label>
                                                                    <input disabled class="form-control" type="number" name="ex_total_question" value="<?php echo $type['ex_total_question'] ?>">
                                                                </div>
                                                                <div class="box2">
                                                                    <label id="name"> ادخل زمن الاختبار
                                                                        <span> * </span> </label>
                                                                    <input disabled class="form-control" type="number" min="5" name="ex_time" value="<?php echo $type['ex_time'] ?>">
                                                                </div>
                                                                <div class="box2">
                                                                    <label id="name"> تاريخ نشر الاختبار علي المنصة
                                                                        <span> * </span> </label>
                                                                    <input disabled class="form-control" type="date" name="ex_date_publish" value="<?php echo $type['ex_date_publish'] ?>">
                                                                </div>
                                                                <div class="box2">
                                                                    <label id="name_en"> نوع الاختبار <span> * </span></label>
                                                                    <select disabled class="form-control" name="ex_type">
                                                                        <option> -- اختر توع الاختبار -- </option>
                                                                        <option <?php if ($type['ex_type'] == 'قصير') echo "selected"; ?> value="قصير"> قصير </option>
                                                                        <option <?php if ($type['ex_type'] == 'نهائي') echo "selected"; ?> value="نهائي"> نهائي </option>
                                                                        <option <?php if ($type['ex_type'] == 'تحديد المستوي') echo "selected"; ?> value="تحديد المستوي"> تحديد المستوي </option>
                                                                    </select>
                                                                </div>
                                                                <div class="box2">
                                                                    <label id="name_en"> اختر الدفعه <span> * </span></label>
                                                                    <select disabled class="form-control" name="ex_batch_num">
                                                                        <option> -- اختر رقم الدفعه -- </option>
                                                                        <?php
                                                                        $stmt = $connect->prepare("SELECT * FROM batches");
                                                                        $stmt->execute();
                                                                        $allcoa = $stmt->fetchAll();
                                                                        foreach ($allcoa as $coa) {
                                                                        ?>
                                                                            <option <?php if ($type['ex_batch_num'] == $coa['batch_id']) echo "selected"; ?> value="<?php echo $coa['batch_id'] ?>"><?php echo $coa['batch_name']; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> <i class="fa fa-close"></i> اغلاق </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END  MODEL VIEW  -->
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
</div>