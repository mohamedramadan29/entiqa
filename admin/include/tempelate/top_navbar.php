<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light mynavbar">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item mytogglebutton">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto topnav">
            <!-- Messages Dropdown Menu -->
            <?php
            if (isset($_SESSION['admin_session']) || isset($_SESSION['serv_name'])) {
                $stmt = $connect->prepare("SELECT * FROM chat WHERE to_person = 'admin' AND admin_noti = 0");
                $stmt->execute();
                $all_message_noti = $stmt->fetchAll();
                $count = $stmt->rowCount();
            ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge"><?php echo $count; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- Message Start -->
                        <?php
                        if ($count > 0) {
                            foreach ($all_message_noti as $message_noti) {
                        ?>
                                <div class="media" style="margin-bottom: 15px;">
                                    <div class="media-body" style="padding: 10px; padding-bottom: 5px;">
                                        <?php
                                        if ($message_noti['send_type'] == 'ind') {
                                        ?>
                                            <a style="text-align: right; text-decoration: none; color: #111;" href="main.php?dir=chat&page=chat&ind_username=<?php echo $message_noti['from_person']; ?>">
                                            <?php
                                        } elseif ($message_noti['send_type'] == 'com') {
                                            ?>
                                                <a style="text-align: right; text-decoration: none; color: #111;" href="main.php?dir=com_chat&page=chat&com_username=<?php echo $message_noti['from_person']; ?>">
                                                <?php
                                            } else {
                                                ?>
                                                    <a href="#" style="text-align: right; text-decoration: none; color: #111;">
                                                    <?php
                                                }
                                                    ?>
                                                    <h3 class="dropdown-item-title">
                                                        <?php echo $message_noti['from_person']; ?>
                                                    </h3>
                                                    <?php
                                                    $message = $message_noti['msg'];
                                                    $first_30_chars = substr($message, 0, 30);
                                                    ?>
                                                    <p class="text-sm"> <?php echo $first_30_chars; ?> </p>
                                                    </a>
                                    </div>
                                </div>
                                <div class="divider"></div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="media" style="margin-bottom: 15px;">
                                <div class="media-body" style="padding: 10px; padding-bottom: 5px;">
                                    <a style="text-align: right; text-decoration: none; color: #111;">
                                        <h3 class="dropdown-item-title">
                                            لا يوجد رسائل جديدة
                                        </h3>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </li>
            <?php
            }
            ?>

            <?php
            if (isset($_SESSION['coash_id'])) {
                $stmt = $connect->prepare("SELECT * FROM coash_notification WHERE status = 0 AND coash_id = ?");
                $stmt->execute(array($_SESSION['coash_id']));
                $all_exam_noti = $stmt->fetchAll();
                $count = $stmt->rowCount();
            ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="badge badge-danger navbar-badge"><?php echo $count; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- Message Start -->
                        <?php
                        if ($count > 0) {
                            foreach ($all_exam_noti as $exam_noti) {
                        ?>
                                <div class="media" style="margin-bottom: 15px;">
                                    <div class="media-body" style="padding: 10px; padding-bottom: 5px;">
                                        <a href="main.php?dir=coashes&page=view_exam&ind_id=<?php echo $exam_noti['ind_id']; ?>" style="text-align: right; text-decoration: none; color: #111;">
                                            <h3 class="dropdown-item-title">
                                                انتهاء اختبار جديد
                                            </h3>
                                            <p class="text-sm"> مشاهدة التفاصيل </p>
                                        </a>

                                    </div>
                                </div>
                                <div class="divider"></div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="media" style="margin-bottom: 15px;">
                                <div class="media-body" style="padding: 10px; padding-bottom: 5px;">
                                    <a style="text-align: right; text-decoration: none; color: #111;">
                                        <h3 class="dropdown-item-title">
                                            لا يوجد اشعارات جديدة
                                        </h3>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </li>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['coash_id'])) {
                $stmt = $connect->prepare("SELECT * FROM chat WHERE to_person='coash' AND  coash_id = ? AND admin_noti = 0");
                $stmt->execute(array($_SESSION['coash_id']));
                $all_message = $stmt->fetchAll();
                $message_count = $stmt->rowCount();
            ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge"><?php echo $message_count; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- Message Start -->
                        <?php
                        if ($message_count > 0) {
                            foreach ($all_message as $message) {
                        ?>
                                <div class="media" style="margin-bottom: 15px;">
                                    <div class="media-body" style="padding: 10px; padding-bottom: 5px;">
                                        <a href="main.php?dir=coash_chat_batch&page=chat&ind_username=<?php echo $message['from_person'] ?>" style="text-align: right; text-decoration: none; color: #111;">
                                            <h3 class="dropdown-item-title">
                                                لديك رسالة جديدة من متدرب
                                            </h3>
                                            <p class="text-sm"> مشاهدة التفاصيل </p>
                                        </a>

                                    </div>
                                </div>
                                <div class="divider"></div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="media" style="margin-bottom: 15px;">
                                <div class="media-body" style="padding: 10px; padding-bottom: 5px;">
                                    <a style="text-align: right; text-decoration: none; color: #111;" href="#">
                                        <h3 class="dropdown-item-title">
                                            لا يوجد  رسائل جديدة
                                        </h3>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </li>
            <?php
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li> 
        </ul>


    </nav>
    <!-- /.navbar -->