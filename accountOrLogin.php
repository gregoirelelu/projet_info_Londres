<?php
session_start();

$servername = 'localhost';
$username_database = 'root';
$server_password = 'root';

$database = new PDO("mysql:host=$servername; dbname=london_ebay", $username_database, $server_password);

    $id_getter = intval($_GET['id']);
    $select_id = $database->prepare('SELECT * FROM users WHERE id = ?');
    $select_id->execute(array($id_getter));
    $result = $select_id->fetch();



    if (isset($_SESSION['id']) and $result['id'] == $_SESSION['id']) {
        header("Location: userAccount.php?id=".$_SESSION['id']);
    }
    else{
        header("Location: login.php");
    }

?>
