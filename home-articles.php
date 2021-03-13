<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style type="text/css">
        .main{
            width: 70%;
            margin-right: auto;
            margin-left: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
        }
        .m-articles{
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .m-articles .card{
            margin-right: 20px;
            margin-top: 20px;
            cursor: pointer;
        }
        .m-articles .card-body{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .swiper-container {
            width: 70%;
            height: 30%;
        }
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            width: 250px !important;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
        .m-articles p{
            font-size: smaller;
        }
        .card-body a{
            color: black;
            width: 20px;
            height: 10px;
        }
        .card-img-top{
            height: 30%;
        }
    </style>
</head>
<body>
<section class="main">
    <h2>Current Trend</h2>
    <div class="m-articles">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="card" style="width: 18rem; height: 25rem">
                        <img src="img/tele.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Samsung</h5>
                            <h5 class="card-title">-</h5>
                            <h5 class="card-title">1399$</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-body">
                            <a href="#" class="card-link"></a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card" style="width: 18rem; height: 25rem">
                        <img src="img/tele1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">TOSHIBA</h5>
                            <h5 class="card-title">-</h5>
                            <h5 class="card-title">1699$</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-body">
                            <a href="#" class="card-link"></a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card" style="width: 18rem; height: 25rem">
                        <img src="img/tele2.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">LG</h5>
                            <h5 class="card-title">-</h5>
                            <h5 class="card-title">150$</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-body">
                            <a href="#" class="card-link"></a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card" style="width: 18rem;height: 25rem">
                        <img src="img/tele.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">SAMSUNG</h5>
                            <h5 class="card-title">-</h5>
                            <h5 class="card-title">1999$</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-body">
                            <a href="#" class="card-link"></a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card" style="width: 18rem; height: 25rem">
                        <img src="img/tele.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">SAMSUNG</h5>
                            <h5 class="card-title">-</h5>
                            <h5 class="card-title">2299$</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-body">
                            <a href="#" class="card-link"></a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card" style="width: 18rem; height: 25rem">
                        <img src="img/tele.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">LG</h5>
                            <h5 class="card-title">-</h5>
                            <h5 class="card-title">999$</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                        <div class="card-body">
                            <a href="#" class="card-link"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <script type="text/javascript">
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 4,
            spaceBetween: 30,
            freeMode: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
</section>
</body>
</html>