 <?php
    if (isset($_SESSION['admin_session'])) {
        

        if (isset($_POST['add_car'])) {

            $name = sanitizeInput($_POST['name']);
            $code = sanitizeInput($_POST['code']);
             
            /// More Validation To Show Error
            $formerror = [];
            if (empty($name) || empty($code)) {
                $formerror[] = 'من فضلك ادخل المعلومات كاملة';
            }
            if (strlen($code) < 3) {
                $formerror[] = 'كود المسوق يجب ان يكون اكثر من ٣ ارقام';
            }

            $stmt = $connect->prepare("SELECT * FROM marketers WHERE name=?");
            $stmt->execute(array($name));
            $name_count = $stmt->rowCount();
            if ($name_count > 0) {
                $formerror[] = ' اسم المسوق موجود من قبل  ';
            }
            $stmt = $connect->prepare("SELECT * FROM marketers WHERE code=?");
            $stmt->execute(array($code));
            $code_count = $stmt->rowCount();
            if ($code_count > 0) {
                $formerror[] = ' هذا الكود موجود من قبل  ';
            }

            foreach ($formerror as $errors) {
                echo "<div class='alert alert-danger danger_message'>" .
                    $errors .
                    '</div>';
            }

            if (empty($formerror)) {
                $stmt = $connect->prepare("INSERT INTO marketers (name,code)
                VALUES (:zname,:zcode)");
                $stmt->execute([
                    'zname' => $name,
                    'zcode' => $code, 
                ]);
                if ($stmt) {

                    $_SESSION['success_message'] = ' تم اضافة مسوق جديد بنجاح';
    ?>
                 <div class="alert-success ">

                     تم اضافة مدرب جديد بنجاح
                     <?php
                      header("Location:main.php?dir=marketers&page=report");
                        ?>
                 </div>
 <?php }
            }
        }
    }else{
        header("Location:index");
    }
    ?>

 <div class="container customer_report">
     <div class="data">
         <div class="bread">
             <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                 <ol class="breadcrumb">

                     <li class="breadcrumb-item active" aria-current="page"> اضافه مسوق جديد </li>
                 </ol>
             </nav>
         </div>
         <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
         <!-- Content Row -->
         <div class="card">
             <div class="card-body">
                 <div class="myform">
                     <form class="form-group insert" action="" method="POST" autocomplete="on" enctype="multipart/form-data">
                         <div class="row">
                             <div class="col-lg-12">
                                 <div class="box2">
                                     <label id="name"> الاسم
                                         <span> * </span> </label>
                                     <input oninvalid="setCustomValidityArabic(this,' من فضلك ادخل اسم المسوق  ')" oninput="resetCustomValidity(this)" required minlength="5" maxlength="200" class="form-control" type="text" name="name">
                                 </div>
                                 <div class="box2">
                                     <label id="name"> الكود
                                         <span> * </span> </label>
                                     <input required oninvalid="setCustomValidityArabic(this,' من فضلك ادخل الكود  ')" oninput="resetCustomValidity(this)" class="form-control" type="text" name="code">
                                 </div>

                                 <div class="box submit_box">

                                     <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value=" اضافه مسوق جديد ">
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
         </div>


     </div>
 </div>
 </div>


 <!-- <script>
     document.addEventListener('DOMContentLoaded', function() {
         var form = document.getElementById('insert_new');

         form.addEventListener('submit', function() {
             var submitButton = document.getElementById('submit_button');
             submitButton.setAttribute('disabled', 'disabled');
         });
     });
 </script> -->