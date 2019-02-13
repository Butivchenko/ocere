<?php
  include_once('functions.php');
  if(is_logged_in()){
    header('Location:http://'.$_SERVER['SERVER_NAME'].'/profile.php');
  }
  $hash_code = $_GET["hash"];

  include_once('php/db.php');
  $sql = "SELECT * FROM users WHERE recovery_hash = '".$hash_code."'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0)
  {
    while ($row = $result->fetch_assoc())
    {
      $curr_user["email"] = $row["Email"];
     }
    $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP1234567890";
    $max=12;
    $size=StrLen($chars)-1;
    $password_rec=null;

        while($max--)
        $password_rec.=$chars[rand(0,$size)];

        $new_pass = md5($password_rec);
        $new_sql = "UPDATE users SET Password = '".$new_pass."', recovery_hash = '' WHERE recovery_hash = '".$hash_code."'";
        echo $new_sql;

    $res = $conn->query($new_sql);
  }


  $message = "
  <!DOCTYPE html>
  <html lang=\"en\">
  <body>
  Your new password for ".$_SERVER['SERVER_NAME']." is $password_rec<br />
  </body>
  </html>
  ";
  $message = wordwrap($message, 70, "\r\n");
  // Отправляем
  $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
  mail($curr_user["email"], 'New password', $message, $headers);


  header('Location:http://'.$_SERVER['SERVER_NAME'].'/login.php');
?>
