<?php

$servername = 'localhost';
$username_database = 'root';
$server_password = '';

$database = new PDO("mysql:host=$servername; dbname=londonproject_bdd", $username_database, $server_password);

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
                                            $add_user = $database->prepare("INSERT INTO users(username, email, password) VALUES('$username', '$email', '$hashedpassword')");
                                            $add_user->execute(array($username, $email, $hashedpassword));
                                            header('Refresh:4; login.php');
                                            $success = "Account created successfully ! <a href= \"login.php\" style='color: #155724'>Login</a>";
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
    </style>
</head>
<body>

<?php include("header.php") ?>

<main>
    <div align="center">
        <h2>Register</h2>
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