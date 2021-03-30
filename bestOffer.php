<?php

if (!isset($_SESSION)){
    session_start();
}

$servername = 'localhost';
$username_database = 'root';
$server_password = 'root';

$database = new PDO("mysql:host=$servername; dbname=londonproject_bdd", $username_database, $server_password);

if (isset($_GET['id'])){

    if (isset($_POST['offerSubmit'], $_POST['offerBuyer'])){

        if (isset($_SESSION['id'])){

            if (!empty($_POST['offerBuyer'])){
                $offer = $_POST['offerBuyer'];

                $sql = $database->prepare("INSERT INTO offers(id_product, id_buyer, date, offer) VALUES (?, ?, NOW(), ?)");
                $sql->execute(array($_GET['id'], $_SESSION['id'], $offer));
            }
        }
        else{

        }
    }
    else{
        echo 'non';
    }
}
?>
