<?php

if (!isset($_SESSION)){
    session_start();
}

$servername = 'localhost';
$username_database = 'root';
$server_password = 'root';

$database = new PDO("mysql:host=$servername; dbname=londonproject_bdd", $username_database, $server_password);

if (isset($_GET['id'])){

    $idSeller = $database->prepare("SELECT * FROM offers WHERE id = ?");
    $idSeller->execute(array($_GET['id']));
    $b = $idSeller->fetch();

    if (isset($_POST['accept'])){


    }
    else if (isset($_POST['refuse'])){
        $sql = $database->prepare("DELETE FROM offers WHERE id = ?");
        $sql->execute(array($_GET['id']));
        header("Location: bestOffer.php?id=".$_SESSION['id']);
    }
    else if (isset($_POST['counterOffer'])){
        $offer = $_POST['counterOfferPrice'];
        $showOffer = 0;

        $sql1 = $database->prepare("UPDATE offers SET offer = ?, showOffer = ? WHERE id = ?");
        $sql1->execute((array($offer, $showOffer, $_GET['id'])));
        header("Location: bestOffer.php?id=".$_SESSION['id']);
    }
    else if (isset($_POST['counterOffer2'])){
        $offer = $_POST['counterOfferPrice'];
        $showOffer = 1;
        $count = $b['counter'];
        $count += 1;

        $sql1 = $database->prepare("UPDATE offers SET offer = ?, counter = ?, showOffer = ? WHERE id = ?");
        $sql1->execute((array($offer, $count, $showOffer, $_GET['id'])));
        header("Location: bestOffer.php?id=".$_SESSION['id']);
    }
}
?>