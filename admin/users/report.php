<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    
                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة الحجوزات </li>
                </ol>
            </nav>
        </div>
        <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
        <!-- Content Row -->
        <!-- START MODEL TO ADD NEW RECORD  -->
        <!-- END RECORD TO EDIT NEW RECORD  -->

        <div class="table-responsive">
            <!--
            <div class="add_new_record">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addrecord">
                    اضف كورس جديد <i class="fa fa-plus"></i>
                </button>
            </div>
                                            -->
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>الاسم الاول </th>
                        <th> الاسم الاخير </th>
                        <th>البريد الالكتروني</th>
                        <th>ارسال تاكيد</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody> <?php
                        $stmt = $connect->prepare('SELECT * FROM customer 
                        INNER JOIN specialt ON customer.spe_id = specialt.spe_id
                        INNER JOIN degree ON customer.deg_id = degree.deg_id
                        INNER JOIN university ON customer.uni_id = university.uni_id
                        INNER JOIN course ON customer.course_id = course.course_id
                        INNER JOIN country ON customer.cou_id = country.cou_id
                        
                        ');
                        $stmt->execute();
                        $alltype = $stmt->fetchAll();
                        foreach ($alltype as $type) { ?> <tr>
                            <td><?php echo $type['cus_name']; ?> </td>
                            <td><?php echo $type['cus_last']; ?> </td>
                            <td> <?php echo $type['cus_email']; ?> </td>
                            <?php
                            if ($type['cus_confirm'] == 0) { ?>
                                <td> <a target="_blank" href="https://www.google.com" class="btn btn-danger btn-sm"> ارسال تاكيد <i class="fa fa-paypal"></i></a> </td>
                            <?php
                            } else { ?>

                                <td> <a target="_blank" href="https://www.google.com" class="btn btn-success btn-sm"> تم تاكيد <i class="fa fa-paypal"></i></a> </td>
                            <?php
                            }
                            ?>

                            <td>
                                <!--
                                <a data-bs-toggle="modal" data-bs-target="#editrecord" class=" btn btn-success btn-sm" href="main.php?dir=whatsapp&page=edit&wha_id=<?php echo $type['wha_id']; ?> ">
                                    تعديل <i class="fa fa-edit"></i>
                                </a>-->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewrecord<?php echo $type['cus_id']; ?>">
                                    مشاهدة <i class="fa fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editrecord<?php echo $type['cus_id']; ?>">
                                    تعديل <i class="fa fa-edit"></i>
                                </button>
                                <a class="confirm btn btn-danger btn-sm" href="main.php?dir=users&page=delete&cus_id=<?php echo $type['cus_id']; ?> ">
                                    حذف <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr> <?php
                                ?>
                        <!-- START MODEL TO Edit RECORD  -->
                        <div class="modal fade" id="editrecord<?php echo $type['cus_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل المستخدم</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="myform">
                                            <form class="form-group insert ajax_form" action="main_ajax.php?dir=users&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                <input type="hidden" name="cus_id" value="<?php echo $type['cus_id'] ?>">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="box2">
                                                            <label id="name"> الاسم الاول
                                                                <span> * </span> </label>
                                                            <input required class="form-control" type="text" name="cou_name" value="<?php echo $type['cus_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">الاسم الاخير<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_name_en" value="<?php echo $type['cus_last'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">رقم الهاتف<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['cus_mobile'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">البريد الالكتروني<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['cus_email'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> الدولة<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['cou_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> الكورس <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['course_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> الجامعه <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['uni_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> التخصص <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['spe_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> الدرجة <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['deg_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> حالة المستخدم <span> * </span></label>
                                                            <select name="cus_state" id="" class="form-control">
                                                                <option value=""> تعديل حالة المستخدم </option>
                                                                <option <?php if ($type['cus_state'] == 0) echo "selected" ?> value="0"> غير مفعل </option>
                                                                <option <?php if ($type['cus_state'] == 1) echo "selected" ?> value="1"> مفعل </option>
                                                            </select>

                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en">تاكيد<span> * </span></label>
                                                            <select name="cus_confirm" id="" class="form-control">
                                                                <option value=""> تاكيد المستخدم </option>
                                                                <option <?php if ($type['cus_confirm'] == 0) echo "selected" ?> value="0">لم يتم التاكيد</option>
                                                                <option <?php if ($type['cus_confirm'] == 1) echo "selected" ?> value="1"> تم التاكيد </option>
                                                            </select>

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
                        <div class="modal fade" id="viewrecord<?php echo $type['cus_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">مشاهدة المستخدم</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="myform">
                                            <form class="form-group insert ajax_form" action="main_ajax.php?dir=whatsapp&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                <input type="hidden" name="cus_id" value="<?php echo $type['cus_id'] ?>">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="box2">
                                                            <label id="name"> الاسم الاول
                                                                <span> * </span> </label>
                                                            <input required class="form-control" type="text" name="cou_name" value="<?php echo $type['cus_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">الاسم الاخير<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_name_en" value="<?php echo $type['cus_last'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">رقم الهاتف<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['cus_mobile'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">البريد الالكتروني<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['cus_email'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> الدولة<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['cou_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> الكورس <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['course_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> الجامعه <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['uni_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> التخصص <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['spe_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> الدرجة <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['deg_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> حالة المستخدم <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php
                                                                                                                                if ($type['cus_state'] == 0) {
                                                                                                                                    echo "غير مفعل";
                                                                                                                                } else {
                                                                                                                                    echo "مفعل";
                                                                                                                                }
                                                                                                                                ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> تاكيد المستخدم <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php
                                                                                                                                if ($type['cus_confirm'] == 0) {
                                                                                                                                    echo "لم يتم التاكيد";
                                                                                                                                } else {
                                                                                                                                    echo "تم التاكيد";
                                                                                                                                }
                                                                                                                                ?>">
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