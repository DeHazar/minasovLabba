<?php
/**
 * Created by PhpStorm.
 * User: garae
 * Date: 28.04.2019
 * Time: 18:24
 */

session_start();

require_once 'scripts/database_connection.php';

$error_message = $_REQUEST['error_message'];

// Если пользователь уже зашел, то кидаем на главную страницу
if (!isset($_SESSION['user_id'])) {

// Если уже отправлен пост запрос с именем пользователя, то смотрим
    if (isset($_POST['username'])) {
        // получаем логин и пароль
        $username = $link->real_escape_string(trim($_REQUEST['username']));
        $password = $link->real_escape_string(trim($_REQUEST['password']));

        // Ищем пользователя в бд
        $query = sprintf("SELECT id ,login, password FROM users " .
            " WHERE login = '%s' AND password = '%s';",
            $username, crypt($password, $username));

        $results = mysqli_query($link, $query);
        //Если он есть то сохраняем в сессии его ид, иначе выводим ошибку
        if (mysqli_num_rows($results) == 1) {
            $result = mysqli_fetch_array($results);
            $user_id = $result['id'];
            $_SESSION['user_id'] = $user_id;
            $_SESSION['login'] = $username;

            header("Location: /index.php");
            exit();
        } else {
            $error_message = "Комбинация логин/пароль не правильна. Проверьте ваши введенные данные";

        }
    } ?>
    <html>
<head>
    <title>Авторизация</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta charset="UTF-8"/>

    <link href="http://fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet" type="text/css">
    <link href="vendor/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <!ПЛАГИНСЫЫ-->
    <link href="css/animate.css" rel="stylesheet">
    <script src="vendor/jquery.min.js" type="text/javascript"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


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
                                <span class=\"badge badge-danger badge-pill mx-1\" style=\"min-width:30px; background-color: #d9534f;\">
                                //КОЛИЧЕСТВО
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
</header>

<style>
    *{
        margin:0;
        padding:0;
    }

    h1 {
        font-size: 2em;
        font-family: "Core Sans N W01 35 Light";
        font-weight: normal;
        margin: .67em 0;
        display: block;
    }

    .avatar {
        margin: 10px 0 20px 0;
    }

    .module{
        position:relative;
        top:10%;
        height:65%;
        width:450px;
        margin-left:auto;
        margin-right:auto;
    }

    ::-moz-selection {
        background: #19547c;
    }
    ::selection {
        background: #19547c;
    }
    input::-moz-selection {
        background: #037db6;
    }
    input::selection {
        background: #037db6;
    }

    body{
        color: #fff;
        background-color:#f0f0f0;
        font-family:helvetica;
        background:url('http://clevertechie.com/img/bnet-bg.jpg') #0f2439 no-repeat center top;
    }

    .body-content{
        position:relative;
        top:20px;
        height:700px;
        width:800px;
        margin-left:auto;
        margin-right:auto;
        background: transparent;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"]
    {
        height:30px;
        width:100%;;
        display: inline-block;
        vertical-align: middle;
        height: 34px;
        padding: 0 10px;
        margin-top: 3px;
        margin-bottom: 10px;
        font-size: 15px;
        line-height: 20px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        background-color: rgba(0, 0, 0, 0.5);
        color: rgba(255, 255, 255, 0.7);
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        border-radius: 2px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"] {
        -webkit-appearance: none;
        -moz-appearance: none;
        -ms-appearance: none;
        appearance: none;
        -webkit-transition: background-position 0.2s, background-color 0.2s, border-color 0.2s, box-shadow 0.2s;
        transition: background-position 0.2s, background-color 0.2s, border-color 0.2s, box-shadow 0.2s;
    }
    input[type="text"]:hover,
    input[type="password"]:hover,
    input[type="email"]:hover {
        border-color: rgba(255, 255, 255, 0.5);
        background-color: rgba(0, 0, 0, 0.5);
        color: rgba(255, 255, 255, 0.7);
    }
    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="email"]:focus {
        border: 2px solid;
        border-color: #1e5f99;
        background-color: rgba(0, 0, 0, 0.5);
        color: #ffffff;
    }
    .btn {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        margin: 3px 0;
        padding: 6px 20px;
        font-size: 15px;
        line-height: 20px;
        height: 34px;
        background-color: rgba(0, 0, 0, 0.15);
        color: #00aeff;
        border: 1px solid rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 rgba(0, 0, 0, 0);
        border-radius: 2px;
        -webkit-transition: background-color 0.2s, box-shadow 0.2s, background-color 0.2s, border-color 0.2s, color 0.2s;
        transition: background-color 0.2s, box-shadow 0.2s, background-color 0.2s, border-color 0.2s, color 0.2s;
    }
    .btn:active {
        padding: 7px 19px 5px 21px;
    }
    .btn:hover,
    .btn:focus {
        background-color: rgba(0, 0, 0, 0.25);
        color: #ffffff;
        border-color: rgba(255, 255, 255, 0.3);
        box-shadow: 0 0 rgba(0, 0, 0, 0);
    }
    .btn:active {
        background-color: rgba(0, 0, 0, 0.15);
        color: rgba(255, 255, 255, 0.8);
        border-color: rgba(255, 255, 255, 0.07);
        box-shadow: inset 1.5px 1.5px 3px rgba(0, 0, 0, 0.5);
    }
    .btn-primary {
        background-color: #098cc8;
        color: #ffffff;
        border: 1px solid transparent;
        box-shadow: 0 0 rgba(0, 0, 0, 0);
        border-radius: 2px;
        -webkit-transition: background-color 0.2s, box-shadow 0.2s, background-color 0.2s, border-color 0.2s, color 0.2s;
        transition: background-color 0.2s, box-shadow 0.2s, background-color 0.2s, border-color 0.2s, color 0.2s;
        background-image: -webkit-linear-gradient(top, #0f9ada, #0076ad);
        background-image: linear-gradient(to bottom, #0f9ada, #0076ad);
        border: 0;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.15) inset;
    }
    .btn-primary:hover,
    .btn-primary:focus {
        background-color: #21b0f1;
        color: #ffffff;
        border-color: transparent;
        box-shadow: 0 0 rgba(0, 0, 0, 0);
    }
    .btn-primary:active {
        background-color: #006899;
        color: rgba(255, 255, 255, 0.7);
        border-color: transparent;
        box-shadow: inset 1.5px 1.5px 3px rgba(0, 0, 0, 0.5);
    }
    .btn-primary:hover,
    .btn-primary:focus {
        background-image: -webkit-linear-gradient(top, #37c0ff, #0097dd);
        background-image: linear-gradient(to bottom, #37c0ff, #0097dd);
    }
    .btn-primary:active {
        background-image: -webkit-linear-gradient(top, #006ea1, #00608d);
        background-image: linear-gradient(to bottom, #006ea1, #00608d);
        box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.6) inset, 0 0 0 1px rgba(255, 255, 255, 0.07) inset;
    }
    .btn-block {
        display: block;
        width: 100%;
        padding-left: 0;
        padding-right: 0;
    }

    .alert {
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 4px 20px 4px 20px;
        font-size: 13px;
        line-height: 20px;
        margin-bottom: 20px;
        text-shadow: none;
        position: relative;
        background-color: #272e3b;
        color: rgba(255, 255, 255, 0.7);
        border: 1px solid #000;
        box-shadow: 0 0 0 1px #363d49 inset, 0 5px 10px rgba(0, 0, 0, 0.75);
    }
    .alert-error {
        color: #f00;
        background-color: #360e10;
        box-shadow: 0 0 0 1px #551e21 inset, 0 5px 10px rgba(0, 0, 0, 0.75);
    }
    .alert:empty{
        display: none;
    }
</style>

<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet"
      type="text/css"/>
<link rel="stylesheet" href="form.css" type="text/css">
<div class="body-content">
    <div class="module">
        <h1>Войти в аккаунт</h1>
        <form class="form" action="login.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="alert alert-error"><?php if (isset($error_message)) echo $error_message; ?></div>
            <input type="text" placeholder="Логин пользователя" name="username" required/>
            <input type="password" placeholder="Пароль" name="password" autocomplete="new-password" required/>
            <input type="submit" value="Войти" name="register" class="btn btn-block btn-primary"/>
        </form>
    </div>
</div>
    </html><?php
} else {
    // Now handle the case where they're logged in
    // redirect to another page, most likely show_user.php
    header("Location: index.php");
}
?>