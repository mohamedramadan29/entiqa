<?php
ob_start();
session_start();
$pagetitle = 'الرسائل';
$ind_navabar = 'ind';
if (isset($_SESSION['ind_id'])) {
    $ind_id = $_SESSION['ind_id'];
    $ind_username = $_SESSION['ind_username'];
    include 'init.php';
    if (isset($_GET['coash_id'])) {
        $coash_id = $_GET['coash_id'];
    }
    if (isset($_GET["other"])) {
        $other_person = $_GET["other"];
    } else {
        $other_person = 'admin';
    }
    if ($other_person == 'admin') {
        $stmt = $connect->prepare("SELECT * FROM admin WHERE admin_name=?");
        $stmt->execute(array($other_person));
        $user_data = $stmt->fetch();

        /// Update Message Notification
        $stmt = $connect->prepare("UPDATE chat SET ind_noti=1 WHERE 
          ind_noti=0 AND from_person=?");
        $stmt->execute(array('admin'));
    } elseif ($other_person != 'admin' && $other_person != 'coash') {
        $stmt = $connect->prepare("SELECT * FROM  company_register WHERE com_username=?");
        $stmt->execute(array($other_person));
        $com_data = $stmt->fetch();
        /// Update Message Notification
        $stmt = $connect->prepare("UPDATE chat SET ind_noti=1 WHERE 
        ind_noti=0 AND from_person=?");
        $stmt->execute(array($_GET["other"]));


        /// Update Inter view Notification
        $stmt = $connect->prepare("UPDATE interview_notificaion SET update_at=? WHERE 
    noti_person_link=? AND noti_com_link=?");
        $stmt->execute(array(date('y-m-d'), $_SESSION['ind_id'], $com_data['com_id']));
    } elseif ($other_person == 'coash') {
        $stmt = $connect->prepare("UPDATE chat SET ind_noti=1 WHERE 
        to_person=? AND from_person='coash'");
        $stmt->execute(array($_SESSION['ind_username']));
    }

    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_username=?");
    $stmt->execute(array($_SESSION["ind_username"]));
    $ind_data = $stmt->fetch();
    $batch_id = $ind_data['ind_batch'];

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
                                    <?php
                                    if (isset($_GET['coash_id'])) {
                                    ?>
                                        <input type="hidden" name="coash_id" value="<?php echo $coash_id ?>">
                                        <input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>">
                                    <?php
                                    }
                                    ?>
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
                                <button type="submit" class="btn btn-primary" name="send_new_message" id="submit_button"> ارسال <i class="fa fa-paper-plane"></i></button>
                        </div>
                        </form>

                    </div>
                </div>
                <div class="col-lg-4">
                    <?php
                    if ($other_person == 'admin') { ?>
                        <div class="chat_reason">
                            <h2>معلومات حول التواصل</h2>
                            <div class="info">
                                <p> تواصل من ادارة انتقاء </p>
                            </div>
                        </div>
                    <?php
                    } elseif ($other_person == 'coash') {
                    ?>
                        <div class="chat_reason">
                            <h2>معلومات حول التواصل</h2>
                            <div class="info">
                                <p> تواصل مع المدرب الخاص بك </p>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="chat_reason">
                            <h2>معلومات حول التواصل</h2>
                            <div class="info">
                                <p> تواصل بشان طلب تفاوض جديد </p>
                                <a style="margin-bottom: 15px;" href="company_profile.php?com_username=<?php echo $other_person; ?>" class="btn btn-primary"><i class="fa fa-eye"></i> مشاهدة معلومات الشركة </a>

                                <?php
                                $stmt = $connect->prepare("SELECT * FROM interview_notificaion WHERE noti_person_link=? AND noti_com_link=?");
                                $stmt->execute(array($_SESSION['ind_id'], $com_data['com_id']));
                                $allinterviewdata = $stmt->fetchAll();
                                $count = $stmt->rowCount();
                                if ($count > 0) { ?>
                                    <p> لديك طلب مقابلة شخصية من الشركة </p>
                                    <div class="bg bg-primary p-2">
                                        <?php
                                        foreach ($allinterviewdata as $intdata) { ?>
                                            <ul class="list-unstyled">
                                                <li style="font-size: 16px;" class="date"> <?php
                                                                                            // استلام التاريخ والوقت من الداتا بيز أو أي مصدر آخر
                                                                                            $dateTimeString = $intdata['interview_date'];

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
                                                                                            echo "الموعد: $date $time $amOrPm";
                                                                                            ?> </li>
                                            </ul>
                                    </div>
                            <?php
                                        }
                                    }
                            ?>
                            <div class="chat_com_option">
                                <?php
                                $stmt = $connect->prepare("SELECT * FROM contract_complete WHERE ind_id = ? AND company_id = ?");
                                $stmt->execute(array($_SESSION['ind_id'], $com_data['com_id']));
                                $count_contract = $stmt->rowCount();
                                $stmt = $connect->prepare("SELECT * FROM contract_cancel WHERE ind_id = ? AND company_id = ?");
                                $stmt->execute(array($_SESSION['ind_id'], $com_data['com_id']));
                                $count_cancel = $stmt->rowCount();
                                if ($count_contract > 0) {
                                ?>
                                    <div class="alert alert-info"> تم اتمام التعاقد مع الشركه <i class="fa fa-check"></i></div>
                                <?php
                                } elseif ($count_cancel > 0) {
                                ?>
                                    <div class="alert alert-danger"> تم الغاء الاتفاق مع الشركه <i class="fa fa-xbox"></i></div>
                                <?php
                                } else {
                                ?>
                                    <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        الغاء الاتفاق مع الشركه
                                    </button>
                                <?php
                                }
                                ?>
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
                                                    <p> هل انت متاكد من الغاء العرض مع الشركه </p>
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
                                                ind_id,cancel_reason,sender) VALUES (:zcom_id,:zind_id,:zcancel_reason,:zsender)");
                                    $stmt->execute(array(
                                        'zcom_id' =>  $com_data['com_id'],
                                        'zind_id' => $_SESSION['ind_id'],
                                        'zcancel_reason' => $cancel_reason,
                                        'zsender' => $_SESSION['ind_id']
                                    ));
                                    if ($stmt) {
                                        $stmt = $connect->prepare("DELETE FROM interview_notificaion WHERE noti_com_link= ? AND  noti_person_link = ?");
                                        $stmt->execute(array($com_data['com_id'], $_SESSION['ind_id']));
                                ?>
                                        <div class="alert alert-success"> تم الغاء العرض بنجاح </div>
                                        <?php header("refresh:0;url=profile"); ?>
                                <?php
                                    }
                                }
                                ?>
                                <?php
                                $stmt = $connect->prepare("SELECT * FROM ind_review WHERE ind_id=? AND com_id = ? ORDER BY rev_id DESC LIMIT 1");
                                $stmt->execute(array($_SESSION['ind_id'], $com_data['com_id']));
                                $review_data = $stmt->fetch();
                                $count_review = $stmt->rowCount();
                                if ($count_review > 0) {
                                ?>
                                    <div class="alert alert-success"> <?php echo $review_data['ind_review']; ?> </div>
                                <?php
                                } else {
                                ?>
                                    <div class="company_review">
                                        <form action="" method="post">
                                            <textarea required placeholder="من فضلك اكتب تقييمك للمنصة" name="com_review" id="" class="form-control"></textarea>
                                            <input class="btn btn-primary" name="send_review" type="submit" value="   ارسال التقييم  ">
                                        </form>
                                        <?php
                                        if (isset($_POST['send_review'])) {
                                            $review = $_POST['com_review'];
                                            $stmt = $connect->prepare("INSERT INTO ind_review (ind_id,com_id, ind_review) VALUES (:zind_id,:zcom_id,:zind_review)");
                                            $stmt->execute(array(
                                                "zind_id" => $_SESSION['ind_id'],
                                                "zcom_id" => $com_data['com_id'],
                                                "zind_review" => $review,
                                            ));
                                            if ($stmt) {
                                                header("Location:ind_message.php?other=" . $other_person);
                                        ?>
                                                <div class="alert alert-success"> شكرا لك علي تقييمك لمنصة انتقاء </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                <?php

                                }
                                ?>

                            </div>
                            </div>
                        </div>
                    <?php
                    } ////
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
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
                    $("#fileDeleteButton").remove();
                    submitButton.removeAttribute('disabled');
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