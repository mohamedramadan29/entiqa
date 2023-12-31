<?php
ob_start();
session_start();
if (isset($_SESSION['ind_id'])) {
    include 'init.php';
    $_SESSION["ind_id"] = $_SESSION['ind_id'];
}
$stmt = $connect->prepare("SELECT * FROM chat WHERE to_person = ?");
$stmt->execute(array($_SESSION['ind_id']));
$count = $stmt->rowCount();
if ($count > 0) {
    echo $count;
} else {
    echo "0";
}
