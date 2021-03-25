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
            header("Location: confirmOrder.php?id=".$_SESSION['id']);
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

if(isset($_POST['submit-form'])){
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $confirm_email = htmlspecialchars($_POST['confirm-email']);
    $password = ($_POST['password']);
    $confirm_password = ($_POST['confirm-password']);

    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    if (!empty($_POST['username']) and !empty($_POST['email']) and !empty($_POST['confirm-email']) and !empty($_POST['password']) and !empty($_POST['confirm-password'])){

        if(!empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['confirm-password'])AND !empty($_POST['email'])){
            $usernamelenght = strlen($username);

            if ($usernamelenght <= 255){
                $emaillenght = strlen($email);

                if ($emaillenght <= 255){
                    $confirm_emaillenght = strlen($confirm_email);

                    if ($confirm_emaillenght <= 255){

                        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $existing_username = $database->prepare("SELECT * FROM users WHERE username = ?");
                            $existing_username->execute(array($username));
                            $username_rowCount = $existing_username->rowCount();

                            if ($username_rowCount == 0){
                                $existing_mail = $database->prepare("SELECT * FROM users WHERE email = ?");
                                $existing_mail->execute(array($email));
                                $mail_rowCount = $existing_mail->rowCount();

                                if ($mail_rowCount == 0){

                                    if ($email == $confirm_email){

                                        if ($password == $confirm_password){
                                            $type = "user";
                                            $add_user = $database->prepare("INSERT INTO users(username, email, password, type) VALUES('$username', '$email', '$hashedpassword', '$type')");
                                            $add_user->execute(array($username, $email, $hashedpassword, $type));
                                            header('Refresh:3; validateBag.php');
                                            $success = "Account created successfully ! <a href= \"validateBag.php\" style='color: #155724'>Login</a>";
                                        }
                                        else{
                                            $error = "Passwords do not match !";
                                        }
                                    }
                                    else{
                                        $error ="E-mails do not match !";
                                    }
                                }
                                else{
                                    $error = "Already existing e-mail !";
                                }
                            }
                            else{
                                $error = "Already existing username !";
                            }
                        }
                        else{
                            $error = "E-mail is not valid !";
                        }
                    }
                    else{
                        $error = "Username must have a maximum of 255 characters !";
                    }
                }
                else{
                    $error = "Username must have a maximum of 255 characters !";
                }
            }
            else{
                $error = "Username must have a maximum of 255 characters !";
            }
        }


    }
    else{
        $error = "All fields must be completed !";
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
            height: 39.5vh;
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
        <h2>Please login</h2>
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

<main>
    <div align="center">
        <h2>Or register</h2>
        <form method="POST" class="register" action="">
            <table>
                <tr>
                    <td align="right">
                        <label for="username">Username:</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Username" id="username" name="username" value="<?php if(isset($username)){ echo $username;} ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="email">E-mail:</label>
                    </td>
                    <td>
                        <input type="email" placeholder="E-mail" id="email" name="email" value="<?php if(isset($email)){ echo $email;} ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="confirm-email">Confirm e-mail:</label>
                    </td>
                    <td>
                        <input type="email" placeholder="Confirm e-mail" id="confirm-email" name="confirm-email" value="<?php if(isset($confirm_email)){ echo $confirm_email;} ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="password">Password:</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Password" id="password" name="password">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="confirm-password">Confirm password:</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Confirm password" id="confirm-password" name="confirm-password">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit-form" value="Register"></td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($error)){
            echo '<div class="alert alert-danger" role="alert" style="width: 45%">'.$error. "</div>";
        }
        ?>
        <?php
        if (isset($success)){
            echo '<div class="alert alert-success" role="alert" style="width: 45%">'.$success. "</div>";
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

