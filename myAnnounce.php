<?php
if (!isset($_SESSION)){
    session_start();
}

$servername = 'localhost';
$username_database = 'root';
$server_password = 'root';

$database = new PDO("mysql:host=$servername; dbname=london_ebay", $username_database, $server_password);

if (isset($_GET['id']) and $_GET['id'] > 0){
    $id_getter = intval($_GET['id']);
    $select_id = $database->prepare('SELECT * FROM users WHERE id = ?');
    $select_id->execute(array($id_getter));
    $result = $select_id->fetch();

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
    </style>
    </head>
    <body>

    <?php include("header.php") ?>

    <main>
        <div align="center">
            <h2 class="title_Welcome">Welcome back <?php echo $result['username'] ?> !</h2>

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
            </div>

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

    <?php
}
?>

