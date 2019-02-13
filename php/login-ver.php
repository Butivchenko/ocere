<?php
  require_once __DIR__ . '/db.php';

  $email = $_POST['email'];
  $pass = md5($_POST['password']);

  $error_name = "login_btn";

  $result = $conn->query("SELECT * FROM users WHERE Email = '".$email."' AND Password = '". $pass ."'");

    if ($result > 0)
    {
       if ($result->num_rows > 0)
       {
         $success = "true";
         session_start();
       }
       else {
         $error =  "Wrong email or password";
       }
    }
    else
    {
       $error =  "Wrong email or password";

    }
  $conn->close();

  echo '{
    "user": "'.$email.'",
    "secret": "'.$pass.'",
    "error": "'.$error.'",
    "error_name": "'.$error_name.'",
    "success": "'.$success.'"
  }';
