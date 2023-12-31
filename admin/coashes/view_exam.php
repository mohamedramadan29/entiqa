<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                     
                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة الاختبارات التي قام بيها المتدرب </li>
                </ol>
            </nav>
        </div>
        <?php
        if (isset($_GET['ind_id'])) {
            $ind_id = $_GET['ind_id'];
        }
        $stmt = $connect->prepare("UPDATE coash_notification SET status = 1 WHERE coash_id=?");
        $stmt->execute(array($_SESSION['coash_id']));

        $stmt = $connect->prepare("SELECT * FROM question_answer
        INNER JOIN exam ON question_answer.exam_id = exam.ex_id
        WHERE user_id=? GROUP BY exam_id");
        $stmt->execute(array($ind_id));
        $allexamq = $stmt->fetchAll();
        $getanswerss = 0;
        foreach ($allexamq as $exam) {
            $stmt = $connect->prepare("SELECT * FROM question WHERE exam_id=?");
            $stmt->execute(array($exam["exam_id"]));
            $allquestion = $stmt->fetchAll();
            foreach ($allquestion as $question) {
                //  echo  $grade["question_answer"] ;

                $stmt = $connect->prepare("SELECT * FROM question_option WHERE question_id =? AND is_right=1");
                $stmt->execute(array($question["ques_id"]));
                $question_options = $stmt->fetchAll();
                foreach ($question_options as $options) {
                    //echo $options["question_id"];
                    //echo "</br>";
                    //echo $options["option_id"];
                    //echo "</br>";
                    //  echo "////////////////////////////////////////////////////////////////////////////";
                    $stmt = $connect->prepare("SELECT * FROM question_answer WHERE question_answer=? AND user_id=?");
                    $stmt->execute(array($options["option_id"], $ind_id));
                    $new_count = $stmt->RowCount();
                    $allanserer = $stmt->fetchAll();
                    foreach ($allanserer as $ans) {
                        // echo $ans["question_answer"];
                    }
                }
            }
        }
        //echo $new_count;


        ?>
        <div class="table-responsive">
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> اسم الاختبار </th>
                        <th> تاريخ النشر </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $connect->prepare("SELECT * FROM question_answer
                    INNER JOIN exam ON question_answer.exam_id = exam.ex_id
                     WHERE user_id=? GROUP BY exam_id");
                    $stmt->execute(array($ind_id));
                    $allexamq = $stmt->fetchAll();
                    foreach ($allexamq as $type) { ?>
                        <tr>
                            <td><?php echo $type['ex_title']; ?> </td>
                            <td> <?php echo $type['ex_date_publish']; ?> </td>
                            <?php
                            ?>
                            <td>
                                <a class="btn btn-primary btn-sm" href="main.php?dir=coashes&page=view_exam_degree&ex_id=<?php echo $type['ex_id']; ?>&ind_id=<?php echo $ind_id; ?> ">
                                    مشاهدة درجة وتفاصيل الاختبار <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr> <?php
                                ?>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>