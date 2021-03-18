<?php
/**
 * Created by PhpStorm.
 * User: garae
 * Date: 28.04.2019
 * Time: 16:27
 */
session_start();
require_once "scripts/database_connection.php";
require_once "scripts/sumCart.php";


?>

<!DOCTYPE html>
<html lang="ru" class="no-js">
<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8"/>
    <title>Продукты</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link href="http://fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet" type="text/css">
    <link href="vendor/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- -->
    <link href="css/animate.css" rel="stylesheet">
    <link href="vendor/swiper/css/swiper.min.css" rel="stylesheet" type="text/css"/>
    <!-- -->
    <link href="css/layout.min.css" rel="stylesheet" type="text/css"/>
    <!--  -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<style>
    .category_bar {
        display: flex;
        background: gray;
        padding: 15px;
        justify-content: space-around;
    }


    .category_bar a {
        text-align: center;
        width: 100%;
        height: 100%;
        color: white;
    }
</style>

<!-- основа -->
<body>
<header class="header navbar-fixed-top">
    <!-- Navbar -->
    <nav class="navbar" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="menu-container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="toggle-icon"></span>
                </button>


            </div>


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse nav-collapse">
                <div class="menu-container">
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item"><a class="nav-item-child nav-item-hover active" href="index.php">Главное
                                окно</a></li>
                        <li class="nav-item"><a class="nav-item-child nav-item-hover" href="products.php">Продукты</a>
                        </li>
                        <?php
                        if (!isset($_SESSION['user_id'])) {
                            echo "<li class=\"nav-item\"><a class=\"nav-item-child nav-item-hover\" href=\"login.php\">Авторизация</a></li>
                                <li class=\"nav-item\"><a class=\"nav-item-child nav-item-hover\" href=\"signUp.php\">Регистрация</a></li>";
                        } else {
                            echo "<li class=\"nav-item\"><a class=\"nav-item-child nav-item-hover\" href=\"profile.php\">Личный кабинет</a></li><li class=\"nav-item\"><a class=\"nav-item-child nav-item-hover\" href=\"/scripts/logOut.php\">Выйти из аккаунта</a></li>
 <li class=\"nav-item\">
                            <a class=\"nav-item-child nav-item-hover\" href=\"cart.php\">Корзина
                                <span class=\"badge badge-danger badge-pill mx-1\" style=\"min-width:30px; background-color: #d9534f;\">" . getSumForAccaunt($link, $_SESSION['user_id']) . " руб.
                            </span>
                            </a>
                        </li>";

                        } ?>
                    </ul>
                </div>
            </div>
            <!-- End Navbar Collapse -->
        </div>
    </nav>
    <!-- Navbar -->
</header>
<!--========== pfujkjdjr ==========-->


<!--========== картинка главного фона ==========-->
<div class="parallax-window" data-parallax="scroll" data-image-src="img/1920x1080/sl2/01.jpg">
    <div class="parallax-content container">

        <h1 class="carousel-title" style="color:darkgrey">Продукты</h1>
        <p></div>
</div>
<!--========== картинка главного фона ==========-->

<!--========== слои ==========-->
<br>
<br>
<br>


<!--здесь начинаются маячки меню ес чо-->
<div class="category_bar">
    <a href="products.php"><div>Все</div></a>
    <?php
    $getCategoriesQuery = sprintf("SELECT DISTINCT category FROM products");
    $result = $link->query($getCategoriesQuery);
    while ($category = $result->fetch_array()) {
        echo "<a href=\"products.php?category=" . $category[0] . "\"> <div>" . $category[0] . "</div></a>";
    }
    ?>

