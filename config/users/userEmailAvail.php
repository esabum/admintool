<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
/* Load values from .ini */

define('APPROOT', $_SERVER['DOCUMENT_ROOT']);
$ini_array = parse_ini_file(APPROOT . '/.config.ini', true);
define('APPBASE', $ini_array["general"]["appbase"]);


require_once APPROOT . '/model/dbconnector/clsMyDBConn.php';
$obj_bconn = new MyConn();
$dbh = $obj_bconn->get_conn();

if (isset($_POST['email'])) {//If an email has been submitted
    $email = trim($_POST['email']); //mysql_real_escape_string($_POST['email']);//Some clean up :)
    $SQL = "SELECT ID FROM users WHERE email = '$email'";
    $check_for_username = mysqli_query($dbh, $SQL);
    if (mysqli_num_rows($check_for_username)) {
        echo '1'; //If there is a record match in the Database - Not Available
    } else {
        echo '0'; //No Record Found - Email is available
    }
}
