<?php
if (!isset($_SESSION)){
    session_start();
}
$_SESSION = array();
session_destroy();
$_SESSION['loggedin'] = false;
header("Location: login.php");
?>
