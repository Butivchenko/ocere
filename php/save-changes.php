<?php
  include_once('../functions.php');
  if(!is_logged_in()){
    header('Location:http://'.$_SERVER['SERVER_NAME'].'/login.php');
  }

  $user = $_COOKIE['user'];
  $secret = $_COOKIE['secret'];

  $user_new['first_name'] = $_POST['first_name'];
  $user_new['last_name'] = $_POST['last_name'];
  $user_new['email'] = $_POST['email'];
  $user_new['bill_country'] = $_POST['country'];

  include('db.php');
  $result = $conn->query("UPDATE users SET
                          `First Name` ='".$user_new['first_name']."',
                          `Last Name` ='".$user_new['last_name']."',
                          `Email` ='".$user_new['email']."',
                          `Billing County` ='".$user_new['bill_country']."'
                          WHERE `Email` ='".$user."'
                          AND `Password` = '".$secret."'");

  if ($result->num_rows == 0)
    {
      $success = "true";
    }
    else {
      $error = "Error";
    }
  echo '{
        "new_email": "'.$user_new['email'].'",
        "success": "'.$success.'",
        "error": "'.$error.'"
        }';


?>
