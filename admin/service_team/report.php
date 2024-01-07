<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page"> اعضاء فريق الخدمة </li>
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
        <!-- Content Row -->
        <!-- START MODEL TO ADD NEW RECORD  -->
        <div class="modal fade" id="addrecord" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> اضافة عضو جديد </h5>
                    </div>
                    <div class="modal-body">
                        <div class="myform">
                            <form class="form-group insert ajax_form" action="main.php?dir=service_team&page=add" method="POST" autocomplete="off" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="box2">
                                            <label id="name"> اسم المستخدم
                                                <span> * </span> </label>
                                            <input minlength="5" maxlength="50" required class="form-control" type="text" name="name">
                                        </div>
                                        <div class="box2 show_hide_password">
                                            <label id="name"> كلمة المرور
                                                <span> * </span> </label>
                                            <input required class="form-control" type="password" name="password" id="password">
                                            <span onclick="togglePasswordVisibility('password', this)" class="fa fa-eye-slash show_eye eye_icon"></span>
                                        </div>
                                        <div class="box2">
                                            <label id="name_en"> البريد الالكتروني <span> * </span></label>
                                            <input required class="form-control" type="email" name="email">
                                        </div>
                                        <div class="box2 show_hide_password">
                                            <label id="name"> تأكيد كلمة المرور
                                                <span> * </span> </label>
                                            <input required class="form-control" type="password" name="confirm_password" value="" id="password2">
                                            <span onclick="togglePasswordVisibility('password2', this)" class="fa fa-eye-slash show_eye eye_icon"></span>
                                        </div>

                                        <div class="box submit_box">

                                        </div>
                                    </div>
                                </div>

                                <!-- START RESPONSE SPACE  -->
                                <!-- area to display a message after completion of upload -->
                                <br>
                                <div class='status'></div>
                                <!-- END RESPONSE SPACE  -->
                        </div>
                    </div>
                    <div class="modal-footer">

                        <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value=" اضافه عضو جديد ">

                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"> <i class="fa fa-close"></i> اغلاق </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END RECORD TO EDIT NEW RECORD  -->

        <div class="table-responsive">
            <div class="add_new_record">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addrecord">
                    اضف عضو جديد <i class="fa fa-plus"></i>
                </button>
            </div>
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> الاسم </th>
                        <th>البريد الالكروني</th>
                        <th> العمليات </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $connect->prepare('SELECT * FROM service_team ORDER BY id DESC');
                    $stmt->execute();
                    $alltype = $stmt->fetchAll();
                    foreach ($alltype as $type) { ?> <tr>
                            <td><?php echo $type['name']; ?> </td>
                            <td><?php echo $type['email']; ?> </td>
                            <td>
                                <a href="main.php?dir=service_team&page=edit&member=<?php echo $type['id']; ?>" class="btn btn-primary btn-sm"> تعديل <i class="fa fa-edit"></i> </a>
                                <a class="confirm btn btn-danger btn-sm" href="main.php?dir=service_team&page=delete&id=<?php echo $type['id']; ?> ">
                                    حذف <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr> <?php
                                ?>
                        <!-- START MODEL TO Edit RECORD  -->
                        <div class="modal fade" id="editrecord<?php echo $type['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل العضو</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="myform">
                                            <form class="form-group insert ajax_form" action="main.php?dir=service_team&page=edit" method="POST" autocomplete="off" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?php echo $type['id'] ?>">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="box2">
                                                            <label id="name"> الاسم
                                                                <span> * </span> </label>
                                                            <input required minlength="5" maxlength="50" class="form-control" type="text" name="name" value="<?php echo $type['name']; ?>">
                                                        </div>
                                                        <div class="box2 show_hide_password">
                                                            <label id="name"> كلمه المرور القديمه
                                                                <span> * </span> </label>
                                                            <input class="form-control" type="password" name="password" value="<?php echo $type['password']; ?>" id="password<?php echo $type['id'] ?>">
                                                            <span onclick="togglePasswordVisibility('password<?php echo $type['id'] ?>', this)" class="fa fa-eye-slash show_eye eye_icon"></span>
                                                        </div>
                                                        <div class="box2 show_hide_password">
                                                            <label id="name"> تعديل كلمة المرور
                                                                <span> * </span> </label>
                                                            <input class="form-control" type="password" name="password" value="" id="password22">
                                                            <span onclick="togglePasswordVisibility('password22', this)" class="fa fa-eye-slash show_eye eye_icon"></span>
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> البريد الالكتروني <span> * </span></label>
                                                            <input required class="form-control" type="email" name="email" value=" <?php echo $type['email']; ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name"> تأكيد كلمة المرور
                                                                <span> * </span> </label>
                                                            <input class="form-control" type="password" name="confirm_password" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- START RESPONSE SPACE  -->
                                                <!-- area to display a message after completion of upload -->

                                                <br>
                                                <div class='status'></div>
                                                <!-- END RESPONSE SPACE  -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">

                                        <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value="تعديل">

                                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"> <i class="fa fa-close"></i> اغلاق </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- END RECORD TO EDIT NEW RECORD  -->
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