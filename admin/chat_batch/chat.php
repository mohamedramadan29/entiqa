<?php
// if (!isset($_SESSION['admin_session']) || !isset($_SESSION['serv_name']) || !isset($_SESSION['coash_id'])) {
//     header("Location:index");
// }
$batch_id = $_GET['batch_id'];
$admin_id = $_SESSION['coash_id'];
$admin_name = 'admin';
$stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_batch=?");
$stmt->execute(array($batch_id));
$inds_data = $stmt->fetchAll();
?>
<div class="chat_section">
    <div class="container">
        <div class="data" id="chat">
            <div class="bread">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"> تواصل مع الدفعه </li>
                    </ol>
                </nav>
            </div>
            <div id="demo"></div>
        </div>
        <div class="form" id="send_message">
            <form action="javascript:void(0)" class="form-group insert ajax_form" id="ajax-form" method="POST" autocomplete="on" enctype="multipart/form-data">
                <div class="message_text">
                    <input type="hidden" id="batch_id" name="batch_id" value="<?php echo $batch_id; ?>">
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
                    <button type="submit" id="submit_button" class="btn btn-primary"> ارسال <i class="fa fa-paper-plane"></i></button>
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
            let batch_id = $("#batch_id").val();
            $.ajax({
                type: "POST",
                url: "main.php?dir=chat_batch&page=add&batch_id=" + batch_id,
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
            let admin_name = $("#admin_name").val();
            let batch_id = $("#batch_id").val();
            $.ajax({
                type: "POST",
                url: "main_ajax.php?dir=chat_batch&page=fetch_msg&batch_id=" + batch_id,
                dataType: "html",
                success: function(data) {
                    $('#demo').html(data);
                }
            });
        }, 1000);
    });
</script>