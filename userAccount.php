<?php
session_start();

$servername = 'localhost';
$username_database = 'root';
$server_password = 'root';

$database = new PDO("mysql:host=$servername; dbname=london_ebay", $username_database, $server_password);

if (isset($_GET['id']) and $_GET['id'] > 0){
    $id_getter = intval($_GET['id']);
    $select_id = $database->prepare('SELECT * FROM users WHERE id = ?');
    $select_id->execute(array($id_getter));
    $result = $select_id->fetch();

    if (isset($_POST['username-edit']) and $_POST['username-edit'] != $result['username'] and !empty($_POST['username-edit'])){
        $newUser = htmlspecialchars($_POST['username-edit']);

        $newUsername = $database->prepare("UPDATE users SET username = ? WHERE id = ?");
        $newUsername->execute(array($newUser, $_SESSION['id']));
        header('Refresh:4; userAccount.php?id='.$_SESSION['id']);
        $success = "Username modified successfully !";
    }
    if (isset($_POST['email-edit']) and $_POST['email-edit'] != $result['email'] and !empty($_POST['email-confirm-edit'])){
        $newEmail = htmlspecialchars($_POST['email-edit']);
        $newEmailConfirm = htmlspecialchars($_POST['email-confirm-edit']);

        if($newEmail == $newEmailConfirm){
            $newEmail1 = $database->prepare("UPDATE users SET email = ? WHERE id = ?");
            $newEmail1->execute(array($newEmail, $_SESSION['id']));
            header('Refresh:4; userAccount.php?id='.$_SESSION['id']);
            $success1 = "E-mail modified successfully !";
        }
        else{
            $error = "E-mails do not match !";
        }
    }
    if (isset($_POST['password-edit']) and !empty($_POST['password-edit'])){
        $passwordChange = ($_POST['password-edit']);
        $passwordChangeConfirm = ($_POST['password-confirm-edit']);

        if (isset($passwordChangeConfirm) and !empty($passwordChangeConfirm)){
            $newpassword = password_hash($_POST['password-edit'], PASSWORD_DEFAULT);

            if ($passwordChange == $passwordChangeConfirm){
                $newpassword1 = $database->prepare("UPDATE users SET password = ? WHERE id = ?");
                $newpassword1->execute(array($newpassword, $_SESSION['id']));
                header('Refresh:4; userAccount.php?id='.$_SESSION['id']);
                $success2 = "Password modified successfully !";
            }
            else{
                $error = "Passwords do not match !";
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
    .edit-title{
        margin-top: 45px;
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
    .profileWithPhoto{
        display: flex;
        justify-content: center;
        position: sticky;
        align-items: center;
    }
    .profile_hidden{
        margin-top: 15px;
    }
    .profilePhoto{
        margin-left: 40px;
    }
</style>
</head>
<body>

<?php include("header.php") ?>

<main>
    <div align="center">
        <h2 class="title_Welcome">Welcome back <?php echo $result['username'] ?> !</h2>
        <div class="navbar">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" id="yourProfile">Your profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                </li>
            </ul>
        </div>

        <div id="profile_hidden" class="profile_hidden">
            <div class="profileWithPhoto">
                <div class="info_profil">
                    <h5>Your informations:</h5>
                    <p>Username: <?php echo $result['username'] ?></p>
                    <p>E-mail: <?php echo $result['email'] ?></p>
                </div>
                <div class="profilePhoto">
                    <p>photo</p>
                </div>
            </div>

            <h5 class="edit-title">Edit profile</h5>
            <form class="edit-profil" method="POST" action="">
                <table>
                    <tr>
                        <td align="right">
                            <label for="username-edit">Username:</label>
                        </td>
                        <td>
                            <input type="text" name="username-edit" value="<?php echo $result['username'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="username-edit">E-mail:</label>
                        </td>
                        <td>
                            <input type="email" name="email-edit" value="<?php echo $result['email'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="username-edit">E-mail:</label>
                        </td>
                        <td>
                            <input type="email" name="email-confirm-edit" value="<?php echo $result['email'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="username-edit">Password:</label>
                        </td>
                        <td>
                            <input type="text" name="password-edit" placeholder="Password"><br>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="username-edit">Password:</label>
                        </td>
                        <td>
                            <input type="text" name="password-confirm-edit" placeholder="Confirm password"><br>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Update">
                        </td>
                    </tr>
                </table>
            </form>
        </div>

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
        <?php
        if (isset($success1)){
            echo '<div class="alert alert-success" role="alert" style="width: 45%">'.$success1. "</div>";
        }
        ?>
        <?php
        if (isset($success2)){
            echo '<div class="alert alert-success" role="alert" style="width: 45%">'.$success2. "</div>";
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

<?php
}
    ?>

