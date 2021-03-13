<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style type="text/css">
        .carousel{
            width: 70%;
            height: 20%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 30px;
            align-items: center;
            z-index: 1;
        }
    </style>
</head>
<body>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="img/macbookpro.jpeg" width="952" height="500" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="img/applewatch1.jpg" width="888" height="500" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="img/iphone121.jpg" width="800" height="500" class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
</body>
</html>
