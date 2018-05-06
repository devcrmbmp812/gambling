<?php
require_once('config.php');	
require_once('libs/PHPMailer/PHPMailer.php');
C::loadClass('User');
$User = new User();
$mail = new PHPMailer;
//$mail->isSMTP();

$logedInID = (int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0;

$userid = $User->query("SELECT `userId`, `email` FROM `tblUser` WHERE `id` = '" . $logedInID . "' LIMIT 0,1");
$user = $userid[0]['userId'];
$user1 = 'Bettingtime.com';
$email = 'info@bettingtime.com';

if(!$mail->ValidateAddress($email)){
	Message::addMessage("Invalid email address.", ERR);
}

$email_body = "";
$email_body .= "User Id = " . $user . "\n";
$email_body .= "Category =" . $_POST['category'] . "\n";
$email_body .= "Good Comment =" . $_POST['likeComment'] . "\n";
$email_body .= "Bad Comment =" . $_POST['dislikeComment'] . "\n";
$email_body .= "Visit Site =" . HOST.$_SERVER['REQUEST_URI'] . "\n";



$mail->setFrom($email, $user1);
//$mail->addAddress('koge4561@gmail.com', 'Herry Park');     // Add a recipient

$mail->isHTML(false);                                  // Set email format to HTML

$mail->Subject = 'Comments From '. $user;
$mail->Body    = $email_body;

$mail->send();
// if(!$mail->send()) {
//     // echo 'Message could not be sent.';
//     // echo 'Mailer Error: ' . $mail->ErrorInfo;
//     Message::addMessage('Mailer Error: ' . $mail->ErrorInfo, ERR);
// } else {
//     // echo 'Message has been sent';
//     Message::addMessage('Message has been sent', SUCCS);
// }

?>