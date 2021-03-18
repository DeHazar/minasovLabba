<?php
session_start();
require_once "scripts/database_connection.php";
require_once "scripts/sumCart.php";

$get_all_cart_user_query = sprintf("SELECT * FROM shopping_cart WHERE user_id = '%s'", $_SESSION['user_id']);
$result = $link->query($get_all_cart_user_query);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Корзина покупок</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <link rel='stylesheet' href='https://s.cdpn.io/6035/grid.css'>
    <script src='https://code.jquery.com/jquery-1.11.1.min.js'></script>

    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,600'>
    <link href="css/cart.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <link rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<nav class="navbar navbar-inverse bg-inverse sticky-top">
    <div class="container p-0 relative">
        <div class="row navbar navbar-toggleable-sm">
            <div class="col-md-2 col-12">
                <a class="navbar-brand" href="index.php">Телескопы</a>
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
                            echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"profile.php\">Личный кабинет</a></li>
<li class=\"nav-item\"><a class=\"nav-link \" href=\"/scripts/logOut.php\">Выйти из аккаунта</a></li>
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
            <script>
                $("#burger").click(function (e) {
                    if ($("#nava").css("display") == "none") {
                        $("#nava").css("display", "block");
                    } else {
                        $("#nava").css("display", "none");
                    }
                });
            </script>
        </div>

    </div>

