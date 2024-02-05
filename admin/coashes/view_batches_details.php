<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة تفاصيل الدفعه </li>
                </ol>
            </nav>
        </div>
        <?php
        $batch_id = $_GET['batch_id'];
        // get the batch data 
        $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_id = ?");
        $stmt->execute(array($batch_id));
        $batch_data = $stmt->fetch();
        $batch_status = $batch_data['batch_status'];
        ?>
        <div class="table-responsive">
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th> تاريخ الميلاد </th>
                        <th> البريد الالكتروني </th>
                        <th>الجنسية</th>
                        <th> العنوان </th>
                        <th> عدد الاختبارات </th>
                        <th> الاختبارات </th>
                    </tr>
                </thead>
                <tbody> <?php
                        $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_batch=?");
                        $stmt->execute(array($batch_id));
                        $allind = $stmt->fetchAll();
                        foreach ($allind as $ind) { ?>
                        <tr>
                            <td><?php echo $ind['ind_name']; ?> </td>
                            <td><?php echo $ind['ind_birthdate']; ?> </td>
                            <td> <?php echo $ind['ind_email']; ?> </td>
                            <td> <?php echo $ind['ind_nationality']; ?> </td>
                            <td> <?php echo $ind['ind_address']; ?> </td>
                            <td>
                                <?php
                                // get the exams number to check show edit trainer resualt or not 
                                $stmt = $connect->prepare("SELECT * FROM exam WHERE ex_batch_num = ? AND coash_id = ?");
                                $stmt->execute(array($batch_id, $_SESSION['coash_id']));
                                $exam_num = $stmt->rowCount();
                                if ($exam_num > 0) {
                                    echo $exam_num;
                                } else {
                                ?>
                                    <span class="badge badge-danger"> لا يوجد اختبارات للمتدربين  </span>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION['coash_id']) || isset($_SESSION['admin_session'])) {
                                ?>
                                    <a class="btn btn-info btn-sm" href="main.php?dir=coashes&page=view_exam&ind_id=<?php echo $ind['ind_id']; ?> ">
                                        مشاهدة الاختبارات<i class="fa fa-view"></i>
                                    </a>
                                    <?php
                                    if ($batch_status != 'تم التأهيل بنجاح') {
                                        if ($exam_num > 0) {
                                    ?>
                                            <!-- <a class="btn btn-primary btn-sm" href="main.php?dir=coashes&page=edit_user&ind_id=<?php echo $ind['ind_id']; ?> ">
                                                تعديل نتائج المتدرب <i class="fa fa-edit"></i>
                                            </a> -->
                                    <?php
                                        }
                                    }
                                    ?>
                                <?php
                                }

                                ?>


                            </td>
                        </tr>

                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>