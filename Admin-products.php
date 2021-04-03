<?php require_once('connexion_bdd.php'); ?>

<?php
if (!isset($_SESSION)){
    session_start();
}

$servername = 'localhost';
$username_database = 'root';
$server_password = '';

$database = new PDO("mysql:host=$servername; dbname=londonproject_bdd", $username_database, $server_password);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin-products</title>
    <link rel="stylesheet" href="css/category.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/footer.css">
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
    </style>
</head>
<body>
<?php include("header.php") ?>

<br><br><br>
<p style=" text-align:center ;  margin-left: 30%; margin-right: 30%; color: #3c3c3c; font-size: 40px; border-style: solid; border-color: #3c3c3c; border-radius: 50px">All Products</p>
<br><br>
<div id="search">
    <form name="form" method="post" action="">
        <input id="motcle" type="text" name="motcle" placeholder="Category">
        <input id="btfind" class="btfind" type="submit" name="btsubmit" value="Search" />
    </form>
    <form name="form1" method="post" action="">
        <input id="motcle1" type="text" name="motcle1" placeholder="Sub-category">
        <input id="btfind1" class="btfind1" type="submit" name="btsubmit1" value="Search" />
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
    <form name="form5" method="post" action="">
        <input id="motcle5" type="text" name="motcle5" placeholder="way of buying">
        <input id="btfind5" class="btfind5" type="submit" name="btsubmit5" value="Search" />
    </form>
    <form name="form6" method="post" action="">
        <input id="motcle6" type="date" name="motcle6" placeholder="max auction end date">
        <input id="btfind6" class="btfind6" type="submit" name="btsubmit6" value="Search" />
    </form>
</div>

<br><br>

<?php

if(isset($_POST['btsubmit'])) {
    $tc = $_POST['motcle'];
    $show = $database->prepare("SELECT * FROM product WHERE CATEGORY LIKE ?");
    $show->execute(array('%' . $tc . '%'));
    $nbr = $show->rowCount();
}
else if(isset($_POST['btsubmit1'])){
    $rc=$_POST['motcle1'];
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
else if(isset($_POST['btsubmit5'])){
    $bc=$_POST['motcle5'];
    $show = $database->prepare("SELECT * FROM product WHERE type LIKE ?");
    $show->execute(array('%'.$bc.'%'));
    $nbr= $show->rowCount();
}
else if(isset($_POST['btsubmit6'])){
    $qc=$_POST['motcle6'];
    $show = $database->prepare("SELECT * FROM product WHERE endBidding < ?");
    $show->execute(array($qc));
    $nbr= $show->rowCount();
}
else{
    $show = $database->prepare("SELECT * FROM product");
    $show->execute(array());
    $nbr= $show->rowCount();
}

echo "<p class='result-found'><b>".$nbr."</b> results found</b></p>";

?>

<p style="text-align: center; margin-left: 30.5%; margin-bottom: -6%; padding: 3%; border-style: solid; border-color: #3c3c3c; color: #3c3c3c; width: 273px; font-size: 40px"><a href="Add_Product.php">+</a></p>

<section class="show-product">
    <div id="layout">
        <?php
        while ($ligne = $show->fetch())
        {
            ?>

            <div id="cars">
                <img src="<?php echo $ligne ['PICTURE'] ?>" /><br/>
                <h5><?php echo $ligne ['SUBCATEGORY']; ?></h5>
                <a class="delProduct" href="Del_Product.php?id=<?=$ligne['id'] ?>">Delete</a>
                <?php echo $ligne ['BRAND']; ?> <br/>
                <?php echo $ligne ['MODEL']; ?> <br/>
                <?php echo $ligne ['PRICE'] ." $"; ?> <br/>
                <a class="editProduct" href="Edit_Product.php?id=<?php echo $ligne['id']; ?>">Edit</a>
                <?php echo $ligne ['type']; ?> <br/><br/>
                <?php echo '<span style="font-size: 10px;">' . $ligne ['dateAdd']; ?> <br/>
                <?php
                if (!strcmp($ligne['type'], "auctions")) {
                        echo '<span style="color: orange;  font-size: 10px;">' . $ligne ['endBidding'] . ' (End bidding) ';
                }
                ?>

            </div>

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


