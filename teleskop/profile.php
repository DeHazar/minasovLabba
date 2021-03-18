<?php
/**
 * Created by PhpStorm.
 * User: garae
 * Date: 24.05.2019
 * Time: 17:59
 */
session_start();
require_once "scripts/database_connection.php";
require_once "scripts/sumCart.php";

if (isset($_SESSION['user_id'])) {
    $information_of_profile = sprintf("SELECT * FROM users WHERE id = '%s'", $_SESSION['user_id']);
    $result = $link->query($information_of_profile);
    $user_info = $result->fetch_array();


}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Подробнее о продукте</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no">
    <link rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<style>body {
        background: -webkit-linear-gradient(left, silver, white);
        font-family: "Open Sans";
    }

    /* Profile container */
    .profile {
        margin: 20px 0;
    }

    /* Profile sidebar */
    .profile-sidebar {
        padding: 20px 0 10px 0;
        background: #fff;
    }

    .profile-img {
        text-align: center;
    }

    .profile-img img {
        width: 70%;
        height: 100%;
    }

    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -20%;
        width: 70%;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8;
    }

    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }

    .profile-usertitle {
        text-align: center;
        margin-top: 20px;
    }

    .profile-usertitle-name {
        color: #5a7391;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .profile-usertitle-login {
        text-transform: uppercase;
        color: #5b9bd1;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .profile-userbuttons {
        text-align: center;
        margin-top: 10px;
    }

    .profile-userbuttons .btn {
        text-transform: uppercase;
        font-size: 11px;
        font-weight: 600;
        padding: 6px 15px;
        margin-right: 5px;
    }

    .profile-userbuttons .btn:last-child {
        margin-right: 0px;
    }

    .profile-usermenu {
        margin-top: 30px;
    }

    .profile-usermenu ul li {
        border-bottom: 1px solid #f0f4f7;
    }

    .profile-usermenu ul li:last-child {
        border-bottom: none;
    }

    .profile-usermenu ul li a {
        color: #93a3b5;
        font-size: 18px;
        font-weight: 400;
    }

    .profile-usermenu ul li a i {
        margin-right: 8px;
        font-size: 14px;
    }

    .profile-usermenu ul li a:hover {
        background-color: #fafcfd;
        color: #5b9bd1;
    }

    .profile-usermenu ul li.active {
        border-bottom: none;
    }

    .profile-usermenu ul li.active a {
        color: #5b9bd1;
        background-color: #fbf6f7;
        border-left: 2px solid #d62828;
        margin-left: -2px;
    }

    /* Profile Content */
    .profile-content {
        width: 100%;
        padding: 20px;
        background: #fff;
        min-height: 460px;
    }

    .profile-content > form {
        padding: 0px 30px;
    }

    table > tbody > tr > td {
        padding: 15px 0 !important;
    }

    table > tbody > tr:hover {
        background-color: #ececff;
        cursor: pointer;
    }</style>
<body>
<nav class="navbar navbar-inverse bg-inverse sticky-top">
    <div class="container p-0 relative">
        <div class="row navbar navbar-toggleable-sm">
            <div class="col-md-2 col-12">
                <a class="navbar-brand" href="#">Телескопы</a>
                <div class="absolute" style=" right:0px;">
                    <button class="navbar-toggler" style="height:40px" type="button" id="burger">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="nava">
                <div class="col-12">
                    <ul class="mr-list-20px navbar-nav my-2 my-md-0 float-md-right">
                        <li class="nav-item">
                            <a class="nav-link " role="button" id="mega-menu-btn" href="index.php">Главная страница</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="products.php">Продукты</a>
                        </li>
                        <?php
                        if (!isset($_SESSION['user_id'])) {
                            echo "<li class=\"nav-item\"><a class=\"nav-link \" href=\"login.php\">Авторизация</a></li>
                                <li class=\"nav-item\"><a class=\"nav-link \" href=\"signUp.php\">Регистрация</a></li>";
                        } else {
                            echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"profile.php\">Личный кабинет</a></li><li class=\"nav-item\"><a class=\"nav-link \" href=\"/scripts/logOut.php\">Выйти из аккаунта</a></li>
 <li class=\"nav-item\">
                            <a class=\"nav-link \" href=\"cart.php\">Корзина
                                <span class=\"badge badge-danger badge-pill mx-1\" id=\"sum_cart\" style=\"min-width:30px; background-color: #d9534f;\">
                               " . getSumForAccaunt($link, $_SESSION['user_id']) . " руб.
                            </span>
                            </a>
                        </li>";

                        } ?>

                    </ul>
                </div>
            </div>
        </div>

    </div>

