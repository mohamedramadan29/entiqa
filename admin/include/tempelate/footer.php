<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="<?php echo $js; ?>bootstrap.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <!-- END RATING SYSTEM -->
  <script src="https://kit.fontawesome.com/588e070751.js" crossorigin="anonymous"></script>
  <!-- Bootstrap -->
   <!-- <script src="<?php echo $js; ?>datatables.min.js"></script>   -->
  <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
  <script src="<?php echo $js; ?>select2.min.js"></script>
  <script src="<?php echo $js; ?>custome.js"></script>
  <script src="dist/js/adminlte.js"></script>
  <!-- START SEND DATA WITH AJAX -->
  <!-- Check File Size And Check IF More Than 5 m Or Not  -->
  <script>
    function checkFileSize() {
      var fileInput = document.getElementById('customFile');
      var fileLabel = document.getElementById('fileLabel');

      // Get the selected files
      var files = fileInput.files;

      // Max file size in megabytes
      var maxSize = 5; // 5 MB

      // Check each selected file
      for (var i = 0; i < files.length; i++) {
        var fileSizeMB = files[i].size / (1024 * 1024); // Convert to megabytes
        if (fileSizeMB > maxSize) {
          alert('حجم الملف يجب أن يكون أقل من 5 ميجابايت.');
          // Clear the file input
          fileInput.value = '';
          // Reset the label text
          fileLabel.innerHTML = 'اختيار ملفات';
          return;
        }
      }
      // Update the label with selected file names
      if (files.length > 0) {
        fileLabel.innerHTML = files.length + ' ملف مختار';
      } else {
        fileLabel.innerHTML = 'اختيار ملفات';
      }
    }
  </script>

  <script>
    function checkFileType() {
      var fileInput = document.getElementById('customFile');
      var allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/png', 'application/pdf'];

      for (var i = 0; i < fileInput.files.length; i++) {
        var fileType = fileInput.files[i].type;

        if (allowedTypes.indexOf(fileType) === -1) {
          // نوع الملف غير مسموح
          alert('يرجى اختيار ملف صورة أو ملف PDF فقط.');

          // إعادة تعيين قيمة الملف بعد تأخير قصير
          setTimeout(function() {
            fileInput.value = '';
          }, 100);

          return;
        }
      }
    }
  </script>

  <script>
    function checkFileTypePdf() {
      var fileInput = document.getElementById('customFile');
      var allowedTypes = ['application/pdf'];
      for (var i = 0; i < fileInput.files.length; i++) {
        var fileType = fileInput.files[i].type;

        if (allowedTypes.indexOf(fileType) === -1) {
          // نوع الملف غير مسموح
          alert(' نوع الملف يجب ان يكون pdf فقط ');

          // إعادة تعيين قيمة الملف بعد تأخير قصير
          setTimeout(function() {
            fileInput.value = '';
          }, 100);

          return;
        }
      }
    }
  </script>


  <!--  Customize Required Message -->
  <script>
    function setCustomValidityArabic(element, message) {
      element.setCustomValidity(message);
    }

    function resetCustomValidity(element) {
      element.setCustomValidity('');
    }
  </script>

  <!-- To Show Hide Password -->
  <script>
    function togglePasswordVisibility(inputId, iconElement) {
      var passwordInput = document.getElementById(inputId);
      var icon = iconElement.classList;
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.remove("fa-eye-slash");
        icon.add("fa-eye");
      } else {
        passwordInput.type = "password";
        icon.remove("fa-eye");
        icon.add("fa-eye-slash");
      }
    }
  </script>


  </div>
  </div>


  </body>

  </html>