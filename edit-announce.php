<?php
if (!isset($_GET)){
    session_start();
}

$servername = 'localhost';
$username_database = 'root';
$server_password = 'root';

$database = new PDO("mysql:host=$servername; dbname=londonproject_bdd", $username_database, $server_password);

if (isset($_GET['id']) and !empty($_GET['id'])) {
    $editArticle = htmlspecialchars($_GET['id']);
    $sql = $database->prepare('SELECT * FROM product WHERE id = ?');
    $sql->execute(array($editArticle));
    $sql = $sql->fetch();

    if (isset($_POST['subcategory-edit']) and $_POST['subcategory-edit'] != $sql['SUBCATEGORY'] and !empty($_POST['subcategory-edit'])) {
        $newSubCate = htmlspecialchars($_POST['subcategory-edit']);

        $newSubCategory = $database->prepare("UPDATE product SET SUBCATEGORY = ? WHERE id = ?");
        $newSubCategory->execute(array($newSubCate, $_GET['id']));
        header('Refresh:4; edit-announce.php?id=' . $_GET['id']);
        $success = "Sub-category modified successfully !";
    }
    if (isset($_POST['brand-edit']) and $_POST['brand-edit'] != $sql['BRAND'] and !empty($_POST['brand-edit'])) {
        $newbr = htmlspecialchars($_POST['subcategory-edit']);

        $newbrand = $database->prepare("UPDATE product SET BRAND = ? WHERE id = ?");
        $newbrand->execute(array($newbr, $_GET['id']));
        header('Refresh:4; edit-announce.php?id=' . $_GET['id']);
        $success1 = "Brand modified successfully !";
    }
    if (isset($_POST['model-edit']) and $_POST['model-edit'] != $sql['MODEL'] and !empty($_POST['model-edit'])) {
        $newmo = htmlspecialchars($_POST['model-edit']);

        $newmodel = $database->prepare("UPDATE product SET MODEL = ? WHERE id = ?");
        $newmodel->execute(array($newmo, $_GET['id']));
        header('Refresh:4; edit-announce.php?id=' . $_GET['id']);
        $success2 = "Model modified successfully !";
    }
    if (isset($_POST['price-edit']) and $_POST['price-edit'] != $sql['PRICE'] and !empty($_POST['price-edit'])) {
        $newpri = htmlspecialchars($_POST['price-edit']);

        $newprice = $database->prepare("UPDATE product SET PRICE = ? WHERE id = ?");
        $newprice->execute(array($newpri, $_GET['id']));
        header('Refresh:4; edit-announce.php?id=' . $_GET['id']);
        $success3 = "Price modified successfully !";
    }
    if (isset($_POST['delete-btn'])){
        $sqlDelete = $database->prepare("DELETE FROM product WHERE id = ?");
        $sqlDelete->execute(array($editArticle));
        header("Location: myannounces.php");
    }
    if (isset($_FILES['picture']) and !empty($_FILES['picture']['name'])) {
        $picturePath = "img/".$_FILES['picture']['name'];
        move_uploaded_file($_FILES['picture']['tmp_name'], $picturePath);

        $newpic = $database->prepare("UPDATE product SET PICTURE = ? WHERE id = ?");
        $newpic->execute(array($picturePath, $_GET['id']));
        header('Refresh:4; edit-announce.php?id=' . $_GET['id']);
        $success4 = "First picture modified successfully !";
    }
    if (isset($_FILES['picture2']) and !empty($_FILES['picture2']['name'])) {
        $picturePath2 = "img/".$_FILES['picture2']['name'];
        move_uploaded_file($_FILES['picture2']['tmp_name'], $picturePath2);

        $newpic2 = $database->prepare("UPDATE product SET PICTURE2 = ? WHERE id = ?");
        $newpic2->execute(array($picturePath2, $_GET['id']));
        header('Refresh:4; edit-announce.php?id=' . $_GET['id']);
        $success4 = "Second picture modified successfully !";
    }
    if (isset($_FILES['picture3'])) {
        if (!empty($_FILES['picture3']['name'])) {
            $picturePath3 = "img/" . $_FILES['picture3']['name'];
            move_uploaded_file($_FILES['picture3']['tmp_name'], $picturePath3);

            $newpic3 = $database->prepare("UPDATE product SET PICTURE3 = ? WHERE id = ?");
            $newpic3->execute(array($picturePath3, $_GET['id']));
            header('Refresh:4; edit-announce.php?id=' . $_GET['id']);
            $success4 = "Third picture modified successfully !";
        }
        else{
            echo '2';
        }
    }
    else{
        echo '1';
        var_dump(isset($_FILES['picture']));
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
    <link rel="stylesheet" href="css/category.css" />
    <style type="text/css">
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
        main1{
            display: flex;
            justify-content: center;
            padding-bottom: 15vh;
        }
        .profile_hidden{
            margin-top: 15px;
        }
        .edit-profil{
            justify-content: center;
        }
    </style>
    </style>
</head>
<body>
<?php include("header.php") ?>

<main>
    <div align="center">
        <h2 class="title_Welcome">Edit your announces!</h2>
        <div class="navbar">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="returnToMyProfile.php" aria-current="page" id="yourProfile">Your profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="myannounces.php">My announces</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                </li>
            </ul>
        </div>
    </div>
</main>

<?php

if (isset($_GET['id']) and !empty($_GET['id'])){
    $editArticle = htmlspecialchars($_GET['id']);
    $sql = $database->prepare('SELECT * FROM product WHERE id = ?');
    $sql->execute(array($editArticle));
    $sql = $sql->fetch();

    ?>

<section class="show-product">
    <div id="layout">
        <div id="hightech">
            <div><img id="img1" src="<?php echo $sql['PICTURE']?>" onclick="myFunction(this)"></div>
            <div style="margin-bottom: 10px">
                <img style="width: 20%" src="<?php echo $sql['PICTURE']?>" onclick="myFunction(this)">

                <?php if ($sql['PICTURE2'] != NULL){ ?>

                    <img style="width: 20%" src="<?php echo $sql['PICTURE2']?>" onclick="myFunction(this)">

                    <?php if ($sql['PICTURE3'] != NULL){ ?>
                        <img style="width: 20%" src="<?php echo $sql['PICTURE3']?>" onclick="myFunction(this)">

                        <?php if ($sql['VIDEO'] != NULL){ ?>
                            <iframe style="width: 100%; height: 40%" src="<?php echo $sql['VIDEO']?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
            <h5><?php echo $sql['SUBCATEGORY']; ?></h5>
            <?php echo $sql['BRAND']; ?> <br/>
            <?php echo $sql['MODEL']; ?> <br/>
            <?php echo $sql['PRICE'] ." $"; ?>
        </div>
    </div>
</section>

<?php } ?>

<div style="display: flex; justify-content: center">
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
    <?php
    if (isset($success3)){
        echo '<div class="alert alert-success" role="alert" style="width: 45%">'.$success3. "</div>";
    }
    ?>
    <?php
    if (isset($success4)){
        echo '<div class="alert alert-success" role="alert" style="width: 45%">'.$success3. "</div>";
    }
    ?>
    <?php
    if (isset($success5)){
        echo '<div class="alert alert-success" role="alert" style="width: 45%">'.$success3. "</div>";
    }
    ?>
    <?php
    if (isset($success6)){
        echo '<div class="alert alert-success" role="alert" style="width: 45%">'.$success3. "</div>";
    }
    ?>
    <?php
    if (isset($success7)){
        echo '<div class="alert alert-success" role="alert" style="width: 45%">'.$success3. "</div>";
    }
    ?>
</div>

<main1>
    <div id="profile_hidden" class="profile_hidden">
        <form class="edit-profil" method="POST" action="">
            <table>
                <tr>
                    <td align="right">
                        <label for="subcategory-edit">Sub-category:</label>
                    </td>
                    <td>
                        <input type="text" name="subcategory-edit" value="<?php echo $sql['SUBCATEGORY'] ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="brand-edit">Brand:</label>
                    </td>
                    <td>
                        <input type="text" name="brand-edit" value="<?php echo $sql['BRAND'] ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="model-edit">Model:</label>
                    </td>
                    <td>
                        <input type="text" name="model-edit" value="<?php echo $sql['MODEL'] ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="price-edit">Price:</label>
                    </td>
                    <td>
                        <input type="text" name="price-edit" value="<?php echo $sql['PRICE'] ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="Picture">Picture:</label>
                    </td>
                    <td>
                        <input type="file" id="picture" name="picture" class="picture" accept="image/heic, image/png, image/jpeg">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="Picture2">Second picture (optional):</label>
                    </td>
                    <td>
                        <input type="file" id="picture2" name="picture2" class="picture2" accept="image/heic, image/png, image/jpeg">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="Picture3">Third picture (optional):</label>
                    </td>
                    <td>
                        <input type="file" id="picture3" name="picture3" class="picture3" accept="image/heic, image/png, image/jpeg">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="video">Video (only url):</label>
                    </td>
                    <td>
                        <input type="text" placeholder="<?php echo $sql['VIDEO'] ?>" id="video" name="video" aria-placeholder="<?php echo $sql['VIDEO'] ?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input style="background-color: blueviolet; color: #ffffff" type="submit" value="Update">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input name="delete-btn" style="background-color: red; color: #ffffff" type="submit" value="Delete"></td>
                </tr>
            </table>
        </form>
    </div>
</main1>

<?php include("footer.php") ?>

<script>
    function myFunction(smallImg){
        var fullImg = document.getElementById("img1");
        fullImg.src = smallImg.src;
    }
</script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
