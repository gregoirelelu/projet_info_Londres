<?php
if (!isset($_SESSION)){
    session_start();
}

if (isset($_SESSION['id'])) {
    header("Location: confirmOrder.php?id=".$_SESSION['id']);
}
else {
    header("Location: validateBag.php");
}
