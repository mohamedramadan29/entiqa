<?php
session_start();
if (isset($_SESSION['com_id'])) {
    unset($_SESSION['com_id']);
}
if (isset($_SESSION['ind_id'])) {
    unset($_SESSION['ind_id']);
}
header("location:../index.php");
session_destroy();
