<?php
$com_username = $_GET['com_username'];

$stmt = $connect->prepare(" SELECT com_image from company_register  WHERE com_username = '$com_username'  ");
$stmt->execute();
$cc_image = $stmt->fetch();
$com_img = $cc_image['com_image'];



//  $admin_id = $_SESSION['coash_id'];
$admin_name = 'admin';
$stmt = $connect->prepare("SELECT * FROM company_register WHERE com_username=?");
$stmt->execute(array($com_username));
$com_data = $stmt->fetch();
// UPDATE MESSAGE NOTI 
$stmt = $connect->prepare("UPDATE chat SET admin_noti = 1 WHERE to_person='admin' AND admin_noti = 0 AND send_type='com'");
$stmt->execute();
?>
<div class="chat_section">
    <div class="container">
        <div class="data" id="chat">
            <div class="bread">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item active" aria-current="page"> تواصل مع الشركات </li>
                    </ol>
                </nav>
            </div>
            <div id="demo"></div>

        </div>
        <div class="form" id="send_message">
            <form action="javascript:void(0)" class="form-group insert ajax_form" id="ajax-form" method="POST" autocomplete="on" enctype="multipart/form-data">
                <div class="message_text">
                    <input type="hidden" id="com_username" value="<?php echo $com_username; ?>">
                    <input type="hidden" id="admin_name" value="<?php echo $admin_name ?>">
                    <input type="hidden" id="ind_img" value="<?php echo $com_img ?>">
                    <input id="to_person" type="hidden" name="to_person" value="<?php echo $com_username; ?>">
                    <textarea name="message_data" id="msg"></textarea>

                    <div class="send_attachments_div">
                        <label for="customFile" style="cursor: pointer;"> اختر المرفقات [pdf \ images] </label>
                        <span> <i class="fa fa-upload"></i> </span>
                        <input type="file" name="message_attachment[]" multiple class="form-control" id="customFile" onchange="checkFileType(),checkFileSize()" accept="image/*, .pdf">
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
                    <button type="submit" class="btn btn-primary" id="submit_button"> ارسال <i class="fa fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
            let formData = new FormData(this);
            var submitButton = document.getElementById('submit_button');
            submitButton.setAttribute('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url: "main_ajax.php?dir=chat&page=add",
                data: formData,
                contentType: false,
                processData: false,
                success: () => {
                    $("#msg").val('');
                    $("#customFile").val('');
                    $("#fileLabel").text('اختيار ملفات');
                    submitButton.removeAttribute('disabled');
                    $("#demo").load();
                    // إزالة جميع الملفات من القائمة بعد الرفع
                    selectedFiles = [];
                    updateFileList();

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
                    <button class="btn btn-danger btn-sm" onclick="removeFile(${index})"> <i style='text-align:center;margin:auto;' class='fa fa-trash'></i> </button>
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
            let admin_name = $("#admin_name").val();
            let com_username = $("#com_username").val();
            $.ajax({
                type: "POST",
                url: "main_ajax.php?dir=com_chat&page=fetch_msg&com_username=" + com_username + '&admin_name=' + admin_name,
                dataType: "html",
                success: function(data) {
                    $('#demo').html(data);
                }
            });
        }, 1000);
    });
</script>