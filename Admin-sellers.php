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
        <title>Admin-sellers</title>
        <link rel="stylesheet" href="css/category.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>
    <body>
    <?php include("header.php") ?>

    <br><br><br>
    <p style=" text-align:center ;  margin-left: 30%; margin-right: 30%; color: #3c3c3c; font-size: 40px; border-style: solid; border-color: #3c3c3c; border-radius: 50px">All registered customers</p>
    <br><br>
    <div id="search-hightech">
        <form name="form" method="post" action="">
            <input id="motcle" type="text" name="motcle" placeholder="username">
            <input id="btfind" class="btfind" type="submit" name="btsubmit" value="Search" />
        </form>
        <form name="form2" method="post" action="">
            <input id="motcle2" type="text" name="motcle2" placeholder="email">
            <input id="btfind2" class="btfind2" type="submit" name="btsubmit2" value="Search" />
        </form>
        <a style="color: white; padding-left: 188%"><b>Ebay</b></a>
    </div>

    <br><br>

    <?php

    if(isset($_POST['btsubmit'])){
        $rc=$_POST['motcle'];
        $show = $database->prepare("SELECT * FROM users WHERE username LIKE ?");
        $show->execute(array('%'.$rc.'%'));
        $nbr= $show->rowCount();
    }
    else if(isset($_POST['btsubmit2'])){
        $mc=$_POST['motcle2'];
        $show = $database->prepare("SELECT * FROM users WHERE email LIKE ?");
        $show->execute(array('%'.$mc.'%'));
        $nbr= $show->rowCount();
    }
    else{
        $show = $database->prepare("SELECT * FROM users");
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

                <div id="cars">
                    <img src="<?php echo $ligne ['picture'] ?>" /><br/>
                    <h5><?php echo $ligne ['username']; ?></h5>
                    <a class="delProduct" href="Del_Account.php?id=<?=$ligne['id'] ?>">Delete</a>
                    <?php echo $ligne ['email']; ?> <br/>

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