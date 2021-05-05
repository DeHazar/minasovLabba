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
    $newPrice = $_POST['price'];

    $query = "UPDATE telescops SET price = ".$newPrice." WHERE id = ".$id;
    $result = $link->query($query);

    if ($result) {
        $error_message = "Телескоп Обновлен";
        header("Location: update.php");
    } else {
        $error_message = "Произошла ошибка при обновлении";
    }
}

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $query = "SELECT * FROM telescops WHERE id = ";
    $query = $query.$id;
    $result = $link->query($query);

    if ($result) {
        $item = $result->fetch_assoc();
    } else {
        $error_message = "Произошла ошибка при получении ответа ";
    }
}
?>

<!DOCTYPE html>
</lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="with-device-width, initial-scale = 1.0">
    <title>Обновление информации телескопа</title>
</head>
<body >

<?php require "../../../../parts/header.php"?>
<div class="container grey lighten-2">
    <div class="col  grey lighten-2 txt-align-span teal-div-cls">
        <h1 class="" style="text-align: center; visibility: visible; ">Обновление информации телескопа</h1>
        <div class="row ">
            <div class="col s8 offset-l2">
                <div class="card grey lighten-3 wrapper center-block">
                    <div class="card-content center">
                        <form class="form" action="" method="post" enctype="multipart/form-data" autocomplete="off">
                            <h4><?php echo $item['Name']; ?></h4>
                            <div class="red-text"><?php if (isset($error_message)) echo $error_message; ?></div>
                            <input type="text" placeholder="id телескопа" name="id"  value="<?php echo $item['id']; ?>" hidden required/>
                            <input type="text" placeholder="Новая цена" value="<?php echo $item['Price']; ?>" name="price" required/>
                            </br>
                            <input type="submit" value="Обновить цену" name="register" class="btn waves-effect waves-light"/>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "../../../../parts/footer.php"?>