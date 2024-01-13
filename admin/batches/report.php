<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة الدفعات </li>
                </ol>
            </nav>
        </div>
        <!-- END RECORD TO EDIT NEW RECORD  -->
        <div class="card">
            <div class="card-header">
                <div class="add_new_record">
                    <?php
                    if (isset($_SESSION['admin_id']) || isset($_SESSION['coash_id'])) {
                    ?>
                        <a href="main.php?dir=batches&page=add" type="button" class="btn btn-primary btn-sm">
                            اضف دفعه جديدة <i class="fa fa-plus"></i>
                        </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th> اسم الدفعه </th>
                                <th> اسم المدرب </th>
                                <th> تاريخ الانطلاق </th>
                                <th>عدد المسجلين في الدفعه</th>
                                <th>حالة الدفعه</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!isset($_SESSION['coash_id'])) {
                                $stmt = $connect->prepare('SELECT * FROM batches
        INNER JOIN coshes ON co_id WHERE coshes.co_id = batches.batch_coach ORDER BY batch_id DESC');
                                $stmt->execute();
                                $alltype = $stmt->fetchAll();
                            } elseif (isset($_SESSION['coash_id'])) {
                                $stmt = $connect->prepare('SELECT * FROM batches
        INNER JOIN coshes ON co_id WHERE batch_coach = ? AND  coshes.co_id = batches.batch_coach  ORDER BY batch_id DESC');
                                $stmt->execute(array($_SESSION['coash_id']));
                                $alltype = $stmt->fetchAll();
                            }
                            foreach ($alltype as $type) {
                                $batch_status = $type['batch_status'];
                            ?>
                                <tr>
                                    <td><?php echo $type['batch_name']; ?> </td>
                                    <td><?php echo $type['co_name']; ?> </td>
                                    <td> <?php echo $type['batch_start']; ?> </td>
                                    <td> <?php echo $type['ind_num']; ?> </td>
                                    <td>
                                        <button class="btn btn-default btn-sm"> <?php echo $type['batch_status']; ?> </button>
                                    </td>
                                    <td>
                                        <a href="main.php?dir=batches&page=view&batch_id=<?php echo $type['batch_id']; ?> " class="btn btn-warning btn-sm"> مشاهدة الدفعه <i class="fa fa-edit"></i> </a>
                                        <?php
                                        if (isset($_SESSION['coash_id'])) {
                                        ?>
                                            <a href="main.php?dir=chat_batch&page=chat&batch_id=<?php echo $type['batch_id']; ?> " class="btn btn-info btn-sm"> تواصل مع الدفعه <i class="fa fa-envelope"></i> </a>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        // if (!isset($_SESSION['coash_id'])) {
                                        ?>
                                        <a type="button" class="btn btn-primary btn-sm" href="main.php?dir=batches&page=edit&batch=<?php echo $type['batch_id'] ?>">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <?php
                                        if (isset($_SESSION['admin_session'])) {
                                        ?>

                                            <a class="confirm btn btn-danger btn-sm" href="main.php?dir=batches&page=delete&batch_id=<?php echo $type['batch_id']; ?> ">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        <?php
                                        } ?>
                                        <?php
                                        // }
                                        ?>
                                    </td>
                                </tr> <?php
                                        ?>
                                <!-- END RECORD TO EDIT NEW RECORD  -->
                                <!-- START MODEL VIEW  -->
                                <div class="modal fade" id="viewbatch<?php echo $type['batch_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">مشاهدة الدفعه</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="myform">
                                                    <form class="form-group insert ajax_form" action="main_ajax.php?dir=individual&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">

                                                        <div class="row">
                                                            <div class="batch_data">
                                                                <ul class="list-unstyled">
                                                                    <li> الاسم </li>
                                                                    <li> تاريخ الميلاد </li>
                                                                    <li> البريد الالكتروني </li>
                                                                    <li> الجنسية </li>
                                                                    <li> العنوان </li>
                                                                </ul>
                                                                <?php
                                                                $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_batch=?");
                                                                $stmt->execute(array($type['batch_id']));
                                                                $allind = $stmt->fetchAll();
                                                                foreach ($allind as $ind) { ?>
                                                                    <ul class="list-unstyled">
                                                                        <li><?php echo $ind['ind_name'];  ?></li>
                                                                        <li><?php echo $ind['ind_birthdate'];  ?></li>
                                                                        <li><?php echo $ind['ind_email'];  ?></li>
                                                                        <li><?php echo $ind['ind_nationality'];  ?></li>
                                                                        <li><?php echo $ind['ind_address'];  ?></li>
                                                                    </ul>
                                                                <?php
                                                                }

                                                                ?>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> <i class="fa fa-close"></i> اغلاق </button>
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
</div>
</div>