</nav>
<!--   Main Content====================================================-->
<main>
    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <div class="profile-img">
                        <img src="data:image/png;base64,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" alt=""/>

                    </div>

                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            <?php  echo $user_info['first_name'];?>
                        </div>
                        <div class="profile-usertitle-login">
                            <?php  echo $user_info['login'];?>
                        </div>
                    </div>

                    <div class="profile-usermenu">
                        <ul class="nav" style="    display: contents;">
                            <li <?php if($_REQUEST['checks'] != "true"){
                                echo "class=\"active\"";
                            } ?>>
                                <a href="profile.php">
                                    <i class="glyphicon glyphicon-home"></i>
                                    Overview </a>
                            </li>
                            <li <?php if($_REQUEST['checks'] == "true"){
                                echo "class=\"active\"";
                            } ?>>
                                <a href="profile.php?checks=true" >
                                    <i class="glyphicon glyphicon-ok"></i>
                                    Заказы </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-md-9" <?php if($_REQUEST['checks'] == "true"){
                echo "style=\"display:none\"";
            } ?>>
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Ваш профиль</h4>
                            <br>
                        </div>
                    </div>
                    <table class="table table-user-information">
                        <tbody>
                        <tr>
                            <td>Email:</td>
                            <td><?php  echo $user_info['email'];?></td>
                        </tr>
                        <tr>
                            <td>Имя</td>
                            <td><?php  echo $user_info['first_name'];?></td>
                        </tr>
                        <tr>
                            <td>Фамилия</td>
                            <td><?php  echo $user_info['last_name'];?></td>
                        </tr>

                        <tr>
                        <tr>
                            <td>Отчество</td>
                            <td><?php  echo $user_info['middle_name'];?></td>
                        </tr>
                        <tr>
                            <td>Место жительства</td>
                            <td><?php  echo $user_info['address'];?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-9 profile-content" <?php if($_REQUEST['checks'] != "true"){
                echo "style=\"display:none\"";
            } ?>>
                    <table class="table" style="cursor: default">
                        <thead>
                        <tr>
                            <th># покупки</th>
                            <th>Название товаров</th>
                            <th>Сумма покупки</th>
                            <th>Дата</th>
                            <th>Чек</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $getChecksQuery = sprintf("SELECT * FROM checks WHERE user_id='%s'", $_SESSION['user_id']);
                            $result = $link ->query($getChecksQuery);
                            while($check = $result -> fetch_array()){
                                echo "<tr>
                            <th scope=\"row\">".$check['id']."</th>
                            <td>".$check['productsNames']."</td>
                            <td>".$check['sum']."</td>
                            <td>".$check['date']."</td>
                            <td><a href='scripts/getPDF.php?checkId=" .$check['id']."'>Скачать чек в PDF</a></td>
                        </tr>";
                            }
                        ?>
                        </tbody>
                    </table>


            </div>
        </div>
        </div>
</main>
<!--   Footer==============================================-->
<footer class="bg-inverse pt-3 footer-special" >
    <div class="container p-0 b-0 ">
        <div class="row ">
            <div class="col-12 col-sm-6 col-md-3 text-white justify-content-center justify-content-sm-start text-sm-left text-center ">
                <ul class="list-unstyled ">
                    <li>
                        <h4 class="specialFooter" style="margin: 0px">Контакты</h4>

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
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js'></script>


<script src="js/index.js"></script>

</html>
