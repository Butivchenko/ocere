<?php
  include_once('../functions.php');
  if(is_logged_in()){
    header('Location:http://'.$_SERVER['SERVER_NAME'].'/profile.php');
  }


// Hash generation

// Символы, которые будут использоваться в пароле.

$chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP1234567890";

// Количество символов в пароле.

$max=19;

// Определяем количество символов в $chars

$size=StrLen($chars)-1;

// Определяем пустую переменную, в которую и будем записывать символы.

$password_rec=null;

// Создаём пароль.

    while($max--)
    $password_rec.=$chars[rand(0,$size)];

$user = $_POST['email'];

$href = "http://".$_SERVER['SERVER_NAME']."/recover_pass.php?hash=$password_rec";
$message = "
<!DOCTYPE html>
<html lang=\"en\">
<body>
We accepted your offer to change your password on ".$_SERVER['SERVER_NAME']."<br />
            if you realy want to recover your password click link below<br />
            <a href=\"$href\">$href</a>
</body>
</html>
";


include('db.php');
$result = $conn->query("UPDATE users SET `recovery_hash` ='".$password_rec."' WHERE `Email` ='".$user."'");

$conn->close();

// На случай если какая-то строка письма длиннее 70 символов мы используем wordwrap()
$message = wordwrap($message, 70, "\r\n");
// Отправляем
$headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($user, 'Password recovery', $message, $headers);
header('Location:http://'.$_SERVER['SERVER_NAME'].'/login.php');

?>
