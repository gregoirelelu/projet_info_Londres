<?php
if (!isset($_SESSION)){
    session_start();
}

header("Location: sell.php?id=".$_SESSION['id']);
