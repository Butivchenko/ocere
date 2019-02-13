<?php

include_once('functions.php');
include('php/db.php');

$orders = json_decode( $_COOKIE['order']);
$message = "";
foreach ($orders as $order => $value)
          {
            $message .= "<p>".$value->name." : ".$value->anchor." - ".$value->url."</p>";


          }
          var_dump($_FILES);
          echo $message."<br />";
          ?>
