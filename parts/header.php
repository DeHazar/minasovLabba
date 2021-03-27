<?php
$root = "http://".$_SERVER["HTTP_HOST"]."/repository/student/sts-07/14263";
//$root = "http://".$_SERVER["HTTP_HOST"]."/";
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
    <link href=\"".$root."/style/animations.css\" rel=\"stylesheet\">
    <link href=\"".$root."/cssStyle/menu.css\" rel=\"stylesheet\">
    <link href=\"".$root."/cssStyle/masterpage.css\" rel=\"stylesheet\">
    <link href=\"".$root."/cssStyle/loader.css\" rel=\"stylesheet\">
    <script src=\"".$root."/Script/jquery-3.6.0.min.js\" type=\"text/javascript\"></script>
    <script src=\"".$root."/Script/materialize.min.js\" type=\"text/javascript\"></script>

    <script src=\"".$root."/Script/index.js\" type=\"text/javascript\"></script>";
    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>


<div class="navbar-fixed">
    <nav class="top-nav nav-background">
        <div class="container">
            <div class="nav-wrapper">
                <a href="#" data-activates="mobile-render" class="button-collapse blue-grey-text"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <?php
                    echo "
                    <li><a href=\"".$root."index.php\">Обо мне</a></li>
                    <li><a href=\"".$root."pages/lections.php\">Лекции</a></li>
                    <li><a href=\"".$root."pages/practices.php\">Практики</a></li>
                    <li><a href=\"".$root."pages/services.php\">Отчеты ССОИ ОТС</a></li>
                    <li><a href=\"".$root."pages/constructions.php\">Отчеты ОКО ОТС</a></li>
                    <li><a href=\"".$root."teleskop/index.php\">Телескопы</a></li>
                    ";
                    ?>
                </ul>
                <ul class="side-nav side-nav-cls" id="mobile-render">
                    <li><a  href="/index.php">Обо мне</a></li>
                    <li><a href="/pages/lections.php">Лекции</a></li>
                    <li><a href="/pages/practices.php">Практики</a></li>
                    <li><a href="/pages/services.php">Отчеты ССОИ ОТС</a></li>
                    <li><a href="/pages/constructions.php">Отчеты ОКО ОТС</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>