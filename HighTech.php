<?php require_once('connexion_bdd.php'); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>High-Tech</title>
    <link rel="stylesheet" href="css/category.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
<?php include("header.php") ?>

<br><br><br><br><br>
<div id="formauto">
    <form name="formauto" method="post" action="">
        <input id="motcle" type="text" name="motcle">
        <input class="btfind" type="submit" name="btsubmit" value="Recherche" />
    </form>
</div>

<div id="articles">

    <?php

    if(isset($_POST['btsubmit'])){
        $mc=$_POST['motcle'];
        $reqSelect="select * from hightech where BRAND like '%$mc%'";
    }
    else{
        $reqSelect="select * from hightech";
    }
    $resultat=mysqli_query($cnlondonproject_bdd,$reqSelect);
    $nbr=mysqli_num_rows($resultat);
    echo "<p><b>".$nbr."</b> results found</b></p>";
    while ($ligne=mysqli_fetch_assoc($resultat))
    {

        ?>

    <div id="layout2">
        <div id="hightech">
            <img src="<?php echo $ligne ['PICTURE'] ?>" /><br/>
            <?php echo $ligne ['REF']; ?> <br/>
            <?php echo $ligne ['BRAND']; ?> <br/>
            <?php echo $ligne ['MODEL']; ?> <br/>
            <?php echo $ligne ['PRICE'] ." $"; ?>
        </div>
    <?php } ?>
    </div>
</div>

<br><br><br><br><br>
<?php include("footer.php") ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>



