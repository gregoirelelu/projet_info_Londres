<?php require_once('connexion_bdd.php'); ?>
<?php
require 'database-class.php';
require 'bag-class.php';
$db = new database();
$bag = new bag($db);
?>

<?php
if (!isset($_SESSION)){
    session_start();
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
        .bag{
            margin: 60px auto;
            width: 75%;
        }
        .bag table{
            width: 100%;
            border-collapse: collapse;
        }
        .product{
            display: flex;
            flex-wrap: wrap;
        }
        .bag th{
            padding: 7px;
            text-align: left;
            color: #ffffff;
            background-color: blueviolet;
        }
        .bag td{
            padding: 10px 5px;
        }
        .bag input{
            padding: 7px;
            width: 60px;
            height: 40px;
        }
        .bag a{
            text-decoration: none;
            color: black;
        }
        .bag a:hover{
            text-decoration: none;
            color: black;
        }
        .bag img{
            margin-right: 12px;
            width: 160px;
            height: 160px;
        }
        .total{
            display: flex;
            justify-content: flex-end;
        }
        .total table{
            border-top: 3px solid blueviolet;
            width: 100%;
            max-width: 310px;
        }
        th:last-child{
            text-align: right;
        }
        td:last-child{
            text-align: right;
        }
    </style>
</head>
<body>
<?php include("header.php") ?>

<main>
    <form method="POST" action="bag.php">
        <div class="bag">
            <p style=" text-align:center ;  margin-left: 30%; margin-right: 30%; color: #3c3c3c; font-size: 40px; border-style: solid; border-color: #3c3c3c; border-radius: 50px">Your Cart</p>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Remove</th>
                    <th>Subtotal (excl. taxes)</th>
                </tr>

                <?php
                $ids = array_keys($_SESSION['bag']);

                if (!empty($ids)){
                    $products = $db->request('SELECT * FROM hightech WHERE id IN ('.implode(',', $ids).')');
                }
                else{
                    $products = array();
                }

                foreach ($products as $products):
                    ?>

                    <tr>
                        <td>
                            <div class="product">
                                <a href="#" class=""><img src="<?php echo $products->PICTURE ?>"></a>
                                <div style="margin-top: 4%">
                                    <span class="category"><?= $products->CATEGORY ?></span><br>
                                    <span class="brand"><?= $products->BRAND ?></span><br>
                                    <span class="model"><?= $products->MODEL ?></span><br>
                                    <small><span class="price"><?= $products->PRICE ?>$</span></small><br>
                                </div>
                            </div>
                        </td>
                        <td><input type="number" name="bag[quantity][<?= $products->id; ?>]" value="<?= $_SESSION['bag'][$products->id]; ?>" style="margin-left: 3vh" onchange="this.form.submit()"></td>
                        <td><span class="action"><a href="bag.php?delBag=<?= $products->id; ?>" class="delete" style="margin-left: 3vh"><i class="far fa-trash-alt"></i></a></span></td>
                        <td><?= $products->PRICE ?>$</td>
                    </tr>
                <?php endforeach; ?>
            </table>
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
                    <tr>
                        <td>Total (incl. taxes)</td>
                        <td><span><?= number_format($bag->total() * 1.2, 2, ',',''); ?>$</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>

</main>

<?php include("footer.php") ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
