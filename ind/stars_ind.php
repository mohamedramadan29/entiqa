<?php
$pagetitle = 'تواصل معنا';
ob_start();
session_start();
$ind_navabar = 'ind';
include 'init.php'; ?>
<div class="contact_hero">
    <div class="overlay">
        <div class="container">
            <div class="data">
                <h2> قائمة أفضل المؤهلين لهذا الشهر  </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="companies.php">للمزيد من المتدربين</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="star_person">
    <div class="container">
        <div class="data">
            <div class="row rows">
                <?php
                $stmt = $connect->prepare("SELECT * FROM ind_register");
                $stmt->execute();
                $alluser = $stmt->fetchAll();
                foreach ($alluser as $user) { ?>
                    <div class="col-lg-3">
                        <div class="info">
                            <?php
                            if($user['ind_gender'] == "انثي"){?>
                                <img src="../images/girl_avatar.png" alt="">
                                <?php
                            }else{?>
                                <img src="../images/avatar.png" alt="">
                                <?php

                            }
                            ?>
                            <h2> <?php echo $user['ind_username']; ?> </h2>
                            <div class="rate">
                                <div>
                                    <p><?php echo $user['ind_nationality']; ?><span> </span> </p>
                                </div>
                                <div>
                                    <p> <?php echo $user['ind_address']; ?> <span> <i class="fa fa-map-marker"></i></span></p>
                                </div>
                            </div>
                            <button class="btn btn-primary"><a href="ind_profile.php?ind_id=<?php echo $user['ind_id']; ?>"> الملف الشخصى </a></button>

                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php

include $tem . "footer.php";


?>