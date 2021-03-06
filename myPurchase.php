<?php

if (!isset($_SESSION)){
    session_start();
}

$servername = 'localhost';
$username_database = 'root';
$server_password = 'root';

$database = new PDO("mysql:host=$servername; dbname=londonproject_bdd", $username_database, $server_password);


if (isset($_GET['id'])){

    $idSeller = $database->prepare("SELECT * FROM product WHERE id = ?");
    $idSeller->execute(array($_GET['id']));
    $a = $idSeller->fetch();

    $idSeller = $database->prepare("SELECT * FROM offers WHERE id = ?");
    $idSeller->execute(array($_GET['id']));
    $b = $idSeller->fetch();

    if (isset($_POST['offerSubmit'], $_POST['offerBuyer'])){

        if (isset($_SESSION['id'])){

            if (!empty($_POST['offerBuyer'])){
                $offer = $_POST['offerBuyer'];
                $idSeller1 = $a['pseudo_seller'];
                $showOffer = 1;
                $count = $b['counter'];
                $count += 1;

                $sql = $database->prepare("INSERT INTO offers(id_product, id_buyer, id_seller, date, offer, counter, showOffer) VALUES (?, ?, ?, NOW(), ?, ?, ?)");
                $sql->execute(array($_GET['id'], $_SESSION['id'], $idSeller1, $offer, $count, $showOffer));
                header("Location: buying.php?id=".$_SESSION['id']);
            }
        }
        else{

        }
    }
}
?>

<html>
<link>
<title>Register</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/footer.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<style type="text/css">
    main{
        height: 77.5vh;
    }
    .title_Welcome{
        margin-top: 25px;
        margin-bottom: 0px;
        background-color: #f5f5f5;
    }
    .navbar{
        background-color: #f5f5f5;
        width: 100%;
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
    .allMessages{
        margin-top: 25px;
        display: grid;
        margin-left: auto;
        margin-right: auto;
        width: 700px;
    }
    .msg{
        background: white;
    }
    .msg tr{
        border-bottom: 1px solid #f5f5f5;
        background: white;
        transition: all 0.3s ease;
    }
    .msg tr:nth-child(odd){
        background: #f5f5f5;
    }
    .msg tr td, .msg tr th{
        padding: 12px 20px;
        vertical-align: middle;
    }
    .msg tr th{
        font-size: 13px;
        text-transform: uppercase;
    }
</style>
</head>
<body>

<?php include("header.php") ?>

<main>
    <div align="center">
        <h2 class="title_Welcome">My purchase</h2>
        <div class="navbar">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="returnToMyProfile.php" aria-current="page" id="yourProfile">Your profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="myannounces.php">My announces</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="paymentCard.php">Payment card</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bestOffer.php">My messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="myPurchase.php">My purchase</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                </li>
            </ul>
        </div>

        <div class="allMessages">
            <table class="msg">

                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Date</th>
                </tr>
                <?php
                $messagesOffer = $database->prepare("SELECT * FROM product WHERE pseudo_seller = ?");
                $messagesOffer->execute(array($_SESSION['id']));

                while ($i = $messagesOffer->fetch()){ ?>

                    <?php if (!strcmp($i[("state")], "outline")){ ?>

                        <tr>
                            <td style="font-size: 10px"><img style="width: 60px; height: auto" src="<?php echo $i['PICTURE']; ?>"><br>
                                <?php echo $i['SUBCATEGORY'] ?><br>
                                <?php echo $i['BRAND'] ?><br>
                                <?php echo $i['MODEL'] ?><br>
                            </td>
                            <td><?php echo $i['PRICE']; ?>$</td>
                            <td><?php echo $i['dateBuying']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
        </div>
    </div>
</main>



<?php include("footer.php") ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
