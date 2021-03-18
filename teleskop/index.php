<?php
session_start();
require_once "scripts/sumCart.php";
require_once "scripts/database_connection.php"
?>
<!DOCTYPE html>
<html lang="ru" class="no-js">
<!-- ЗАГОЛОВОЧЕК -->
<head>
    <title>Телескопы Хаббла, купить</title>
    <meta http-equiv="T-HB" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta charset="UTF-8"/>

    <link href="http://fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet" type="text/css">
    <link href="vendor/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <!ПЛАГИНСЫЫ-->
    <link href="css/animate.css" rel="stylesheet">
    <link href="vendor/swiper/css/swiper.min.css" rel="stylesheet" type="text/css"/>

    <!-- THEME STYLES -->
    <link href="css/layout.min.css" rel="stylesheet" type="text/css"/>
</head>
<!-- ЗАГОЛОВОК -->


<!-- BODY -->
<body>

<!--========== заголовки ==========-->
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


            <!--РЕГИСТРАЦИЯ И ПРОДУКТЫ-->
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
                            echo "<li class=\"nav-item\"><a class=\"nav-item-child nav-item-hover\" href=\"profile.php\">Личный кабинет</a></li>
<li class=\"nav-item\"><a class=\"nav-item-child nav-item-hover\" href=\"/scripts/logOut.php\">Выйти из аккаунта</a></li>
 <li class=\"nav-item\">
                            <a class=\"nav-item-child nav-item-hover\" href=\"cart.php\">Корзина
                                <span class=\"badge badge-danger badge-pill mx-1\" style=\"min-width:30px; background-color: #d9534f;\">".getSumForAccaunt($link,$_SESSION['user_id'])." руб.   
                            </span>
                            </a>
                        </li>";

                        }
                        $query = "SELECT * FROM users WHERE id='".$_SESSION['user_id']."' AND is_admin=1";
                        $result = $link->query($query);
                        if($result->num_rows== 1){
                            echo "<li class=\"nav-item\"><a class=\"nav-item-child nav-item-hover\" href=\"admin.php\">Админ</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- End Navbar Collapse -->
        </div>
    </nav>
    <!-- Navbar -->
</header>
<!--========== конец заголовочка ==========-->


<!--========== слаидер ==========-->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <div class="container">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        </ol>
    </div>
    <!-- СЛАЙДЕР ААААААААААААААААА -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img class="img-responsive" src="img/1920x1080/01.jpg" alt="Slider Image">
            <div class="container">
                <div class="carousel-centered">
                    <div class="margin-b-40">
                        <h1 class="carousel-title">Новости</h1>
                        <p> Новое исследование ставит под вопрос существующие модели черных дыр.. <br/></p>
                    </div>
                    <!--кнопка перехода к новостям -->
                    <a href="#" class="btn-theme btn-theme-sm btn-white-brd text-uppercase">Читать</a>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="img-responsive" src="img/1920x1080/02.jpg" alt="Slider Image">
            <div class="container">
                <div class="carousel-centered">
                    <div class="margin-b-40">
                        <h2 class="carousel-title">Новости</h2>
                        <p>Аппарат «Вояджер-2», возможно, приближается к межзвездному пространству! <br/></p>
                    </div>
                    <a href="#" class="btn-theme btn-theme-sm btn-white-brd text-uppercase">Читать</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--========== конец слайдера ==========-->


<!-- Pagination -->
<div class="swiper-testimonials-pagination"></div>
<!-- End Testimonials -->



<!-- Promo Section -->
<div class="promo-section overflow-h">
    <div class="container">
        <div class="clearfix">
            <div class="ver-center">
                <div class="ver-center-aligned">
                    <div class="promo-section-col">
                        <h2>Лирическое отступление</h2>
                        <p>
                            Отец рассказывал, как пятилетним мальчишкой, посмотрев в ночное небо, заметил странную
                            мигающую и движущуюся звезду… Это был 57-й год и наш первый искусственный спутник. В тот
                            осенний день новости космоса были во всех газетах, на всех радиостанциях, на каждом
                            телеканале.

                            Сегодня я поднимаю глаза и вижу те же 3 000 звезд, жизнь которых кажется мне вечной, а еще
                            десятки мигающих точек, вглядывающихся в Землю обзорными датчиками или улавливающих частицы
                            реликтового излучения. Я смотрю на небо, и небо смотрит на меня: манит, завораживает,
                            изучает…

                            Современные новости астрономии - это не только запуски искусственных спутников. Это старты
                            ракет-носителей с пилотируемыми кораблями, телескопами или модулями МКС. Это доклады о новых
                            открытиях, смелые гипотезы и поиски внеземной жизни. Это проект "HUBBLE TELESCOPE".
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="promo-section-img-right">
        <img class="img-responsive" src="img/970x970/01.jpg" alt="Content Image">
    </div>
</div>
<!-- End Promo Section -->


<br>
<br>


<!--========== конец главного сайта ==========-->

<!--========== шняги ==========-->


<style>
    .footer-special.row > div[class*='col-'] {
        display: flex;
        flex: 1 0 auto;
    }

    .footer-special.mb-20px > [class^="col-"] {
        margin-bottom: 20px;
    }

    .footer-special.bg-inverse {
        background-color: #292b2c !important;
    }

    .footer-special.border-top-footer {
        border-top: 1px solid #efefef;
    }

    .footer-special.h-copyright {
        height: 70px;
    }

    @media only screen and (max-width: 576px) {
        .container {
            margin-left: 0;
            margin-right: 0;
        }
    }

    .border-top-footer {
        border-top: 1px solid #efefef;
    }

    .h-copyright {
        height: 70px;
    }

    @media only screen and (max-width: 576px) {
        .container {
            margin-left: 0;
            margin-right: 0;
        }
    }

    .footer-special.pt-5 {
        padding-top: 3rem !important;
    }

    .specialFooter {
        color: #fff !important;
        float: left;
    }
</style>
<footer class="bg-inverse pt-5 footer-special">
    <div class="container p-0 ">
        <div class="row m-0 mb-5 pb-3 mb-20px ">
            <div class="col-12 col-sm-6 col-md-3 text-white justify-content-center justify-content-sm-start text-sm-left text-center ">
                <ul class="list-unstyled ">
                    <li>
                        <h4 class="specialFooter" style="margin: 0px">Контакты</h4>
                        <br>
                    </li>
                    <li class="pt-3 ">
                        <ul class="list-unstyled">
                            <li class="specialFooter">telescopehubble@gmail.com</li>
                            <li class="specialFooter">Москва +7 (499) 678-02-33</li>
                            <li class="specialFooter">Петербург +7 (812) 418-29-33</li>
                            <li class="specialFooter">Вся Россия 8 (800) 700-75-26</li>

                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <!--    copyright-->
    <div class="border-top-footer ">
        <div class="container ">
            <div class="row m-0 ">
                <div class="col h-copyright ">
                    <p class="text-white text-center " style="margin-top:25px; color: #FFFFFF">&copy; Телескопы Хаббла, купить</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--========== END FOOTER ==========-->

<!-- вернуться вверх кнопка ссылк -->
<a href="javascript:void(0);" class="js-back-to-top back-to-top">Выше</a>
<script src="vendor/jquery.min.js" type="text/javascript"></script>
<script src="vendor/jquery-migrate.min.js" type="text/javascript"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<!-- плагины -->
<script src="vendor/jquery.easing.js" type="text/javascript"></script>
<script src="vendor/jquery.back-to-top.js" type="text/javascript"></script>
<script src="vendor/jquery.smooth-scroll.js" type="text/javascript"></script>
<script src="vendor/jquery.wow.min.js" type="text/javascript"></script>
<script src="vendor/swiper/js/swiper.jquery.min.js" type="text/javascript"></script>
<script src="vendor/masonry/jquery.masonry.pkgd.min.js" type="text/javascript"></script>
<script src="vendor/masonry/imagesloaded.pkgd.min.js" type="text/javascript"></script>

<script src="js/layout.min.js" type="text/javascript"></script>
<script src="js/components/wow.min.js" type="text/javascript"></script>
<script src="js/components/swiper.min.js" type="text/javascript"></script>
<script src="js/components/masonry.min.js" type="text/javascript"></script>

</body>
</html>