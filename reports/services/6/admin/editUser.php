<?php

session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 2) {

    } else {
        header("Location: ../main.php");

    }
}
require_once '../../../../Script/database_connection.php';

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $userQuery = "SELECT * FROM users WHERE id=".$id;
    $result = $link->query($userQuery);
    $item = $result->fetch_assoc();
}

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
        header("Location: user_list.php");
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
        <div class="row ">
            <div class="col s5 offset-l4">
                <div class="card grey lighten-3 wrapper center-block">
                    <div class="card-content center">
                        <form class="form" method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="alert alert-error"><?php if (isset($error_message)) echo $error_message; ?></div>
                            <input type="text" placeholder="id пользователя" name="id" value="<?php echo $item['id'] ?>" required/>
                            <input type="text" placeholder="email" name="email" value="<?php echo $item['email'] ?>" required/>
                            <input type="text" placeholder="Имя" name="first_name" value="<?php echo $item['first_name'] ?>" required/>
                            <input type="text" placeholder="Фамилия" name="last_name" value="<?php echo $item['last_name'] ?>" required/>
                            <input type="text" placeholder="Отчество" name="middle_name"  value="<?php echo $item['middle_name'] ?>" required/>
                            <select name="role" class="select-dropdown" style="display: block" >
                                <?php
                                $query = "SELECT * FROM roles";
                                $result = $link -> query($query);
                                $items = [];
                                while ($role = $result->fetch_assoc()) {
                                    $items[] = $role;
                                    if ($role["id"] == $item['user_role']) {
                                        echo '<option value="'.$role['id'].'" selected>'.$role['title'].'</option>';
                                    } else {
                                        echo '<option value="'.$role['id'].'">'.$role['title'].'</option>';
                                    }
                                }
                                ?>

                            </select>
                            </br>
                            <input type="submit" value="Редактировать" name="register" class="btn waves-effect waves-light"/>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php require "../../../../parts/footer.php"?>
