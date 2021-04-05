<?php require_once('connexion_bdd.php'); ?>

<?php
if (!isset($_SESSION)){
    session_start();
}

$servername = 'localhost';
$username_database = 'root';
$server_password = 'root';

$database = new PDO("mysql:host=$servername; dbname=londonproject_bdd", $username_database, $server_password);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Buying</title>
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
            height: 7%;
            text-align: center;
        }
        .addBid{
            float: right;
            color: #ffffff;
            background-color: #7bdbdb;
            border-radius: 25px;
            width: 30%;
            height: 7%;
            text-align: center;
        }
        .addBid:hover{
            float: right;
            color: #ffffff;
            background-color: #7bdbdb;
            border-radius: 25px;
            width: 30%;
            height: 7%;
            text-align: center;
        }
        .addBag:hover{
            float: right;
            color: #ffffff;
            background-color: blueviolet;
            border-radius: 25px;
            width: 30%;
            height: 7%;
            text-align: center;
            text-decoration: none;
        }
        .addOffer{
            float: right;
            color: #ffffff;
            background-color: #338301;
            border-radius: 25px;
            width: 30%;
            height: 7%;
            text-align: center;
        }
        .addOffer:hover{
            float: right;
            color: #ffffff;
            background-color: #338301;
            border-radius: 25px;
            width: 30%;
            height: 7%;
            text-align: center;
        }
    </style>
</head>
<body>
<?php include("header.php") ?>

<br><br><br>
<p style=" text-align:center ;  margin-left: 30%; margin-right: 30%; color: #3c3c3c; font-size: 40px; border-style: solid; border-color: #3c3c3c; border-radius: 50px">Buying</p>

<form style="justify-content: center" method="POST" action="">
    <select style="margin-left: 25px; margin-top: 20px" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="type">
        <option value="buyNow" selected>Buy it Now</option>
        <option value="bestOffer">Best offer</option>
        <option value="auctions"><a href="Add_Product.php">Auctions</a></option>
    </select>
    <input type="submit" name="btsubmit5" value="Go!">
</form>

<br><br>
<div id="search-hightech">
    <form name="form" method="post" action="">
        <input id="motcle" type="text" name="motcle" placeholder="Sub-category">
        <input id="btfind" class="btfind" type="submit" name="btsubmit" value="Search" />
    </form>
    <form name="form2" method="post" action="">
        <input id="motcle2" type="text" name="motcle2" placeholder="brand">
        <input id="btfind2" class="btfind2" type="submit" name="btsubmit2" value="Search" />
    </form>
    <form name="form3" method="post" action="">
        <input id="motcle3" type="text" name="motcle3" placeholder="model">
        <input id="btfind3" class="btfind3" type="submit" name="btsubmit3" value="Search" />
    </form>
    <form name="form4" method="post" action="">
        <input id="motcle4" type="number" name="motcle4" placeholder="max price">
        <input id="btfind4" class="btfind4" type="submit" name="btsubmit4" value="Search" />
    </form>
</div>

<br><br>

<?php

if(isset($_POST['btsubmit'])){
    $rc=$_POST['motcle'];
    $show = $database->prepare("SELECT * FROM product WHERE SUBCATEGORY LIKE ?");
    $show->execute(array('%'.$rc.'%'));
    $nbr= $show->rowCount();
}
else if(isset($_POST['btsubmit2'])){
    $mc=$_POST['motcle2'];
    $show = $database->prepare("SELECT * FROM product WHERE BRAND LIKE ?");
    $show->execute(array('%'.$mc.'%'));
    $nbr= $show->rowCount();
}
else if(isset($_POST['btsubmit3'])){
    $lc=$_POST['motcle3'];
    $show = $database->prepare("SELECT * FROM product WHERE MODEL LIKE ?");
    $show->execute(array('%'.$lc.'%'));
    $nbr= $show->rowCount();
}
else if(isset($_POST['btsubmit4'])){
    $nc=$_POST['motcle4'];
    $show = $database->prepare("SELECT * FROM product WHERE PRICE < ?");
    $show->execute(array($nc));
    $nbr= $show->rowCount();
}
else if(isset($_POST['type'])){
    $hc=$_POST['type'];
    if (strcmp($hc, "buyNow")){
        $show = $database->prepare("SELECT * FROM product WHERE type LIKE ?");
        $show->execute(array($hc));
        $nbr= $show->rowCount();
    }
    else if (strcmp($hc, "bestOffer")){
        $show = $database->prepare("SELECT * FROM product WHERE type LIKE ?");
        $show->execute(array($hc));
        $nbr= $show->rowCount();
    }
    else if (strcmp($hc, "auctions")){
        $show = $database->prepare("SELECT * FROM product WHERE type LIKE ?");
        $show->execute(array($hc));
        $nbr= $show->rowCount();
    }
}
else{
    $show = $database->prepare("SELECT * FROM product");
    $show->execute(array());
    $nbr= $show->rowCount();
}

echo "<p class='result-found'><b>".$nbr."</b> results found</b></p>";

?>

<section class="show-product">
    <div id="layout">
        <?php
        while ($ligne = $show->fetch())
        {
            ?>

            <?php if (!strcmp($ligne['state'], "online")){ ?>

            <div id="hightech">
                <a href="productPage.php?id=<?= $ligne['id']; ?>"><img src="<?php echo $ligne ['PICTURE'] ?>" /></a><br/>
                <h5><?php echo $ligne ['SUBCATEGORY']; ?></h5>
                <?php echo $ligne ['BRAND']; ?> <br/>
                <?php echo $ligne ['MODEL']; ?> <br/>
                <?php echo $ligne ['PRICE'] ." $"; ?> <br/>
                <?php echo $ligne ['type']; ?><br/>
                <?php
                if (!strcmp($ligne['type'], "auctions")){
                    ?>

                    <a class="addBid" href="Bidding.php?id=<?= $ligne['id']; ?>">Bid</a><br>

                    <?php
                }
                else if (!strcmp($ligne['type'], "buyNow")){
                    ?>

                    <a class="addBag" href="addBag.php?id=<?= $ligne['id']; ?>">Add</a><br>

                    <?php
                }
                else if (!strcmp($ligne['type'], "bestOffer")){
                    ?>

                    <form method="post" action="bestOffer.php?id=<?= $ligne['id']; ?>">
                        <textarea style="height: 30px; width: 240px" placeholder="Your offer" name="offerBuyer"></textarea>$
                        <input style="font-size: 10px" class="addOffer" type="submit" value="Send offer" name="offerSubmit">
                    </form>

                    <?php
                }
                ?>
                <div style="float: right; font-size: 10px;"><?php echo $ligne ['dateAdd']; ?></div>
            </div>
        <?php } ?>
        <?php } ?>

    </div>
</section>

<br><br><br><br><br>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<?php include ("footer.php")?>

