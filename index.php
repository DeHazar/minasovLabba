
<!DOCTYPE html>
<html>
    <head>
        <title>Обо мне</title>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="./font-mfizz-2.4.1/font-mfizz.css">
        <!--Import materialize.css-->
        <link href="./style/materialize.min.css" rel="stylesheet">
        <link href="./style/font-awesome.min.css" rel="stylesheet">
        <link href="./style/animations.css" rel="stylesheet">
        <link href="./cssStyle/menu.css" rel="stylesheet">
        <link href="./cssStyle/masterpage.css" rel="stylesheet">
        <link href="./cssStyle/loader.css" rel="stylesheet">
        <script src="./Script/jquery-3.6.0.min.js" type="text/javascript"></script>
        <script src="./Script/materialize.min.js" type="text/javascript"></script>
        
        <script src="./Script/index.js" type="text/javascript"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body class="body-cls-style">
        <div class="body-cls-style">
            <?php
            require_once './loader.php';
            ?>
            <div class="main-wrapper" style="display: none;">
                <?php
                require_once './menu.php';
                ?>
            </div>
        </div>
        <script src="Script/css3-animate-it.js" type="text/javascript"></script>
    </body>
</html>
