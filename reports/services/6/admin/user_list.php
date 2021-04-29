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
    $email = $_POST['email'];
    $name = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $middleName = $_POST['middle_name'];
    $role = $_POST['role'];

    $updateQuery = "UPDATE users SET email = \"".$email."\" , first_name ='".$name."', last_name = '".
    $lastName."', middle_name = '".$middleName."', user_role = ".$role." WHERE id = ".$id;
    $result = $link->query($updateQuery);

    if ($result) {
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
    <title>Редактирование</title>
</head>
<body >

<?php require "../../../../parts/header.php"?>
<div class="container grey lighten-2">
    <div class="col  grey lighten-2 txt-align-span teal-div-cls">
        <h1 class="" style="text-align: center; visibility: visible; ">Редактирование пользователя</h1>
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
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody id="mainTable">
                        <?php

                        $query = "SELECT * FROM roles";
                        $result = $link->query($query);
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
                            <td><form action='editUser.php' method='get'>
                            <input type='text' value='".$item['id']."' name='id' hidden>
                            <input type='submit' class='btn' value='Редактировать'>
</form></td>
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
