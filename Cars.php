<?php require_once('connexion_bdd.php'); ?>

<?php
require 'database-class.php';
require 'bag-class.php';
$db = new database();
$bag = new bag($db);
?>

<?php
if (!isset($_SESSION)){
    session_start();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cars</title>
    <link rel="stylesheet" href="css/category.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style type="text/css">
        .addBag{
            float: right;
            color: #ffffff;
            background-color: blueviolet;
            border-radius: 25px;
            width: 30%;
            height: 100%;
            text-align: center;
        }
        .addBag:hover{
            float: right;
            color: #ffffff;
            background-color: blueviolet;
            border-radius: 25px;
            width: 30%;
            height: 120%;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php include("header.php") ?>

<br><br><br>
<p style=" text-align:center ;  margin-left: 30%; margin-right: 30%; color: #3c3c3c; font-size: 40px; border-style: solid; border-color: #3c3c3c; border-radius: 50px">Cars</p>
<br><br>
<div id="search">
    <form name="form" method="post" action="">
        <input id="motcle" type="text" name="motcle" placeholder="Sub-category">
        <input id="btfind" class="btfind" type="submit" name="btsubmit" value="Search" />
    </form>
    <form name="form" method="post" action="">
        <input id="motcle2" type="text" name="motcle2" placeholder="brand">
        <input id="btfind2" class="btfind2" type="submit" name="btsubmit" value="Search" />
    </form>
    <form name="form2" method="post" action="">
        <input id="motcle3" type="text" name="motcle3" placeholder="model">
        <input id="btfind3" class="btfind3" type="submit" name="btsubmit3" value="Search" />
    </form>
    <form name="form3" method="post" action="">
        <input id="motcle4" type="number" name="motcle4" placeholder="max price">
        <input id="btfind4" class="btfind4" type="submit" name="btsubmit4" value="Search" />
    </form>
    <p id="log"><b>eBay</b></p>
</div>
<br><br>

    <?php

    if(isset($_POST['btsubmit'])){
        $rc=$_POST['motcle'];
        $reqSelect="select * from product where SUBCATEGORY IN ('Vehicle') like '%$rc%'";
    }
    else if(isset($_POST['btsubmit'])){
        $mc=$_POST['motcle'];
        $reqSelect="select * from product where BRAND IN ('Vehicle') like '%$mc%'";
    }
    else if(isset($_POST['btsubmit2'])){
        $lc=$_POST['motcle2'];
        $reqSelect="select * from product where MODEL IN ('Vehicle') like '%$lc%'";
    }
    else if(isset($_POST['btsubmit3'])){
        $nc=$_POST['motcle3'];
        $reqSelect="select * from product where PRICE IN ('Vehicle') PRICE < '$nc'";
    }
    else{
        $reqSelect="select * from product where CATEGORY IN ('Vehicle')";
    }
    $resultat=mysqli_query($cnlondonproject_bdd,$reqSelect);
    $nbr=mysqli_num_rows($resultat);
    echo "<p><b>".$nbr."</b> results found</b></p>";
    while ($ligne=mysqli_fetch_assoc($resultat))
    {

    ?>

    <div id="layout">
        <div id="cars">
            <img src="<?php echo $ligne ['PICTURE'] ?>" /><br/>
            <?php echo $ligne ['SUBCATEGORY']; ?> <br/>
            <?php echo $ligne ['BRAND']; ?> <br/>
            <a class="addBag" href="addBag.php?id=<?= $ligne['id']; ?>">Add</a>
            <?php echo $ligne ['MODEL']; ?> <br/>
            <?php echo $ligne ['PRICE'] ." $"; ?>
        </div>
        <?php } ?>
    </div>

<br><br><br><br><br>
<?php include("footer.php") ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>