<?php
if (!isset($_SESSION)){
    session_start();
}

$servername = 'localhost';
$username_database = 'root';
$server_password = '';

$database = new PDO("mysql:host=$servername; dbname=londonproject_bdd", $username_database, $server_password);

if (isset($_POST['submit-form-sell'])){
    $category = $_POST['category'];
    $subcategory = htmlspecialchars($_POST['subcategory']);
    $brand = htmlspecialchars($_POST['brand']);
    $model = htmlspecialchars($_POST['model']);
    $price = htmlspecialchars($_POST['price']);

    if (!empty($_POST['category']) and !empty($_POST['subcategory']) and !empty($_POST['brand']) and !empty($_POST['model']) and !empty($_POST['price'])){

        if ($subcategory <= 50){

            if ($brand <= 50){

                if ($model <= 50){

                    if (isset($_FILES['picture']) and !empty($_FILES['picture']['name'])){
                        $maxSize = 5000000;
                        $extensions = array('jpg', 'jpeg', 'png', 'heic');

                        if ($_FILES['picture']['size'] <= $maxSize){

                            $picturePath = "img/".$_FILES['picture']['name'];
                            move_uploaded_file($_FILES['picture']['tmp_name'], $picturePath);

                            $pseudo_seller = $_SESSION['id'];

                            $sql = $database->prepare("INSERT INTO product(CATEGORY, SUBCATEGORY, BRAND, MODEL, PRICE, PICTURE, pseudo_seller) VALUES('$category', '$subcategory', '$brand', '$model', '$price', '$picturePath', '$pseudo_seller')");
                            $sql->execute(array($category, $subcategory, $brand, $model, $price, $picturePath));
                            $success = "Your announce has been uploaded successfully!";
                        }
                        else{
                            $error = "Photo is too heavy! (Max 5Mo)";
                        }
                    }
                }
                else{
                    $error = "Model must have a maximum of 50 characters !";
                }
            }
            else{
                $error = "Brand must have a maximum of 50 characters !";
            }
        }
        else{
            $error = "Sub-category must have a maximum of 50 characters !";
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
        .sellForm a{
            color: black;
        }
        .sellForm{
            justify-content: center;
        }
    </style>
</head>
<body>
<?php include("header.php") ?>

<p style=" text-align:center ; margin-top: 45px; margin-left: 30%; margin-right: 30%; color: #3c3c3c; font-size: 40px; border-style: solid; border-color: #3c3c3c; border-radius: 50px">Sell your products!</p>
<div class="sellmain" align="center">
    <form method="POST" class="sellForm" action="" enctype="multipart/form-data">
        <table>
            <tr>
                <td align="right">
                    <label for="category">Category:</label>
                </td>
                <td>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="category">
                        <option value="High-Tech">High-Tech</option>
                        <option value="Vehicle">Vehicle</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="subcategory">Sub-category:</label>
                </td>
                <td>
                    <input type="text" placeholder="Sub-category" id="subcategory" name="subcategory" aria-placeholder="Sub-category">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="brand">Brand:</label>
                </td>
                <td>
                    <input type="text" placeholder="Brand" id="brand" name="brand" aria-placeholder="Brand">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="model">Model:</label>
                </td>
                <td>
                    <input type="text" placeholder="Model" id="model" name="model" aria-placeholder="Model">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="price">Price:</label>
                </td>
                <td>
                    <input type="text" placeholder="Price" id="price" name="price" aria-placeholder="Price">
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
                <td></td>
                <td><input type="submit" name="submit-form-sell" value="Upload"></td>
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

<?php include("footer.php") ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

