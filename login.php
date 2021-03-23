<?php
if (!isset($_SESSION)){
    session_start();
}

$servername = 'localhost';
$username_database = 'root';
$server_password = 'root';

$database = new PDO("mysql:host=$servername; dbname=londonproject_bdd", $username_database, $server_password);

if (isset($_POST['submit-form-login'])){
    $email_login = htmlspecialchars($_POST['email-login']);
    $password_login = ($_POST['password-login']);
    $hashedpassword_login = password_hash($password_login, PASSWORD_DEFAULT);

    if (!empty($email_login) and !empty($password_login)){
        $existing_userOrPassword = $database->prepare("SELECT * FROM users WHERE email = :email");
        $existing_userOrPassword->execute(array('email' => $email_login));
        $result = $existing_userOrPassword->fetch();

        if ($result and password_verify($password_login, $result['password'])){
            $_SESSION['id'] = $result['id'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['picture-profile'] = $result['picture'];
            header("Location: userAccount.php?id=".$_SESSION['id']);
        }
        else{
            $error = "Incorrect username or password !";
        }
        $existing_userOrPassword->closeCursor();
    }
    else{
        $error = "All fields must be completed !";
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
    .register a{
        color: black;
    }
    .haveAccount{
        font-size: 12px;
    }
    .register{
        justify-content: center;
    }
</style>
</head>
<body>

<?php include("header.php") ?>

<main>
    <div align="center">
        <h2>Login</h2>
        <form method="POST" class="register" action="">
            <table>
                <tr>
                    <td align="right">
                        <label for="email-login">E-mail:</label>
                    </td>
                    <td>
                        <input type="email" placeholder="E-mail" id="email-login" name="email-login" value="<?php if(isset($email_login)){ echo $email_login;} ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="password-login">Password:</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Password" id="password-login" name="password-login" value="<?php if(isset($password_login)){ echo $password_login;} ?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit-form-login" value="Login"></td>
                </tr>
                <tr>
                    <td class="haveAccount">You don't have an account ?</td>
                    <td><a href="register.php" class="haveAccount">Register now !</a></td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($error)){
            echo '<div class="alert alert-danger" role="alert" style="width: 45%">'.$error. "</div>";
        }
        ?>
    </div>
</main>



<?php include("footer.php") ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>