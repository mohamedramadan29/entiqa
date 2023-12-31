<?php
ob_start();
$pagetitle = 'الرئيسية';
session_start();
include 'init.php';
?>
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
            include 'company/add.php';
        } elseif ($dir == 'company' && $page == 'edit') {
            include 'company/edit.php';
        }
        // END EDUCATION WEB SITE ///////////////////////////////////////
        // START individual
        if ($dir == 'individual' && $page == 'add') {
            include 'individual/add.php';
        } elseif ($dir == 'individual' && $page == 'edit') {
            include 'individual/edit.php';
        }
        // END individual WEB SITE ///////////////////////////////////////
        // START Coashes
        if ($dir == 'coashes' && $page == 'add') {
            include 'coashes/add.php';
        } elseif ($dir == 'coashes' && $page == 'edit') {
            include 'coashes/edit.php';
        } 
        // Start Services Section
        if ($dir == 'services_section' && $page == 'add') {
            include 'services_section/add.php';
        } elseif ($dir == 'services_section' && $page == 'edit') {
            include 'services_section/edit.php';
        }
        // END Services Section

        // END EXAM Section
        // START QUESTION
        if ($dir == 'question' && $page == 'add') {
            include 'question/add.php';
        } elseif ($dir == 'question' && $page == 'edit') {
            include 'question/edit.php';
        }
        // END QUESTION
        // END Services Section
        if ($dir == 'com_chat' && $page == 'add') {
            include 'com_chat/add.php';
        }
        if ($dir == 'com_chat' && $page == 'fetch_msg') {
            include 'com_chat/fetch_msg.php';
        }
        // END Services Section
        if ($dir == 'chat' && $page == 'add') {
            include 'chat/add.php';
        }
        if ($dir == 'chat' && $page == 'fetch_msg') {
            include 'chat/fetch_msg.php';
        }
        if ($dir == 'coash_chat_batch' && $page == 'fetch_msg') {
            include 'coash_chat_batch/fetch_msg.php';
        }
        // Start Chat Section
        // ٍStart with Draw
        if ($dir == 'withdraw' && $page == 'edit') {
            include 'withdraw/edit.php';
        }
        if ($dir == 'chat_batch' && $page == 'fetch_msg') {
            include 'chat_batch/fetch_msg.php';
        }
        // end With Draw
        // END SEP WEB SITE ///////////////////////////////////////

        // END users

        ?>