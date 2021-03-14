<?php
session_start();

if ($_SESSION['loggedin'] == true) {
    header("Location: userAccount.php?id=".$_SESSION['id']);
}
else {
    header("Location: login.php");
}







