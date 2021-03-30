<?php
if (!isset($_SESSION)){
    session_start();
}
require 'database-class.php';
require 'bag-class.php';
$db = new database();
$bag = new bag($db);

$header="MIME-Version: 1.0\r\n";
$header.='From:"Pierre&Greg_Ebay.com"<support@Pierre&Greg_Ebay.com>'."\n";
$header.='Content-Type:text/html; charset="utf-8"'."\n";
$header.='Content-Transfer-Encoding: 8bit';

$message = '
<html>
<body>
    <div align="center">
        Thank you for your trust!
    </div>
</body>
</html>
';

$servername = 'localhost';
$username_database = 'root';
$server_password = 'root';

$database = new PDO("mysql:host=$servername; dbname=londonproject_bdd", $username_database, $server_password);

$select_id = $database->prepare('SELECT * FROM users WHERE id = ?');
$select_id->execute(array($_SESSION['id']));
$result = $select_id->fetch();
$ids = array_keys($_SESSION['bag']);
$products = $db->request('SELECT * FROM product WHERE id IN ('.implode(',', $ids).')');

if (isset($_POST['submit'])){

    if (isset($_POST['paymentType']) and !empty($_POST['cardNumber']) and !empty($_POST['cardName']) and !empty($_POST['cardExpiration']) and !empty($_POST['cardSecurity'])){
        $cardType = $_POST['paymentType'];
        $paypalEmail = $_POST['paypalEmail'];
        $paypalPassword = $_POST['paypalPassword'];

        if (strcmp($cardType, "Visa") == 0){
            $cardNumber = $_POST['cardNumber'];
            $cardName = $_POST['cardName'];
            $cardExpiration = $_POST['cardExpiration'];
            $cardSecurity = $_POST['cardSecurity'];
            $sql = $database->prepare("UPDATE users SET cardType = ?, cardNumber = ?, cardName = ?, cardExpiration = ?, cardSecurity = ? WHERE id = ?");
            $sql->execute(array($cardType, $cardNumber, $cardName, $cardExpiration, $cardSecurity, $_SESSION['id']));
            $success = "Order successfully completed!";
            mail($_SESSION['email'], "Confirmation order", $message, $header);

            for ($i = 0; $i < sizeof($ids); $i++){
                $deleteProduct = $database->prepare("DELETE FROM product WHERE id = ?");
                $deleteProduct->execute(array($ids[$i]));
                $bag->delete($ids[$i]);
            }
        }
        else if (strcmp($cardType, "MasterCard") == 0){
            $cardNumber1 = $_POST['cardNumber1'];
            $cardName1 = $_POST['cardName1'];
            $cardExpiration1 = $_POST['cardExpiration1'];
            $cardSecurity1 = $_POST['cardSecurity1'];
            $sql = $database->prepare("UPDATE users SET cardType = ?, cardNumber = ?, cardName = ?, cardExpiration = ?, cardSecurity = ? WHERE id = ?");
            $sql->execute(array($cardType, $cardNumber1, $cardName1, $cardExpiration1, $cardSecurity1, $_SESSION['id']));
            $success = "Order successfully completed!";

            for ($i = 0; $i < sizeof($ids); $i++){
                $deleteProduct = $database->prepare("DELETE FROM product WHERE id = ?");
                $deleteProduct->execute(array($ids[$i]));
                $bag->delete($ids[$i]);
            }
        }
        else if (strcmp($cardType, "American Express") == 0){
            $cardNumber2 = $_POST['cardNumber2'];
            $cardName2 = $_POST['cardName2'];
            $cardExpiration2 = $_POST['cardExpiration2'];
            $cardSecurity2 = $_POST['cardSecurity2'];
            $sql = $database->prepare("UPDATE users SET cardType = ?, cardNumber = ?, cardName = ?, cardExpiration = ?, cardSecurity = ? WHERE id = ?");
            $sql->execute(array($cardType, $cardNumber2, $cardName2, $cardExpiration2, $cardSecurity2, $_SESSION['id']));
            $success = "Order successfully completed!";

            for ($i = 0; $i < sizeof($ids); $i++){
                $deleteProduct = $database->prepare("DELETE FROM product WHERE id = ?");
                $deleteProduct->execute(array($ids[$i]));
                $bag->delete($ids[$i]);
            }
        }
        else if (strcmp($cardType, "PayPal") == 0){
            $existing_userOrPassword = $database->prepare("SELECT * FROM users WHERE email = :email");
            $existing_userOrPassword->execute(array('email' => $paypalEmail));
            $result = $existing_userOrPassword->fetch();

            if ($result and password_verify($paypalPassword, $result['password'])){
                $success = "Order successfully completed!";

                for ($i = 0; $i < sizeof($ids); $i++){
                    $deleteProduct = $database->prepare("DELETE FROM product WHERE id = ?");
                    $deleteProduct->execute(array($ids[$i]));
                    $bag->delete($ids[$i]);
                }
            }
        }
        else if (strcmp($cardType, "myCard") == 0){
            $cardNumber3 = $_POST['cardNumber3'];
            $cardName3 = $_POST['cardName3'];
            $cardExpiration3 = $_POST['cardExpiration3'];
            $cardSecurity3 = $_POST['cardSecurity3'];

            if (strcmp($cardType, $select_id['cardType']) and strcmp($cardNumber3, $select_id['cardNumber']) and strcmp($cardName3, $select_id['cardName']) and strcmp($cardExpiration3, $select_id['cardExpiration']) and strcmp($cardSecurity3, $select_id['cardSecurity'])){
                $success = "Order successfully completed!";
                for ($i = 0; $i < sizeof($ids); $i++){
                    $deleteProduct = $database->prepare("DELETE FROM product WHERE id = ?");
                    $deleteProduct->execute(array($ids[$i]));
                    $bag->delete($ids[$i]);
                }
            }
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
        .total{
            border: 2px solid blueviolet;
            display: flex;
            justify-content: center;
            width: 23%;
            margin: 80px auto;
        }
        .back{
            color: black;
            margin-left: 20px;
        }
        .back:hover{
            color: black;
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
    <a class="back" href="bag.php"><i class="fas fa-times fa-2x"></i></a>
    <p style=" text-align:center ; margin-top: 30px; margin-left: 30%; margin-right: 30%; color: #3c3c3c; font-size: 40px; border-style: solid; border-color: #3c3c3c; border-radius: 50px">Confirm order</p>

    <form method="post" action="" class="formSend" id="formSend">
        <div id="form" class="form">
            <input type="radio" id="visa" name="paymentType" value="Visa" checked onclick="showForm()">
            <label for="visa"><img src="img/visa1.png"></label>
            <input type="radio" id="masterCard" name="paymentType" value="MasterCard" onclick="showForm()">
            <label for="masterCard"><img src="img/mastercard.png"></label>
            <input type="radio" id="americanExpress" name="paymentType" value="American Express" onclick="showForm()">
            <label for="americanExpress"><img style="width: 105px; height: auto" src="img/americanexpress.png"></label>
            <input type="radio" id="paypal" name="paymentType" value="PayPal" onclick="showForm()">
            <label for="paypal"><img style="width: 65px; height: auto" src="img/paypal.png"></label>
            <input type="radio" id="myCard" name="paymentType" value="myCard" onclick="showForm()">
            <label for="myCard"><img style="width: 65px; height: auto" src="img/mycard.png"></label>
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
            <div id="paypalForm">
                <div id="formCard" class="paypalForm">
                    <div>
                        <label for="paypalEmail">E-mail</label>
                        <input type="text" id="paypalEmail" name="paypalEmail" placeholder="exemple@gmail.com">
                    </div>
                    <div>
                        <label for="paypalPassword">Password</label>
                        <input type="password" id="paypalPassword" name="paypalPassword" placeholder="********">
                    </div>
                </div>
            </div>
            <div id="myCardForm">
                <div id="formCard" class="myCardForm">
                    <div>
                        <label for="cardNumber3">Card number</label>
                        <input type="text" id="cardNumber3" name="cardNumber3" value="<?php echo $result['cardNumber'] ?>">
                    </div>
                    <div>
                        <label for="cardName3">Card name</label>
                        <input type="text" id="cardName3" name="cardName3" value="<?php echo $result['cardName'] ?>">
                    </div>
                    <div>
                        <label for="cardExpiration3">Card expiration</label>
                        <input type="text" id="cardExpiration3" name="cardExpiration3" value="<?php echo $result['cardExpiration'] ?>">
                    </div>
                    <div>
                        <label for="cardSecurity3">Security code</label>
                        <input type="text" id="cardSecurity3" name="cardSecurity3" value="<?php echo $result['cardSecurity'] ?>">
                    </div>
                </div>
            </div>
        </div>
    </form>


    <?php
    if (isset($error)){
        echo '<div class="alert alert-danger" role="alert" style="width: 45%; display: flex; margin-right: auto; margin-left: auto;">'.$error. "</div>";
    }
    ?>
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
    <div class="paymentButton">
        <button class="submitbtn" id="submitbtn" type="submit" name="submit" form="formSend">Validate payment</button>
    </div>
    <br><br>
    <?php
    if (isset($success)){
        echo '<div class="alert alert-success" role="alert" style="width: 45%; display: flex; margin-right: auto; margin-left: auto">'.$success. "</div>";
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
        else if (document.getElementById('paypal').checked == true){
            document.getElementById('visaForm').style.display = "none";
            document.getElementById('masterCardForm').style.display = "none";
            document.getElementById('americanExpressForm').style.display = "none";
            document.getElementById('paypalForm').style.display = "grid";
            document.getElementById('myCardForm').style.display = "none";
        }
        else if (document.getElementById('myCard').checked == true){
            document.getElementById('visaForm').style.display = "none";
            document.getElementById('masterCardForm').style.display = "none";
            document.getElementById('americanExpressForm').style.display = "none";
            document.getElementById('paypalForm').style.display = "none";
            document.getElementById('myCardForm').style.display = "grid";
        }
    }

</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
