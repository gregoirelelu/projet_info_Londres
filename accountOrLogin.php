<?php
session_start();

if ($_SESSION['loggedin'] == true) {
    header("Location: userAccount.php");
}
else {
    header("Location: login.php");
}
?>






