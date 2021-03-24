<?php require_once('connexion_bdd.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add product</title>
    <link rel="stylesheet" href="css/category.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/normalize.css">

</head>
<body>
<?php include("header.php") ?>

<div id="insert">
<h2>Insert a product </h2>
<form  name="ins" method="post" action="">
    <input type="text" name="CATEGORY" placeholder="Category"/><br><br>
    <input type="text" name="SUBCATEGORY" placeholder="Sub-category"/><br><br>
    <input type="text" name="BRAND" placeholder="Brand"/><br><br>
    <input type="text" name="MODEL" placeholder="Model"/><br><br>
    <input type="text" name="PRICE" placeholder="Price"/><br><br>
    <input type="text" name="PICTURE" placeholder="Picture"/><br><br>
    <input id="btn_ins" type="submit" value="Insert" />
</form>

    <br><p style="text-align: center"><a href="Admin-products.php">Return</a></p>

</div>
<?php

$bdd = new PDO ("mysql:host=localhost; dbname=londonproject_bdd; charset=utf8", "root", "root");

if ( isset($_POST['CATEGORY']) AND isset($_POST['SUBCATEGORY']) AND isset($_POST['BRAND']) AND isset($_POST['MODEL']) AND isset($_POST['PRICE']) AND isset($_POST['PICTURE'])){

    $requete = $bdd->prepare("INSERT INTO product (CATEGORY, SUBCATEGORY, BRAND, MODEL, PRICE, PICTURE) VALUES (?, ?, ?, ?, ?, ?)");
    $requete->execute(array($_POST['CATEGORY'], $_POST['SUBCATEGORY'], $_POST['BRAND'], $_POST['MODEL'], $_POST['PRICE'], $_POST['PICTURE']));


    ?>

    <?php
}
?>


<br><br><br><br><br>
<?php include("footer.php") ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>