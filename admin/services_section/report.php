<?php



if (!isset($_SESSION['admin_session']) && !isset($_SESSION['serv_name'])) {
    header("Location:index");
}

?>

<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة متدربين لم يتم تسجيلهم في دفعات </li>
                </ol>
            </nav>
        </div>


        <div class="table-responsive">
            <div class="add_new_record">
            </div>
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> الاسم </th>
                        <th>البريد الألكتروني</th>
                        <th> رقم الهاتف </th>
                        <th> الجنسية </th>
                        <th> تاريخ الميلاد </th>
                        <th> حالة الدفع </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_batch=0 ORDER BY ind_id DESC");
                    $stmt->execute();
                    $alltype = $stmt->fetchAll();
                    foreach ($alltype as $type) { ?> <tr>
                            <td><?php echo $type['ind_name']; ?> </td>
                            <td><?php echo $type['ind_email']; ?> </td>
                            <td>
                                <?php echo $type['ind_phone']; ?>
                            </td>
                            <td> <?php echo $type['ind_nationality']; ?> </td>
                            <td> <?php echo $type['ind_birthdate']; ?> </td>
                            <td> <?php if ($type['ind_payment_charge'] == 'CAPTURED') {
                                    ?>
                                    <span class="badge badge-success"> تم الدفع </span>
                                <?php
                                    } else {
                                ?>
                                    <span class="badge badge-danger"> لم يتم الدفع بعد </span>
                                <?php
                                    } ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewrecord<?php echo $type['ind_id']; ?>">
                                    مشاهدة <i class="fa fa-eye"></i>
                                </button>
                                <?php if ($type['ind_payment_charge'] == 'CAPTURED') {
                                ?>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addbatch<?php echo $type['ind_id']; ?>">
                                        تسجيل الفرد في دفعه <i class="fa fa-registered"></i>
                                    </button>
                                <?php
                                } else {
                                ?>
                                    <span class="badge badge-danger"> انتظر الدفع لتتمكن من التسجيل </span>
                                <?php
                                } ?>

                                <a class="btn btn-info btn-sm" href="main.php?dir=chat&page=chat&ind_username=<?php echo $type['ind_username']; ?>" id="chatLink">
                                    <i class="fa fa-comment"></i> تواصل
                                </a>
                                <?php if (isset($_SESSION['admin_session'])) {
                                ?>
                                    <a class="confirm btn btn-danger btn-sm" href="main.php?dir=services_section&page=delete&ind_id=<?php echo $type['ind_id']; ?>">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <?php
                                } ?>

                            </td>
                        </tr> <?php
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
                                                <input type="hidden" name="cou_id" value="<?php echo $type['ind_id'] ?>">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="box2">
                                                            <label id="name"> الاسم
                                                                <span> * </span> </label>
                                                            <input required class="form-control" type="text" name="ind_name" value="<?php echo $type['ind_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> الاسم الانجليزي<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_name_en" value="<?php echo $type['cou_name_en'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> نبذة مختصرة <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info" value="<?php echo $type['cou_info'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> نبذة مختصرة باللغه الانجليزية <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['cou_info_en'] ?>">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="">
                                                                <label> الصورة </label>
                                                                <input type="file" class="form-control" name='image'>
                                                            </div>
                                                        </div>

                                                        <div class="box submit_box">
                                                            <input class="btn btn-outline-primary btn-sm" name="edit_record" type="submit" value="تعديل الدولة">
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

                        <!-- START MODEL TO Add Batches  -->
                        <div class="modal fade" id="addbatch<?php echo $type['ind_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> الدفعات </h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="myform">
                                            <form class="form-group insert ajax_form" action="main_ajax.php?dir=services_section&page=add" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                <input type="hidden" name="ind_id" value="<?php echo $type['ind_id']; ?>">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="box">
                                                            <label id="name"> الدفعات المتاحة
                                                                <span> * </span> </label>
                                                            <select required class="form-control" name="batch_id">
                                                                <option value=""> -- اختر الدفعه -- </option>
                                                                <?php
                                                                $stmt = $connect->prepare("SELECT * FROM batches WHERE ind_num < batch_max AND batch_status != 'تم التأهيل بنجاح'");
                                                                $stmt->execute();
                                                                $allbatch = $stmt->fetchAll();
                                                                foreach ($allbatch as $batch) {
                                                                ?>
                                                                    <option value="<?php echo $batch['batch_id']; ?>"><?php echo $batch['batch_name']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="box submit_box">
                                                            <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value="اضافة في الدفعه">
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
                                                            <input disabled required class="form-control" type="text" name="ind_name" value="<?php echo $type['ind_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name"> اسم المستخدم
                                                                <span> * </span> </label>
                                                            <input disabled required class="form-control" type="text" name="ind_name" value="<?php echo $type['ind_username'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> البريد الألكتروني <span> * </span></label>
                                                            <input disabled class="form-control" type="text" name="ind_email" value="<?php echo $type['ind_email'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> رقم الهاتف <span> * </span></label>
                                                            <input disabled class="form-control" type="text" name="ind_birthdate" value="<?php echo $type['ind_phone'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en">الجنسية<span> * </span></label>
                                                            <input disabled class="form-control" type="text" name="ind_nationality" value="<?php echo $type['ind_nationality'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">الجنس<span> * </span></label>
                                                            <input disabled class="form-control" type="text" name="ind_gender" value="<?php echo $type['ind_gender'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">تاريخ الميلاد<span> * </span></label>
                                                            <input disabled class="form-control" type="text" name="ind_birthdate" value="<?php echo $type['ind_birthdate'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> امكانية التنقل للعمل في مدينة اخري <span> * </span></label>
                                                            <input disabled class="form-control" type="text" name="ind_transfer" value="<?php echo $type['ind_transfer'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">رقم الدفعه<span> * </span></label>
                                                            <input disabled class="form-control" type="text" name="ind_batch" value="<?php if ($type['ind_batch'] == 0) {
                                                                                                                                            echo 'لم يتم التسجيل في دفعه';
                                                                                                                                        } else {
                                                                                                                                            echo $type['ind_batch'];
                                                                                                                                        } ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> مهارة اللغه الانجليزية <span> * </span></label>
                                                            <input disabled class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_english'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> منطقه السكن الحالية <span> * </span></label>
                                                            <input disabled class="form-control" type="text" name="ind_address" value="<?php echo $type['ind_address'] ?>">
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