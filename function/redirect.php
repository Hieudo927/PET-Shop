<?php
session_start();
function redirect($url, $message)
{
    $_SESSION['msg'] = $message;
    header('Location: '. $url);
    exit();
}

