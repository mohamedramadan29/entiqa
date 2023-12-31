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
        <!-- Content Row -->
        <!-- START MODEL TO ADD NEW RECORD  -->
        <div class="modal fade" id="addrecord" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> اضافة دولة جديد </h5>
                    </div>
                    <div class="modal-body">
                        <div class="myform">
                            <form class="form-group insert ajax_form" action="main_ajax.php?dir=country&page=add" method="POST" autocomplete="on" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="box2">
                                            <label id="name"> الاسم
                                                <span> * </span> </label>
                                            <input required class="form-control" type="text" name="cou_name">
                                        </div>
                                        <div class="box2">
                                            <label id="name_en"> الاسم الانجليزي<span> * </span></label>
                                            <input class="form-control" type="text" name="cou_name_en">
                                        </div>
                                        <div class="box2">
                                            <label id="name_en"> معلومات <span> * </span></label>
                                            <input class="form-control" type="text" name="cou_info">
                                        </div>

                                        <div class="box2">
                                            <label id="name_en"> معلومات باللغه الانجليزية <span> * </span></label>
                                            <input class="form-control" type="text" name="cou_info_en">
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="">
                                                <label> الصورة </label>
                                                <input id="logo" class="form-control dropify_" data-default-file="" type="file" name="image1" value="">
                                            </div>
                                            <div id="logo_" class="col-md-3">
                                            </div>
                                        </div>
                                        <div class="box submit_box">
                                            <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value=" اضافه دولة جديد ">
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
            <div class="add_new_record">
                <!--
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addrecord">
                    اضف دولة جديد <i class="fa fa-plus"></i>
                </button>
-->
            </div>
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> الاسم </th>
                        <th>البريد الالكروني</th>
                        <th> الجنسية </th>
                        <th> تاريخ الميلاد </th>
                        <th>رقم الدفعه</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody> <?php
                        $ind_id = $_GET['ind_id'];
                        $stmt = $connect->prepare('SELECT * FROM ind_register WHERE ind_id=?');
                        $stmt->execute(array($ind_id));
                        $alltype = $stmt->fetchAll();
                        foreach ($alltype as $type) { ?> <tr>
                            <td><?php echo $type['ind_name']; ?> </td>
                            <td><?php echo $type['ind_email']; ?> </td>
                            <td> <?php echo $type['ind_nationality']; ?> </td>
                            <td> <?php echo $type['ind_birthdate']; ?> </td>
                            <td> <?php echo $type['ind_batch']; ?> </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewrecord<?php echo $type['ind_id']; ?>">
                                    مشاهدة <i class="fa fa-eye"></i>
                                </button>
                                <a class="btn btn-info btn-sm" href="main.php?dir=chat&page=chat&ind_id=<?php echo $type['ind_id']; ?> ">
                                    تواصل <i class="fa fa-comment"></i>
                                </a>
                            </td>
                        </tr> <?php
                                ?>
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

                                                        <div class="box2">
                                                            <label id="name_en">درجة تقييم الأختبار النهائي<span> * </span></label>
                                                            <input class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_final_exam'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">درجة الأختبارات القصيرة<span> * </span></label>
                                                            <input class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_sub_exam'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">درجة الأداء و التطبيق<span> * </span></label>
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
                                                    </div>
                                                </div>
                                                <div class="box submit_box">
                                                    <input class="btn btn-outline-primary btn-sm" name="edit_record" type="submit" value="تعديل المستخدم">
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