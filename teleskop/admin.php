<?php
/**
 * Created by PhpStorm.
 * User: garae
 * Date: 30.05.2019
 * Time: 0:28
 */

require_once "scripts/database_connection.php";
session_start();
$query = "SELECT * FROM users WHERE id=" . $_SESSION['user_id'] . " AND is_admin=1";
$result = $link->query($query);
if ($result->num_rows != 1) {
    echo "Недостаточно прав пользователя!";
    exit();
}
?>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админская панель</title>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,200italic,300italic,400italic,600italic,700italic'
          rel='stylesheet' type='text/css'>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://threedubmedia.googlecode.com/files/jquery.event.drag-1.5.min.js"
            type="text/javascript"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <link rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
    <style>
        *, *:before, *:after {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        ul, li {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: rgba(0, 0, 0, 0.85);
            font: 100% / 1;
            font: 400 12px / 1 'Source Sans Pro', Helvetica, Arial, sans-serif;
        }

        .panel-container {
            position: absolute;
            top: 50px;
            bottom: 50px;
            left: 50px;
            right: 50px;
        }

        .panel-controls {
            float: left;
            width: 175px;
            background-color: transparent;
            height: 100%;
            font-size: 14px;
            padding: 10px 0;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
            -webkit-transition: width 0.3s;
            -moz-transition: width 0.3s;
            -ms-transition: width 0.3s;
            transition: width 0.3s;
        }

        .panel-controls li {
            white-space: nowrap;
            padding: 5px 0;
            color: #F1F1F1;
            font-weight: 300;
            min-height: 50px;
            list-style: none;
            display: table;
            width: 100%;
            text-transform: uppercase;
        }

        .panel-controls li:hover a, .panel-controls li.active a {
            color: #18A7E1;
        }

        .panel-controls li.active a .caret {
            display: inline-block;
        }

        .panel-controls li a {
            cursor: pointer;
            display: table-cell;
            vertical-align: middle;
        }

        .panel-controls li a .label {
            opacity: 1;
            -webkit-transition: opacity 0.3s;
            -moz-transition: opacity 0.3s;
            -ms-transition: opacity 0.3s;
            transition: opacity 0.3s;
        }

        .panel-controls li a i {
            width: 15px;
            margin-right: 10px;
            text-align: center;
        }

        .panel-controls li a .caret {
            display: none;
            font-size: 35px;
            position: absolute;
            left: 165px;
            color: #F1F1F1;
            line-height: 50%;
            -webkit-transition: left 0.3s;
            -moz-transition: left 0.3s;
            -ms-transition: left 0.3s;
            transition: left 0.3s;
        }

        .panel-controls li.nav-control a {
            color: #F1F1F1;
        }

        .panel-controls li.nav-control a i {
            font-size: 20px;
        }

        .panel-controls.collapsed {
            width: 50px;
        }

        .panel-controls.collapsed li a .label {
            opacity: 0;
        }

        .panel-controls.collapsed li a .caret {
            left: 30px;
        }

        section.panel-content {
            margin-left: 175px;
            height: 100%;
            -webkit-transition: margin-left 0.3s;
            -moz-transition: margin-left 0.3s;
            -ms-transition: margin-left 0.3s;
            transition: margin-left 0.3s;
        }

        section.panel-content .main-wrapper {
            background-color: #F1F1F1;
            margin-bottom: 50px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
        }

        section.panel-content .widget {
            padding: 10px;
        }

        section.panel-content.collapsed {
            margin-left: 40px;
        }

    </style>
    <script>
        window.console = window.console || function (t) {
        };
    </script>
    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>
</head>
<body translate="no">
<div class="panel-container">
    <div class="panel-controls" data-bind="css: {collapsed: collapsedNav}">
        <ul>
            <li class="nav-control" data-bind="click: collapse.bind($data)"><a><i class="fa fa-bars"></i></a></li>
            <li data-bind="css: {active: displayTab() === 'users'}, click: changeTab.bind($data, 'users')"><a><i
                            class="fa fa-users"></i><span class="label">Пользователи</span><i
                            class="fa fa-caret-left caret"></i></a></li>
            <li data-bind="css: {active: displayTab() === 'documents'}, click: changeTab.bind($data, 'documents')"><a><i
                            class="fa fa-archive"></i><span class="label">Товары</span><i
                            class="fa fa-caret-left caret"> </i></a></li>
            <li data-bind="css: {active: displayTab() === 'checks'}, click: changeTab.bind($data, 'checks')"><a><i
                            class="fa fa-check"></i><span class="label">Чеки</span><i
                            class="fa fa-caret-left caret"> </i></a></li>
            <li onclick="window.location='index.php'"><a><i class="fa fa-thumb-tack"></i><span class="label">Главное меню</span><i
                            class="fa fa-caret-left caret"></i></a></li>

        </ul>
    </div>
    <section class="panel-content" data-bind="css: {collapsed: collapsedNav}">
        <div class="main-wrapper">
            <div class="widget" id="users" data-bind="visible: displayTab() === 'users'">
                <table class="table table-sm">
                    <thead>
                    <tr style="border-bottom: 2px solid #2db9ff;">
                        <th scope="col">#</th>
                        <th scope="col">login</th>
                        <th scope="col">В email</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Фамилия</th>
                        <th scope="col">Отчество</th>
                        <th scope="col">Адрес</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $users_query = "SELECT * FROM users";
                    $result = $link->query($users_query);
                    while ($user = $result->fetch_array()) {
                        echo "
                    <tr style=\"    border-top: 1px solid #aaa;\">
                        <th scope=\"row\">" . $user['id'] . "</th>
                        <td>" . $user['login'] . "</td>
                        <td>" . $user['email'] . "</td>
                        <td>" . $user['first_name'] . "</td>
                        <td>" . $user['last_name'] . "</td>
                        <td>" . $user['middle_name'] . "</td>
                        <td>" . $user['address'] . "</td>
                    </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="widget" id="checks" data-bind="visible: displayTab() === 'checks'">
                <div id="collections">
                    <div class="collection">
                        <div class="collection-info">
                            <table class="table table-sm">
                                <thead>
                                <tr style="border-bottom: 2px solid #2db9ff;">
                                    <th scope="col"># покупки</th>
                                    <th scope="col">Название товаров</th>
                                    <th cope="col">Сумма покупки</th>
                                    <th cope="col">Дата</th>
                                    <th cope="col">Чек</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $getChecksQuery = sprintf("SELECT * FROM checks");
                                $result = $link->query($getChecksQuery);
                                while ($check = $result->fetch_array()) {
                                    echo "<tr>
                            <th scope=\"row\">" . $check['id'] . "</th>
                            <td>" . $check['productsNames'] . "</td>
                            <td>" . $check['sum'] . "</td>
                            <td>" . $check['date'] . "</td>
                            <td><a href='scripts/getPDF.php?checkId=" . $check['id'] . "'>Скачать чек в PDF</a></td>
                        </tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="collection-controls"></div>
                    </div>
                </div>
            </div>
            <div class="widget" id="documents" data-bind="visible: displayTab() === 'documents'">
                <div id="collections">
                    <div class="collection">
                        <div class="collection-info">
                            <table class="table table-sm">
                                <thead>
                                <tr style="border-bottom: 2px solid #2db9ff;">
                                    <th scope="col">#</th>
                                    <th scope="col">Описание</th>
                                    <th scope="col">В наличии</th>
                                    <th scope="col">Категория</th>
                                    <th scope="col">Цена, руб</th>
                                    <th scope="col">Перейти на страницу</th>
                                    <th scope="col">Удаление</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $products_query = "SELECT * FROM products";
                                $result = $link->query($products_query);
                                while ($product = $result->fetch_array()) {
                                    echo "
                    <tr style=\"    border-top: 1px solid #aaa;\">
                        <th scope=\"row\">" . $product['id'] . "</th>
                        <td>" . substr($product['description'], 0, 150) . "</td>
                        <td>" . $product['available'] . "</td>
                        <td>" . $product['category'] . "</td>
                        <td>" . $product['price'] . "</td>
                        <td><a href='product-detail.php?product_id=" . $product['id'] . "'>Перейти</a></td> 
                        <td><a href='deleteProduct.php?product_id=" . $product['id'] . "'>Удалить</a></td> 
                    </tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                            <button class="btn" onclick="window.location='addProduct.php'">Добавить товары</button>
                        </div>
                        <div class="collection-controls"></div>
                    </div>
                </div>
            </div>
            <div class="widget" id="pins" data-bind="visible: displayTab() === 'pins'"><span>Pins</span></div>
        </div>
    </section>
</div>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/knockout/3.0.0/knockout-min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script>
<script id="rendered-js">
    (function () {
        var AdminPanelViewModel;

        AdminPanelViewModel = class AdminPanelViewModel {
            constructor() {
                this.changeTab = this.changeTab.bind(this);
                this.collapse = this.collapse.bind(this);
                this.displayTab = ko.observable('users');
                this.collapsedNav = ko.observable(false);
            }

            changeTab(tab) {
                return this.displayTab(tab);
            }

            collapse() {
                return this.collapsedNav(!this.collapsedNav());
            }
        };


        $(function () {
            return ko.applyBindings(new AdminPanelViewModel());
        });

    }).call(this);
</script>
</body>
</html>
