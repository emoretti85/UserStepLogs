<?php

/**
 * Add this code at the beginning of each page you want to check
 */

require_once 'core/UserStepLogs.class.php';

//Use your strategy to identify the user, register UID or IP or you believe anything useful to your interest
$UserId="XYZ0123";

$USL = new UserStepLogs($UserId,$_SERVER, $_POST);
    
/**
 * Add this code at the beginning of each page you want to check
 */    
