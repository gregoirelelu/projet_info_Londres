<?php
if (!isset($_SESSION)){
    session_start();
}

$servername = 'localhost';
$username_database = 'root';
$server_password = 'root';

$database = new PDO("mysql:host=$servername; dbname=londonproject_bdd", $username_database, $server_password);

$select_id = $database->prepare('SELECT * FROM users WHERE id = ?');
$select_id->execute(array($_SESSION['id']));
$result = $select_id->fetch();

if (isset($_POST['submit'])){
    $cardType = $_POST['paymentType'];

    if (isset($_POST['paymentType'])){

        if (strcmp($cardType, "Visa") == 0){
            $cardNumber = $_POST['cardNumber'];
            $cardName = $_POST['cardName'];
            $cardExpiration = $_POST['cardExpiration'];
            $cardSecurity = $_POST['cardSecurity'];
            $sql = $database->prepare("UPDATE users SET cardType = ?, cardNumber = ?, cardName = ?, cardExpiration = ?, cardSecurity = ? WHERE id = ?");
            $sql->execute(array($cardType, $cardNumber, $cardName, $cardExpiration, $cardSecurity, $_SESSION['id']));
            $success = "Card added successfully!";
        }
        else if (strcmp($cardType, "MasterCard") == 0){
            $cardNumber1 = $_POST['cardNumber1'];
            $cardName1 = $_POST['cardName1'];
            $cardExpiration1 = $_POST['cardExpiration1'];
            $cardSecurity1 = $_POST['cardSecurity1'];
            $sql = $database->prepare("UPDATE users SET cardType = ?, cardNumber = ?, cardName = ?, cardExpiration = ?, cardSecurity = ? WHERE id = ?");
            $sql->execute(array($cardType, $cardNumber1, $cardName1, $cardExpiration1, $cardSecurity1, $_SESSION['id']));
            $success = "Card added successfully!";
        }
        else if (strcmp($cardType, "American Express") == 0){
            $cardNumber2 = $_POST['cardNumber2'];
            $cardName2 = $_POST['cardName2'];
            $cardExpiration2 = $_POST['cardExpiration2'];
            $cardSecurity2 = $_POST['cardSecurity2'];
            $sql = $database->prepare("UPDATE users SET cardType = ?, cardNumber = ?, cardName = ?, cardExpiration = ?, cardSecurity = ? WHERE id = ?");
            $sql->execute(array($cardType, $cardNumber2, $cardName2, $cardExpiration2, $cardSecurity2, $_SESSION['id']));
            $success = "Card added successfully!";
        }
    }
    else{
        $error = "All fileds must be completed!";
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
    <style type="text/css">
        main{
            height: 75vh;
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
            position: relative;
        }
        .nav a:hover{
            text-decoration: none;
            padding-top: 3px;
            border-bottom: 2px solid black;
            color: black;
            cursor: pointer;
        }
        .form{
            display: flex;
            justify-content: center;
            margin-top: 25px;
            width: 100%;
        }
        .form input{
            margin-right: 5px;
        }
        .form label{
            margin-right: 15px;
        }
        #masterCardForm{
            display: none;
        }
        #americanExpressForm{
            display: none;
        }
        #paypalForm{
            display: none;
        }
        #myCardForm{
            display: none;
        }

        .visaForm{
            justify-content: center;
            display: grid;
        }
        .masterCardForm{
            justify-content: center;
            display: grid;
        }
        .americanExpressForm{
            justify-content: center;
            display: grid;
        }
        .paypalForm{
            justify-content: center;
            display: grid;
        }
        .myCardForm{
            justify-content: center;
            display: grid;
        }
        .form img{
            width: 80px;
            height: auto;
        }
        #visaForm #cardNumber{
            width: 250px;
        }
        .submitbtn{
            display: flex;
            margin-left: auto;
            margin-right: auto;
            color: #ffffff;
            background-color: blueviolet;
        }
        .formSend{
            display: grid;
        }
    </style>
</head>
<body>
<?php include("header.php") ?>

