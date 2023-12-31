<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page"> المقابلات الشخصية بين الافراد والشركات </li>
                </ol>
            </nav>
        </div>
        <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
        <!-- Content Row -->
        <!-- Start Update Compelete Contract Allllert -->
        <?php
        $stmt = $connect->prepare("UPDATE interview_notificaion SET inter_admin_noti=1 WHERE inter_admin_noti=0");
        $stmt->execute();
        ?>
        <!-- End Update Compelete Contract Allllert -->

        <div class="table-responsive">
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> اسم الشركة </th>
                        <th>اسم الفرد </th>
                        <th> تاريخ المقابلة </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody> <?php
                        $i = 1;
                        $stmt = $connect->prepare('SELECT * FROM interview_notificaion
                        INNER JOIN company_register ON company_register.com_id = interview_notificaion.noti_com_link
                        INNER JOIN ind_register ON ind_register.ind_id = interview_notificaion.noti_person_link');
                        $stmt->execute();
                        $alltype = $stmt->fetchAll();
                        foreach ($alltype as $type) { ?> <tr>
                            <td><?php echo $i++ ?> </td>
                            <td><?php echo $type['com_name']; ?> </td>
                            <td><?php echo $type['ind_name']; ?> </td>
                            <td> <?php
                                    // استلام التاريخ والوقت من الداتا بيز أو أي مصدر آخر
                                    $dateTimeString = $type['interview_date'];

                                    // تحويل السلسلة إلى كائن DateTime
                                    $dateTime = new DateTime($dateTimeString);

                                    // تحديد تنسيق التاريخ والوقت
                                    $dateFormat = "Y-m-d";
                                    $timeFormat = "h:i A";

                                    // الحصول على التاريخ والوقت بالتنسيق المطلوب
                                    $date = $dateTime->format($dateFormat);
                                    $time = $dateTime->format($timeFormat);

                                    // تحديد ما إذا كانت الساعة تقع في فترة الصباح أم المساء
                                    $period = $dateTime->format("A"); // AM أو PM

                                    // تحديد مساءً أو صباحًا
                                    $amOrPm = ($period == "AM") ? "صباحًا" : "مساءً";

                                    // عرض التاريخ والوقت والفترة (صباحًا أو مساءًا)
                                    echo "الموعد: $date $time $amOrPm"; ?> </td>

                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewrecord<?php echo $type['com_id']; ?>">
                                    تفاصيل الشركة <i class="fa fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editrecord<?php echo $type['ind_id']; ?>">
                                    تفاصيل الفرد <i class="fa fa-eye"></i>
                                </button>
                                </a>
                            </td>
                        </tr> <?php
                                ?>
                        <!-- START MODEL TO Edit RECORD  -->
                        <div class="modal fade" id="editrecord<?php echo $type['ind_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> تفاصيل المتدرب </h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="myform">
                                            <form class="form-group insert ajax_form" action="#" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                <input type="hidden" name="ind_id" value="<?php echo $type['ind_id'] ?>">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="box2">
                                                            <label id="name">الاسم
                                                                <span> * </span> </label>
                                                            <input readonly required class="form-control" type="text" name="ind_name" value="<?php echo $type['ind_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> البريد الالكروني <span> * </span></label>
                                                            <input readonly class="form-control" type="text" name="ind_email" value="<?php echo $type['ind_email'] ?>">
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
                                                            <label id="name_en"> امكانية التنقل للعمل في مدينة اخري <span> * </span></label>
                                                            <input readonly class="form-control" type="text" name="ind_transfer" value="<?php echo $type['ind_transfer'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">رقم الدفعه<span> * </span></label>
                                                            <input readonly class="form-control" type="text" name="ind_batch" value="<?php echo $type['ind_batch'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> مهارة اللغه الانجليزية <span> * </span></label>
                                                            <input readonly class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_english'] ?>">
                                                        </div>


                                                        <div class="box2">
                                                            <label id="name_en">درجة تقييم الأختبار النهائي<span> * </span></label>
                                                            <input readonly class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_final_exam'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">درجة الأختبارات القصيرة<span> * </span></label>
                                                            <input readonly class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_sub_exam'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">درجة الأداء و التطبيق<span> * </span></label>
                                                            <input readonly class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_exer_exam'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">درجة الحضور<span> * </span></label>
                                                            <input readonly class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_attend'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">النسبة النهائية<span> * </span></label>
                                                            <input readonly class="form-control" type="text" name="ind_english	" value="<?php echo $type['ind_degree_percen'] ?>">
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
                                                            <input readonly class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> اسم الشركه باللغه الانجليزية</label>
                                                            <input readonly class="form-control" id="com_name" type="text" name="com_name_en" value="<?php echo $type['com_name_en'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> اسم المستخدم </label>
                                                            <input readonly class="form-control" id="com_name" type="text" name="com_username" value="<?php echo $type['com_username'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">البريد الالكتروني</label>
                                                            <input readonly class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_email'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">رقم السجل التجاري</label>
                                                            <input readonly class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_num'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">نشاط الشركة</label>
                                                            <input readonly class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_active'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">مكان الشركه</label>
                                                            <input readonly class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_place'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">افرع الشركه</label>
                                                            <input readonly class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_braches'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">سنة التاسيس</label>
                                                            <input readonly class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_founded'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">اوقات ساعات العمل</label>
                                                            <input readonly class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_work_h'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">عدد الشفتات</label>
                                                            <input readonly class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_work_libs'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> عدد ايام الاجازة الاسبوعية </label>
                                                            <input readonly class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_work_libs'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name">نوع العمل</label>
                                                            <input readonly class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_work_type'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> الراتب المقدر </label>
                                                            <input readonly class="form-control" id="com_name" type="text" name="com_name" value="<?php echo $type['com_salary'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label class="form-label" for="com_name"> العمولة المقدرة </label>
                                                            <input readonly class="form-control" id="com_name" type="text" name="com_commission" value="<?php echo $type['com_work_libs'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label for="com_status"> حالة الشركه</label>
                                                            <select disabled name="com_status" class="form-control" id="">
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