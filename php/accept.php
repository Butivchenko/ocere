<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

include_once('../functions.php');

$user = $_COOKIE['user'];
$secret = $_COOKIE['secret'];
$comment = serialize($_COOKIE['comment']);
$file = $_SESSION["file"];
$realname = $_SESSION["fileName"];

include('db.php');
$result = $conn->query("SELECT * FROM users WHERE Email = '" . $user . "' AND Password = '" . $secret . "'");

if ($result > 0) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row["Id"];
            $name = $row['First Name'] . " " . $row['Last Name'];
        }
    }
}


$order = $_COOKIE["order"];
$comment = $_COOKIE["comment"];
$date = date("Y-m-d");
echo $order;


$result = $conn->query("INSERT INTO `orders`(`user_id`, `order`, `comment`, `date`, `status`) VALUES ($id,'" . $order . "','" . $comment . "','" . $date . "', 'In Progress')");


$orders = $conn->query("SELECT id FROM orders ORDER BY id DESC LIMIT 1");

if ($orders > 0) {
    if ($orders->num_rows > 0) {
        while ($row = $orders->fetch_assoc()) {
            $id_order = $row["id"];
        }
    }
}
$this_order_id = $id_order;

$orders = json_decode($_COOKIE['order']);
$i = -1;
foreach ($orders as $order => $value) {
    $i++;
}
$rows_count = $i;


$to = "tomparling@gmail.com";

$subject = "New Order <Order#" . $this_order_id . "> on Outreach Form";
$boundary = "---";
$message = "A new order has been placed on the Blogger Outreach Form:<br />";
$message .= "1. Client Name: $name<br />";
$message .= "2. Client Email Address: $user<br />";
$message .= "3. Order Number: $this_order_id<br />";

if ($rows_count == -1) {

    $message .= "4. Total Links: in file $realname<br />";
    $message .= "5.  Total Price: to count<br />";
    $message .= "6.  Comments box text: $comment<br />";

} else {
    $message .= "4. Total Links: $rows_count<br />";
    $message .= "5.  List of all links: <br />";
// декорирую в массив и вывожу без последнего значения цены
    $orders1 = json_decode($_COOKIE['order'], true);
    if ($orders1) {
        for ($q = 0; $q < count($orders1) - 1; $q++) {
            $message .= "<p>" . $orders1["row$q"]["name"] . " : " . $orders1["row$q"]["anchor"] . " - " . $orders1["row$q"]["url"] . "</p>";
        }
    }
    $message .= "6.  Total Price: $orders->summary<br />";
    $message .= "7.  Comments box text: $comment<br />";
}


$subject = "Order Number:" . $this_order_id;
$pars = explode('.', $_SESSION["fileName"]);
$expansion = end($pars);


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
$file_to_attach = $file;

if ($expansion === "xls" || $expansion === "xlsx") {

    $email->AddAttachment($file_to_attach, $realname);
}
$email->Send();

if ($result === TRUE) {
    unset($_COOKIE['order']);
    unset($_COOKIE['comment']);

    setcookie('order', null, -1, '/');
    setcookie('comment', null, -1, '/');
    header('Location:http://' . $_SERVER['SERVER_NAME'] . '/dashboard.php');
}
?>