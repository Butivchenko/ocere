<?php
  $old = $_POST['old_pass'];
  $new = $_POST['new_pass'];
  $new_r = $_POST['repeat_pass'];
  $user = $_COOKIE['user'];
  $secret = $_COOKIE['secret'];
  if($old && $new && $new_r)
  {
    if($new == $new_r)
    {
        if ($secret == md5($old))
        {
          $new_pass = md5($new);
          include('db.php');
          $result = $conn->query("UPDATE users SET Password = '".$new_pass."' WHERE Email ='".$user."'");
          $success = "true";
        }
        else {
          $error = "Old password is incorect";
          $error_name = "old_pass";
        }
    }
    else
    {
    $error = "You have to input same values";
      $error_name = "new_pass";
    }
  }
  else
  {
    $error = "You have to fill all fields";
  }
  echo '{
    "new": "'.$new_pass.'",
    "error": "'.$error.'",
    "error_name": "'.$error_name.'",
    "success": "'.$success.'"
  }';
?>
