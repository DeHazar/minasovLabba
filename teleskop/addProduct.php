<?php
/**
 * Created by PhpStorm.
 * User: garae
 * Date: 30.05.2019
 * Time: 17:59
 */

session_start();
require_once "scripts/database_connection.php";
$query = "SELECT * FROM users WHERE id='" . $_SESSION['user_id'] . "' AND is_admin=1";
$result = $link->query($query);
if ($result->num_rows != 1) {
    echo "Недостаточно прав пользователя!";
    exit();
}

if (isset($_POST['name']) | isset($_POST['category'])) {
    $productName = $_POST['name'];
    $category = $_POST['category'];
    $available = $_POST['amount'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = "";
    $image2 = "";
    $image3 = "";

    if (!empty($_FILES['image1']['size'])) {
        if (empty($_FILES['image1']['size'])) die('Вы не выбрали файл');
        if ($_FILES['image1']['size'] > (5 * 1024 * 1024)) die('Размер файла не должен превышать 5Мб');
        $imageinfo = getimagesize($_FILES['image1']['tmp_name']);
        $upload_dir = 'img/'; //имя папки с картинками
        $name = $upload_dir . date('YmdHis') . basename($_FILES['image1']['name']);
        $mov = move_uploaded_file($_FILES['image1']['tmp_name'], $name);
        if ($mov) {
            //здесь коннект к БД
            $image = htmlentities(stripslashes(strip_tags(trim($name))), ENT_QUOTES, 'UTF-8');
            //если mysql - здесь еще mysql_real_escape_string обработай, mysqli - mysqli_real_escape_string,PDO - quote
            //выполняешь запрос, если все ок - то выводишь "поздравления" если все плохо - выводишь ошибку
            //здесь запрос
        } else echo 'Произошла ошибка при загрузке фотографии. Пожалуйста, попробуйте снова';
    }

    if (!empty($_FILES['image2']['size'])) {
        if (empty($_FILES['image2']['size'])) die('Вы не выбрали файл');
        if ($_FILES['image2']['size'] > (5 * 1024 * 1024)) die('Размер файла не должен превышать 5Мб');
        $imageinfo = getimagesize($_FILES['image2']['tmp_name']);

        $upload_dir = 'img/'; //имя папки с картинками
        $name = $upload_dir . date('YmdHis') . basename($_FILES['image2']['name']);
        $mov = move_uploaded_file($_FILES['image2']['tmp_name'], $name);
        if ($mov) {
            //здесь коннект к БД
            $image2 = htmlentities(stripslashes(strip_tags(trim($name))), ENT_QUOTES, 'UTF-8');
            //если mysql - здесь еще mysql_real_escape_string обработай, mysqli - mysqli_real_escape_string,PDO - quote
            //выполняешь запрос, если все ок - то выводишь "поздравления" если все плохо - выводишь ошибку
            //здесь запрос
        } else echo 'Произошла ошибка при загрузке фотографии. Пожалуйста, попробуйте снова';

    }

    if (!empty($_FILES['image3']['size'])) {
        if (empty($_FILES['image3']['size'])) die('Вы не выбрали файл');
        if ($_FILES['image3']['size'] > (5 * 1024 * 1024)) die('Размер файла не должен превышать 5Мб');
        $imageinfo = getimagesize($_FILES['image3']['tmp_name']);

        $upload_dir = 'img/'; //имя папки с картинками
        $name = $upload_dir . date('YmdHis') . basename($_FILES['image3']['name']);
        $mov = move_uploaded_file($_FILES['image3']['tmp_name'], $name);
        if ($mov) {
//здесь коннект к БД
            $image3 = htmlentities(stripslashes(strip_tags(trim($name))), ENT_QUOTES, 'UTF-8');
//если mysql - здесь еще mysql_real_escape_string обработай, mysqli - mysqli_real_escape_string,PDO - quote
//выполняешь запрос, если все ок - то выводишь "поздравления" если все плохо - выводишь ошибку
//здесь запрос
        } else echo 'Произошла ошибка при загрузке фотографии. Пожалуйста, попробуйте снова';

    }

    $add_query = sprintf("INSERT INTO products (name,description,category,amount,price,image,image2,image3) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s')"
        , $productName, $description, $category, $available, $price, $image, $image2, $image3);

    $result = $link->query($add_query);
    if ($result) {
        header("Location: products.php");
        exit();
    } else {
        echo "Ошибка при добавлении продукции";
    }

}


?>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админская панель</title>
    <link rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>

<body>
<form action="addProduct.php" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Название</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Название">
        </div>
        <div class="form-group col-md-6">
            <label for="category">Категория</label>
            <input type="text" class="form-control" id="category" name="category" placeholder="Категория">
        </div>
        <div class="form-group col-md-6">
            <label for="price">Цена</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Цена">
        </div>
        <div class="form-group col-md-6">
            <label for="amount">Количество</label>
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Цена">

        </div>
    </div>
    <div class="form-group" style="margin: 1em;">
        <label for="description">Описание</label>
        <textarea class="form-control" id="description" name="description" rows="5"></textarea>
    </div>
    <label for="image1">Картинка 1</label><input type="file" name="image1">
    <label for="image2">Картинка 2</label><input type="file" name="image2">
    <label for="image3">Картинка 3</label><input type="file" name="image3">

    <button type="submit" class="btn btn-primary" name="add" style="    margin-left: 50%;
    transform: translateX(-50%);
    width: 500px;
}">Добавить
    </button>
</form>
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script>
</html>
