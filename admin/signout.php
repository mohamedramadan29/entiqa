<?php
session_start();
if (isset($_SESSION['admin_session'])) {
    unset($_SESSION['admin_session']);
}
if (isset($_SESSION['serv_name'])) {
    unset($_SESSION['serv_name']);
}
if (isset($_SESSION['coash_id'])) {
    unset($_SESSION['coash_id']);
}
header('location:index');
// session_destroy();
