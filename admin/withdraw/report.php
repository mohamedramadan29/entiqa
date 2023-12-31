<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <i class="fa fa-heart"></i> <a href="main.php?dir=dashboard&page=dashboard"> <?php echo  $website_title; ?></a> <i class="fa fa-chevron-left"></i> </li>
                    <li class="breadcrumb-item active" aria-current="page"> طلبات سحب الاموال </li>
                </ol>
            </nav>
        </div>
        <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
        <!-- Content Row -->


        <!-- Start Update Company View Allllert -->
        <?php
        $stmt = $connect->prepare("UPDATE withdraw SET with_admin_noti=1 WHERE with_admin_noti=0");
        $stmt->execute();
        ?>
        <!-- End Update Company View Allllert -->

        <div class="table-responsive">
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> اسم الشركة </th>
                        <th> وسيلة السحب </th>
                        <th> المبلغ المطلوب سحبة </th>
                        <th> البريد الالكتروني </th>
                        <th> تاريخ الطلب </th>
                        <th> حالة الطلب </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody> <?php
                        $i = 1;
                        $stmt = $connect->prepare('SELECT * FROM  withdraw
                        INNER JOIN company_register ON company_register.com_id =  withdraw.com_id');
                        $stmt->execute();
                        $alltype = $stmt->fetchAll();
                        foreach ($alltype as $type) { ?> <tr>
                            <td><?php echo $i++ ?> </td>
                            <td><?php echo $type['com_name']; ?> </td>
                            <td><?php echo $type['with_method']; ?> </td>
                            <td> <?php echo $type['with_price']; ?> </td>
                            <td> <?php echo $type['with_email']; ?> </td>
                            <td> <?php echo $type['date']; ?> </td>
                            <td> <?php
                                    if ($type['with_status'] == 0) { ?>
                                    <button class="btn btn-danger btn-sm"> الطلب تحت المراجعه </button>
                                <?php
                                    } else {
                                ?>
                                    <button class="btn btn-success btn-sm"> تم السحب </button>

                                <?php
                                    }

                                ?>
                            </td>

                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editwithdraw<?php echo $type['id']; ?>">
                                    تعديل الطلب <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewrecord<?php echo $type['com_id']; ?>">
                                    تفاصيل الشركة <i class="fa fa-eye"></i>
                                </button>

                            </td>
                        </tr> <?php
                                ?>
                        <!-- start view company -->
                        <div class="modal fade" id="editwithdraw<?php echo $type['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> تعديل حالة الطلب </h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="myform">
                                            <form class="form-group edit ajax_form" action="main_ajax.php?dir=withdraw&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                <input type="hidden" name="with_id" value="<?php echo $type['id'] ?>">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="box">
                                                            <label for="com_status"> تعديل حالة الطلب </label>
                                                            <select name="with_status" class="form-control" id="">
                                                                <option value=""> -- حدد حالة الطلب -- </option>
                                                                <option <?php if ($type['with_status'] == 1) echo 'selected'; ?> value="1"> اكتمل التحويل </option>
                                                                <option <?php if ($type['with_status'] == 0) echo 'selected'; ?> value="0"> تحت المراجعه </option>
                                                            </select>
                                                        </div>
                                                        <div class="box submit_box">
                                                            <input class="btn btn-outline-primary btn-sm" name="" type="submit" value="تعديل  ">
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
                        <!-- start view company -->
                        <div class="modal fade" id="viewrecord<?php echo $type['com_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> مشاهدة تفاصيل الشركة </h5>
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