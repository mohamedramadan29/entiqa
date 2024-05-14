<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة تفاصيل الدفعه </li>
                </ol>
            </nav>
        </div>
        <?php
        $batch_id = $_GET['batch_id'];
        ?>
        <div class="table-responsive">
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th> رقم الهاتف  </th>
                        <th> البريد الالكتروني </th>
                        <th>الجنسية</th>
                        <th> العنوان </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody> <?php
                        $stmt = $connect->prepare("SELECT * FROM ind_register WHERE ind_batch=?");
                        $stmt->execute(array($batch_id));
                        $allind = $stmt->fetchAll();
                        foreach ($allind as $ind) { ?>
                        <tr>
                            <td><?php echo $ind['ind_name']; ?> </td>
                            <td><?php echo $ind['ind_phone']; ?> </td>
                            <td> <?php echo $ind['ind_email']; ?> </td>
                            <td> <?php echo $ind['ind_nationality']; ?> </td>
                            <td> <?php echo $ind['ind_address']; ?> </td>

                            <td>
                                <?php
                                if (isset($_SESSION['coash_id'])) {
                                ?>
                                    <a href="main.php?dir=coash_chat_batch&page=chat&ind_username=<?php echo  $ind['ind_username']; ?>" class="btn btn-warning btn-sm"> تواصل مع المتدرب <i class="fa fa-envelope"></i> </a>
                                <?php
                                }
                                ?>

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