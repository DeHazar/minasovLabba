<?php
require "./database_connection.php";

$query= sprintf("SELECT * FROM telescops");
$result = $link->query($query);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="with-device-width, initial-scale = 1.0">
    <title>Таблица данных</title>
</head>
<body >

<?php require "../../../parts/header.php"?>
<h1 class="" style="text-align: center; visibility: visible; ">Телескопы</h1>
<div class="col s12 grey lighten-2 txt-align-span teal-div-cls">
    <div class="row">
        <div class="col s12 animatedParent">
            <div class="card grey lighten-3 animated fadeInLeft go">
                <div class="card-content color-cls">
                    <table class="responsive-table centered qal-tbl-font">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Фокусное расстояние</th>
                            <th>Диаметр, мм</th>
                            <th>Вес, кг</th>
                            <th>Цена, руб</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($item = $result->fetch_assoc()) {
                            echo "<tr>
                            <td>".$item["Name"]."</td>
                            <td>".$item["Focus"]."</td>
                            <td>".$item["Diameter"]."</td>
                            <td>".$item["Weight"]."</td>
                            <td>".$item["Price"]."</td>
                            </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </br>
    <div class="row">
        <a href="select.php">Выборка телескопов , у которых диаметр объектива больше 70 мм</a>
        </br>
        <a href="sortFocus.php">Отсортировать телескопы по фокусному расстоянию</a>
        </br>
        <a href="sortPrice.php">Сортировка по цене телескопа по выборке с весом больше 3 кг</a>
        </br>
    </div>
</div>

<?php require "../../../parts/footer.php"?>
</body>
</html>

