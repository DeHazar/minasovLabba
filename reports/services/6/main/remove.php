<?php
session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 3) {

    }else {
        header("Location: ../main.php");

    }
}
require_once '../../../../Script/database_connection.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

        $removeQuery = "DELETE FROM telescops WHERE id = ".$id;
        $result = $link->query($removeQuery);

        if ($result) {
            $error_message = "Телескоп удален";
        } else {
            $error_message = "Произошла ошибка при удалении";
        }
}
?>

<!DOCTYPE html>
</lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="with-device-width, initial-scale = 1.0">
    <title>УДАЛЕНИЕ</title>
</head>
<body >

<?php require "../../../../parts/header.php"?>
<div class="container grey lighten-2">
    <div class="col  grey lighten-2 txt-align-span teal-div-cls">
        <h1 class="" style="text-align: center; visibility: visible; ">Удаление телескопа</h1>
<!--        <div class="row ">-->
<!--            <div class="col s5 offset-l4">-->
<!--                <div class="card grey lighten-3 wrapper center-block">-->
<!--                    <div class="card-content center">-->
<!--                        <form class="form" action="" method="post" enctype="multipart/form-data" autocomplete="off">-->
<!--                            <div class="alert alert-error">--><?php //if (isset($error_message)) echo $error_message; ?><!--</div>-->
<!--                            <input type="text" placeholder="id телескопа" name="id" required/>-->
<!--                            </br>-->
<!--                            <input type="submit" value="Удалить" name="register" class="btn waves-effect waves-light"/>-->
<!--                        </form>-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <h3 class="center"><div class="alert alert-error"><?php if (isset($error_message)) echo $error_message; ?></div></h3>
        <div class="row">
                <div class="col s12">
                    <div class="card grey lighten-3 ">
                        <div class="card-content color-cls">
                            <table class="responsive-table centered qal-tbl-font" id="sortable">
                                <thead>
                                <tr>
                                    <th> ID </th>
                                    <th onclick="sortTable(0)">Название</th>
                                    <th onclick="sortTable(1)">Фокусное расстояние</th>
                                    <th onclick="sortTable(2)">Диаметр, мм</th>
                                    <th onclick="sortTable(3)">Вес, кг</th>
                                    <th onclick="sortTable(4)">Цена, руб</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody id="mainTable">
                                <?php
                                $query= sprintf("SELECT * FROM telescops");
                                $result = $link->query($query);

                                while ($item = $result->fetch_assoc()) {
                                    echo "<tr>
                            <td>".$item["id"]."</td>
                            <td>".$item["Name"]."</td>
                            <td>".$item["Focus"]."</td>
                            <td>".$item["Diameter"]."</td>
                            <td>".$item["Weight"]."</td>
                            <td>".$item["Price"]."</td>
                            <td><form action='remove.php' method='post'>
                            <input type='text' value='".$item['id']."' name='id' hidden>
                            <input type='submit' class='btn' value='Удалить'>
                            </form></td>
                            </tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>iv>
        <div class="row">
            <div class="text-center text-accent-3" style="margin-left: 10px;">      Данный ресурс содержит информацию о телескопах. Все данные публикуются исключительно в рамках учебной дисциплицны "Сетевые сервисы обработки информации в ОТС".</div>
        </div>
    </div>
</div>
</body>
<?php require "../../../../parts/footer.php"?>
</html>
