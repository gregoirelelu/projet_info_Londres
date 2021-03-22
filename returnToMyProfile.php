<?php
if (!isset($_SESSION)){
    session_start();
}

header("Location: userAccount.php?id=".$_SESSION['id']);
?>
