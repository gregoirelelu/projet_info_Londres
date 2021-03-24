<?php
if (!isset($_SESSION)){
    session_start();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <style type="text/css">
        .header{
            display:flex;
            background-color: #fff;
            flex-wrap:wrap;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 2;
        }
        .float-left{
            float: left;
        }
        .float-right{
            float: right;
        }
        .header h3{
            font-size: 50px;
            padding-left: 20px;
        }
        .header .h-right{
            display: flex;
        }
        .header .h-right p{
            padding: 15px 5px 2px;
            font-size: 20px;
            margin-right: 15px;
        }
        .dropdown button{
            padding: 15px 5px 2px;
            font-size: 20px;

            border: none;
            color: black;
            background-color: #ffffff;
            outline: none !important;
        }
        .dropdown button:hover{
            border: none;
            color: black;
            background-color: #ffffff;
            outline: none;
        }
        .header .h-right input{
            margin-right: 10px;
            background-color: #efefef;
            padding: 5px;
            border: none;
            outline: none;
            border-radius: 30px;
        }
        .header a{
            text-decoration: none;
            color: black;
            transition: all 0.3s ease-in-out;
            border-bottom: 2px solid transparent;
        }
        .header a:hover{
            text-decoration: none;
            padding-top: 3px;
            border-bottom: 2px solid black;
            color: black;
        }
    </style>
</head>
<body>
<nav class="header">
    <div class="float-left">
        <h3><a href="home.php">eBay</a></h3>
    </div>
    <div class="float-right">
        <div class="h-right">
            <p>
            <div class="dropdown">
                <button class="btn btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="HighTech.php">High-Tech</a>
                    <a class="dropdown-item" href="Cars.php">Vehicles</a>
                </div>
            </div>
            </p>
            <p><a href="#">Buying</a></p>
            <p><a href="#">Sell</a></p>
            <p>
            <div class="dropdown">
                <button class="btn btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Admin
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="Admin-products.php">Access to products</a>
                    <a class="dropdown-item" href="Admin-sellers.php">Access to sellers</a>
                </div>
            </div>
            </p>
            <form>
                <input type="search" placeholder="Search">
            </form>
            <p><a href="bag.php"><i class="fas fa-shopping-bag"></i></a></p>
            <p><a href="accountOrLogin.php"><i class="fas fa-user"></i></a></p>
        </div>
    </div>
</nav>
</body>
</html>

