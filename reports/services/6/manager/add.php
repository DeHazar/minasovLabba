<?php
session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 4) {

    }else {
        header("Location: ../main.php");

    }
}
require_once '../../../../Script/database_connection.php';

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $focus = $_POST['focus'];
    $diameter = $_POST['diameter'];
    $weight = $_POST['weight'];
    $price = $_POST['price'];

    $updateQuery = "INSERT INTO telescops (Name, Focus, Diameter, Weight, Price)".
    "VALUES ('".$name."',".$focus.",".$diameter.",".$weight.",".$price.")";

    $result = $link->query($updateQuery);

    if ($result) {
        $success_added = "Успешно добавлено";
        $error_message = "";
    } else {
        $error_message = "Ошибка, при обновлении данных";
    }
}
?>

<!DOCTYPE html>
</lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="with-device-width, initial-scale = 1.0">
    <title>Добавление</title>
</head>
<body >

<?php require "../../../../parts/header.php"?>
<div class="container grey lighten-2">
    <div class="col  grey lighten-2 txt-align-span teal-div-cls">
        <h1 class="" style="text-align: center; visibility: visible; ">Добавление телескопа</h1>
        <div class="row ">
            <div class="col s5 offset-l4">
                <div class="card grey lighten-3 wrapper center-block">
                    <div class="card-content center">
                        <form class="form" method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="alert alert-error"><?php if (isset($success_added)) echo $error_message; ?></div>
                            <div class="alert alert-success"><?php if (isset($success_added)) echo $success_added; ?></div>
                            <input type="text" placeholder="Название телескопа" name="name" required/>
                            <input type="number" placeholder="Фокусное расстояние в мм" name="focus" required/>
                            <input type="number" placeholder="Диаметр объектива в мм" name="diameter" required/>
                            <input type="text" placeholder="Вес устройства в кг" name="weight" required/>
                            <input type="number" placeholder="Цена в рублях" name="price" required/>
                            </br>
                            <input type="submit" value="Добавить" name="register" class="btn waves-effect waves-light"/>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="text-center text-accent-3" style="margin-left: 10px;">      Данный ресурс содержит информацию о телескопах. Все данные публикуются исключительно в рамках учебной дисциплицны "Сетевые сервисы обработки информации в ОТС".</div>
        </div>
    </div>
</div>
</body>
<?php require "../../../../parts/footer.php"?>
</html>
