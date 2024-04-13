<?php
/*
Created by mohamed ramadan
Email:mr319242@gmail.com
Phone:01011642731

*/
include "connect.php";
//include "config.php";
$tem = "include/";
$css = "themes/css/";
$js = "themes/js/";
$fonts = "themes/fonts/";
include $tem . "header.php";

// Function to sanitize input
function sanitizeInput($input)
{
    // Use appropriate sanitization or validation techniques based on your requirements
    $sanitizedInput = htmlspecialchars(trim($input));
    return $sanitizedInput;
}