</div>
<div class="row margin-b-50">
    <?php
    if ($_REQUEST['category'] == "все" || !isset($_REQUEST['category'])) {

        $select_products = "SELECT * FROM products";
        $result = $link->query($select_products);
        while ($product = $result->fetch_array()) {
            $available = "Нет в наличии";
            if ($product['amount'] > 0) {
                $available = "В наличии";
            }

            $product_item = sprintf("<div class=\"col-sm-4 sm-margin-b-50\">
        <div class=\"margin-b-20\">
            <div class=\"wow zoomIn\" data-wow-duration=\".3\" data-wow-delay=\".1s\">
                <img class=\"img-responsive\" src=\"%s\" alt=\"Our Exceptional Solutions Image\">
            </div>
        </div>
        <h3><a href=\"#\">%s руб</a> <span class=\"text-uppercase margin-l-20\">%s</span></h3>
        <p>%s</p>
        <a class=\"link\" href=\"product-detail.php?product_id=%s\">Подробнее</a>
    </div>",
                $product['image'], $product['price'], $available, $product['name'], $product['id']);
            echo $product_item;
        }
    } else {
        $category = $_REQUEST['category'];
        $select_products = sprintf("SELECT * FROM products WHERE category ='%s'",$link->real_escape_string($category));
        $result = $link->query($select_products);
        while ($product = $result->fetch_array()) {
            $available = "Нет в наличии";
            if ($product['amount'] > 1) {
                $available = "В наличии";
            }

            $product_item = sprintf("<div class=\"col-sm-4 sm-margin-b-50\">
        <div class=\"margin-b-20\">
            <div class=\"wow zoomIn\" data-wow-duration=\".3\" data-wow-delay=\".1s\">
                <img class=\"img-responsive\" src=\"%s\" alt=\"Our Exceptional Solutions Image\">
            </div>
        </div>
        <h3><a href=\"#\">%s руб</a> <span class=\"text-uppercase margin-l-20\">%s</span></h3>
        <p>%s</p>
        <a class=\"link\" href=\"product-detail.php?product_id=%s\">Подробнее</a>
    </div>",
                $product['image'], $product['price'], $available, $product['name'], $product['id']);
            echo $product_item;
        }
    }
    ?>

</div>
<!--// end row -->
<!-- End Our Exceptional Solutions -->

<br>
<br>
<br>

<!-- Promo Section -->
<div class="promo-section overflow-h">
    <div class="container">
        <div class="clearfix">
            <div class="ver-center">
                <div class="ver-center-aligned">
                    <div class="promo-section-col">
                        <h2>Для профессионалов своего дела</h2>
                        <p>В нашем интернет-магазине, вы можете найти большой ассортимент телескопов "Sky-Watcher" и
                            некоторых других.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="promo-section-img-right">
        <img class="img-responsive" src="img/970x970/03.jpg" alt="Content Image">
    </div>
</div>
<!-- End Promo Section -->
<!--========== END PAGE LAYOUT ==========-->
<br>


<!--========== блок с сообщениями (который не работает и не будет никогда!)-->
<footer class="footer">
    <style>

        .border-top-footer {
            background-color: #292b2c !important;
        }

        .border-top-footer {
            border-top: 1px solid #efefef;
        }

        .h-copyright {
            height: 40px;
        }
    </style>
    <div class="border-top-footer ">
        <div class="container ">
            <div class="row m-0 ">
                <div class="col h-copyright ">
                    <p class="text-white text-center " style="margin-top:25px; color: #FFFFFF">&copy; Телескопы и
                        космос</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--конец блока с сообщениями-->

<!--========== шняги ==========-->
<a href="javascript:void(0);" class="js-back-to-top back-to-top">Выше</a>

<script src="vendor/jquery.min.js" type="text/javascript"></script>
<script src="vendor/jquery-migrate.min.js" type="text/javascript"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="vendor/jquery.easing.js" type="text/javascript"></script>
<script src="vendor/jquery.back-to-top.js" type="text/javascript"></script>
<script src="vendor/jquery.smooth-scroll.js" type="text/javascript"></script>
<script src="vendor/jquery.wow.min.js" type="text/javascript"></script>
<script src="vendor/jquery.parallax.min.js" type="text/javascript"></script>
<script src="vendor/swiper/js/swiper.jquery.min.js" type="text/javascript"></script>
<script src="js/layout.min.js" type="text/javascript"></script>
<script src="js/components/wow.min.js" type="text/javascript"></script>
<script src="js/components/swiper.min.js" type="text/javascript"></script>

</body>


</html>
