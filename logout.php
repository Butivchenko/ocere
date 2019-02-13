<?php
unset($_COOKIE['user']);
unset($_COOKIE['secret']);
unset($_SESSION['role']);
setcookie('user', null, -1, '/');
setcookie('secret', null, -1, '/');
header('Location:http://' . $_SERVER['SERVER_NAME'] . '/login.php');

?>
