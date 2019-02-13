<?php
session_start();



function is_logged_in()
{
    if ($_COOKIE['user'] && $_COOKIE['secret']) {
        $user = $_COOKIE['user'];
        $secret = $_COOKIE['secret'];
        include('php/db.php');
        $result = $conn->query("SELECT * FROM users WHERE Email = '" . $user . "' AND Password = '" . $secret . "'");

        if ($result > 0) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $_SESSION['userRole'] = $row["role"];;
                }

                $answer = true;
            } else {
                $answer = false;
            }
        } else {
            $answer = false;

        }


    } else {
        $answer = false;
    }
    return $answer;
}
