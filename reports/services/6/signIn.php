<?php session_start(); ?>
<!DOCTYPE html>
<lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="with-device-width, initial-scale = 1.0">
    <title>Авторизация</title>
</head>

<?php require "../../../parts/header.php"?>

<?php

require_once '../../../Script/database_connection.php';
if (isset($_REQUEST['error_message'])) {
    $error_message = $_REQUEST['error_message'];
}

// Если пользователь уже зашел, то кидаем на главную страницу
if (!isset($_SESSION['user_id'])) {
// Если уже отправлен пост запрос с именем пользователя, то смотрим
if (isset($_POST['username'])) {
    // получаем логин и пароль
    $username = $link->real_escape_string(trim($_POST['username']));
    $password = $link->real_escape_string(trim($_POST['password']));

    // Ищем пользователя в бд
    $query = sprintf("SELECT id ,login, password, user_role FROM users " .
        " WHERE login = '%s' AND password = '%s';",
        $username, crypt($password, $username));

    $results = mysqli_query($link, $query);
    //Если он есть то сохраняем в сессии его ид, иначе выводим ошибку
    if (mysqli_num_rows($results) == 1) {
        $result = mysqli_fetch_array($results);
        $user_id = $result['id'];
        $_SESSION['user_id'] = $user_id;
        $_SESSION['login'] = $username;
        $_SESSION['role'] = $result['user_role'];
        header("Location: ../6/main.php");
        exit();
    } else {
        $error_message = "Комбинация логин/пароль не правильна. Проверьте ваши введенные данные";
    }
} ?>

<!-- BODY -->
<body>
<link rel="stylesheet" href="auth.css" type="text/css">
<div class="body-content">
    <div class="module">
        <h1>Войти в аккаунт</h1>
        <form class="form" action="" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="alert alert-error"><?php if (isset($error_message)) echo $error_message; ?></div>
            <input type="text" placeholder="Логин пользователя" name="username" required/>
            <input type="password" placeholder="Пароль" name="password"  required/>
            </br>
            <input type="submit" value="Войти" name="register" class="btn waves-effect waves-light"/>
        </form>
    </div></div>
<?php
} else {
    // Now handle the case where they're logged in
    // redirect to another page, most likely show_user.php
    header("Location: main.php");
}
?>

<?php require "../../../parts/footer.php"?>
</body>
</html>