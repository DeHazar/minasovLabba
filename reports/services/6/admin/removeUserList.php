<?php
session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 2) {

    }else {
        header("Location: ../main.php");

    }
}
require_once '../../../../Script/database_connection.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if ($id == $_SESSION['user_id']) {
        $error_message = "ВЫ не можете удалить себя сами";
    } else {
        $removeQuery = "DELETE FROM users WHERE id = ".$id;
        $result = $link->query($removeQuery);

        if ($result) {
            $error_message = "Пользователь удален";
        } else {
            $error_message = "Произошла ошибка";
        }
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
    <h1 class="" style="text-align: center; visibility: visible; ">Удаление пользователя</h1>
    <div class="row ">
        <div class="col s5 offset-l4">
        <div class="card grey lighten-3 wrapper center-block">
            <div class="card-content center">
                <form class="form" action="" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="alert alert-error"><?php if (isset($error_message)) echo $error_message; ?></div>
                    <input type="text" placeholder="id пользователя" name="id" required/>
                    </br>
                    <input type="submit" value="Удалить" name="register" class="btn waves-effect waves-light"/>
                </form>

            </div>
        </div>
    </div>

        <div class="row">
        <div class="col s12">
            <table class="responsive-table centered qal-tbl-font" id="sortable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>login</th>
                    <th>email</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Отчество</th>
                    <th>Уровень прав</th>
                </tr>
                </thead>
                <tbody id="mainTable">
                <?php
                $query = "SELECT * FROM roles";
                $result = $link -> query($query);
                $items = [];
                while ($item = $result->fetch_assoc()) {
                    $items[] = $item;
                }

                $query2 = "SELECT * FROM users";
                $result = $link->query($query2);

                while ($item = $result->fetch_assoc()) {
                    $level = current(array_filter($items, function($e) use ($item) {
                        if ($e['id'] == $item['user_role']) {
                            return true;
                        }
                        return false;
                    }));

                    echo "<tr>
                            <td>".$item["id"]."</td>
                            <td>".$item["login"]."</td>
                            <td>".$item["email"]."</td>
                            <td>".$item["first_name"]."</td>
                            <td>".$item["last_name"]."</td>
                            <td>".$item["middle_name"]."</td>
                            <td>".$level['title']."</td>
                            </tr>";
                }
                ?>
                </tbody>
            </table>
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
