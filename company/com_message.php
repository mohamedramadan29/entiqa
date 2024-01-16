<?php
$pagetitle = 'الرسائل';
ob_start();
session_start();
$com_navbar = 'com';
if (isset($_SESSION['com_id'])) {

    $com_id = $_SESSION['com_id'];
    $com_username = $_SESSION['com_username'];
    include 'init.php';
    if (isset($_GET["other"])) {
        $other_person = $_GET["other"];
    } else {
        $other_person = 'admin';
    }
    if ($other_person == "admin") {
        $stmt = $connect->prepare("SELECT * FROM admin WHERE admin_name=?");
        $stmt->execute(array($other_person));
        $user_data = $stmt->fetch();
    } else {
        $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_username=?");
        $stmt->execute(array($other_person));
        $user_data = $stmt->fetch();
    }
    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
    $stmt->execute(array($_SESSION["com_id"]));
    $com_data = $stmt->fetch();
    /// Update Message Notification
    $stmt = $connect->prepare("UPDATE chat SET com_noti=1 WHERE 
        com_noti=0 AND from_person=?");
    $stmt->execute(array($_GET["other"]));



    // get the subscribe amount for company

    /* get the subsciption payment */
    $stmt = $connect->prepare("SELECT * FROM subscribe LIMIT 1");
    $stmt->execute();
    $sub_data = $stmt->fetch();
    $ind_sub_amount = $sub_data['company_subscribe'];
?>
    <div class="chat_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="data">
                        <div id="demo"></div>
                        <div class="form">
                            <form action="javascript:void(0)" class="form-group insert ajax_form" id="ajax-form" method="POST" autocomplete="on" enctype="multipart/form-data">
                                <div class="message_text">
                                    <input type="hidden" id="other_person" name="to_person" value="<?php echo $other_person ?>">
                                    <textarea name="message_data" id="msg"></textarea>
                                    <div class="send_attachments_div">
                                        <label for="customFile" style="cursor: pointer;"> اختر المرفقات [pdf \ images] </label>
                                        <span> <i class="fa fa-upload"></i> </span>
                                        <input type="file" name="message_attachment[]" multiple class="form-control" id="customFile" onchange="checkFileType(),checkFileSize()" accept="image/*, .pdf">
                                    </div>
                                    <div class="send_message_button">
                                        <?php
                                        if ($other_person == 'admin' || $other_person == 'coash') {
                                        ?>
                                            <p class="send_attachment btn btn-primary"> رفع المرفقات <i class="fa fa-file"></i> </p>
                                        <?php
                                        }
                                        ?>
                                        <button type="submit" class="btn btn-primary" id="submit_button"> ارسال <i class="fa fa-paper-plane"></i></button>
                                    </div>
                                    <div id="fileListContainer">
                                        <!-- ستظهر هنا قائمة الملفات المختارة -->
                                    </div>
                                    <script>
                                        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                                            var fileInput = e.target;
                                            var fileNames = Array.from(fileInput.files).map(file => file.name);
                                            document.querySelector('.custom-file-label').textContent = fileNames.join(', ');
                                        });
                                    </script>
                                </div>
                            </form>
                            <?php
                            if ($other_person != 'admin') {
                            ?>

                                <div class="attention">
                                    <p> <i class="fa fa-chevron-left"></i> يرجي التنوية بالنقر الي تحديد الموعد المقابلة المدرج اعلاة في حالة الرغبة </p>
                                    <p> <i class="fa fa-chevron-left"></i> يرجي التنوية في حال الرغبة في التعاقد علي زر اتمام التعاقد </p>
                                </div>
                            <?php
                            }
                            ?>
                            <style>
                                .attention {
                                    margin-top: 30px;
                                }

                                .attention p {
                                    font-size: 16px;
                                    color: #5c5a5a;
                                }

                                .attention p i {
                                    color: var(--main-color);
                                    margin-left: 10px;
                                    position: relative;
                                    top: 3px;
                                }
                            </style>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <?php
                    if ($other_person == 'admin') {
                    ?>
                        <div class="chat_reason">
                            <h2>معلومات حول التواصل</h2>
                            <div class="info">
                                <p> تواصل من ادارة انتقاء </p>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="chat_reason">
                            <h2>معلومات</h2>
                            <div class="info">
                                <p>تواصل مع المستخدم بشان طلب التعاقد</p>
                                <?php
                                $stmt = $connect->prepare("SELECT * FROM contract_complete WHERE ind_id=?");
                                $stmt->execute(array($user_data['ind_id']));
                                $count = $stmt->rowCount();
                                // check if this contract canceled before or not 
                                $stmt = $connect->prepare("SELECT * FROM contract_cancel WHERE company_id=? AND ind_id=?");
                                $stmt->execute(array($_SESSION["com_id"], $user_data['ind_id']));
                                $count_cancel = $stmt->rowCount();
                                if ($count > 0) { ?>
                                    <div class="alert alert-info"> تم اتمام التعاقد مع المتدرب من قبل <i class="fa fa-check"></i></div>
                                    <div class="chat_com_option">
                                        <div class="company_review">
                                            <?php
                                            $stmt = $connect->prepare("SELECT * FROM company_review WHERE com_id=? AND ind_id = ? ORDER BY rev_id DESC LIMIT 1");
                                            $stmt->execute(array($_SESSION['com_id'], $user_data['ind_id']));
                                            $review_data = $stmt->fetch();
                                            $count_review = $stmt->rowCount();
                                            if ($count_review > 0) {
                                            ?>
                                                <div class="alert alert-success"> <?php echo $review_data['com_review']; ?> </div>
                                            <?php
                                            } else {
                                            ?>
                                                <form action="" method="post">
                                                    <textarea required minlength="5" placeholder="من فضلك اكتب تقييمك للمنصة" name="com_review" id="" class="form-control"></textarea>
                                                    <input class="btn btn-primary" name="send_review" type="submit" value="   ارسال التقييم  ">
                                                </form>
                                                <?php
                                                if (isset($_POST['send_review'])) {
                                                    $review = sanitizeInput($_POST['com_review']);
                                                    $formerror = [];
                                                    if (empty($review)) {
                                                        $formerror[] = 'من فضلك اكتب تقيمك اولا ';
                                                    }
                                                    if (empty($formerror)) {
                                                        $stmt = $connect->prepare("INSERT INTO company_review (com_id,ind_id, com_review) VALUES (:zcom_id,:zind_id,:zcom_review)");
                                                        $stmt->execute(array(
                                                            "zcom_id" => $_SESSION['com_id'],
                                                            "zind_id" => $user_data['ind_id'],
                                                            "zcom_review" => $review,
                                                        ));
                                                        if ($stmt) {
                                                            header("Location:com_message.php?other=" . $other_person);
                                                ?>
                                                            <div class="alert alert-success"> شكرا لك علي تقيمك لمنصة انتقاء </div>
                                                        <?php
                                                        }
                                                    } else {
                                                        foreach ($formerror as $error) {
                                                        ?>
                                                            <div class="alert alert-danger"> <?php echo $error; ?> </div>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                } elseif ($count_cancel > 0) {

                                    /////////////////////////////// الغائ الاتفاق 
                                ?>
                                    <div class="alert alert-danger"> تم الغاء الاتفاق مع المتدرب من قبل <i class="fa fa-error"></i></div>
                                    <div class="chat_com_option">
                                        <div class="company_review">
                                            <?php
                                            $stmt = $connect->prepare("SELECT * FROM company_review WHERE com_id=? AND ind_id = ? ORDER BY rev_id DESC LIMIT 1");
                                            $stmt->execute(array($_SESSION['com_id'], $user_data['ind_id']));
                                            $review_data = $stmt->fetch();
                                            $count_review = $stmt->rowCount();
                                            if ($count_review > 0) {
                                            ?>
                                                <p> تقيمك لمنصه انتقاء </p>
                                                <div class="alert alert-success"> <?php echo $review_data['com_review']; ?> </div>
                                            <?php
                                            } else {
                                            ?>
                                                <form action="" method="post">
                                                    <textarea required minlength="5" placeholder="من فضلك اكتب تقييمك للمنصة" name="com_review" id="" class="form-control"></textarea>
                                                    <input class="btn btn-primary" name="send_review" type="submit" value="   ارسال التقييم  ">
                                                </form>
                                                <?php
                                                if (isset($_POST['send_review'])) {
                                                    $review = sanitizeInput($_POST['com_review']);
                                                    $formerror = [];
                                                    if (empty($review)) {
                                                        $formerror[] = 'من فضلك اكتب تقيمك اولا ';
                                                    }
                                                    if (empty($formerror)) {
                                                        $stmt = $connect->prepare("INSERT INTO company_review (com_id,ind_id, com_review) VALUES (:zcom_id,:zind_id,:zcom_review)");
                                                        $stmt->execute(array(
                                                            "zcom_id" => $_SESSION['com_id'],
                                                            "zind_id" => $user_data['ind_id'],
                                                            "zcom_review" => $review,
                                                        ));
                                                        if ($stmt) {
                                                            header("Location:com_message.php?other=" . $other_person);
                                                ?>
                                                            <div class="alert alert-success"> شكرا لك علي تقيمك لمنصة انتقاء </div>
                                                        <?php
                                                        }
                                                    } else {
                                                        foreach ($formerror as $error) {
                                                        ?>
                                                            <div class="alert alert-danger"> <?php echo $error; ?> </div>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php

                                } else { ?>
                                    <div class="chat_com_option">
                                        <?php
                                        $stmt = $connect->prepare('SELECT * FROM interview_notificaion WHERE noti_person_link=? AND noti_com_link=?');
                                        $stmt->execute(array($user_data['ind_id'], $_SESSION['com_id']));
                                        $count_inter = $stmt->rowCount();
                                        if ($count_inter > 0) { ?>
                                            <div class="alert alert-info">
                                                تم تحديد موعد المقابلة بنجاح <i class="fa fa-check"></i>
                                            </div>
                                        <?php
                                        } else { ?>
                                            <button class="btn btn-primary make_inter_time"> عمل للمقابلة الشخصية </button>
                                        <?php
                                        }
                                        ?>
                                        <div class="interview_options">
                                            <form action="" method="POST">
                                                <div class="box">
                                                    <label for="">تاريخ ووقت المقابلة</label>
                                                    <input required name="interview_date" type="text" class="form-control" id="interviewDate" />
                                                </div>
                                                <input class="btn btn-primary" name="send_interview" type="submit" value="  ارسال التوقيت للمتدرب">
                                            </form>
                                        </div>
                                        <?php
                                        if (isset($_POST['send_interview'])) {
                                            $formerror = [];
                                            $to_person =  $user_data['ind_id'];
                                            $date = sanitizeInput($_POST['interview_date']);
                                            if (empty($date)) {
                                                $formerror[] = 'من فضلك حدد تاريخ ووقت المقابله ';
                                            }
                                            if (empty($formerror)) {
                                                $stmt = $connect->prepare("INSERT INTO interview_notificaion (noti_title,noti_person_link,noti_com_link,interview_date)
                                                VALUES(:znoti_title,:znoti_perspn,:znoti_com,:zdate)");
                                                $stmt->execute(array(
                                                    "znoti_title" => "  طلب مقابلة شخصية ",
                                                    "znoti_perspn" => $to_person,
                                                    "znoti_com" => $_SESSION['com_id'],
                                                    "zdate" => $date,
                                                ));
                                                if ($stmt) { ?>
                                                    <div class="alert alert-success"> <i class="fa fa-check"></i> تم ارسال الموعد بنجاح </div>
                                                <?php
                                                    header("location:com_message?other=" . $other_person);
                                                }
                                            } else {
                                                foreach ($formerror as $error) {
                                                ?>
                                                    <div class="alert alert-danger"> <?php echo $error; ?> </div>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <button class="btn btn-warning send_con_contract"> اتمام التعاقد مع المتدرب </button>
                                        <!-- Modal -->
                                        <div class="compelete_contract">
                                            <div class="com_contract">
                                                <form action="" method="POST">
                                                    <?php
                                                    if ($com_data['com_balance'] < $ind_sub_amount) { ?>
                                                        <div class="alert alert-info"> لا يوجد لديك رصيد كافي لاتمام التعاقد مع المتدرب من فضلك يجب عليك شحن الرصيد اولا مبلغ التعاقد هو <?php echo $ind_sub_amount; ?> ريال سعودي </div>
                                                    <?php
                                                    } else { ?>
                                                        <p> هل انت متاكد من اتمام التعاقد مع المتدرب ...............
                                                            وخصم المبلغ المتفق علية وهو <?php echo $ind_sub_amount ?> ريال من الرصيد الخاص بك علي المنصة </p>
                                                        <input class="btn btn-primary" name="send_con_compelete" type="submit" value="  ارسال التاكيد">
                                                    <?php
                                                    }
                                                    ?>
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                        $price = $ind_sub_amount;
                                        if (isset($_POST['send_con_compelete'])) {
                                            $formerror = [];
                                            $stmt = $connect->prepare("SELECT * FROM contract_complete WHERE ind_id = ?");
                                            $stmt->execute(array($user_data['ind_id']));
                                            $count_before_contract = $stmt->rowCount();
                                            if ($count_before_contract > 0) {
                                                $formerror[] = 'هذا المتدرب متعاقد بالفعل مع شركه';
                                            }
                                            if (empty($formerror)) {
                                                $stmt = $connect->prepare("INSERT INTO contract_complete (company_id,
                                                ind_id,con_com_price) VALUES (:zcom_id,:zind_id,:zprice)");
                                                $stmt->execute(array(
                                                    'zcom_id' => $_SESSION['com_id'],
                                                    'zind_id' =>  $user_data['ind_id'],
                                                    'zprice' => $price
                                                ));
                                                if ($stmt) {
                                                    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id=?");
                                                    $stmt->execute(array($_SESSION['com_id']));
                                                    $com_data = $stmt->fetch();
                                                    $count = $stmt->rowCount();

                                                    $com_balance = $com_data['com_balance'];
                                                    $new_com_balance = $com_balance - $price;
                                                    if ($count > 0) {
                                                        $stmt = $connect->prepare("UPDATE company_register SET com_balance=? WHERE com_id=?");
                                                        $stmt->execute(array($new_com_balance, $_SESSION['com_id']));
                                                    }
                                                    $stmt = $connect->prepare("UPDATE ind_register SET ind_status=3 WHERE ind_id=?");
                                                    $stmt->execute(array($user_data['ind_id']));
                                        ?>
                                                    <div class="alert alert-success"> رااائع !! تم تاكيد الاتفاق مع المتدرب </div>
                                                <?php
                                                    header("refresh:3;url=profile");
                                                }
                                            } else {
                                                foreach ($formerror as $error) {
                                                ?>
                                                    <div class="alert alert-info"><?php echo $error; ?></div>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <?php
                                        $stmt = $connect->prepare("SELECT * FROM contract_complete WHERE ind_id = ? AND company_id = ?");
                                        $stmt->execute(array($user_data['ind_id'], $_SESSION['com_id']));
                                        $count_contract = $stmt->rowCount();
                                        if ($count_contract > 0) {
                                        ?>
                                        <?php
                                        }
                                        ?>
                                        <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            الغاء الاتفاق مع المتدرب
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"> الغاء الاتفاق </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="" method="post">
                                                        <div class="modal-body">
                                                            <p> هل انت متاكد من الغاء العرض مع المتدرب </p>
                                                            <label for=""> من فضلك اكتب سبب الالغاء </label>
                                                            <textarea required name="cancel_reason" class="form-control"></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button style="width: auto;" type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"> رجوع </button>
                                                            <button style="width: auto;" type="submit" class="btn btn-danger btn-sm" name="cancel_contract"> الغاء الاتفاق </button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        if (isset($_POST['cancel_contract'])) {
                                            $cancel_reason = $_POST['cancel_reason'];
                                            $stmt = $connect->prepare("INSERT INTO  contract_cancel (company_id,
                                                ind_id,cancel_reason) VALUES (:zcom_id,:zind_id,:zcancel_reason)");
                                            $stmt->execute(array(
                                                'zcom_id' => $_SESSION['com_id'],
                                                'zind_id' => $user_data['ind_id'],
                                                'zcancel_reason' => $cancel_reason
                                            ));
                                            if ($stmt) {
                                                // $stmt = $connect->prepare("DELETE FROM interview_notificaion WHERE noti_com_link= ? AND  noti_person_link = ?");
                                                // $stmt->execute(array($_SESSION['com_id'], $user_data['ind_id']));

                                        ?>
                                                <div class="alert alert-success"> تم الغاء الاتفاق بنجاح </div>
                                                <?php header("refresh:1;url=profile"); ?>
                                        <?php
                                            }
                                        }

                                        ?>
                                        <div class="company_review">
                                            <?php
                                            $stmt = $connect->prepare("SELECT * FROM company_review WHERE com_id=? AND ind_id = ? ORDER BY rev_id DESC LIMIT 1");
                                            $stmt->execute(array($_SESSION['com_id'], $user_data['ind_id']));
                                            $review_data = $stmt->fetch();
                                            $count_review = $stmt->rowCount();
                                            if ($count_review > 0) {
                                            ?>
                                                <div class="alert alert-success"> <?php echo $review_data['com_review']; ?> </div>
                                            <?php
                                            } else {
                                            ?>
                                                <form action="" method="post">
                                                    <textarea required minlength="5" placeholder="من فضلك اكتب تقييمك للمنصة" name="com_review" id="" class="form-control"></textarea>
                                                    <input id="submit_button" class="btn btn-primary" name="send_review" type="submit" value="   ارسال التقييم  ">
                                                </form>
                                                <?php
                                                if (isset($_POST['send_review'])) {
                                                    $review = sanitizeInput($_POST['com_review']);
                                                    $formerror = [];
                                                    if (empty($review)) {
                                                        $formerror[] = 'من فضلك اكتب تقيمك اولا ';
                                                    }
                                                    if (empty($formerror)) {
                                                        $stmt = $connect->prepare("INSERT INTO company_review (com_id,ind_id, com_review) VALUES (:zcom_id,:zind_id,:zcom_review)");
                                                        $stmt->execute(array(
                                                            "zcom_id" => $_SESSION['com_id'],
                                                            "zind_id" => $user_data['ind_id'],
                                                            "zcom_review" => $review,
                                                        ));
                                                        if ($stmt) {
                                                            header("Location:com_message.php?other=" . $other_person);
                                                ?>
                                                            <div class="alert alert-success"> شكرا لك علي تقيمك لمنصة انتقاء </div>
                                                        <?php
                                                        }
                                                    } else {
                                                        foreach ($formerror as $error) {
                                                        ?>
                                                            <div class="alert alert-danger"> <?php echo $error; ?> </div>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
    // check if this company active or not active 
    $stmt = $connect->prepare("SELECT * FROM company_register WHERE com_id = ?");
    $stmt->execute(array($_SESSION['com_id']));
    $company_data = $stmt->fetch();
    $active_status = $company_data['com_status'];
    $com_balance = $company_data['com_balance'];
    if ($active_status == 0 || $com_balance == 0 && $other_person != 'admin') {
        header('Location:index');
        exit();
    }
    include $tem . "footer.php";
} else {
    header('Location:index.php');
    exit();
}
?>

<script>
    $(document).ready(function() {
        // انتقل إلى الشات عند فتح الصفحة
        var target = $('#send_message');
        if (target.length) {
            $('html, body').scrollTop(target.offset().top);
        }
    });
</script>
<!-- to insert message -->
<script>
    $(document).ready(function($) {
        // قائمة لتخزين معلومات الملفات المختارة
        let selectedFiles = [];
        $('#ajax-form').submit(function(e) {
            e.preventDefault();
            var submitButton = document.getElementById('submit_button');
            submitButton.setAttribute('disabled', 'disabled');
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "ajax_send",
                data: formData,
                contentType: false,
                processData: false,
                success: () => {
                    $("#msg").val('');
                    $("#customFile").val('');
                    $("#fileLabel").text('اختيار ملفات');
                    $("#demo").load();
                    // إزالة جميع الملفات من القائمة بعد الرفع
                    selectedFiles = [];
                    updateFileList();
                    submitButton.removeAttribute('disabled');
                    $("#fileDeleteButton").remove();
                }
            });
        });
        // حذف ملف محدد
        window.removeFile = function(index) {
            selectedFiles.splice(index, 1);
            updateFileList();
        };

        // تحديث قائمة الملفات
        function updateFileList() {
            // حذف جميع العناصر في قائمة الملفات
            $('#fileListContainer').empty();

            // إضافة الملفات المحددة إلى قائمة الملفات
            selectedFiles.forEach((file, index) => {
                $('#fileListContainer').append(`
                <div>
                    <span>${file.name}</span>
                    <button class="btn btn-danger btn-sm" onclick="removeFile(${index})"> <i class='fa fa-trash'></i> </button>
                </div>
            `);
            });

            // إعادة تحديث قيمة ال input بناءً على الملفات المحددة
            let input = document.getElementById('customFile');
            if (selectedFiles.length > 0) {
                // إنشاء كائن FileList بناءً على الملفات المحددة
                let fileList = new DataTransfer();
                selectedFiles.forEach(file => fileList.items.add(file));
                // تعيين القيمة الجديدة للـ input
                input.files = fileList.files;
            } else {
                // إذا لم يتم اختيار ملفات، قم بتعيين قيمة فارغة للـ input
                input.value = null;
            }
        }
        // إضافة ملفات جديدة عند تحديد ملفات
        $('#customFile').on('change', function() {
            selectedFiles = Array.from(this.files);
            updateFileList();
        });
        // حذف جميع الملفات عند النقر على زر الحذف
        window.clearFiles = function() {
            selectedFiles = [];
            updateFileList();
            // إعادة تعيين قيمة الـ input بعد الحذف
            let input = document.getElementById('customFile');
            input.value = null;
            // إزالة زر الحذف
            $("#fileDeleteButton").remove();
        };
    });
</script>

<!-- to fetch message -->

<script type="text/javascript">
    $(document).ready(function() {
        setInterval(function() {
            let other = $("#other_person").val();
            let ind_username = $("#ind_username").val();
            $.ajax({
                type: "POST",
                url: "fetch_msg.php?other=" + other,
                dataType: "html",
                success: function(data) {
                    $('#demo').html(data);
                }
            });
        }, 1000);
    });
</script>