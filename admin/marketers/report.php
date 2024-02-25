<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page"> مشاهده المسوقين </li>
                </ol>
            </nav>
        </div>
        <?php
        if (isset($_SESSION['success_message'])) {
            $message = $_SESSION['success_message'];
            unset($_SESSION['success_message']);
        ?>
            <?php
            ?>
            <script src="plugins/jquery/jquery.min.js"></script>
            <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
            <script>
                $(function() {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: '<?php echo $message; ?>',
                        showConfirmButton: false,
                        timer: 2000
                    })
                })
            </script>
            <?php
        } elseif (isset($_SESSION['error_messages'])) {
            $formerror = $_SESSION['error_messages'];
            foreach ($formerror as $error) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="max-width: 800px; margin:20px">
                    <?php echo $error; ?>
                    <button style="font-size: 13px; top:-3px;" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php
            }
            unset($_SESSION['error_messages']);
        }
        ?>
        <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->


        <div class="table-responsive">

            <div class="card">

                <?php
                if (isset($_SESSION['success_message'])) {
                    $message = $_SESSION['success_message'];
                    unset($_SESSION['success_message']);
                ?>
                    <?php
                    ?>
                    <script src="plugins/jquery/jquery.min.js"></script>
                    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
                    <script>
                        $(function() {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: '<?php echo $message; ?>',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        })
                    </script>
                    <?php
                } elseif (isset($_SESSION['error_messages'])) {
                    $formerror = $_SESSION['error_messages'];
                    foreach ($formerror as $error) {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="max-width: 800px; margin:20px">
                            <?php echo $error; ?>
                            <button style="font-size: 13px; top:-3px;" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                <?php
                    }
                    unset($_SESSION['error_messages']);
                }
                ?>



                <?php
                if (isset($_SESSION['admin_session'])) {
                ?>
                    <div class="card-header">
                        <div class="add_new_record">
                            <a href="main.php?dir=marketers&page=add" class="btn btn-primary btn-sm"> اضافة مسوق جديد <i class="fa fa-plus"></i> </a>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="card-body">

                    <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th> الاسم </th>
                                <th> كود المسوق </th>
                                <th> الافراد </th>
                                <th> العمليات </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $connect->prepare("SELECT * FROM marketers order by id desc");
                            $stmt->execute();
                            $allmarketers = $stmt->fetchAll();
                            foreach ($allmarketers as $type) { ?> <tr>
                                    <td><?php echo $type['name']; ?> </td>
                                    <td><?php echo $type['code']; ?> </td>
                                    <td>
                                    <?php 
                                    $stmt = $connect->prepare("SELECT * FROM ind_register where marketer_id = ?");
                                    $stmt->execute(array($type['id']));
                                    $count_ind = $stmt->rowCount();
                                    if($count_ind > 0){
                                        ?>
                                        <a href="main.php?dir=marketers&page=users&market_id=<?php echo $type['id']; ?> " class="btn btn-primary btn-sm"> مشاهده الافراد </a>
                                        <?php 
                                    }else{
                                        ?>
                                        <span class="badge badge-danger"> لا يوجد </span>
                                        <?php 
                                    }
                                    ?>     </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editrecord<?php echo $type['id']; ?>">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <a class="confirm btn btn-danger btn-sm" href="main.php?dir=marketers&page=delete&id=<?php echo $type['id']; ?> ">
                                            <i class="fa fa-trash"></i>
                                        </a>

                                    </td>
                                </tr> <?php
                                        ?>
                                <!-- START MODEL TO Edit RECORD  -->
                                <div class="modal fade" id="editrecord<?php echo $type['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"> تعديل المسوق </h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="myform">
                                                    <form class="form-group insert ajax_form" action="main.php?dir=marketers&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                        <input type="hidden" name="marketer_id" value="<?php echo $type['id'] ?>">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="box2">
                                                                    <label id="name"> الاسم
                                                                        <span> * </span> </label>
                                                                    <input oninvalid="setCustomValidityArabic(this,'من فضلك ادخل اسم المسوق ')" oninput="resetCustomValidity(this)" required class="form-control" type="text" name="name" value="<?php echo $type['name']; ?>">
                                                                </div>
                                                                <div class="box2">
                                                                    <label id="name"> كود المسوق
                                                                        <span> * </span> </label>
                                                                    <input oninvalid="setCustomValidityArabic(this,'  من فضلك ادخل كود المسوق ')" oninput="resetCustomValidity(this)" class="form-control" type="text" name="code" value="<?php echo $type['code']; ?>">
                                                                </div>

                                                                <div class="box submit_box">
                                                                    <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value="تعديل المسوق">
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
                                                                    <input pattern="[a-zA-Z]+" oninvalid="setCustomValidityArabic(this,'يجب ان تكون الحروف المستخدمة فى اسم المتخدم حروف انجليزية فقط')" oninput="resetCustomValidity(this)" required class="form-control" type="text" name="ind_name" value="<?php echo $type['ind_name'] ?>">
                                                                </div>
                                                                <div class="box2">
                                                                    <label id="name"> كلمة المرور
                                                                        <span> * </span> </label>
                                                                    <input pattern="[a-zA-Z0-9]+" oninvalid="setCustomValidityArabic(this,' كلمه المرور يحب الا تحتوي علي احرف عربيه ')" oninput="resetCustomValidity(this)" required class="form-control" type="text" name="co_password" value="<?php echo $type['co_password']; ?>">
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
</div>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.insert').addEventListener('submit', function() {
            // تعطيل زر الإرسال بعد النقر
            var submitButton = this.querySelector('[type="submit"]');
            submitButton.setAttribute('disabled', 'disabled');

            // // إظهار رسالة أو رمز للتحميل
            // var loadingMessage = document.createElement('span');
            // loadingMessage.innerHTML = 'جاري التحميل...';
            // loadingMessage.style.marginLeft = '10px';
            // submitButton.parentNode.appendChild(loadingMessage);
        });
    });
</script>