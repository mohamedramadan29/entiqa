 <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ind_id =  $_POST['ind_id'];
        $batch_id =   $_POST['batch_id'];
        $formerror = [];
        if (empty($batch_id)) {
            $formerror[] = 'من فضلك حدد الدفعه ';
        }
        $stmt = $connect->prepare("UPDATE ind_register SET ind_batch=? WHERE ind_id=?");
        $stmt->execute([
            $batch_id,
            $ind_id,
        ]);
        if ($stmt) { ?>
         <div class="alert-success ">
             تم اضافة الفرد في دفعه جديدة بنجاح
             <?php
                $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_id=?");
                $stmt->execute(array($batch_id));
                $batch_data = $stmt->fetch();
                $ind_num = $batch_data['ind_num'] + 1;
                $stmt = $connect->prepare("UPDATE batches SET ind_num=? WHERE batch_id=?");
                $stmt->execute(array($ind_num, $batch_id));
                header("Location:main.php?dir=services_section&page=report");
                ?>
         </div>

 <?php }
    }
