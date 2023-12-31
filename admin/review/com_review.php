<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة تقييمات الشركات </li>
                </ol>
            </nav>
        </div>
        <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
        <!-- Content Row -->
        <div class="table-responsive">
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> اسم الشركة </th>
                        <th> التقييم </th>
                        <th> عرض التقييم </th>
                        <th> العمليات </th>
                    </tr>
                </thead>
                <tbody> <?php
                        $stmt = $connect->prepare('SELECT * FROM company_review 
                        INNER JOIN company_register ON company_review.com_id = company_register.com_id ORDER BY rev_id DESC ');
                        $stmt->execute();
                        $alltype = $stmt->fetchAll();
                        foreach ($alltype as $type) { ?> <tr>
                            <td><?php echo $type['com_name']; ?> </td>
                            <td><?php echo $type['com_review']; ?> </td>
                            <td><?php
                                if ($type['rev_show'] == 1) {
                                ?>
                                    <button class="btn btn-success btn-sm"> نعم </button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn btn-danger btn-sm"> لا </button>

                                <?php
                                } ?>
                            </td>
                            <td>
                                <a href="main.php?dir=review&page=edit_com&rev_id=<?php echo $type['rev_id']; ?>" type="button" class="btn btn-primary btn-sm">
                                    مشاهدة وتعديل <i class="fa fa-eye"></i>
                                </a>
                                <a class="confirm btn btn-danger btn-sm" href="main.php?dir=review&page=delete_com_review&rev_id=<?php echo $type['rev_id']; ?> ">
                                    حذف <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr> <?php
                                ?>

                        <!-- START MODEL VIEW  -->
                        <div class="modal fade" id="viewrecord<?php echo $type['rev_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">مشاهدة التقييم </h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="myform">
                                            <form class="form-group insert ajax_form" action="main_ajax.php?dir=review&page=edit_com" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                <input type="hidden" name="rev_id" value="<?php echo $type['rev_id'] ?>">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="box2">
                                                            <label id="name"> عرض التقييم في الموقع
                                                                <span> * </span> </label>
                                                            <select class="form-control" name="rev_show" id="">
                                                                <option value=""> -- اختر -- </option>
                                                                <option <?php if ($type['rev_show'] == 1) echo "selected"; ?> value="1"> نعم </option>
                                                                <option <?php if ($type['rev_show'] == 0) echo "selected"; ?> value="0" value="0"> لا </option>
                                                            </select>

                                                        </div>
                                                        <div class="box2">
                                                            <label id="name"> الشركة
                                                                <span> * </span> </label>
                                                            <input disabled class="form-control" type="text" name="com_id" value="<?php echo $type['com_name']; ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">التقييم <span> * </span></label>
                                                            <textarea name="com_review" class="form-control"><?php echo $type['com_review']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="box submit_box">
                                                        <input class="btn btn-outline-primary btn-sm" name="" type="submit" value=" تعديل التقييم ">
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-close"></i> اغلاق </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END  MODEL VIEW  -->
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>