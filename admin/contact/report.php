<?php
if (!isset($_SESSION['admin_session']) && !isset($_SESSION['serv_name'])) {
    header("Location:index");
}

?>

<div class="container customer_report" style="padding: 0;">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة رسائل تواصل معنا </li>
                </ol>
            </nav>
        </div>
        <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
        <!-- Content Row -->

        <!-- Start Update Company View Allllert -->
        <?php
        $stmt = $connect->prepare("UPDATE contact SET admin_noti=1 WHERE admin_noti=0");
        $stmt->execute();
        ?>
        <!-- End Update Company View Allllert -->

        <div class="table-responsive">
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> الاسم الاول </th>
                        <th>الاسم الاخير</th>
                        <th>البريد الالكروني</th>
                        <th> رقم الهاتف </th>
                        <th> الاجراءات </th>
                    </tr>
                </thead>
                <tbody> <?php
                        $i = 1;
                        $stmt = $connect->prepare('SELECT * FROM contact ORDER BY con_id DESC');
                        $stmt->execute();
                        $alltype = $stmt->fetchAll();
                        foreach ($alltype as $type) { ?> <tr>
                            <td><?php echo $i++ ?> </td>
                            <td style="overflow-wrap: anywhere;"><?php echo $type['first_name']; ?> </td>
                            <td style="overflow-wrap: anywhere;"><?php echo $type['last_name']; ?> </td>
                            <td> <?php echo $type['email']; ?> </td>
                            <td> <?php echo $type['mobile']; ?> </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewrecord<?php echo $type['con_id']; ?>">
                                    مشاهدة <i class="fa fa-eye"></i>
                                </button>
                                <?php
                                if (isset($_SESSION['admin_session'])) {
                                ?>
                                    <a class="confirm btn btn-danger btn-sm" href="main.php?dir=contact&page=delete&con_id=<?php echo $type['con_id']; ?> ">
                                        حذف <i class="fa fa-trash"></i>
                                    </a>
                                <?php
                                }
                                ?>

                            </td>
                        </tr> <?php
                                ?>

                        <!-- START MODEL VIEW  -->
                        <div class="modal fade" id="viewrecord<?php echo $type['con_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">مشاهدة الرسالة</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="myform">
                                            <form class="form-group insert ajax_form" action="main_ajax.php?dir=contact&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                <input type="hidden" name="mes_id" value="<?php echo $type['con_id'] ?>">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="box2">
                                                            <label id="name"> الاسم الاول
                                                                <span> * </span> </label>

                                                            <div style="border: 1px solid #ccc; background-color: #ececec; border-radius: 3px; padding: 5px;font-size: 16px;color: #5c5959;word-wrap: break-word;">
                                                                <?php echo $type['first_name']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> الاسم الاخير<span> * </span></label>
                                                            <div style="border: 1px solid #ccc; background-color: #ececec; border-radius: 3px; padding: 5px;font-size: 16px;color: #5c5959;word-wrap: break-word;">
                                                                <?php echo $type['last_name']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">البريد الالكروني<span> * </span></label>
                                                            <textarea disabled min="1" class="form-control" type="text" name="wha_order"><?php echo $type['email'] ?></textarea>
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> رقم الهاتف <span> * </span></label>
                                                            <input disabled min="1" class="form-control" type="text" name="wha_order" value="<?php echo $type['mobile'] ?>">
                                                        </div>
                                                        <div class="box">
                                                            <label id="name_en">الرسالة<span> * </span></label>
                                                            <div style="border: 1px solid #ccc; background-color: #ececec; border-radius: 3px; padding: 10px;font-size: 16px;color: #5c5959;word-wrap: break-word;">
                                                                <?php echo $type['message']; ?>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"> <i class="fa fa-close"></i> اغلاق </button>
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