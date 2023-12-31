<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                     
                    <li class="breadcrumb-item active" aria-current="page"> عرض السؤال </li>
                </ol>
            </nav>
        </div>
        <?php
        if (isset($_GET['ques_id'])) {
            $ques_id = $_GET['ques_id'];
            $stmt = $connect->prepare("SELECT * FROM question WHERE ques_id=?");
            $stmt->execute(array($ques_id));
            $question_data = $stmt->fetch();
        }
        ?>

        <div class="new_update_form">
            <div class="myform">
                <form class="form-group insert" action="" method="POST" autocomplete="on" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
                        <div class="col-lg-12">
                            <div class="box2">
                                <label id="name"> السؤال
                                    <span> * </span> </label>
                                <input disabled class="form-control" type="text" name="ques_ques" value="<?php echo $question_data['ques_ques']; ?>">
                            </div>
                            <br>
                            <br>
                            <p class="alert alert-default-info"> اختيارات السؤال ! </p>
                            <?php
                            $stmt = $connect->prepare("SELECT * FROM question_option WHERE question_id =?");
                            $stmt->execute(array($ques_id));
                            $question_option_data = $stmt->fetchAll();
                            foreach ($question_option_data as $i => $value) {
                                //echo $question_option_data[$i][3];
                            ?>
                                <div class="box">
                                    <label id="name"> الاختيار
                                    </label>
                                    <input type="hidden" class="form-control" name="question_id[]" value="<?php echo $ques_id; ?>">
                                    <textarea disabled rows="2" name="answer[]" required="" class="form-control"> <?php echo $question_option_data[$i][1] ?></textarea>
                                    <label><input disabled type="radio" <?php if ($question_option_data[$i][3] == 1) echo "checked"; ?> name="is_right[]" class="is_right" value="1"> <small> الاجابة الصحيحة </small></label>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="box submit_box d-none">
                                <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value="تعديل سؤال">
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $exam_id = $_POST["exam_id"];
    $ques_ques = $_POST["ques_ques"];

    $stmt = $connect->prepare("UPDATE question SET ques_ques=? WHERE ques_id =?");
    $stmt->execute([
        $ques_ques, $ques_id
    ]);
    if ($stmt) {
 
        $question_id = $_POST['question_id'];

        foreach ($_POST['answer'] as $i => $value) {
            if (isset($_POST['is_right'][$i])) {
                $is_right  = 1;
            } else {
                $is_right  = 0;
            }
            if (isset($_POST['answer'][$i])) {
                $answers  = $_POST['answer'][$i];
            }
            $stmt = $connect->prepare("UPDATE question_option SET option_text=?,is_right=? WHERE question_id =?");
            $stmt->execute(array(
                $answers,
                $is_right,
                $ques_id
            ));
        }



?>
        <div class="container">
            <div class="alert-success">
                تم تعديل السؤال بنجاح
                <?php
                ?>
            </div>
        </div>
<?php }
}
