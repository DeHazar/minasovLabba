<?php
$root = "http://".$_SERVER["HTTP_HOST"]."/repository/student/sts-07/14263";
//  $root = "http://".$_SERVER["HTTP_HOST"]."/";
//session_start();
?>
<html>
<head>
    <title>Обо мне</title>
    <?php

        echo " <link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"".$root."/font-mfizz-2.4.1/font-mfizz.css\">
    <!--Import materialize.css-->
    <link href=\"".$root."/style/materialize.min.css\" rel=\"stylesheet\">
    <link href=\"".$root."/style/font-awesome.min.css\" rel=\"stylesheet\">
    <link href=\"".$root."/cssStyle/menu.css\" rel=\"stylesheet\">
    <link href=\"".$root."/cssStyle/masterpage.css\" rel=\"stylesheet\">
    <script src=\"".$root."/Script/jquery-3.6.0.min.js\" type=\"text/javascript\"></script>
    <script src=\"".$root."/Script/materialize.min.js\" type=\"text/javascript\"></script>

    <script src=\"".$root."/Script/index.js\" type=\"text/javascript\"></script>";
    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>


<div class="navbar-fixed">
    <nav class="top-nav nav-background">
        <div class="container">
                <a href="#" data-activates="mobile-render" class="button-collapse blue-grey-text"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <?php
                    echo "
                    <li><a href=\"".$root."/achiments.php\">Достижения</a><li>
                    <li><a href=\"".$root."/index.php\">Обо мне</a></li>
                    <li><a href='".$root."/Photos/my_photos.php'>Фотографии</a> </li>
                    <li><a href=\"".$root."/pages/services.php\">Отчеты ССОИ ОТС</a></li>
                    <li><a href=\"".$root."/pages/constructions.php\">Отчеты ОКО ОТС</a></li>
                    <li><a href=\"".$root."/reports/services/6/main.php\">Проект</a></li>
                    ";
                    // Если пользователь уже зашел, то кидаем на главную страницу
                    if (isset($_SESSION['user_id'])) {
                        echo "<li ><a href=\"".$root."/reports/services/6/signOut.php\" class='red-text'>Выйти</a></li>";
                    }
                    ?>

                </ul>
                <ul class="side-nav side-nav-cls" id="mobile-render">
                    <?php
                    echo "
                    <li><a href=\"".$root."/achiments.php\">Достижения</a><li>
                    <li><a href=\"".$root."/index.php\">Обо мне</a></li>
                    <li><a href='".$root."/Photos/my_photos.php'>Фотографии</a> </li>
                    <li><a href=\"".$root."/pages/services.php\">Отчеты ССОИ ОТС</a></li>
                    <li><a href=\"".$root."/pages/constructions.php\">Отчеты ОКО ОТС</a></li>
                    <li><a href=\"".$root."/reports/services/6/main.php\">Проект</a></li>
                    ";
                    // Если пользователь уже зашел, то кидаем на главную страницу
                    if (isset($_SESSION['user_id'])) {
                        echo "<li ><a href=\"".$root."/reports/services/6/signOut.php\" class='red-text'>Выйти</a></li>";
                    }
                    ?>
                </ul>
        </div>
    </nav>
</div>
