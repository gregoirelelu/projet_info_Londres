<?php
if (!isset($_SESSION)){
    session_start();
}

if (isset($_SESSION['id'])) {
    header("Location: userAccount.php?id=".$_SESSION['id']);
}
else {
    header("Location: login.php");
}







