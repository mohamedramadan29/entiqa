<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    
                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة الدفعات الخاصة بالمدرب علي المنصة </li>
                </ol>
            </nav>
        </div>
        <?php
        $co_id = $_GET['co_id'];
        ?>

        <div class="table-responsive">
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> اسم الدفعه </th>
                        <th> تاريخ بداية الدفعه </th>
                        <th> عدد المسجلين حاليا </th>
                        <th>اقل عدد </th>
                        <th> اكثر عدد </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody> <?php
                        $stmt = $connect->prepare("SELECT * FROM batches WHERE batch_coach=?");
                        $stmt->execute(array($co_id));
                        $allind = $stmt->fetchAll();
                        foreach ($allind as $ind) { ?>
                        <tr>
                            <td><?php echo $ind['batch_name']; ?> </td>
                            <td><?php echo $ind['batch_start']; ?> </td>
                            <td> <?php echo $ind['ind_num']; ?> </td>
                            <td> <?php echo $ind['batch_min']; ?> </td>
                            <td> <?php echo $ind['batch_max']; ?> </td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="main.php?dir=coashes&page=view_batches_details&batch_id=<?php echo $ind['batch_id']; ?> ">
                                    مشاهدة تفاصيل الدفعه <i class="fa fa-eye"></i>
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