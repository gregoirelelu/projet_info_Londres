<?php
if (!isset($_GET)){
    session_start();
}

$servername = 'localhost';
$username_database = 'root';
$server_password = 'root';

$database = new PDO("mysql:host=$servername; dbname=londonproject_bdd", $username_database, $server_password);

if (isset($_GET['id']) and !empty($_GET['id'])) {
    $editArticle = htmlspecialchars($_GET['id']);
    $sql = $database->prepare('SELECT * FROM product WHERE id = ?');
    $sql->execute(array($editArticle));
    $sql = $sql->fetch();

    if (isset($_POST['subcategory-edit']) and $_POST['subcategory-edit'] != $sql['SUBCATEGORY'] and !empty($_POST['subcategory-edit'])) {
        $newSubCate = htmlspecialchars($_POST['subcategory-edit']);

        $newSubCategory = $database->prepare("UPDATE product SET SUBCATEGORY = ? WHERE id = ?");
        $newSubCategory->execute(array($newSubCate, $_GET['id']));
        header('Refresh:4; edit-announce.php?id=' . $_GET['id']);
        $success = "Sub-category modified successfully !";
    }
    if (isset($_POST['brand-edit']) and $_POST['brand-edit'] != $sql['BRAND'] and !empty($_POST['brand-edit'])) {
        $newbr = htmlspecialchars($_POST['subcategory-edit']);

        $newbrand = $database->prepare("UPDATE product SET BRAND = ? WHERE id = ?");
        $newbrand->execute(array($newbr, $_GET['id']));
        header('Refresh:4; edit-announce.php?id=' . $_GET['id']);
        $success1 = "Brand modified successfully !";
    }
    if (isset($_POST['model-edit']) and $_POST['model-edit'] != $sql['MODEL'] and !empty($_POST['model-edit'])) {
        $newmo = htmlspecialchars($_POST['model-edit']);

        $newmodel = $database->prepare("UPDATE product SET MODEL = ? WHERE id = ?");
        $newmodel->execute(array($newmo, $_GET['id']));
        header('Refresh:4; edit-announce.php?id=' . $_GET['id']);
        $success2 = "Model modified successfully !";
    }
    if (isset($_POST['price-edit']) and $_POST['price-edit'] != $sql['PRICE'] and !empty($_POST['price-edit'])) {
        $newpri = htmlspecialchars($_POST['price-edit']);

        $newprice = $database->prepare("UPDATE product SET PRICE = ? WHERE id = ?");
        $newprice->execute(array($newpri, $_GET['id']));
        header('Refresh:4; edit-announce.php?id=' . $_GET['id']);
        $success3 = "Price modified successfully !";
    }
    if (isset($_POST['delete-btn'])){
        $sqlDelete = $database->prepare("DELETE FROM product WHERE id = ?");
        $sqlDelete->execute(array($editArticle));
        header("Location: myannounces.php");
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/category.css" />
    <style type="text/css">
        .title_Welcome{
            margin-top: 25px;
            margin-bottom: 0px;
            background-color: #f5f5f5;
        }
        .nav a{
            text-decoration: none;
            color: black;
            transition: all 0.3s ease-in-out;
            border-bottom: 2px solid transparent;
        }
        .nav a:hover{
            text-decoration: none;
            padding-top: 3px;
            border-bottom: 2px solid black;
            color: black;
            cursor: pointer;
        }
        main1{
            display: flex;
            justify-content: center;
            padding-bottom: 15vh;
        }
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
        .back{
            color: black;
            margin-left: 20px;
            float: left;
        }
        .back:hover{
            color: black;
        }
        .product-small-img img{
            height: 40px;
            width: auto;
            margin: 10px 0;
            cursor: pointer;
            display: block;
        }
        .product-small-img{
            float: left;
        }
        .img-container img{
            height: 100px;
            width: auto;
        }
        .img-container{
            float: right;
        }
    </style>
    </style>
</head>
<body>
<?php include("header.php") ?>

<?php

if (isset($_GET['id']) and !empty($_GET['id'])){
    $sql = $database->prepare('SELECT * FROM product WHERE id = ?');
    $sql->execute(array($_GET['id']));
    $sql = $sql->fetch();

    ?>

    <main>
        <div align="center">
            <h2 class="title_Welcome"><?php echo $sql['BRAND']?> - <?php echo $sql['MODEL']?></h2>
            <a class="back" href="buying.php"><i class="fas fa-times fa-2x"></i></a>
        </div>
    </main>

    <section class="show-product">
        <div id="layout">
            <div id="hightech">
                <div><img id="img1" src="<?php echo $sql['PICTURE']?>" onclick="myFunction(this)"></div>
                <div style="margin-bottom: 10px">
                    <img style="width: 20%" src="<?php echo $sql['PICTURE']?>" onclick="myFunction(this)">

                    <?php if ($sql['PICTURE2'] != NULL){ ?>

                    <img style="width: 20%" src="<?php echo $sql['PICTURE2']?>" onclick="myFunction(this)">

                    <?php if ($sql['PICTURE3'] != NULL){ ?>
                    <img style="width: 20%" src="<?php echo $sql['PICTURE3']?>" onclick="myFunction(this)">

                    <?php if ($sql['VIDEO'] != NULL){ ?>
                    <iframe style="width: 100%; height: 40%" src="<?php echo $sql['VIDEO']?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    <?php } ?>
                    <?php } ?>
                    <?php } ?>
                </div>
                <h5><?php echo $sql['SUBCATEGORY']; ?></h5>
                <?php echo $sql['BRAND']; ?> <br/>
                <?php echo $sql['MODEL']; ?> <br/>
                <?php echo $sql['PRICE'] ." $"; ?>

                <?php if (!strcmp($sql['type'], "auctions")){
                ?>

                <a class="addBid" href="Bidding.php?id=<?= $sql['id']; ?>">Bid</a><br>

                <?php
                }
                else if (!strcmp($sql['type'], "buyNow")){
                    ?>

                    <a class="addBag" href="addBag.php?id=<?= $sql['id']; ?>">Add</a><br>

                    <?php
                }
                else if (!strcmp($sql['type'], "bestOffer")){
                    ?>

                    <form method="post" action="bestOffer.php?id=<?= $sql['id']; ?>">
                        <textarea style="height: 30px; width: 240px" placeholder="Your offer" name="offerBuyer"></textarea>$
                        <input style="font-size: 10px" class="addOffer" type="submit" value="Send offer" name="offerSubmit">
                    </form>

                    <?php
                }
                ?>
                <?php echo $sql['description']; ?><br>
                <div style="float: right; font-size: 10px;"><?php echo $sql ['dateAdd']; ?></div>
            </div>
        </div>
    </section>

<?php } ?>


<?php include("footer.php") ?>

<script>
    function myFunction(smallImg){
        var fullImg = document.getElementById("img1");
        fullImg.src = smallImg.src;
    }
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
