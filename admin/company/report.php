<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة الشركات </li>
                </ol>
            </nav>
        </div>
        <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
        <!-- Content Row -->
        <!-- START MODEL TO ADD NEW RECORD  -->

        <!-- Start Update Company View Allllert -->
        <?php
        $stmt = $connect->prepare("UPDATE company_register SET com_updated=1 WHERE com_updated=0");
        $stmt->execute();
        ?>
        <!-- End Update Company View Allllert -->
        <!-- Modal -->
        <div class="modal fade" id="addrecord" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> اضافة مستشار جديد </h5>
                    </div>
                    <div class="modal-body">
                        <div class="myform">
                            <form class="form-group insert ajax_form" action="main_ajax.php?dir=whatsapp&page=add" method="POST" autocomplete="on" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="box2">
                                            <label id="name"> الاسم
                                                <span> * </span> </label>
                                            <input required class="form-control" type="text" name="wha_name">
                                        </div>
                                        <div class="box2">
                                            <label id="name_en"> الاسم الانجليزي<span> * </span></label>
                                            <input class="form-control" type="text" name="wha_name_en">
                                        </div>
                                        <div class="box2">
                                            <label id="name_en"> رقم المستشار <span> * </span></label>
                                            <input min="1" class="form-control" type="number" name="wha_order">
                                        </div>
                                        <div class="box2">
                                            <label id="name_en"> رقم الواتساب <span> * </span></label>
                                            <input class="form-control" type="text" name="wha_number">
                                        </div>
                                        <div class="box2">
                                            <label id="name_en"> نبذة مختصرة <span> * </span></label>
                                            <input class="form-control" type="text" name="wha_info">
                                        </div>

                                        <div class="box2">
                                            <label id="name_en"> نبذة مختصرة باللغه الانجليزية <span> * </span></label>
                                            <input class="form-control" type="text" name="wha_info_en">
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
                                            <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value=" اضافه مستشار جديد ">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- START RESPONSE SPACE  -->
                            <!-- area to display a message after completion of upload -->
                            <div class='status'></div>
                            <br>
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
        <?php



        ?>
        <div class="table-responsive">
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> اسم الشركه </th>
                        <th> اسم الشركه [en] </th>
                        <th> رقم الهاتف </th>
                        <th>تاريخ الانضمام </th>
                        <th>البريد الالكتروني</th>
                        <th> السجل التجاري </th>
                        <th> التفاوضات المكتملة </th>
                        <th> التفاوضات لم تكتمل </th>
                        <th> الرصيد </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody> <?php
                        $i = 1;
                        $stmt = $connect->prepare('SELECT * FROM company_register ORDER BY com_id DESC');
                        $stmt->execute();
                        $alltype = $stmt->fetchAll();
                        foreach ($alltype as $type) { ?> <tr>
                            <td><?php echo $i++; ?> </td>
                            <td><?php echo $type['com_name']; ?> </td>
                            <td><?php echo $type['com_name_en']; ?> </td>
                            <td> <?php echo $type['com_phone']; ?> </td>
                            <td> <?php echo  date('Y-m-d', strtotime($type['start_date'])); ?> </td>
                            <td><?php echo $type['com_email']; ?> </td>
                            <td> <?php echo $type['com_num']; ?> </td>
                            <td>
                                <?php
                                // عدد التفاوضات المكتملة 
                                $stmt = $connect->prepare("SELECT * FROM contract_complete WHERE company_id=?");
                                $stmt->execute(array($type['com_id']));
                                $count_compelete = $stmt->rowCount();
                                if ($count_compelete > 0) {
                                    echo $count_compelete;
                                } else {
                                    echo "لا يوجد ";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                // عدد التفاوضات لم تكتمل 
                                $stmt = $connect->prepare("SELECT * FROM contract_cancel WHERE company_id=?");
                                $stmt->execute(array($type['com_id']));
                                $count_cancel = $stmt->rowCount();
                                if ($count_cancel > 0) {
                                    echo $count_cancel;
                                } else {
                                    echo "لا يوجد ";
                                }
                                ?>
                            </td>
                            <td> <?php echo $type['com_balance']; ?> </td>
                            <td>
                                <!-- <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewrecord<?php echo $type['com_id']; ?>">
                                    <i class="fa fa-eye"></i>
                                </button> -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editrecord<?php echo $type['com_id']; ?>">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <?php
                                if (isset($_SESSION['admin_session'])) {
                                ?>
                                    <a class="confirm btn btn-danger btn-sm" href="main.php?dir=company&page=delete&com_id=<?php echo $type['com_id']; ?> ">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <?php
                                }
                                ?>
                                <a class="btn btn-info btn-sm" href="main.php?dir=com_chat&page=chat&com_username=<?php echo $type['com_username']; ?> ">
                                    <i class="fa fa-comment"></i>
                                </a>
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
                                                            <label class="form-label" for="com_name"> اسم الشركه بالعربية</label>
                                                            <input disabled class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> اسم الشركه باللغه الانجليزية</label>
                                                            <input disabled class="form-control" id="com_name" type="text" name="com_name_en" value="<?php echo $type['com_name_en'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> اسم المستخدم </label>
                                                            <input disabled class="form-control" id="com_name" type="text" name="com_username" value="<?php echo $type['com_username'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">البريد الالكتروني</label>
                                                            <input disabled class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_email'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_phone"> رقم الهاتف </label>
                                                            <input disabled class="form-control" id="com_phone" type="text" name="com_phone" value="<?php echo $type['com_phone'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">رقم السجل التجاري</label>
                                                            <input disabled class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_num'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">نشاط الشركة</label>
                                                            <input disabled class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_active'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">مقر الشركه</label>
                                                            <input disabled class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_place'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">افرع الشركه</label>
                                                            <textarea readonly class="form-control" name="" id=""><?php echo $type['com_braches'] ?></textarea>
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">سنة التاسيس</label>
                                                            <input disabled class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_founded'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">اوقات ساعات العمل <span> [ ساعه ] </span></label>
                                                            <input disabled class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_work_h'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">عدد الشفتات</label>
                                                            <input disabled class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_work_libs'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> عدد ايام الاجازة الاسبوعية<span> [ يوم ] </span></label>
                                                            <input disabled class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_weekend_num'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">نوع العمل</label>
                                                            <input disabled class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_work_type'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> الراتب المقدر <span> [ ريال سعودي ] </span> </label>
                                                            <input disabled class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_salary'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> العمولة المقدرة <span> [ % ] </span></label>
                                                            <input disabled class="form-control" id="com_name" type="text" name="com_commission" value="<?php echo $type['com_commission'] ?>">
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
                        <!-- START MODEL VIEW   
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
                            -->
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