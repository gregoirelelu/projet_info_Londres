<?php require_once('connexion_bdd.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styleTest.css" />
</head>

<body>

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

        <div id="hightech">
            <img src="<?php echo $ligne ['PICTURE'] ?>" /><br/>
            <?php echo $ligne ['REF']; ?> <br/>
            <?php echo $ligne ['BRAND']; ?> <br/>
            <?php echo $ligne ['MODEL']; ?> <br/>
            <?php echo $ligne ['PRICE'] ." $"; ?>
        </div>
    <?php } ?>
</div>

</body>
</html>