</nav>
<div class="cart">
    <div class="container">
        <div class="grid_12">
            <h1>Cart</h1>

        </div>
        <ul class="items">
            <?php while ($order = $result->fetch_array()) {
                $get_images_query = sprintf("SELECT image2, image3, description, amount FROM products WHERE id = '%s'", $order['id_product']);
                $images_get = $link->query($get_images_query);
                $images = $images_get->fetch_array();

                echo "<li class=\"grid_4 item\">
                <a href=\"#\" class=\"btn-remove\" content='" . $order['id_product'] . "'>
                    <span class=\"icon icon-remove\" content='" . $order['id_product'] . "'></span>
                </a>
                <div class=\"preview\">
                    <ul class=\"images\"
                        data-images=\"[&quot;" . $order['image'] . "&quot;,&quot;" . $images['image2'] . "&quot;,&quot;" . $images['image3'] . "&quot;]\">
                        <li><img src=\"" . $order['image'] . "\"/></li>
                        <li><img src=\"" . $images['image2'] . "\"/></li>
                        <li><img src=\"" . $images['image3'] . "\"/></li>
                    </ul>
                    <img src=\"" . $order['image'] . "\"/>
                </div>
                <div class=\"details\" data-price=\"" . $order['price'] . "\">
                    <h3>
                        " . $order['name'] . "
                        <span class=\"right\"></span>
                    </h3>
                    <p>" . mb_strimwidth($images['description'], 0, 100) . "</p>
                    <div class=\"inner_container\">
                        <div class=\"col_1of2\">
                            <p>  " . $order['price'] . " руб.</p>
                        </div>
                        <div class=\"col_1of2 align-right\">
                            <p>
                            <span class=\"current_quantity\">" . $order['count'] . "</span>
                                <a href=\"#\" class=\"btn-quantity plus\" content='" . $order['id_product'] . "' data='".$images['amount']."'>
                                    <span class=\"icon icon-plus\" content='" . $order['id_product'] . "' data='".$images['amount']."'></span>
                                </a>
                                <a href=\"#\" class=\"btn-quantity minus\" content='" . $order['id_product'] . "'>
                                    <span class=\"icon icon-minus\" content='" . $order['id_product'] . "'></span>
                                </a>
                            </p>
                            <input type=\"hidden\" class=\"quantity_field\" name=\"quantity\" value=\"" . $order['count'] . "\" data-price=\"" . $order['price'] . "\"/>
                        </div>
                    </div>
                </div>
            </li>";
            } ?>

        </ul>

        <div class="grid_12 summary">
            <div class="inner_container">
                <div class="col_1of2 meta-data">
                    <div class="sub-total">
                        <em>Итого: </em><span class="amount"></span>
                    </div>
                </div>
                <div class="col_1of2">
                    <div class="total">
                        <span class="amount"></span>
                    </div>
                </div>
                <div class="col_1of1">
                    <a href="#" class="btn-checkout" data-toggle="modal" data-target="#modalCart">Заказать</a>
                </div>
                <div class="col_1of1">
                    <a href="#" id="clear_cart" style="background: #c0392b;" class="btn-checkout">Очистить корзину</a>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Заказ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">
                <div id="error" class="alert alert-danger">
                    Заполните все данные!
                </div>

                <form>
                    <div id="addressInputForm">
                        <div class="form-row" style="display: flex;">
                            <div class="form-group col-md-6">
                                <label for="country">Страна</label>
                                <input type="text" class="form-control" id="country" placeholder="Страна" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity">Город</label>
                                <input type="text" class="form-control" id="inputCity" placeholder="Город" required>
                            </div>
                        </div>
                        <div class="form-group" style="    margin-left: 16px;
                           margin-right: 16px;">
                            <label for="inputAddress">Улица</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="Улица" required>
                        </div>
                        <div class="form-row" style="display: flex;">
                            <div class="form-group col-md-6">
                                <label for="home">Дом</label>
                                <input type="text" class="form-control" id="home" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputZip">Индекс</label>
                                <input type="text" class="form-control" id="inputZip" required>
                            </div>

                        </div>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <button class="btn btn-outline-primary waves-effect waves-light"
                                data-dismiss="modal">Закрыть
                        </button>
                        <button type="submit" class="btn btn-primary" onclick="
                          $('#error').toggle();
                          addCheck();
                        ">Заказать
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="js/cart.js"></script>
</body>
<script async>
    function getXmlHttp() {
        var xmlhttp;
        try {
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (E) {
                xmlhttp = false;
            }
        }
        if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
            xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
    }

    function addCheck(){
        if($("#inputAddress")[0].value != ""){
            const xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
            xmlhttp.open('POST', 'scripts/addCheck.php', true); // Открываем асинхронное соединение
            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xmlhttp.send("date=" + new Date().getDate() +"." + (+new Date().getMonth() + 1) + "." + new Date().getFullYear() + "&address=" +
                document.getElementById("inputAddress").value +", " + document.getElementById("home").value + " Индекс: " + document.getElementById("inputZip").value);
            xmlhttp.onreadystatechange = function () { // Ждём ответа от сервера
                if (xmlhttp.readyState === 4) { // Ответ пришёл
                    if (xmlhttp.status === 200) { // Сервер вернул код 200 (что хорошо)
                        console.log("response=" + xmlhttp.responseText);
                         if ("OK" === xmlhttp.responseText) {
                             location.href = 'profile.php?checks=true'
                        } else {
                            location.href = 'index.php';
                        }
                    }
                }
            };
        }
    }

    $(document).ready(function () {
        $(".btn-remove").click(function (e) {
            e.preventDefault();
            let product_id = e.target.getAttribute("content");
            var jsonString = JSON.stringify([product_id]);
            $.ajax({
                type: "POST",
                url: ("scripts/deleteFromCart.php"),
                data: {data: jsonString},
                success: function (response) {
                    var jsonData = JSON.parse(response);
                }
            });
        });

        $("#clear_cart").click(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: ("scripts/clear_cart.php"),
                data: {},
                success: function (response) {
                    var buttons = $(".btn-remove");
                    for (let i = 0; i < buttons.length; i++) {
                        buttons[i].click();
                    }
                }
            });
        });
    });
    $("#error").toggle();
    $("#cardForm").toggle();

    function cardShow() {
        $("#addressInputForm").toggle();
        $("#cardForm").toggle();
        let text = $('#enter_card')[0].value === "Ввести данные карты" ? "Ввести адрес" : "Ввести данные карты";
        $('#enter_card')[0].value = text;
    }
</script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js'></script>
<script src='https://mdbootstrap.com/previews/docs/latest/js/mdb.min.js'></script>
</html>
