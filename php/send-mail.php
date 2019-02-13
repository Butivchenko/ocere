<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

include_once('../functions.php');

/* получатели */
$to = "tomparling@gmail.com";

  $theme = $_POST['theme'];
  $who = $_POST['user'];
  $name = $_POST['first_name']." ".$_POST['last_name'];
  $country = $_POST['country'];

// $to = 'misha.liluweb@gmail.com';

/* тема/subject */

if($theme == 'new_user')
{
  $theme = 'New User Signup on Outreach Form';
  $description = 'New user '.$who.' is signed up to forms.ocere.com';
  $extra = '';
}
else if($theme == 'new_order')
{
  $theme = 'New order';
  $description = 'New order from'.$who.'. <br /> forms.ocere.com';
  $extra = $order;
  $who = $_COOKIE["user"];
}
else {
  $theme = 'Test';
  $description = 'Test description';
  $who = 'User';
  $extra = 'Some information';
}
$subject = $theme;

/* сообщение */
$message = '
<html>
<head>
 <title>'.$theme.'</title>
</head>
<body>
<p>A new user has signed up on the Blogger Outreach Form:</p>
<table>
 <tr>
<td>
<br />
Name: '.$name.'
<br />
Email: '.$who.'
<br />
Country: '.$country.'</p>
</td>
 </tr>
</table>
</body>
</html>
';



// Send mail.

$email = new PHPMailer();
$email->isSMTP();
$email->CharSet = "UTF-8";
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$email->SMTPDebug = 0;
$email->Host = 'smtp.gmail.com';
$email->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$email->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$email->SMTPAuth = true;

// account gmail
$email->Username = "forms.ocere@gmail.com";
$email->Password = "@r6ZkmTajLoS";

$email->From = 'you@example.com';
$email->FromName = 'adm@progger.ru';
$email->Subject = $subject;
$email->msgHTML($message);
$email->AddAddress($to);
$email->AddAddress("remi@ocere.com");
$email->AddAddress("ben@ocere.com ");
$email->AddAddress("tom@ocere.com");
$email->Send();




//
///* Для отправки HTML-почты вы можете установить шапку Content-type. */
//$headers= "MIME-Version: 1.0\r\n";
//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
//
//
///* и теперь отправим из */
//mail($to, $subject, $message, $headers);
//


echo '{
"success":"true",
"message":"'.$message.'"
}';
