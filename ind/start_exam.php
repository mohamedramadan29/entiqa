<?php
$pagetitle = '   الاختبار  ';
ob_start();
session_start();
if (isset($_SESSION['ind_id'])) {
    $ind_navabar = 'ind';
}
if (isset($_SESSION['ind_id']) || isset($_GET['ind_id'])) {
    include 'init.php';
    $ind_id = $_SESSION['ind_id'];
    if (isset($_GET['ind_id'])) {
        $ind_id = $_GET['ind_id'];
    }
?>
    <?php
    if (isset($_GET['exam_id'])) {
        $exam_id = $_GET['exam_id'];
        $stmt = $connect->prepare("SELECT * FROM ind_exams_login WHERE ind_id = ? AND exam_id = ?");
        $stmt->execute(array($ind_id, $exam_id));
        $countregister = $stmt->rowCount();
        // check if the user submitted before or not 
        $stmt = $connect->prepare("SELECT * FROM question_answer WHERE user_id = ? AND exam_id = ?");
        $stmt->execute(array($ind_id, $exam_id));
        $count_answer = $stmt->rowCount();
        if ($countregister > 0 && $count_answer > 0) {
            header("Location:exam");
        } else {
            $stmt = $connect->prepare("INSERT INTO ind_exams_login (ind_id,exam_id) VALUES (:zind_id,:zexam_id)");
            $stmt->execute(array(
                "zind_id" => $ind_id,
                "zexam_id" => $exam_id,
            ));
        }
    }
    /************** GET EXAM INFORMATION ***********************/
    $stmt = $connect->prepare("SELECT * FROM exam WHERE  ex_id = ?");
    $stmt->execute(array($exam_id));
    $exam_data = $stmt->fetch();
    $exam_time = $exam_data['ex_time'];
    $coash_id = $exam_data['coash_id'];
    ?>
    <div class="profile_hero exam_profile_hero" style="background-image: none;">
        <div class="overlay">
            <div class="container">
                <div class="data">
                    <br>
                    <br>
                    <br>

                    <h2 style="color: #000;"> بداية الاختبار </h2>
                    <div class="examination_timer">
                        <?php
                        // // تحديد وقت بدء الاختبار إذا لم يكن معرفًا بالفعل
                        // if (!isset($_SESSION['start_time'])) {
                        //     $_SESSION['start_time'] = time();
                        // }
                        // $time = 60 * $exam_time;

                        // $startTime = $_SESSION['start_time'];
                        // $currentTime = time();
                        // $elapsedTime = $currentTime - $startTime;
                        // $timeLimit = $time;

                        // تحديد وقت بدء الاختبار إذا لم يكن معرفًا بالفعل
                        if (!isset($_SESSION['start_time'])) {
                            $_SESSION['start_time'] = time();
                        }

                        $timeLimit = $exam_time * 60; // تحويل الوقت إلى ثواني
                        $elapsedTime = max(0, time() - $_SESSION['start_time']); // استخدم max للتأكد من أن القيمة لا تكون أقل من صفر

                        $remainingTime = max(0, $timeLimit - $elapsedTime); // استخدم max للتأكد من أن القيمة لا تكون أقل من صفر
                        ?>
                        <div id="CountDownTimer" data-timer="<?php echo $remainingTime; ?>" style="width: 500px; height: 250px;"></div>
                        <!-- <p class="notes"> اذا لم يتم الانتهاء من الاختبار في الوقت المحدد لم يحتسب لك نتيجة الاختبار </p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

    // GET USER INFORMATION

    $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id=?");
    $stmt->execute(array($ind_id));
    $ind_data = $stmt->fetch();
    $batch_id = $ind_data['ind_batch'];
    ?>
    <div class="exam_section">
        <div class="container">

            <?php echo $_SESSION['exam_session']; ?>
            <div class="data">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="info">
                            <div class="card">
                                <div class="card-body">
                                    <form id="send_response_form" method="POST" action="" class="form-group" enctype="multipart/form-data">
                                        <?php
                                        $stmt = $connect->prepare("SELECT * FROM question WHERE exam_id=?");
                                        $stmt->execute(array($exam_id));
                                        $alldate = $stmt->fetchAll();
                                        $i = 1;
                                        foreach ($alldate as $date) {
                                            $stmt = $connect->prepare("SELECT * FROM question_option WHERE question_id =?");
                                            $stmt->execute(array($date['ques_id']));
                                            $alloptions = $stmt->fetchAll();
                                        ?>
                                            <ul class="q-items list-group mt-4 mb-4">
                                                <li class="q-field list-group-item">
                                                    <strong> <?php echo $date['ques_ques'] ?></strong>
                                                    <input type="hidden" name="question_id[<?php echo $date['ques_id'] ?>]" value="<?php echo $date['ques_id'] ?>">
                                                    <br>
                                                    <ul class='list-group mt-4 mb-4'>
                                                        <?php
                                                        foreach ($alloptions as $option) { ?>
                                                            <li class="answer list-group-item">
                                                                <label><input type="radio" name="option_id[<?php echo $date['ques_id'] ?>]" value="<?php echo $option['option_id'] ?>"> <?php echo $option['option_text'] ?></label>
                                                            </li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </li>
                                            </ul>
                                        <?php
                                        }
                                        ?>
                                        <hr>
                                        <br>
                                        <button name="send_response" onclick="finishTest()" type="submit" class="btn" style="background-color: var(--main-color); color:#fff;margin: auto;display: block;"> ارسال اتمام الاختبار <i class="fa fa-send"></i> </button>
                                    </form>
                                    <?php
                                    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                                        //$option_id  = $_POST['option_id'];
                                        foreach ($_POST['question_id'] as $i => $value) {
                                            $user_id = $_SESSION['ind_id'];
                                            $exam_id = $exam_id;
                                            $question_id = $_POST['question_id'][$i];
                                            if (isset($_POST['option_id'][$i])) {
                                                $option_id  = $_POST['option_id'][$i];
                                            } else {
                                                $option_id  = 0;
                                            }
                                            $stmt = $connect->prepare("INSERT INTO question_answer
                                            (user_id,exam_id,question,question_answer)
                                            VALUES (:zuser_id,:zexam_id,:zquestion,:zq_answer)");
                                            $stmt->execute(array(
                                                "zuser_id" => $user_id,
                                                "zexam_id" => $exam_id,
                                                "zquestion" => $question_id,
                                                "zq_answer" => $option_id,
                                            ));
                                        }
                                        if ($stmt) {
                                            $stmt = $connect->prepare("INSERT INTO coash_notification (ind_id, noti_desc, noti_date,coash_id)
                                            VALUES (:zind_id, :znoti_desc, :znoti_date,:zcoash_id)
                                            ");
                                            $stmt->execute(array(
                                                'zind_id' => $ind_id,
                                                'znoti_desc' => "انتهاء اختبار ",
                                                'zcoash_id' => $coash_id,
                                                'znoti_date' => date("Y-m-d"),
                                            ));

                                    ?>
                                            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                                            <script>
                                                new swal({
                                                    title: " شكرا لك   !",
                                                    text: "تم ارسال الاختبار بنجاح!",
                                                    icon: "success",
                                                    button: "اغلاق",
                                                });
                                            </script>
                                            <?php header('refresh:3;url=exam.php');
                                            ?>
                                    <?php
                                        } else {
                                            echo "Not Good";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>



<?php
    // session_destroy();
    include $tem . "footer.php";
} else {
    header('Location:../index.php');
    exit();
}
?>

<script>
    $(document).ready(function() {
        $('.answer').each(function() {
            $(this).click(function() {
                $(this).find('input[type="radio"]').prop('checked', true).siblings('input[type="radio"]').prop('checked', false)
                $(this).css('background', '#00c4ff3d')
                $(this).siblings('li').css('background', 'white')
            })
        })
    })
</script>

<script>
    const examTime = <?php echo $remainingTime; ?>;
    let remainingTime = examTime;
    let timerInterval;

    function startTimer() {
        timerInterval = setInterval(function() {
            remainingTime--;

            if (remainingTime <= 0) {
                clearInterval(timerInterval);
                alert("انتهى وقت الاختبار، سيتم اعتماد الإجابات الخاصة بك.");

                // إرسال النموذج
                document.getElementById("send_response_form").submit();
                // تأخير تغيير موقع الصفحة بعد الإعلان
                setTimeout(function() {
                    window.location.href = "exam";
                }, 1000); // تأخير لمدة 1 ثانية
            }
        }, 4000);
    }

    // ابدأ العد التنازلي
    startTimer();
</script>

<!-- <script>
    window.onload = function() {
        if (performance.navigation.type == 1) {
            alert(' لقد قمت باعادة تحميل الصفحة :) ');
            document.getElementById("send_response_form").submit();
            // يمكنك هنا تنفيذ أي شيء تريده عند إعادة تحميل الصفحة
        }
    };
</script> -->

<!-- 
<script>
    if (history.pushState) {
        //Chrome and modern browsers
        history.pushState(null, document.title, location.href);
        window.addEventListener('popstate', function(event) {
            history.pushState(null, document.title, location.href);
        });
    } else {
        //IE
        history.forward();
    }
</script> -->