<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/*Load values from .ini*/
define('APPROOT', $_SERVER['DOCUMENT_ROOT']);
$ini_array = parse_ini_file(APPROOT . '/.config.ini', true);
define('APPBASE', $ini_array["general"]["appbase"]);


require_once APPROOT . '/model/userauth/SessMemHD.php';
require_once APPROOT . '/config/labels/model/clsLabel.php';
$objLabel = New Labels;
$lblEmailHeader = $objLabel->get_Label('lblEmailHeader', $SelLang);
$lblEmailBody = $objLabel->get_Label('lblEmailBody', $SelLang);
$lblUser = $objLabel->get_Label('lblUser', $SelLang);
$lblPassword = $objLabel->get_Label('lblPassword', $SelLang);
$lblWelcome = $objLabel->get_Label('lblWelcome', $SelLang);
$lblUserPasswordRecovery = $objLabel->get_Label('lblUserPasswordRecovery', $SelLang);

foreach ($_POST as $key => $val) {
    $$key = $val;
}
foreach ($_GET as $key => $val) {
    $$key = $val;
}

$accessbit = 0;
for ($i = 0; $i < count($access_bit); $i++) {
    $accessbit = $objBitCtrl->set_bit($accessbit, $access_bit[$i]);
}

$password = '';
if ($id == 0) {
//generation the new password
    $characters = 'BbCcDdFfGgHhJjKkLlMmNnPpQqRrSsTtUuVvWwXxYyZz123456789';

    for ($i = 0; $i < 10; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
}

require_once APPROOT . '/config/users/model/clsUsersW.php';
$objUsers = new UsersW;
$objUsers->set_Id($id);
$objUsers->set_Language_Id($language_id);
$objUsers->set_First($first);
$objUsers->set_Last($last);
$objUsers->set_Email($email);
$objUsers->set_Pass($password);
$objUsers->set_Enabled($enabled);
$objUsers->set_Access_Bit($accessbit);
$result = $objUsers->execute();
if ($id == 0 && is_numeric($result) && $result > 0) {
    require_once APPROOT . '/config/users/model/clsUsers.php';
    $objUser =  new Users;
    $objUser->set_ID($result);
    $objUser->execute();
    require_once APPROOT . '/include-php/PHPMailer/PHPMailerAutoload.php';
    $mail = new phpmailer();
    $mail->isSMTP();
    $mail->Host = "int.aratours.com ";
    //$mail->SMTPAuth = true;
    //$mail->Username = "autogestion@latinconnect.com";
    //$mail->Password = "TMNAp*Lg6,#J";
    //$mail->SMTPSecure = 'tls';
    $mail->Port = 25;

    $mail->setFrom("banks@aratours.com", "User manager - Ara Banking");
    $mail->addAddress($objUser->get_Email(0, 'txt'), $objUser->get_First(0, 'txt') . ' ' . $objUser->get_Last(0, 'txt'));
    $mail->addReplyTo('it@aratours.com', 'IT - Ara Tours');
//$mail->addCC('it@aratours.com', 'IT - Ara Tours');
    $mail->addBCC('it@aratours.com', 'IT - Ara Tours');

    $mail->Subject = $lblWelcome;
    
    //First, last y el email son leídos directamente de la base de datos.
    $message = $lblEmailHeader . " " . $objUser->get_First(0) . " " . $objUser->get_Last(0) . ":\r\n";
    $message .= $lblEmailBody . "\r\n";
    $message .= $lblUser . ": " . $objUser->get_Email(0) . "\r\n";
    $message .= $lblPassword . ": " . trim($password) . "\r\n";

    $mail->Body = nl2br($message); //Si el que recibe no admite texto HTML, utiliza texto plano.
    $mail->AltBody = $message;

    $mailed = $mail->Send();
    //if (!$mailed){error}
}
echo $result;


