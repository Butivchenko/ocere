<?php
  require_once __DIR__ . '/recaptchalib.php';
  require_once __DIR__ . '/db.php';

  // Введите свой секретный ключ
$secret = "6LfJD2gUAAAAAMaBD5Z0uHFM1_XId7Yz3L6sDoWR";

// пустой ответ каптчи
$response = null;

// Для проверка вашего секретного ключа

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$pasLens = strlen($_POST["password"]);
$password = md5($_POST["password"]);
$country = $_POST["country"];
$capcha = $_POST["captcha"];

$success = 'false';



$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$captcha), true);


 if (strlen($capcha) > 0) {


  $result = $conn->query("SELECT * FROM users WHERE Email = '$email'");

  if ($result->num_rows == 0)
  {
    $sql = "INSERT INTO `users`( `First Name`, `Last Name`, `Email`, `Password`, `Billing County`)
            VALUES ( '$first_name', '$last_name', '$email','$password','$country')";

        if( $email )
        {
          if (filter_var($email, FILTER_VALIDATE_EMAIL))
          {
            if($pasLens>=6)
            {
              if ($conn->query($sql) === TRUE)
              {

                $success = 'true';
                $error = 'no';
                $error_id = 'no';
              }
              else
              {
                  $error = "Error: " . $sql . "<br>" . $conn->error;
              }
            }
            else {
              $error = "Password must be more than 6 chars";
              $error_name = 'password';

            }
          }
          else {
            $error = "Incorect email";
            $error_name = 'email';

          }
        }
        else {
          $error =  "Please input email";
          $error_name = 'email';

        }
      }
  else
  {
    $error = "Such email already in use";
    $error_name = 'email';
  }
}
else {
  $error = "You must enter recaptcha. Error : ".$response["error-codes"][0];
  $error_name = 'capcha_holder';
}

echo '{
  "error": "'.$error.'",
  "error_name": "'.$error_name.'",
  "success": "'.$success.'",
  "secret": "'.$password.'",
  "user": "'.$email.'"
}';

$conn->close();
?>
