<?php
if (!isset($_SESSION)){
    session_start();
}

$servername = 'localhost';
$username_database = 'root';
$server_password = 'root';

$database = new PDO("mysql:host=$servername; dbname=londonproject_bdd", $username_database, $server_password);

if (isset($_POST['submit']) and !isset($_GET['id'])){

    if (!empty($_POST['name']) and !empty($_POST['surname']) and !empty($_POST['address']) and !empty($_POST['address2']) and !empty($_POST['city']) and !empty($_POST['state']) and !empty($_POST['postal']) and !empty($_POST['telephone'])){
        if (!empty($_POST['terms'])){
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $address = $_POST['address'];
            $address2 = $_POST['address2'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $postal = $_POST['postal'];
            $telephone = $_POST['telephone'];

            $sql = $database->prepare("INSERT INTO payments(name, surname, address, address2, city, state, postal, telephone) VALUES ('$name', '$surname', '$address', '$address2', '$city', '$state', '$postal', '$telephone')");
            $sql->execute(array($name, $surname, $address, $address2, $city, $state, $postal, $telephone));
            header('Refresh:2; payment.php?id='.$_SESSION['id']);
            $success = "Correct informations! Redirect to payment!";
        }
        else{
            $error1 = "You must agree before confirm order!";
        }
    }
    else{
        $error = "All fields must be completed!";
    }
}
if (isset($_POST['submit']) and isset($_GET['id'])){

    if (!empty($_POST['name']) and !empty($_POST['surname']) and !empty($_POST['address']) and !empty($_POST['address2']) and !empty($_POST['city']) and !empty($_POST['state']) and !empty($_POST['postal']) and !empty($_POST['telephone'])){
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $address = $_POST['address'];
        $address2 = $_POST['address2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $postal = $_POST['postal'];
        $telephone = $_POST['telephone'];

        $sql = $database->prepare("INSERT INTO payments(name, surname, address, address2, city, state, postal, telephone) VALUES ('$name', '$surname', '$address', '$address2', '$city', '$state', '$postal', '$telephone')");
        $sql->execute(array($name, $surname, $address, $address2, $city, $state, $postal, $telephone));
        header('Refresh:2; payment.php?id='.$_GET['id']);
        $success = "Correct informations! Redirect to payment!";
    }
    else{
        $error = "All fields must be completed!";
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
        .confirmOrder{
            margin-top: 45px;
            width: 80%;
            margin-left: 100px;
            height: 74vh;
        }
        .paymentbtn{
            color: white;
            text-decoration: none;
        }
        .paymentbtn:hover{
            color: white;
            text-decoration: none;
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

<a class="back" href="bag.php"><i class="fas fa-times fa-2x"></i></a>
<p style=" text-align:center ;  margin-left: 30%; margin-right: 30%; color: #3c3c3c; font-size: 40px; border-style: solid; border-color: #3c3c3c; border-radius: 50px">Confirm order</p>

<main class="confirmOrder">
    <form method="post" class="row g-3 needs-validation" action="" novalidate>
        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="validationCustom01" value="" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-4">
            <label for="validationCustom02" class="form-label">Surname</label>
            <input name="surname" type="text" class="form-control" id="validationCustom02" value="" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-4">
            <label for="validationCustomUsername" class="form-label">City</label>
            <div class="input-group has-validation">
                <input name="city" type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <label for="validationCustomUsername" class="form-label">Address line 1</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-home"></i></span>
                <input name="address" type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <label for="validationCustomUsername" class="form-label">Address line 2</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-home"></i></span>
                <input name="address2" type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <label for="validationCustom04" class="form-label">State</label>
            <select name="state" class="form-select" id="validationCustom04" required>
                <option selected disabled value="">Choose...</option>
                <option>England</option>
                <option>France</option>
                <option>USA</option>
                <option>Germany</option>
                <option>Other</option>
            </select>
            <div class="invalid-feedback">
                Please select a valid state.
            </div>
        </div>
        <div class="col-md-3">
            <label for="validationCustom05" class="form-label">Postal code</label>
            <input name="postal" type="text" class="form-control" id="validationCustom05" required>
            <div class="invalid-feedback">
                Please provide a valid zip.
            </div>
        </div>
        <div class="col-md-3">
            <label for="validationCustom05" class="form-label">Phone's number</label>
            <input name="telephone" type="text" class="form-control" id="validationCustom05" required>
            <div class="invalid-feedback">
                Please provide a valid zip.
            </div>
        </div>
        <div class="col-12">
            <div class="form-check">
                <input name="terms" class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                    Agree to terms and conditions
                </label>
                <div class="invalid-feedback">
                    You must agree before submitting.
                </div>
            </div>
        </div>
        <div class="col-12">
            <button style="background-color: blueviolet; margin-top: 20px" class="btn btn-primary" type="submit" name="submit">Go to the payment</a></button>
        </div>
    </form>
    <?php
    if (isset($error)){
        echo '<div class="alert alert-danger" role="alert" style="width: 45%">'.$error. "</div>";
    }
    ?>
    <?php
    if (isset($error1)){
        echo '<div class="alert alert-danger" role="alert" style="width: 45%">'.$error1. "</div>";
    }
    ?>
    <?php
    if (isset($success)){
        echo '<div class="alert alert-success" role="alert" style="width: 45%">'.$success. "</div>";
    }
    ?>
</main>


<?php include("footer.php") ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
