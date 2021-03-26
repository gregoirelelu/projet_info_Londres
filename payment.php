<?php
if (!isset($_SESSION)){
    session_start();
}
require 'database-class.php';
require 'bag-class.php';
$db = new database();
$bag = new bag($db);
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
            height: 78vh;
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
        .form img{
            width: 80px;
            height: auto;
        }
        #visaForm #cardNumber{
            width: 250px;
        }
        .total{
            border: 2px solid blueviolet;
            display: flex;
            justify-content: center;
            margin-top: 80px;
            width: 23%;
            margin-left: auto;
            margin-right: auto;
        }
        .back{
            color: black;
            margin-left: 20px;
        }
        .back:hover{
            color: black;
        }
    </style>
</head>
<body>

<?php include("header.php") ?>

<main>
    <a class="back" href="bag.php"><i class="fas fa-times fa-2x"></i></a>
    <p style=" text-align:center ; margin-top: 30px; margin-left: 30%; margin-right: 30%; color: #3c3c3c; font-size: 40px; border-style: solid; border-color: #3c3c3c; border-radius: 50px">Confirm order</p>
    <div class="form">
        <input type="radio" id="visa" name="paymentType" value="Visa" checked onclick="showForm()">
        <label for="visa"><img src="img/visa1.png"></label>
        <input type="radio" id="masterCard" name="paymentType" value="MasterCard" onclick="showForm()">
        <label for="masterCard"><img src="img/mastercard.png"></label>
        <input type="radio" id="americanExpress" name="paymentType" value="American Express" onclick="showForm()">
        <label for="americanExpress"><img style="width: 105px; height: auto" src="img/americanexpress.png"></label>
        <input type="radio" id="paypal" name="paymentType" value="PayPal" onclick="showForm()">
        <label for="paypal"><img style="width: 65px; height: auto" src="img/paypal.png"></label>
    </div>

    <div class="form1">
        <div id="visaForm">
            <form class="visaForm">
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
            </form>
        </div>
        <div id="masterCardForm">
            <form class="masterCardForm">
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
            </form>
        </div>
        <div id="americanExpressForm">
            <form  class="americanExpressForm">
                <div>
                    <label for="cardNumber">Card number</label>
                    <input type="text" id="cardNumber" name="cardNumber" placeholder="xxxx xxxxxx xxxxx">
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
            </form>
        </div>
        <div id="paypalForm">
            <form class="paypalForm">
                <div>
                    <label for="paypalEmail">E-mail</label>
                    <input type="text" id="paypalEmail" name="paypalEmail" placeholder="exemple@gmail.com">
                </div>
                <div>
                    <label for="paypalPassword">Password</label>
                    <input type="password" id="paypalPassword" name="paypalPassword" placeholder="********">
                </div>
            </form>
        </div>
    </div>
    <div class="total">
        <table>
            <tr>
                <td>Articles</td>
                <td><?= $bag->countProducts(); ?></td>
            </tr>
            <tr>
                <td>Subtotal (excl. taxes)</td>
                <td><span><?= number_format($bag->total(), 2, ',',''); ?>$</span></td>
            </tr>
            <tr>
                <td>VAT</td>
                <td><?= number_format(($bag->total() * 1.2) - ($bag->total()), 2, ',',''); ?>$</td>
            </tr>
            <tr style="background-color: blueviolet; color: #ffffff; width: 100%">
                <td>Total (incl. taxes)</td>
                <td><span><?= number_format($bag->total() * 1.2, 2, ',',''); ?>$</span></td>
            </tr>
        </table>
    </div>
</main>

<?php include("footer.php") ?>

<script type="text/javascript">
    function showForm(){
        if (document.getElementById('visa').checked == true){
            document.getElementById('visaForm').style.display = "flex";
            document.getElementById('masterCardForm').style.display = "none";
            document.getElementById('americanExpressForm').style.display = "none";
            document.getElementById('paypalForm').style.display = "none";
        }
        else if (document.getElementById('masterCard').checked == true){
            document.getElementById('visaForm').style.display = "none";
            document.getElementById('masterCardForm').style.display = "flex";
            document.getElementById('americanExpressForm').style.display = "none";
            document.getElementById('paypalForm').style.display = "none";
        }
        else if (document.getElementById('americanExpress').checked == true){
            document.getElementById('visaForm').style.display = "none";
            document.getElementById('masterCardForm').style.display = "none";
            document.getElementById('americanExpressForm').style.display = "flex";
            document.getElementById('paypalForm').style.display = "none";
        }
        else if (document.getElementById('paypal').checked == true){
            document.getElementById('visaForm').style.display = "none";
            document.getElementById('masterCardForm').style.display = "none";
            document.getElementById('americanExpressForm').style.display = "none";
            document.getElementById('paypalForm').style.display = "flex";
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
