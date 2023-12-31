 <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['add_car'])) {
            $formerror = [];
            $exam_id = $_POST["exam_id"];
            $ques_ques = $_POST["ques_ques"];
            // check if this question added or not to this exam before
            $stmt = $connect->prepare("SELECT * FROM question WHERE exam_id = ? AND ques_ques=?");
            $stmt->execute(array($exam_id, $ques_ques));
            $count_exam_before = $stmt->rowCount();
            if ($count_exam_before > 0) {
                $formerror[] = 'تم اضافة هذا السؤال من قبل في هذا الأختبار';
            }
            // check if this question have more answeres or not have any answer
            $count = $_POST['answer'];
            $answers = $_POST['answer'];
            $question_id = $_POST['question_id'];
            $right_count = 0; // مُتغير لتعقب عدد الإجابات الصحيحة
            foreach ($_POST['answer'] as $i => $value) {
                $is_right = 0; // افتراضياً ليس هناك إجابة صحيحة
                if (isset($_POST['is_right'][$i])) {
                    $is_right = 1;
                    $right_count++; // زيادة العداد عندما يتم تحديد إجابة صحيحة
                } else {
                    $is_right  = 0;
                }
            }
            if ($right_count < 1) {
                $formerror[] =   "يجب اختيار إجابة واحدة على الأقل كصحيحة";
            } elseif ($right_count > 1) {
                $formerror[] = "اخترت أكثر من إجابة صحيحة، يجب اختيار إجابة واحدة فقط";
            }

            if (empty($ques_ques)) {
                $formerror[] = ' من فضلك ادخل عنوان الاختبار ';
            }
            // check if the number question equal the numbers in exam question 
            $stmt = $connect->prepare("SELECT * FROM question WHERE exam_id = ?");
            $stmt->execute(array($exam_id));
            $question_number = $stmt->rowCount();

            ////// 
            $stmt = $connect->prepare("SELECT * FROM exam WHERE ex_id=?");
            $stmt->execute(array($exam_id));
            $exam_data = $stmt->fetch();
            $question_number_in_exam = $exam_data['ex_total_question'];
            if ($question_number >= $question_number_in_exam) {
                $formerror[] = 'لا يمكن اضافة عدد اسئلة اخري لهذا الأختبار ';
            }
            if (empty($formerror)) {
                $stmt = $connect->prepare("INSERT INTO question (exam_id,ques_ques)
                VALUES (:zexam_id,:zques_ques)");
                $stmt->execute([
                    'zexam_id' => $exam_id,
                    'zques_ques' => $ques_ques
                ]);
                if ($stmt) {
                    $count = $_POST['answer'];
                    $answers = $_POST['answer'];
                    $question_id = $_POST['question_id'];
                    foreach ($_POST['answer'] as $i => $value) {
                        if (isset($_POST['is_right'][$i])) {
                            $is_right  = 1;
                        } else {
                            $is_right  = 0;
                        }
                        $stmt = $connect->prepare("INSERT INTO question_option (option_text,question_id,is_right)
                        VALUES (:zoption_text,:zquestion_id,:zis_right) ");
                        $stmt->execute(array(
                            'zoption_text' => $_POST['answer'][$i],
                            'zquestion_id' => $_POST['question_id'][$i],
                            'zis_right' => $is_right
                        ));
                    }
                    $_SESSION['success_message'] = " تمت الأضافة بنجاح  ";
                    header('LOCATION:main.php?dir=question&page=report&ex_id=' . $exam_id);
    ?>

                 <div class="alert-success ">
                     تم اضافة سوال جديد بنجاح
                     <?php
                        header('LOCATION:main.php?dir=question&page=report&ex_id=' . $exam_id);
                        ?>
                 </div>
             <?php
                }
            } else {
                $_SESSION['error_messages'] = $formerror;
                header('LOCATION:main.php?dir=question&page=report&ex_id=' . $exam_id);
                exit();
                foreach ($formerror as $error) {
                ?>
                 <div class="alert alert-danger"> <?php echo $error; ?> </div>
 <?php
                }
            }
        }
    }
