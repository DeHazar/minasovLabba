<?php
session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 4) {

    }else {
        header("Location: ../main.php");

    }
}
?>

<!DOCTYPE html>
<lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="with-device-width, initial-scale = 1.0">
    <title>Редактор</title>
</head>
<body >

<?php require "../../../../parts/header.php"?>

<div class="col s12 grey lighten-2 txt-align-span teal-div-cls">
    <h1 class="" style="text-align: center; visibility: visible; ">Редактор</h1>
    <div class="col s5 center">
        <div class="card grey lighten-3 wrapper center-block">
            <div class="card-content center">
                <div class="row">
                    <a class="waves-effect waves-light btn" style="width: 400px;" href="../table.php">Посмотреть таблицу с телескопами</a>

                </div>
                <div class="row">
                    <a class="waves-effect waves-light btn" style="width: 400px;" href="add.php"> Добавить новый телескоп</a>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="text-center text-accent-3">Данный ресурс содержит информацию о телескопах. Все данные публикуются исключительно в рамках учебной дисциплицны "Сетевые сервисы обработки информации в ОТС".</div>
        </div>
    </div>
</div>

</body>
<?php require "../../../../parts/footer.php"?>
</html>
