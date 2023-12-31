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
            $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id = ?");
            $stmt->execute(array($ind_id));
            $ind_data = $stmt->fetch();
            $ind_name = $ind_data['ind_username'];
        }
        if (isset($_GET['ex_id'])) {
            $exam_id = $_GET['ex_id'];
        }

        $stmt = $connect->prepare('SELECT * FROM question_answer WHERE exam_id=? AND user_id=?');
        $stmt->execute(array($exam_id, $ind_id));
        $allanswers = $stmt->fetchAll();
        $degree = 0;
        foreach ($allanswers as $answer) {
            $stmt = $connect->prepare('SELECT * FROM question_option WHERE option_id=?');
            $stmt->execute(array($answer['question_answer']));
            $grades = $stmt->fetchAll();

            foreach ($grades as $grade) {
                if ($grade['is_right'] == 1) {
                    $degree = $degree + 1;
                } else {
                    //echo 'Error Answer';
                }
            }
        }
        // echo $degree
        ?>
        <div class="table-responsive">

            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> اسم المتدرب </th>
                        <th> اسم الاختبار </th>
                        <th> عدد الاسئلة </th>
                        <th> تاريخ النشر </th>
                        <th> نوع الاختبار </th>
                        <th> درجة الاختبار للمتدرب </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $connect->prepare("SELECT * FROM exam WHERE ex_id=?");
                    $stmt->execute(array($exam_id));
                    $allexamq = $stmt->fetchAll();
                    foreach ($allexamq as $type) { ?>
                        <tr>
                            <td> <?php echo $ind_name; ?> </td>
                            <td><?php echo $type['ex_title']; ?> </td>
                            <td><?php echo $type['ex_total_question']; ?> </td>
                            <td> <?php echo $type['ex_date_publish']; ?> </td>
                            <td> <?php echo $type['ex_type']; ?> </td>
                            <td> <?php echo $degree; ?> </td>
                            <?php
                            ?>

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