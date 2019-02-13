<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include_once('functions.php');

$user = $_COOKIE['user'];
$secret = $_COOKIE['secret'];


include('php/db.php');
$result = $conn->query("SELECT * FROM users WHERE Email = '" . $user . "' AND Password = '" . $secret . "'");

if ($result > 0) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row["Id"];
            $name = $row['First Name'] . " " . $row['Last Name'];
        }
    }
}

$service = $_POST["select"];
$page = $_POST['page'];

if (isset($_POST["website_url"]) && !empty($_POST["website_url"])) {
    $site_url = $_POST["website_url"];
} else {
    $site_url = null;
}
    if ($_FILES['fileToUpload']['error'][0] !== 0) {
        $pars_service = explode("£", $service);
        $price = $pars_service[1];
        $order = "{\"row0\":{\"name\":\"" . $service . "\",\"url\":\"" . $site_url . "\",\"price\":\"" . $price . "\"},\"summary\":\"" . $price . "\"}";

    } else {
        $prise = null;
        $order = "{\"row0\":{\"name\":\"" . $page . "\",\"url\":\"" . $site_url . "\",\"price\":\"" . $price . "\"},\"summary\":\"" . $price . "\"}";
    }

$details = $_POST["details"];
$date = date("Y-m-d");

$result = $conn->query("INSERT INTO `orders`(`user_id`, `order`, `comment`, `date`, `status`) VALUES ($id,'" . $order . "','" . $details . "','" . $date . "', 'In Progress')");

$orders = $conn->query("SELECT id FROM orders ORDER BY id DESC LIMIT 1");

if ($orders > 0) {
    if ($orders->num_rows > 0) {
        while ($row = $orders->fetch_assoc()) {
            $id_order = $row["id"];
        }
    }
}
$this_order_id = $id_order;

$orders = json_decode($order);
$i = -1;
foreach ($orders as $order => $value) {
    $i++;
}
$rows_count = $i;

//generate message

$to = "tomparling@gmail.com";

$subject = "New Order <Order#" . $this_order_id . "> on Outreach Form";
$boundary = "---";
$message = "A new order has been placed on the " . $page . " Form: <br />";
$message .= "1. Client Name: $name <br />";
$message .= "2. Client Email Address: $user <br />";
$message .= "3. Order Number: $this_order_id <br />";

if ($_FILES['fileToUpload']['error'][0] === 0) {

    if (isset ($site_url) && !empty($site_url)) {
        $message .= "4.  Site URL: $site_url  <br />";

        for ($i = 0; $i <= count($_FILES['fileToUpload']); $i++) {

            $all_files .= "<p>".$_FILES['fileToUpload']['name'][$i]."</p>";
        }
        $message .= "5. Total Links: in file :" . $all_files ;
        $message .= "6.  Total Price: to count <br />";
        $message .= "7.  Details: $details <br />";
    } else {

        for ($i = 0; $i <= count($_FILES['fileToUpload']); $i++) {

            $all_files .= "<p>".$_FILES['fileToUpload']['name'][$i]."</p>";
        }
        $message .= "4. Total Links: in file :" . $all_files ;
//        $message .= "4. Total Links: in file " . $_FILES['fileToUpload']['name'] . "<br />";
        $message .= "5.  Total Price: to count <br />";
        $message .= "6.  Details: $details <br />";
    }
} else {

    $message .= "4.  Site URL: $site_url  <br />";
    $message .= "5.  Price: $orders->summary <br />";
    $message .= "6.  Details: $details <br />";
}

$subject = "Order Number:" . $this_order_id;

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
$email->FromName = 'Online Order System';
$email->Subject = $subject;
$email->msgHTML($message);
$email->AddAddress($to);
$email->AddAddress("remi@ocere.com");
$email->AddAddress("ben@ocere.com ");
$email->AddAddress("tom@ocere.com");
$email->AddAddress("dmitriym.liluweb@gmail.com");
$file_to_attach = $file;

for ($i = 0; $i <= count($_FILES['fileToUpload']); $i++) {
    $pars = explode('.', $_FILES['fileToUpload']['name'][$i]);
    $expansion = end($pars);

    if ($expansion === "xls" || $expansion === "xlsx" || $expansion === "doc" || $expansion === "docx") {


        if ($_FILES['fileToUpload']) {


            // save file in server
            $our_file = file($_FILES["fileToUpload"]["tmp_name"][$i]);
            $fileNameWrite = time() . "_" . $_FILES["fileToUpload"]["name"][$i];
            $file = $_SERVER["DOCUMENT_ROOT"] . "/uploads/$fileNameWrite";
            file_put_contents($file, $our_file);


            $email->AddAttachment($_FILES['fileToUpload']['tmp_name'][$i], $_FILES['fileToUpload']['name'][$i]);
        }
    }
}
$email->Send();

if ($result === TRUE) {
    unset($_COOKIE['order']);
    unset($_COOKIE['comment']);

    setcookie('order', null, -1, '/');
    setcookie('comment', null, -1, '/');
    header('Location:http://' . $_SERVER['SERVER_NAME'] . '/dashboard.php');
}