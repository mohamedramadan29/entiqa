<?php
/*
Created by mohamed ramadan
Email:mr319242@gmail.com
Phone:01011642731

*/
include "../connect.php";
include "config.php";
$tem  = "include/tempelate/";
$func = "include/function/";
$css = "themes/css/";
$js  = "themes/js/";

include $tem . "header.php";
if (!isset($Nonavbar)) {
    include $tem . "navbar.php";
}


// Function to sanitize input
function sanitizeInput($input)
{
    // Use appropriate sanitization or validation techniques based on your requirements
    $sanitizedInput = htmlspecialchars(trim($input));
    return $sanitizedInput;
}
date_default_timezone_set('Asia/Riyadh');


// لاعادة التاريخ ووقت الرساله منذ متي 
function formatTimeDifference($dateTime)
{
    date_default_timezone_set('Asia/Riyadh');

    $messageTimestamp = strtotime($dateTime);
    $timeDifference = time() - $messageTimestamp;

    $days = floor($timeDifference / (60 * 60 * 24));
    $hours = floor(($timeDifference % (60 * 60 * 24)) / (60 * 60));
    $minutes = floor(($timeDifference % (60 * 60)) / 60);

    if ($days > 0) {
        // تحديد النص بناءً على عدد الأيام
        $daysText = ($days == 1) ? "يوم" : "أيام";
        return "منذ $days $daysText";
    } elseif ($hours > 0) {
        $hoursText = ($hours == 1) ? "ساعة" : "ساعات";
        return "منذ $hours $hoursText";
    } else {
        $minutesText = ($minutes == 1) ? "دقيقة" : "دقائق";
        return "منذ $minutes $minutesText";
    }
}

function generateNewSessionToken()
{
    return md5(uniqid(mt_rand(), true));
}
