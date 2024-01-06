<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة الاختبارات </li>
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
        <?php
        $stmt = $connect->prepare('SELECT ques_id FROM question order by ques_id DESC LIMIT 1');
        $stmt->execute();
        $next_question = $stmt->fetchcolumn();
        if ($next_question == 0) {
            $next_question_id = 1;
        } else {
            $next_question_id = $next_question + 1;
        }
        ?>
        <?php
        if (isset($_GET['ex_id'])) {
            $exam_id = $_GET['ex_id'];
        } else {
            $exam_id = "";
        }
        ?>
        <div class="modal fade" id="addrecord" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> اضافة سؤال جديد </h5>
                    </div>
                    <div class="modal-body">
                        <div class="myform">
                            <script>
                                function handleCheckboxClick(currentIndex) {
                                    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                                    for (var i = 0; i < checkboxes.length; i++) {
                                        if (i !== currentIndex) {
                                            checkboxes[i].checked = false;
                                        }
                                    }
                                }
                            </script>
                            <form class="form-group" action="main_ajax.php?dir=question&page=add" method="POST" autocomplete="on" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
                                    <div class="col-lg-12">
                                        <div class="box2">
                                            <label id="name"> ادخل السؤال
                                                <span> * </span> </label>
                                            <input required class="form-control" type="text" name="ques_ques">
                                        </div>
                                        <br>
                                        <br>
                                        <p class="alert alert-default-info"> ادخل اختيارات السؤال ! </p>
                                        <div class="box">
                                            <label id="name"> الاختيار الاول
                                                <span> * </span> </label>
                                            <input type="hidden" class="form-control" name="question_id[]" value="<?php echo $next_question_id ?>">
                                            <textarea rows="2" name="answer[]" required="" class="form-control"></textarea>
                                            <label><input type="checkbox" name="is_right[0]" class="is_right" value="1"> <small> الاجابة الصحيحة </small></label>
                                        </div>

                                        <div class="box">
                                            <label id="name"> الاختيار الثاني
                                                <span> * </span> </label>
                                            <input type="hidden" class="form-control" name="question_id[]" value="<?php echo $next_question_id ?>">
                                            <textarea rows="2" name="answer[]" required="" class="form-control"></textarea>
                                            <label><input type="checkbox" name="is_right[1]" class="is_right" value="1"> <small> الاجابة الصحيحة </small></label>
                                        </div>
                                        <div class="box">
                                            <label id="name"> الاختيار الثالث
                                                <span> * </span> </label>
                                            <input type="hidden" class="form-control" name="question_id[]" value="<?php echo $next_question_id ?>">
                                            <textarea rows="2" name="answer[]" required="" class="form-control"></textarea>
                                            <label><input type="checkbox" name="is_right[2]" class="is_right" value="1"> <small> الاجابة الصحيحة </small></label>
                                        </div>
                                        <div class="box">
                                            <label id="name"> الاختيار الرابع
                                                <span> * </span> </label>
                                            <input type="hidden" class="form-control" name="question_id[]" value="<?php echo $next_question_id ?>">
                                            <textarea rows="2" name="answer[]" required="" class="form-control"></textarea>
                                            <label><input type="checkbox" name="is_right[3]" class="is_right" value="1"> <small> الاجابة الصحيحة </small></label>

                                        </div>
                                        <div class="box submit_box">
                                            <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value=" إضافة سؤال ">
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
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addrecord">
                    اضف سؤال جديد <i class="fa fa-plus"></i>
                </button>
            </div>
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> عنوان السؤال </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody> <?php
                        $stmt = $connect->prepare('SELECT * FROM question 
                        WHERE exam_id=? ');
                        $stmt->execute(array($exam_id));
                        $alltype = $stmt->fetchAll();
                        foreach ($alltype as $type) { ?>
                        <tr>
                            <td><?php echo $type['ques_ques']; ?> </td>
                            <?php
                            ?>
                            <td>
                                <a class="btn btn-primary btn-sm" href="main.php?dir=question&page=view&ques_id=<?php echo $type['ques_id']; ?> ">
                                    مشاهدة <i class="fa fa-eye"></i>
                                </a>
                                <a class="confirm btn btn-danger btn-sm" href="main.php?dir=question&page=delete&ques_id=<?php echo $type['ques_id']; ?> ">
                                    حذف <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr> <?php
                                ?>
                        <!-- START MODEL TO Edit RECORD  -->
                        <!-- END RECORD TO EDIT NEW RECORD  -->
                        <!-- START MODEL VIEW  -->
                        <div class="modal fade" id="viewexam<?php echo $type['ques_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">مشاهدة السؤال</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="myform">
                                            <form class="form-group insert ajax_form" action="main_ajax.php?dir=individual&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="box2">
                                                            <label id="name"> ادخل السؤال
                                                                <span> * </span> </label>
                                                            <input required class="form-control" type="text" name="ques_ques" value="<?php echo $type["ques_ques"] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name"> الاختيار الاول
                                                                <span> * </span> </label>
                                                            <input required class="form-control" type="text" name="ques_ch1" value="<?php echo $type["ques_ch1"] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name"> الاختيار الثاني
                                                                <span> * </span> </label>
                                                            <input required class="form-control" type="text" name="ques_ch2" value="<?php echo $type["ques_ch2"] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name"> الاختيار الثالث
                                                                <span> * </span> </label>
                                                            <input required class="form-control" type="text" name="ques_ch3" value="<?php echo $type["ques_ch3"] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name"> الاختيار الرابع
                                                                <span> * </span> </label>
                                                            <input id="q4" required class="form-control" type="text" name="ques_ch4" value="<?php echo $type["ques_ch4"] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name"> اجابة السؤال
                                                                <span> * </span> </label>
                                                            <input required placeholder="من فضلك ادخل الاجابة مثل الاختيار الصحيح" class="form-control" type="text" name="ques_ans" value="<?php echo $type["ques_ans"] ?>">
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