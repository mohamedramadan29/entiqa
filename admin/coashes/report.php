<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    
                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة المدربين </li>
                </ol>
            </nav>
        </div>
        <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
        <!-- Content Row -->
        <!-- START MODEL TO ADD NEW RECORD  -->
        <div class="modal fade" id="addrecord" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> اضافة مدرب جديد </h5>
                    </div>
                    <div class="modal-body">
                        <div class="myform">
                            <form class="form-group insert ajax_form" action="main_ajax.php?dir=coashes&page=add" method="POST" autocomplete="on" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="box2">
                                            <label id="name"> اسم المستخدم
                                                <span> * </span> </label>
                                            <input required minlength="5" maxlength="200" class="form-control" type="text" name="co_name">
                                        </div>
                                        <div class="box2">
                                            <label id="name"> كلمة المرور
                                                <span> * </span> </label>
                                            <input required minlength="8" maxlength="20" class="form-control" type="password" name="co_password">
                                        </div>
                                        <div class="box2">
                                            <label id="name_en"> الهاتف <span> * </span></label>
                                            <input required minlength="8" maxlength="20" class="form-control" type="text" name="co_phone">
                                        </div>
                                        <div class="box2">
                                            <label id="name"> تأكيد كلمة المرور
                                                <span> * </span> </label>
                                            <input required minlength="8" maxlength="20" class="form-control" type="password" name="confirm_password">
                                        </div>
                                        <div class="box2">
                                            <label id="name_en"> البريد الالكتروني <span> * </span></label>
                                            <input required class="form-control" type="email" name="co_email">
                                        </div>

                                        <div class="box2">
                                            <label id="name_en">الخدمة المقدمة<span> * </span></label>
                                            <input required minlength="5" maxlength="200" class="form-control" type="text" name="co_services">
                                        </div>
                                        <div class="box2">
                                            <label id="name_en"> سنين الخبرة <span> * </span></label>
                                            <input required min="0" max="20" class="form-control" type="number" name="co_exper">
                                        </div>

                                        <div class="box submit_box">
                                            <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value=" اضافه مدرب جديد ">
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
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> <i class="fa fa-close"></i> اغلاق </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END RECORD TO EDIT NEW RECORD  -->

        <div class="table-responsive">
            <?php
            if (isset($_SESSION['admin_session'])) {
            ?>
                <div class="add_new_record">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addrecord">
                        اضف مدرب جديد <i class="fa fa-plus"></i>
                    </button>
                </div>
            <?php
            }

            ?>
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> الاسم </th>
                        <th>البريد الالكروني</th>
                        <th> رقم الهاتف </th>
                        <th> الخدمة المقدمة </th>
                        <th> عدد سنين الخبرة </th>
                        <th> العمليات </th>
                    </tr>
                </thead>
                <tbody> <?php
                        if (!isset($_SESSION['coash_id'])) {
                            $stmt = $connect->prepare('SELECT * FROM coshes ORDER BY co_id DESC ');
                            $stmt->execute();
                        } else {
                            $stmt = $connect->prepare('SELECT * FROM coshes WHERE co_id = ?');
                            $stmt->execute(array($_SESSION['coash_id']));
                        }

                        $alltype = $stmt->fetchAll();
                        foreach ($alltype as $type) { ?> <tr>
                            <td><?php echo $type['co_name']; ?> </td>
                            <td><?php echo $type['co_email']; ?> </td>
                            <td> <?php echo $type['co_phone']; ?> </td>
                            <td> <?php echo $type['co_services']; ?> </td>
                            <td> <?php echo $type['co_exper']; ?> </td>
                            <td>
                                <?php
                                $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_coach = ?");
                                $stmt->execute(array($type['co_id']));
                                $count_batch = $stmt->rowCount();
                                if (isset($_SESSION['admin_session'])) {
                                ?>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editrecord<?php echo $type['co_id']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <?php

                                    if ($count_batch > 0) {
                                    } else {
                                    ?>
                                        <a class="confirm btn btn-danger btn-sm" href="main.php?dir=coashes&page=delete&co_id=<?php echo $type['co_id']; ?> ">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                <?php
                                }
                                ?>
                                <?php
                                if ($count_batch > 0) {
                                ?>
                                    <a class="btn btn-warning btn-sm" href="main.php?dir=coashes&page=view_batches&co_id=<?php echo $type['co_id']; ?> ">
                                        مشاهدة الدفعات <i class="fa fa-edit"></i>
                                    </a>
                                <?php
                                }
                                ?>
                            </td>
                        </tr> <?php
                                ?>
                        <!-- START MODEL TO Edit RECORD  -->
                        <div class="modal fade" id="editrecord<?php echo $type['co_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل المدرب</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="myform">
                                            <form class="form-group insert ajax_form" action="main_ajax.php?dir=coashes&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                <input type="hidden" name="co_id" value="<?php echo $type['co_id'] ?>">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="box2">
                                                            <label id="name"> الاسم
                                                                <span> * </span> </label>
                                                            <input required  minlength="5" maxlength="200" class="form-control" type="text" name="co_name" value="<?php echo $type['co_name']; ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name"> تعديل كلمة المرور
                                                                <span> * </span> </label>
                                                            <input  class="form-control" type="password" name="co_password">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> الهاتف <span> * </span></label>
                                                            <input required minlength="8" maxlength="20" class="form-control" type="text" name="co_phone" value="<?php echo $type['co_phone']; ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name"> تأكيد كلمة المرور
                                                                <span> * </span> </label>
                                                            <input class="form-control" type="password" name="confirm_password">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> البريد الالكتروني <span> * </span></label>
                                                            <input required class="form-control" type="email" name="co_email" value=" <?php echo $type['co_email']; ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en">الخدمة المقدمة<span> * </span></label>
                                                            <input required  minlength="5" maxlength="200" class="form-control" type="text" name="co_services" value="<?php echo $type['co_services']; ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> سنين الخبرة <span> * </span></label>
                                                            <input required min="0" max="20" class="form-control" type="number" name="co_exper" value="<?php echo $type['co_exper']; ?>">
                                                        </div>
                                                        <div class="box submit_box">
                                                            <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value="تعديل المدرب">
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
                                                            <label id="name"> كلمة المرور
                                                                <span> * </span> </label>
                                                            <input required class="form-control" type="text" name="co_password" value="<?php echo $type['co_password']; ?>">
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
                                                            <label id="name_en"> امكانية التنقل للعمل في مدينة اخري <span> * </span></label>
                                                            <input class="form-control" type="text" name="ind_transfer" value="<?php echo $type['ind_transfer'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">رقم الدفعه<span> * </span></label>
                                                            <input class="form-control" type="text" name="ind_batch" value="<?php echo $type['ind_batch'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> مهارة اللغه الانجليزية <span> * </span></label>
                                                            <input class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_english'] ?>">
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