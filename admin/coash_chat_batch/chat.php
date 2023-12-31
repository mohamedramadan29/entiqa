<?php
$ind_username = $_GET['ind_username'];
$admin_id = $_SESSION['coash_id'];
$admin_name = 'coash';
$stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_username=?");
$stmt->execute(array($ind_username));
$ind_data = $stmt->fetch();


$stmt = $connect->prepare("UPDATE chat SET admin_noti = 1 WHERE to_person='coash' AND  coash_id = ? AND admin_noti = 0 AND from_person = ?");
$stmt->execute(array($_SESSION['coash_id'], $ind_username));
?>
<div class="chat_section">
    <div class="container">
        <div class="data" id="chat">
            <div class="bread">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        
                        <li class="breadcrumb-item active" aria-current="page"> تواصل مع المتدرب </li>
                    </ol>
                </nav>
            </div>
            <div id="demo"></div>
        </div>
        <div class="form" id="send_message">
            <form action="javascript:void(0)" class="form-group insert ajax_form" id="ajax-form" method="POST" autocomplete="on" enctype="multipart/form-data">
                <div class="message_text"> 

                    <input type="hidden" id="ind_username" value="<?php echo $ind_username; ?>">
                    <input type="hidden" id="admin_name" value="<?php echo $admin_name ?>">
                    <input type="hidden" id="ind_img" value="<?php echo $ind_img ?>">
                    <input id="to_person" type="hidden" name="to_person" value="<?php echo $ind_data['ind_username']; ?>">
                    <textarea name="message_data" id="msg"></textarea>
                    <div class="custom-file">
                        <input type="file" name="message_attachment[]" multiple class="form-control" id="customFile" onchange="checkFileSize()">
                        <!-- <input type="file" name="message_attachment[]" multiple class="custom-file-input" id="customFile" aria-label="اختيار ملفات" onchange="checkFileSize()"> 
                        <label class="custom-file-label" for="customFile" id="fileLabel">اختيار ملفات</label>  -->
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
                    <button type="submit" class="btn btn-primary"> ارسال <i class="fa fa-paper-plane"></i></button>
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
            $.ajax({
                type: "POST",
                url: "main.php?dir=coash_chat_batch&page=add",
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
            let ind_username = $("#ind_username").val();
            $.ajax({
                type: "POST",
                url: "main_ajax.php?dir=coash_chat_batch&page=fetch_msg&ind_username=" + ind_username + '&admin_name=' + admin_name,
                dataType: "html",
                success: function(data) {
                    $('#demo').html(data);
                }
            });
        }, 1000);
    });
</script>