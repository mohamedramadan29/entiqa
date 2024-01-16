<?php
// if (!isset($_SESSION['admin_session']) || !isset($_SESSION['coash_id'])) {
//     header("Location:index");
// }

?>

<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page">تعديل نتائج المتدرب </li>
                </ol>
            </nav>
        </div>

        <?php
        if (isset($_GET['ind_id'])) {
            $ind_id = $_GET['ind_id'];
            $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_id=?");
            $stmt->execute(array($ind_id));
            $ind_data = $stmt->fetch();
        }
        ?>
        <?php
        $date_now = date("Y-m-d");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ind_sub_exam = $_POST["ind_sub_exam"];
            $ind_final_exam = $_POST["ind_final_exam"];
            $ind_exer_exam = $_POST["ind_exer_exam"];
            $ind_attend = $_POST["ind_attend"];
            $ind_degree_percen = $_POST["ind_degree_percen"];
            $ind_status = $_POST['ind_status'];
            $rating_star = $_POST['rating_star'];
            $stmt = $connect->prepare("UPDATE ind_register SET ind_sub_exam=?,
               ind_final_exam=?,ind_exer_exam=?,ind_attend=?,ind_degree_percen=?,ind_status=?,rating_star=? WHERE ind_id =?");
            $stmt->execute([
                $ind_sub_exam, $ind_final_exam,
                $ind_exer_exam, $ind_attend,
                $ind_degree_percen, $ind_status, $rating_star, $ind_id
            ]);
            if ($stmt) {
                if ($ind_status == 1) {
                    $stmt = $connect->prepare("UPDATE ind_register SET date_change_status=? WHERE ind_id =?");
                    $stmt->execute(array($date_now, $ind_id));
                    $stmt = $connect->prepare("SELECT * FROM ind_congrat WHERE ind_id = ?");
                    $stmt->execute(array($ind_id));
                    $count = $stmt->rowCount();
                    if ($count > 0) {
                    } else {
                        $stmt = $connect->prepare("INSERT INTO ind_congrat (ind_id, name, description) 
                        VALUES(:zind_id, :zname, :zdesc)
                        ");
                        $stmt->execute(array(
                            'zind_id' => $ind_id,
                            "zname" => 'تأهيل',
                            "zdesc" => ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ',
                        ));
                    }
                }
        ?>
                <div class="container">
                    <div class="alert-success">
                        تم تعديل المتدرب بنجاح
                        <?php
                        header("Location:main.php?dir=coashes&page=edit_user&ind_id=" . $ind_id)
                        ?>
                    </div>
                </div>
        <?php }
        }
        ?>
        <div class="new_update_form">
            <div class="myform">
                <form class="form-group insert" action="" method="POST" autocomplete="on" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
                        <div class="col-lg-12">
                            <div class="box2">
                                <label id="name">رقم الدفعه
                                    <span> * </span> </label>
                                <input disabled class="form-control" type="text" name="ind_batch" value="<?php echo $ind_data['ind_batch']; ?>">
                            </div>
                            <div class="box2">
                                <label id="name"> الاختبار النهائي
                                    <span> * </span> </label>
                                <input class="form-control" min="0" max="100" type="number" name="ind_final_exam" value="<?php echo $ind_data['ind_final_exam']; ?>">
                            </div>
                            <div class="box2">
                                <label id="name"> الاختبارات القصيرة
                                </label>
                                <input class="form-control" min="0" max="100" type="number" name="ind_sub_exam" value="<?php echo $ind_data['ind_sub_exam']; ?>">
                            </div>
                            <div class="box2">
                                <label id="name"> الأداء التطبيقي
                                </label>
                                <input class="form-control" min="0" max="100" type="number" name="ind_exer_exam" value="<?php echo $ind_data['ind_exer_exam']; ?>">
                            </div>
                            <div class="box2">
                                <label id="name"> الحضور
                                </label>
                                <input class="form-control" min="0" max="100" type="number" name="ind_attend" value="<?php echo $ind_data['ind_attend']; ?>">
                            </div>
                            <div class="box2">
                                <label id="name"> النتيجة النهائية
                                </label>
                                <input class="form-control" min="0" max="100" type="number" name="ind_degree_percen" value="<?php echo $ind_data['ind_degree_percen']; ?>">
                            </div>
                            <div class="box submit_box d-none">
                                <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value="تعديل سوال">
                            </div>
                            <div class="box2">
                                <label id="name_en"> حالة المتدرب <span> * </span></label>
                                <select required class="form-control" name="ind_status" id="select">
                                    <option value="" disabled> اختر </option>
                                    <option <?php if ($ind_data['ind_status'] == -1)
                                                echo "selected"; ?> value="-1"> لم يختبر </option>
                                    <option <?php if ($ind_data['ind_status'] == 0)
                                                echo "selected"; ?> value="0"> غير مؤهل </option>
                                    <option <?php if ($ind_data['ind_status'] == 1)
                                                echo "selected"; ?> value="1"> مؤهل </option>
                                    <option <?php if ($ind_data['ind_status'] == 2)
                                                echo "selected"; ?> value="2"> افضل المؤهلين </option>
                                </select>
                            </div>
                            <div class="box2">
                                <label for=""> التقيم النهائي [ نجمة * ] </label>
                                <select required name="rating_star" class="form-control select2" id="">
                                    <option value=""> التقيم النهائي </option>
                                    <option <?php if ($ind_data['rating_star'] == 1) echo 'selected'; ?> value="1"> 1 </option>
                                    <option <?php if ($ind_data['rating_star'] == 2) echo 'selected'; ?> value="2"> 2 </option>
                                    <option <?php if ($ind_data['rating_star'] == 3) echo 'selected'; ?> value="3"> 3 </option>
                                    <option <?php if ($ind_data['rating_star'] == 4) echo 'selected'; ?> value="4"> 4 </option>
                                    <option <?php if ($ind_data['rating_star'] == 5) echo 'selected'; ?> value="5"> 5 </option>
                                </select>
                            </div>

                        </div>
                        <div class="box submit_box">
                            <input class="btn btn-outline-primary btn-sm" name="add_car" type="submit" value="   تعديل النتائج  ">
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