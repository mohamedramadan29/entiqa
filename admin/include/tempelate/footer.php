  <script src="<?php echo $js; ?>jquery.min.js"></script>
  <script src="<?php echo $js; ?>bootstrap.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <!-- END RATING SYSTEM -->
  <script src="https://kit.fontawesome.com/588e070751.js" crossorigin="anonymous"></script>
  <!-- Bootstrap -->
  <script src="<?php echo $js; ?>datatables.min.js"></script>
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

  </div>
  </div>


  </body>

  </html>