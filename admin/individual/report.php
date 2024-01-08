<?php
if (isset($_SESSION['admin_session']) || isset($_SESSION['serv_name'])) {

?>


    <div class="container customer_report">
        <div class="data">
            <div class="bread">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"> مشاهدة المتدربين </li>
                    </ol>
                </nav>
            </div>
            <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
            <!-- Start Update Company View Allllert -->
            <?php
            $stmt = $connect->prepare("UPDATE ind_register SET ind_updated=1 WHERE ind_updated=0");
            $stmt->execute();
            ?>
            <div class="table-responsive">

                <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> الاسم </th>
                            <th>البريد الالكروني</th>
                            <th> الجنسية </th>
                            <th> تاريخ الميلاد </th>
                            <th>اسم الدفعة</th>
                            <th> التفاوضات المكتملة </th>
                            <th>التفاوضات الملغية </th>
                            <th> اشتراك الخدمة </th>
                            <th> العمليات </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $stmt = $connect->prepare('SELECT * FROM ind_register WHERE ind_batch != 0 ORDER BY ind_id DESC');
                        $stmt->execute();
                        $alltype = $stmt->fetchAll();
                        foreach ($alltype as $type) { ?>
                            <tr>
                                <td>
                                    <?php echo $i++ ?>
                                </td>
                                <td>
                                    <?php echo $type['ind_name']; ?>
                                </td>
                                <td>
                                    <?php echo $type['ind_email']; ?>
                                </td>
                                <td>
                                    <?php echo $type['ind_nationality']; ?>
                                </td>
                                <td>
                                    <?php echo $type['ind_birthdate']; ?>
                                </td>
                                <td>
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_id=?");
                                    $stmt->execute(array($type['ind_batch']));
                                    $batch_data = $stmt->fetch();
                                    $count = $stmt->rowCount();
                                    if ($count) {
                                        echo $batch_data['batch_name'];
                                    } else {
                                        echo " لا يوجد دفعة حاليا  ";
                                    }
                                    ?>
                                </td>
                                <!--
                            <td>
                                <?php
                                $stmt = $connect->prepare("SELECT to_person FROM chat WHERE send_type='com' AND to_person=? GROUP BY to_person");
                                $stmt->execute(array($type['ind_username']));
                                $con_count = $stmt->rowCount();
                                echo $con_count;
                                ?>
                            </td>
                                -->
                                <td>
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM contract_complete WHERE ind_id = ?");
                                    $stmt->execute(array($type['ind_id']));
                                    $count_com = $stmt->rowCount();
                                    echo $count_com;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM contract_cancel WHERE ind_id = ?");
                                    $stmt->execute(array($type['ind_id']));
                                    $count_cancel = $stmt->rowCount();
                                    echo $count_cancel;
                                    ?>
                                </td>
                                <td>

                                    <?php
                                    if ($type['ind_payment_charge'] == 'CAPTURED') {
                                        echo 'تم الاشتراك';
                                    } else {
                                        echo 'لم يتم الاشتراك';
                                    }
                                    ?>
                                </td>
                                <td>

                                    <?php
                                    if (isset($_SESSION['admin_session'])) {
                                        if ($type['ind_payment_charge'] != 'CAPTURED') {
                                    ?>
                                            <a class="confirm btn btn-danger btn-sm" href="main.php?dir=individual&page=delete&ind_id=<?php echo $type['ind_id']; ?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        <?php
                                        }
                                        ?>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editrecord<?php echo $type['ind_id']; ?>">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    <?php
                                    } ?>
                                    <a class="btn btn-info btn-sm" href="main.php?dir=chat&page=chat&ind_username=<?php echo $type['ind_username']; ?>" id="chatLink">
                                        <i class="fa fa-comment"></i>
                                    </a>

                                </td>
                            </tr>
                            <?php
                            ?>
                            <!-- START MODEL TO Edit RECORD  -->
                            <div class="modal fade" id="editrecord<?php echo $type['ind_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">تعديل المتدرب</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="myform">
                                                <form class="form-group insert ajax_form" action="main_ajax.php?dir=individual&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                    <input type="hidden" name="ind_id" value="<?php echo $type['ind_id'] ?>">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="box2">
                                                                <label id="name">الاسم
                                                                    <span> * </span> </label>
                                                                <input readonly required class="form-control" type="text" name="ind_name" value="<?php echo $type['ind_name'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name"> اسم المستخدم
                                                                    <span> * </span> </label>
                                                                <input readonly required class="form-control" type="text" name="ind_username" value="<?php echo $type['ind_username'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en"> البريد الالكروني <span> * </span></label>
                                                                <input readonly class="form-control" type="text" name="ind_email" value="<?php echo $type['ind_email'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en"> رقم الهاتف <span> * </span></label>
                                                                <input readonly class="form-control" type="text" name="ind_mobile" value="<?php echo $type['ind_phone'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en"> منطقة السكن <span> * </span></label>
                                                                <input readonly class="form-control" type="text" name="ind_mobile" value="<?php echo $type['ind_address'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en">تاريخ الميلاد <span> * </span></label>
                                                                <input readonly class="form-control" type="text" name="ind_birthdate" value="<?php echo $type['ind_birthdate'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en">الجنسية<span> * </span></label>
                                                                <input readonly class="form-control" type="text" name="ind_nationality" value="<?php echo $type['ind_nationality'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en">الجنس<span> * </span></label>
                                                                <input readonly class="form-control" type="text" name="ind_nationality" value="<?php echo $type['ind_gender'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en"> امكانية التنقل للعمل في مدينة اخري <span> *
                                                                    </span></label>
                                                                <input readonly class="form-control" type="text" name="ind_transfer" value="<?php echo $type['ind_transfer'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en"> الدفعه<span> * </span></label>
                                                                <?php
                                                                $stmt = $connect->prepare("SELECT * FROM batches WHERE ind_num < batch_max");
                                                                $stmt->execute();
                                                                $allbatches = $stmt->fetchAll();
                                                                ?>
                                                                <select class="form-control select" name="ind_batch">
                                                                    <option value="0"> -- اختر الدفعه -- </option>
                                                                    <?php
                                                                    foreach ($allbatches as $batch) { ?>
                                                                        <option <?php if ($batch['batch_id'] == $type['ind_batch'])
                                                                                    echo "selected" ?> value="<?php echo $batch['batch_id']; ?>"> <?php echo $batch['batch_name']; ?> </option>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>

                                                            <div class="box2">
                                                                <label id="name_en"> مهارة اللغه الانجليزية <span> *
                                                                    </span></label>
                                                                <input readonly class="form-control" type="text" name="ind_english" value="<?php echo $type['ind_english'] ?>">
                                                            </div>
                                                            <?php
                                                            if (isset($_SESSION['admin_session'])) {
                                                            ?>
                                                                <div class="box2">
                                                                    <label id="name_en"> حالة المتدرب <span> * </span></label>
                                                                    <select class="form-control select2" name="ind_status">
                                                                        <option value="-1"> -- اختر -- </option>
                                                                        <option <?php if ($type['ind_status'] == 0)
                                                                                    echo "selected"; ?> value="0"> غير مؤهل </option>
                                                                        <option <?php if ($type['ind_status'] == 1)
                                                                                    echo "selected"; ?> value="1"> مؤهل </option>
                                                                        <option <?php if ($type['ind_status'] == 2)
                                                                                    echo "selected"; ?> value="2"> افضل المؤهلين </option>
                                                                        <option <?php if ($type['ind_status'] == 3)
                                                                                    echo "selected"; ?> value="3">مؤهلين تم توظيفهم </option>
                                                                    </select>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <div class="box2">
                                                                <label id="ind_certificate"> الشهادة الخاصة بالمتدرب </label>

                                                                <div class="custom-file">
                                                                    <input type="file" name="ind_certificate" class="form-control" id="customFile" onchange="checkFileSize(),checkFileTypePdf()" accept=".pdf">

                                                                    <!-- <input type="file" name="message_attachment[]" multiple class="custom-file-input" id="customFile" aria-label="اختيار ملفات" onchange="checkFileSize()"> 
                        <label class="custom-file-label" for="customFile" id="fileLabel">اختيار ملفات</label>  -->
                                                                </div>
                                                                <?php
                                                                if (isset($type['ind_certificate']) && $type['ind_certificate'] != null) {
                                                                ?>
                                                                    <div class="certificate_image">
                                                                        <br>
                                                                        <?php
                                                                        if (!empty($type['ind_certificate'])) {
                                                                        ?>
                                                                            <a target="_blank" href="uploads/<?php echo $type['ind_certificate'] ?>" class="btn btn-warning btn-sm"> مشاهدة الشهادة </a>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="box submit_box">
                                                                <input class="btn btn-outline-primary btn-sm" name="edit_record" type="submit" value="تعديل المستخدم">
                                                            </div>
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
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> <i class="fa fa-close"></i> اغلاق </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END RECORD TO EDIT NEW RECORD  -->
                            <!-- START MODEL VIEW  -->
                            <div class="modal fade" id="viewrecord<?php echo $type['ind_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">مشاهدة المتدرب</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="myform">
                                                <form class="form-group insert ajax_form" action="main_ajax.php?dir=individual&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                    <input type="hidden" name="ind_id" value="<?php echo $type['ind_id'] ?>">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="box2">
                                                                <label id="name">الاسم
                                                                    <span> * </span> </label>
                                                                <input required class="form-control" type="text" name="ind_name" value="<?php echo $type['ind_name'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en"> البريد الالكروني <span> * </span></label>
                                                                <input class="form-control" type="text" name="ind_email" value="<?php echo $type['ind_email'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en">تاريخ الميلاد <span> * </span></label>
                                                                <input class="form-control" type="text" name="ind_birthdate" value="<?php echo $type['ind_birthdate'] ?>">
                                                            </div>

                                                            <div class="box2">
                                                                <label id="name_en">الجنسية<span> * </span></label>
                                                                <input class="form-control" type="text" name="ind_nationality" value="<?php echo $type['ind_nationality'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en"> امكانية التنقل للعمل في مدينة اخري <span> *
                                                                    </span></label>
                                                                <input class="form-control" type="text" name="ind_transfer" value="<?php echo $type['ind_transfer'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en">رقم الدفعه<span> * </span></label>
                                                                <input class="form-control" type="text" name="ind_batch" value="<?php echo $type['ind_batch'] ?>">
                                                            </div>

                                                            <div class="box2">
                                                                <label id="name_en"> مهارة اللغه الانجليزية <span> *
                                                                    </span></label>
                                                                <input class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_english'] ?>">
                                                            </div>

                                                            <div class="box2">
                                                                <label id="name_en">درجة تقييم الأختبار النهائي<span> *
                                                                    </span></label>
                                                                <input class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_final_exam'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en">درجة الأختبارات القصيرة<span> *
                                                                    </span></label>
                                                                <input class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_sub_exam'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en">درجة الأداء و التطبيق<span> *
                                                                    </span></label>
                                                                <input class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_exer_exam'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en">درجة الحضور<span> * </span></label>
                                                                <input class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_attend'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en">النسبة النهائية<span> * </span></label>
                                                                <input class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_degree_percen'] ?>">
                                                            </div>
                                                            <div class="box2">
                                                                <label id="name_en"> حالة المتدرب <span> * </span></label>
                                                                <select class="form-control" name="ind_status" id="select">
                                                                    <option value="-1"> -- اختر -- </option>
                                                                    <option <?php if ($type['ind_status'] == 0)
                                                                                echo "selected"; ?> value="0"> غير مؤهل </option>
                                                                    <option <?php if ($type['ind_status'] == 1)
                                                                                echo "selected"; ?> value="1"> مؤهل </option>
                                                                    <option <?php if ($type['ind_status'] == 2)
                                                                                echo "selected"; ?> value="2"> افضل المؤهلين </option>
                                                                    <option <?php if ($type['ind_status'] == 3)
                                                                                echo "selected"; ?> value="3">مؤهلين تم توظيفهم </option>
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

<?php

} else {
    header("Location:index");
}

?>