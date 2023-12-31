<?php
ob_start();
$pagetitle = 'الرئيسية';
session_start();
include 'init.php';
include $tem . 'top_navbar.php';
if (isset($_SESSION['admin_session'])) {
    include $tem . 'left_sidebar.php';
} elseif (isset($_SESSION['serv_name'])) {
    include $tem . 'serv_navbar.php';
} elseif (isset($_SESSION['coash_id'])) {
    include $tem . 'coash_navbar.php';
} else {
    header("Location:index");
}
?>
<div class="content-wrapper">
    <div class="category">
        <?php
        $page = '';
        if (isset($_GET['page']) && isset($_GET['dir'])) {
            $page = $_GET['page'];
            $dir = $_GET['dir'];
        } else {
            $page = 'manage';
        }


        // START EDUCATION WEB  /////////////////////////////////////////
        // START COMPANY
        if ($dir == 'company' && $page == 'add') {
        } elseif ($dir == 'company' && $page == 'edit') {
        } elseif ($dir == 'company' && $page == 'delete') {
            include 'company/delete.php';
        } elseif ($dir == 'company' && $page == 'report') {
            include 'company/report.php';
        } elseif ($dir == 'company' && $page == 'view') {
            include 'company/view.php';
        }
        // END COMPANY


        // START individual
        if ($dir == 'individual' && $page == 'add') {
            include 'individual/add.php';
        } elseif ($dir == 'individual' && $page == 'edit') {
            include 'individual/edit.php';
        } elseif ($dir == 'individual' && $page == 'delete') {
            include 'individual/delete.php';
        } elseif ($dir == 'individual' && $page == 'report') {
            include 'individual/report.php';
        } elseif ($dir == 'individual' && $page == 'view') {
            include 'individual/view.php';
        }
        // START Services Section
        if ($dir == 'services_section' && $page == 'add') {
            include 'services_section/add.php';
        } elseif ($dir == 'services_section' && $page == 'edit') {
            include 'services_section/edit.php';
        } elseif ($dir == 'services_section' && $page == 'delete') {
            include 'services_section/delete.php';
        } elseif ($dir == 'services_section' && $page == 'report') {
            include 'services_section/report.php';
        }
        // START Coashes Section
        if ($dir == 'coashes' && $page == 'add') {
            include 'coashes/add.php';
        } elseif ($dir == 'coashes' && $page == 'edit') {
            include 'coashes/edit.php';
        } elseif ($dir == 'coashes' && $page == 'delete') {
            include 'coashes/delete.php';
        } elseif ($dir == 'coashes' && $page == 'report') {
            include 'coashes/report.php';
        } elseif ($dir == 'coashes' && $page == 'view_batches') {
            include 'coashes/view_batches.php';
        } elseif ($dir == 'coashes' && $page == 'view_batches_details') {
            include 'coashes/view_batches_details.php';
        } elseif ($dir == 'coashes' && $page == 'edit_user') {
            include 'coashes/edit_user.php';
        } elseif ($dir == 'coashes' && $page == 'view_exam') {
            include 'coashes/view_exam.php';
        } elseif ($dir == 'coashes' && $page == 'view_exam_degree') {
            include 'coashes/view_exam_degree.php';
        }
        // START Coashes Section
        if ($dir == 'batches' && $page == 'add') {
            include 'batches/add.php';
        } elseif ($dir == 'batches' && $page == 'edit') {
            include 'batches/edit.php';
        } elseif ($dir == 'batches' && $page == 'delete') {
            include 'batches/delete.php';
        } elseif ($dir == 'batches' && $page == 'report') {
            include 'batches/report.php';
        } elseif ($dir == 'batches' && $page == 'view') {
            include 'batches/view.php';
        }


        // END Services Section
        if ($dir == 'chat' && $page == 'chat') {
            include 'chat/chat.php';
        } elseif ($dir == 'chat' && $page == 'delete') {
            include 'chat/delete.php';
        } elseif ($dir == 'com_chat' && $page == 'delete') {
            include 'com_chat/delete.php';
        } elseif ($dir == 'coash_chat_batch' && $page == 'delete') {
            include 'coash_chat_batch/delete.php';
        }
        // Start Chat Section

        // End Chat Section
        // START CONTACT
        if ($dir == 'contact' && $page == 'add') {
            include 'contact/add.php';
        } elseif ($dir == 'contact' && $page == 'edit') {
            include 'contact/edit.php';
        } elseif ($dir == 'contact' && $page == 'delete') {
            include 'contact/delete.php';
        } elseif ($dir == 'contact' && $page == 'report') {
            include 'contact/report.php';
        }
        // END CONTACT
        // START EXAM
        if ($dir == 'exam' && $page == 'add') {
            include 'exam/add.php';
        } elseif ($dir == 'exam' && $page == 'edit') {
            include 'exam/edit.php';
        } elseif ($dir == 'exam' && $page == 'delete') {
            include 'exam/delete.php';
        } elseif ($dir == 'exam' && $page == 'report') {
            include 'exam/report.php';
        }
        // END EXAM
        // START QUESTION
        if ($dir == 'question' && $page == 'add') {
            include 'question/add.php';
        } elseif ($dir == 'question' && $page == 'edit') {
            include 'question/edit.php';
        } elseif ($dir == 'question' && $page == 'view') {
            include 'question/view.php';
        } elseif ($dir == 'question' && $page == 'delete') {
            include 'question/delete.php';
        } elseif ($dir == 'question' && $page == 'report') {
            include 'question/report.php';
        }
        //Compelete Contract
        if ($dir == 'compelete_contract' && $page == 'report') {
            include 'compelete_contract/report.php';
        }
        //Cancel Contract
        if ($dir == 'cancel_contract' && $page == 'report') {
            include 'cancel_contract/report.php';
        }
        // With Draw
        if ($dir == 'withdraw' && $page == 'report') {
            include 'withdraw/report.php';
        }
        // Interview
        if ($dir == 'interview' && $page == 'report') {
            include 'interview/report.php';
        }
        // With All Chats 
        if ($dir == 'all_chats' && $page == 'report') {
            include 'all_chats/report.php';
        } elseif ($dir == 'all_chats' && $page == 'chat_details') {
            include 'all_chats/chat_details.php';
        }
        // END QUESTION
        if ($dir == 'dashboard' && $page == 'dashboard') {
            include 'dashboard.php';
        }
        // END QUESTION
        if ($dir == 'dashboard' && $page == 'serv_dashboard') {
            include 'serv_dashboard.php';
        }
        if ($dir == 'dashboard' && $page == 'coash_dashboard') {
            include 'coash_dashboard.php';
        }
        // START COM CHAT
        if ($dir == 'com_chat' && $page == 'chat') {
            include 'com_chat/chat.php';
        } elseif ($dir == 'com_chat' && $page == 'report') {
            include 'company/report.php';
        }
        // START Chat batches
        if ($dir == 'chat_batch' && $page == 'chat') {
            include 'chat_batch/chat.php';
        } elseif ($dir == 'chat_batch' && $page == 'report') {
            include 'company/report.php';
        } elseif ($dir == 'chat_batch' && $page == 'add') {
            include 'chat_batch/add.php';
        } elseif ($dir == 'chat_batch' && $page == 'delete') {
            include 'chat_batch/delete.php';
        }
        // START Chat batches
        if ($dir == 'coash_chat_batch' && $page == 'chat') {
            include 'coash_chat_batch/chat.php';
        } elseif ($dir == 'coash_chat_batch' && $page == 'report') {
            include 'company/report.php';
        } elseif ($dir == 'coash_chat_batch' && $page == 'add') {
            include 'coash_chat_batch/add.php';
        }
        // START REVIEW
        if ($dir == 'review' && $page == 'com_review') {
            include 'review/com_review.php';
        } elseif ($dir == 'review' && $page == 'ind_review') {
            include 'review/ind_review.php';
        } elseif ($dir == 'review' && $page == 'delete_com_review') {
            include 'review/delete_com_review.php';
        } elseif ($dir == 'review' && $page == 'delete_ind_review') {
            include 'review/delete_ind_review.php';
        } elseif ($dir == 'review' && $page == 'edit_com') {
            include 'review/edit_com.php';
        } elseif ($dir == 'review' && $page == 'edit_ind') {
            include 'review/edit_ind.php';
        }
        // END REVIEW
        // START ADMIN SETTINGD
        if ($dir == 'settings' && $page == 'report') {
            include 'settings/report.php';
        } elseif ($dir == 'settings' && $page == 'edit') {
            include 'settings/edit.php';
        }
        // END ADMIN SETTINGD
        // START Services team
        if ($dir == 'service_team' && $page == 'add') {
            include 'service_team/add.php';
        } elseif ($dir == 'service_team' && $page == 'edit') {
            include 'service_team/edit.php';
        } elseif ($dir == 'service_team' && $page == 'delete') {
            include 'service_team/delete.php';
        } elseif ($dir == 'service_team' && $page == 'report') {
            include 'service_team/report.php';
        }
        ?>
    </div>
</div>
</div>
<?php
include $tem . 'footer.php';

ob_end_flush();
?>