<main>
    <div align="center">
        <h2 class="title_Welcome">Your payment card!</h2>
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
    </div>

    <form method="post" action="" class="formSend" id="formSend">
        <div id="form" class="form">
            <input type="radio" id="visa" name="paymentType" value="Visa" checked onclick="showForm()">
            <label for="visa"><img src="img/visa1.png"></label>
            <input type="radio" id="masterCard" name="paymentType" value="MasterCard" onclick="showForm()">
            <label for="masterCard"><img src="img/mastercard.png"></label>
            <input type="radio" id="americanExpress" name="paymentType" value="American Express" onclick="showForm()">
            <label for="americanExpress"><img style="width: 105px; height: auto" src="img/americanexpress.png"></label>

        </div>

        <div class="form1">
            <div id="visaForm">
                <div id="formCard" class="visaForm">
                    <div>
                        <label for="cardNumber">Card number</label>
                        <input type="text" id="cardNumber" name="cardNumber" placeholder="xxxx xxxx xxxx xxxx">
                    </div>
                    <div>
                        <label for="cardName">Card name</label>
                        <input type="text" id="cardName" name="cardName" placeholder="NAME SURNAME">
                    </div>
                    <div>
                        <label for="cardExpiration">Card expiration</label>
                        <input type="text" id="cardExpiration" name="cardExpiration" placeholder="xx/xx">
                    </div>
                    <div>
                        <label for="cardSecurity">Security code</label>
                        <input type="text" id="cardSecurity" name="cardSecurity" placeholder="xxx">
                    </div>
                </div>
            </div>

            <div id="masterCardForm">
                <div id="formCard" class="masterCardForm">
                    <div>
                        <label for="cardNumber1">Card number</label>
                        <input type="text" id="cardNumber1" name="cardNumber1" placeholder="xxxx xxxx xxxx xxxx">
                    </div>
                    <div>
                        <label for="cardName1">Card name</label>
                        <input type="text" id="cardName1" name="cardName1" placeholder="NAME SURNAME">
                    </div>
                    <div>
                        <label for="cardExpiration1">Card expiration</label>
                        <input type="text" id="cardExpiration1" name="cardExpiration1" placeholder="xx/xx">
                    </div>
                    <div>
                        <label for="cardSecurity1">Security code</label>
                        <input type="text" id="cardSecurity1" name="cardSecurity1" placeholder="xxx">
                    </div>
                </div>
            </div>
            <div id="americanExpressForm">
                <div id="formCard" class="americanExpressForm">
                    <div>
                        <label for="cardNumber2">Card number</label>
                        <input type="text" id="cardNumber2" name="cardNumber2" placeholder="xxxx xxxxxx xxxxx">
                    </div>
                    <div>
                        <label for="cardName2">Card name</label>
                        <input type="text" id="cardName2" name="cardName2" placeholder="NAME SURNAME">
                    </div>
                    <div>
                        <label for="cardExpiration2">Card expiration</label>
                        <input type="text" id="cardExpiration2" name="cardExpiration2" placeholder="xx/xx">
                    </div>
                    <div>
                        <label for="cardSecurity2">Security code</label>
                        <input type="text" id="cardSecurity2" name="cardSecurity2" placeholder="xxx">
                    </div>
                </div>
            </div>


        </div>
    </form>

    <div class="paymentButton">
        <button class="submitbtn" id="submitbtn" type="submit" name="submit" form="formSend">Save payment card</button>
    </div>

    <?php
    if (isset($error)){
        echo '<div class="alert alert-danger" role="alert" style="width: 45%; display: flex; margin-right: auto; margin-left: auto;">'.$error. "</div>";
    }
    ?>
    <?php
    if (isset($success)){
        echo '<div class="alert alert-success" role="alert" style="width: 45%; display: flex; margin-right: auto; margin-left: auto;">'.$success. "</div>";
    }
    ?>
</main>

<?php include("footer.php") ?>

<script type="text/javascript">
    function showForm(){
        if (document.getElementById('visa').checked == true){
            document.getElementById('visaForm').style.display = "grid";
            document.getElementById('masterCardForm').style.display = "none";
            document.getElementById('americanExpressForm').style.display = "none";
            document.getElementById('paypalForm').style.display = "none";
            document.getElementById('myCardForm').style.display = "none";
        }
        else if (document.getElementById('masterCard').checked == true){
            document.getElementById('visaForm').style.display = "none";
            document.getElementById('masterCardForm').style.display = "grid";
            document.getElementById('americanExpressForm').style.display = "none";
            document.getElementById('paypalForm').style.display = "none";
            document.getElementById('myCardForm').style.display = "none";
        }
        else if (document.getElementById('americanExpress').checked == true){
            document.getElementById('visaForm').style.display = "none";
            document.getElementById('masterCardForm').style.display = "none";
            document.getElementById('americanExpressForm').style.display = "grid";
            document.getElementById('paypalForm').style.display = "none";
            document.getElementById('myCardForm').style.display = "none";
        }
    }

</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
