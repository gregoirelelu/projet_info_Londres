<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style type="text/css">
        .main1{
            width: 100%;
            margin-right: auto;
            margin-left: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }
        .m-round{
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .m-rounds .m-round{
            margin-right: 20px;
            margin-top: 20px;
            cursor: pointer;
        }
        .m-round .circle{
            margin: 10px;
            width: 160px;
            height: 160px;
            opacity: 0.8;
            border-radius: 50%;
            text-align: center;
            line-height: 12rem;
        }
        .m-round a{
            color: black;
        }
        .m-round a:hover{
            color: black;
        }
    </style>
</head>
<body>
<section class="main1">
    <h2>Popular on eBay</h2>
    <div class="m-rounds">
        <div class="m-round">
            <div class="circle" style="background: #7bdbdb"><a href="#"><i class="fas fa-tv fa-4x"></i></a></div>
            <div class="circle" style="background: #f67272"><a href="#"><i class="fas fa-tshirt fa-4x"></i></a></div>
            <div class="circle" style="background: #ab0000"><a href="#"><i class="fas fa-football-ball fa-4x"></i></a></div>
            <div class="circle" style="background: #999999"><a href="#"><i class="fas fa-car fa-4x"></i></a></div>
            <div class="circle" style="background: #ffd87a"><a href="#"><i class="fas fa-hammer fa-4x"></i></a></div>
            <div class="circle" style="background: #79d700"><a href="#"><i class="fas fa-palette fa-4x"></i></a></div>
            <div class="circle" style="background: #8e06a7"><a href="#"><i class="fas fa-paw fa-4x"></i></a></div>
        </div>
    </div>
</section>
</body>
</html>