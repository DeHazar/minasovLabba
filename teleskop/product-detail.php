<?php
session_start();
require_once  "scripts/database_connection.php";
require_once "scripts/sumCart.php";
$product_id = $link->real_escape_string(trim($_REQUEST['product_id']));
$information_of_product_query = sprintf("SELECT * FROM products WHERE id = '%s'",$product_id);
$result = $link -> query($information_of_product_query);
 while ($product = $result->fetch_array()) {
     $available = "Нет в наличии";
     if ($product['amount'] > 0) {
         $available = "В наличии";
     }
     $amount = $product['amount'];
     $price = $product['price'];
     $image1 = $product['image'];
     $image2 = $product['image2'];
     $image3 = $product['image3'];
     $description = $product['description'];
     $name = $product['name'];
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
                               ".getSumForAccaunt($link,$_SESSION['user_id'])." руб.
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
    <div class="container mb-4">
        <!--       Detail Product-->
        <div class="row no-gutters mt-4">
            <!--               picture product-->
            <div class="col-12 col-md-7">
                <div class="row no-gutters w-100">
                    <!--                       Main picture-->
                    <div class="col-12 col-lg-10 flex-lg-last border-full-1px-solid border-color-a0">
                        <div class="d-flex justify-content-center align-items-center w-100 px-5">
                            <img src="<?php if(isset($image1)) {echo $image1; }else echo "https://dummyimage.com/400x600/61e66c/fff";?>" class="img-fluid" id="main-image"
                                 style="max-height:600px;">
                        </div>
                    </div>
                    <!--                           side picture-->
                    <div class=" col-12 col-lg-2 flex-lg-first mb-md-0 mb-4" style="display:block">
                        <div class="row no-gutters ">

                            <div class="col-4 col-sm-3 col-lg-12 border-full-1px-solid border-color-a0 justify-content-center side-picture active"
                                 role="button" data-target="side-1">
                                <div class="p-2 w-75">
                                    <img src="<?php if(isset($image2)) {echo $image2; }else echo "https://dummyimage.com/400x600/61e66c/fff";?>" class="img-fluid ">
                                </div>
                            </div>

                            <div class="col-4 col-sm-3 col-lg-12 border-full-1px-solid border-color-a0 justify-content-center side-picture"
                                 role="button" data-target="side-2">
                                <div class="p-2 w-75">
                                    <img src="<?php if(isset($image3)) {echo $image1; }else echo "https://dummyimage.com/400x600/61e66c/fff";?>" class="img-fluid ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--                 Параметры телескопа-->
            <div class="col-12 col-md-5">
                <div class="pt-0 pr-2 pb-2 pl-1 pl-md-5">
                    <!--                       Название-->
                    <div class="mb-4 border-full-2px-solid border-top-0 border-left-0 border-right-0 border-color-inverse">
                        <h1><?php echo $name;?></h1>
                    </div>

                    <!--                   Цена-->
                    <div class="mb-5 ">
                        <h6 class="text-muted font-size-08 text-uppercase ">Цена:</h6>
                        <h4><?php echo $price." руб.";?></h4>
                    </div>
                    <!--                   Количество-->
                    <div class="mb-5 ">
                        <select class="custom-select ml-0 mb-1 font-weight-bold" id="select_count"
                                style="border-radius:0; width:80px; border:1px solid #bfb6bb ">

                            <?php if ($available == "Нет в наличии"){ echo "<option selected>0</option>";}else {
                                for ($i=1 ;$i < $amount + 1; $i++){
                                    echo "<option value=\"".$i."\" selected>".$i."</option>";
                                }

                            }?>

                        </select>
                        <a href="# " class=" ">
                            <h6 class="text-muted font-size-08 text-uppercase "><u><?php echo $available;?></u></h6>
                        </a>
                    </div>
                    <!--Button-->
                    <div class=" ">
                        <?php if ($available == "Нет в наличии"){
                            } else {
                            echo " <button type=\"button\"
                                class=\"mb-1 btn py-3 px-5 bg-inverse text-color-a0 text-uppercase font-weight-bold\" id=\"addToCart\"
                                style=\"border-radius:0px; \">Добавить в корзину
                        </button>";
                        }?>
                        <p id="product_id" hidden><?php echo $product_id;?></p>
                        <script>
                            $(document).ready(function (){$("#addToCart").click(function (e) {
                                e.preventDefault();
                                var jsonString = JSON.stringify([$("#select_count option:selected ")[0].value,$("#product_id")[0].innerText]);
                                $.ajax({
                                    type: "POST",
                                    url: ("scripts/purshahe_cart.php"),
                                    data: {data: jsonString},
                                    success: function (response) {
                                        var  jsonData = JSON.parse(response);
                                        $("#sum_cart")[0].innerText = jsonData.success + " руб."
                                    }
                                });
                            });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    Description / Details / shipping -->
    <div class="container">
        <div class="my-5">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-color-a1  active" data-toggle="tab" href="#deskripsi"
                       role="tab">Описание</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-color-a1" data-toggle="tab" href="#shipping" role="tab">Доставка</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content font-size-09" style="background-color:#fafafa">
                <div class="tab-pane fade show active px-3 py-4 text-color-a2" id="deskripsi" role="tabpanel">
                    <?php echo $description; ?>
                </div>
                <div class="tab-pane fade px-3 py-4 text-color-a2" id="shipping" role="tabpanel">Доставка по России бесплатно.
                    2-14 дней.
                </div>
            </div>
        </div>
    </div>

    <!--   Footer==============================================-->
    <footer class="bg-inverse pt-2 footer-special">
        <div class="container p-0 ">
            <div class="row  ">
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
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js'></script>


<script src="js/index.js"></script>

</html>
