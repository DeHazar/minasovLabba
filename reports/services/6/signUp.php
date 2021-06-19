<?php session_start();?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="with-device-width, initial-scale = 1.0">
    <title>Регистрация</title>
</head>
<body >

<?php require "../../../parts/header.php"?>
<?php

require_once "../../../Script/database_connection.php";
//создаем пользователя если есть хотя бы логин и пароль
if (isset($_REQUEST['username']) | isset($_REQUEST['password'])) {
    $username = trim($_REQUEST['username']);
    $password = trim($_REQUEST['password']);
    $email = trim($_REQUEST['email']);
    $first_name = trim($_REQUEST['first_name']);
    $last_name = trim($_REQUEST['second_name']);
    $middle_name = trim($_REQUEST['middle_name']);
    // $address = trim($_REQUEST['address']);
    $confirm_password = trim($_REQUEST['confirm_password']);

    $checkUserQuery = sprintf("SELECT login FROM users WHERE login = '%s'", $link->real_escape_string($username));
    $result = $link->query($checkUserQuery);

    if ($password != $confirm_password) {
        $error_message = "Пароли не совпадают";
    } else if ($result->num_rows >= 1) {
        $error_message = "Пользователь с таким логином уже существует";
    } else {
        $insert_sql = sprintf("INSERT INTO users " .
            "( login, password, email, first_name, last_name, middle_name, user_role)" .
            "VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');",
            $link->real_escape_string($username),
            $link->real_escape_string(crypt($password, $username)),
            $link->real_escape_string($email),
            $link->real_escape_string($first_name),
            $link->real_escape_string($last_name),
            $link->real_escape_string($middle_name),
        1);
        // Insert the user into the database
        $result = $link->query($insert_sql);

        if ($result) {
            $_SESSION['user_id'] = $link->insert_id;
            $_SESSION['login'] = $username;
            $_SESSION['role'] = 1;
            header("Location: main.php");
            exit();
        } else {
            $error_message = "Произошла непредвиденная ошибка";
        }
    }
}

?>
<link rel="stylesheet" href="auth.css" type="text/css">
<div class="body-content">
    <div class="module">
        <h1>Зарегистрируйте новый аккаунт</h1>
        <form class="form" action="signUp.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="alert alert-error"><?php if (isset($error_message)) echo $error_message; ?></div>
            <input type="text" placeholder="Логин пользователя" name="username" required/>
            <input type="email" placeholder="Email" name="email" required/>
            <input type="password" placeholder="Пароль" name="password" autocomplete="new-password"
                   onkeydown="clearClicked(event)" onkeypress="pressedButton(event)" required/>
            <input type="password" placeholder="Повторите пароль" name="confirm_password" autocomplete="new-password"
                   required/>
            <input type="text" placeholder="Имя"onkeypress="return ( event.charCode === 32 || (event.keyCode > 1071 && event.keyCode < 1104 ) ||
            (event.keyCode > 1039 && event.keyCode < 1104));" name="first_name" required/>
            <input type="text" placeholder="Фамилия" onkeypress="return ( event.charCode === 32 || (event.keyCode > 1071 && event.keyCode < 1104 ) ||
            (event.keyCode > 1039 && event.keyCode < 1104));" name="second_name" required/>
            <input type="text" placeholder="Отчество" onkeypress="return ( event.charCode === 32 || (event.keyCode > 1071 && event.keyCode < 1104 ) ||
            (event.keyCode > 1039 && event.keyCode < 1104));" name="middle_name" required/>
            <input type="submit" value="Зарегистрироваться" id="register" name="register"
                   class="btn btn-block btn-primary"/>
        </form>
    </div>
</div>
<div id="footer"></div>
</body>
<script>
    let clicked = {};

    function clearClicked(event) {
        if (event.keyCode === 8) {
            clicked = {};
        }
    }

    function pressedButton(event) {

        clicked[event.keyCode] = isNaN(clicked[event.keyCode]) ? 1 : clicked[event.keyCode] + 1;
        let flag = false;
        for (key in clicked) {
            if (clicked[key] > 3) {
                flag = true;
            }
        }

        if (flag) {
            $(".alert").text("Более трёх повторяющихся символов");
            $("#register")[0].disabled = true;
        } else {
            $(".alert").text("");
            $("#register")[0].disabled = false;
        }
    }
</script>
</html>
<?php require "../../../parts/footer.php"?>
</body>
</html>
