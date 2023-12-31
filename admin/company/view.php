<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                     
                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة معلومات الشركة </li>
                </ol>
            </nav>
        </div>
        <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
        <!-- Content Row -->
        <!-- START MODEL TO ADD NEW RECORD  -->

        <div class="table-responsive">
            <div class="add_new_record">

            </div>
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> اسم الشركه </th>
                        <th>البريد الالكتروني</th>
                        <th> رقم السجل التجاري </th>
                        <th> مكان الشركه </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody> <?php
                        $com_id = $_GET['com_id'];
                        $stmt = $connect->prepare('SELECT * FROM company_register WHERE com_id=?');
                        $stmt->execute(array($com_id));
                        $alltype = $stmt->fetchAll();
                        foreach ($alltype as $type) { ?> <tr>
                            <td><?php echo $type['com_name']; ?> </td>
                            <td><?php echo $type['com_email']; ?> </td>
                            <td> <?php echo $type['com_num']; ?> </td>
                            <td> <?php echo $type['com_place']; ?> </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewrecord<?php echo $type['com_id']; ?>">
                                    مشاهدة <i class="fa fa-eye"></i>
                                </button>
                            </td>
                        </tr> <?php
                                ?>
                        <!-- START MODEL TO Edit RECORD  -->
                        <!-- Modal -->
                        <div class="modal fade" id="editrecord<?php echo $type['com_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل الشركه</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="myform">
                                            <form class="form-group insert ajax_form" action="main_ajax.php?dir=company&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                <input type="hidden" name="com_id" value="<?php echo $type['com_id'] ?>">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> اسم الشركه </label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> اسم الشركه باللغه الانجليزية</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name_en" value="<?php echo $type['com_name_en'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> اسم المستخدم </label>
                                                            <input class="form-control" id="com_name" type="text" name="com_username" value="<?php echo $type['com_username'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">البريد الالكتروني</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_email'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">رقم السجل التجاري</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_num'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">نشاط الشركة</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_active'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">مكان الشركه</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_place'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">افرع الشركه</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_braches'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">سنة التاسيس</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_founded'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">اوقات ساعات العمل</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_work_h'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">عدد الشفتات</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_work_libs'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> عدد ايام الاجازة الاسبوعية </label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_work_libs'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">نوع العمل</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_work_type'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> الراتب المقدر </label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_salary'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> العمولة المقدرة </label>
                                                            <input class="form-control" id="com_name" type="text" name="com_commission" value="<?php echo $type['com_work_libs'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label for="com_status"> حالة الشركه</label>
                                                            <select name="com_status" class="form-control" id="">
                                                                <option value=""> -- حدد حالة الشركه -- </option>
                                                                <option <?php if ($type['com_status'] == 0) echo 'selected'; ?> value="0"> غير نشطة </option>
                                                                <option <?php if ($type['com_status'] == 1) echo 'selected'; ?> value="1"> نشطة </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="box submit_box">
                                                        <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value=" تعديل حالة الشركه">
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
                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> <i class="fa fa-close"></i> اغلاق</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END RECORD TO EDIT NEW RECORD  -->
                        <!-- START MODEL VIEW  -->
                        <div class="modal fade" id="viewrecord<?php echo $type['com_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> مشاهدة الشركات </h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="myform">
                                            <form class="form-group insert ajax_form" action="main_ajax.php?dir=whatsapp&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                <input type="hidden" name="wha_id" value="<?php echo $type['com_id'] ?>">
                                                <div class="row">

                                                    <div class="col-lg-12">
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> اسم الشركه </label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> اسم الشركه باللغه الانجليزية</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name_en" value="<?php echo $type['com_name_en'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> اسم المستخدم </label>
                                                            <input class="form-control" id="com_name" type="text" name="com_username" value="<?php echo $type['com_username'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">البريد الالكتروني</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_email'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">رقم السجل التجاري</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_num'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">نشاط الشركة</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_active'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">مكان الشركه</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_place'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">افرع الشركه</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_braches'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">سنة التاسيس</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_founded'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">اوقات ساعات العمل</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_work_h'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">عدد الشفتات</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_work_libs'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> عدد ايام الاجازة الاسبوعية </label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_work_libs'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">نوع العمل</label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_work_type'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> الراتب المقدر </label>
                                                            <input class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_salary'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> العمولة المقدرة </label>
                                                            <input class="form-control" id="com_name" type="text" name="com_commission" value="<?php echo $type['com_work_libs'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label for="com_status"> حالة الشركه</label>
                                                            <select name="com_status" class="form-control" id="">
                                                                <option value=""> -- حدد حالة الشركه -- </option>
                                                                <option <?php if ($type['com_status'] == 0) echo 'selected'; ?> value="0"> غير نشطة </option>
                                                                <option <?php if ($type['com_status'] == 1) echo 'selected'; ?> value="1"> نشطة </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-close"></i> اغلاق </button>
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