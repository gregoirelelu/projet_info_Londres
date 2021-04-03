<?php require_once('connexion_bdd.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit product</title>
    <link rel="stylesheet" href="css/category.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
<?php include("header.php") ?>

<div id="insert" style="width: 500px">
    <h2> Insert the modified product </h2>
    <form  name="ins" method="post" action="">
        <input type="text" name="CATEGORY" placeholder="Category"/><br><br>
        <input type="text" name="SUBCATEGORY" placeholder="Sub-category"/><br><br>
        <input type="text" name="BRAND" placeholder="Brand"/><br><br>
        <input type="text" name="MODEL" placeholder="Model"/><br><br>
        <input type="text" name="PRICE" placeholder="Price"/><br><br>
        <input type="text" name="PICTURE" placeholder="Picture"/><br><br>
        <input type="text" name="pseudo_seller" placeholder="pseudo_seller"/><br><br>
        <input type="text" name="type" placeholder="Type"/><br><br>
        <input id="btn_ins" type="submit" value="Insert" />
    </form>

    <br><p style="text-align: center"><a href="Admin-products.php">Return</a></p>

</div>
<?php

$objetPdo = new PDO ("mysql:host=localhost; dbname=londonproject_bdd; charset=utf8", "root", "");

$pdoStat = $objetPdo->prepare('DELETE FROM product WHERE id=:id');

$pdoStat->bindValue(':id',$_GET['id'],PDO::PARAM_INT);

$executeIsOK = $pdoStat->execute();

$bdd = new PDO ("mysql:host=localhost; dbname=londonproject_bdd; charset=utf8", "root", "");

if ( isset($_POST['CATEGORY']) AND isset($_POST['SUBCATEGORY']) AND isset($_POST['BRAND']) AND isset($_POST['MODEL']) AND isset($_POST['PRICE']) AND isset($_POST['PICTURE']) AND isset($_POST['pseudo_seller']) AND isset($_POST['type'])){

    $requete = $bdd->prepare("INSERT INTO product (CATEGORY, SUBCATEGORY, BRAND, MODEL, PRICE, PICTURE, dateAdd, pseudo_seller, type) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?)");
    $requete->execute(array($_POST['CATEGORY'], $_POST['SUBCATEGORY'], $_POST['BRAND'], $_POST['MODEL'], $_POST['PRICE'], $_POST['PICTURE'], $_POST['pseudo_seller'], $_POST['type']));


    ?>

    <?php
}
?>


<br><br><br><br><br>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>

