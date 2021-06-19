<?php
session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 4) {

    } else {
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


    $target_dir = "../../../../image/Telescopes/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $fileName = basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
//            echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $error_message = "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $error_message = "Файл с таким названием уже существует.";
        $uploadOk = 0;
    }

//    if (array_key_exists("fileToUpload", $_FILES)) {
//// Check file size
//    if ($_FILES["fileToUpload"]["size"] > 500000) {
//        $error_message = "Sorry, your file is too large.";
//        $uploadOk = 0;
//    }

// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $error_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error_message = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
//            echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }


        $updateQuery = "INSERT INTO telescops (Name, Focus, Diameter, Weight, Price, image_path)" .
            "VALUES ('" . $name . "'," . $focus . "," . $diameter . "," . $weight . "," . $price . ",'" . $fileName . "')";

        $result = $link->query($updateQuery);

        if ($result) {
            $success_added = "Успешно добавлено";
//            $error_message = "";
        } else {
            $error_message = "Ошибка, при обновлении данных";
        }
    }
//    } else {
////        echo $error_message;
////        $success_added = "Успешно добавлено";
//    }
}
?>

<!DOCTYPE html>
</lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="with-device-width, initial-scale = 1.0">
    <title>Добавление</title>
</head>
<body>

<?php require "../../../../parts/header.php" ?>
<div class="container grey lighten-2">
    <div class="col  grey lighten-2 txt-align-span teal-div-cls">
        <h1 class="" style="text-align: center; visibility: visible; ">Добавление телескопа</h1>
        <div class="row ">
            <div class="col s5 offset-l4">
                <div class="card grey lighten-3 wrapper center-block">
                    <div class="card-content center">
                        <form class="form" method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="alert alert-error"><?php if (isset($error_message)) echo "ОШИБКА: ".$error_message; ?></div>
                            <div class="alert alert-success"><?php if (isset($success_added)) echo "SUCCESS: ".$success_added; ?></div>
                            <input type="text" placeholder="Название телескопа" name="name" required/>
                            <input type="number" placeholder="Фокусное расстояние в мм" name="focus" required/>
                            <input type="number" placeholder="Диаметр объектива в мм" name="diameter" required/>
                            <input type="text" placeholder="Вес устройства в кг" name="weight" required/>
                            <input type="number" placeholder="Цена в рублях" name="price" required/>
                            <input type="file" name="image" placeholder="Выберите фото" required/>
                            </br>
                            <input type="submit" value="Добавить" name="add" class="btn waves-effect waves-light"/>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="text-center text-accent-3" style="margin-left: 10px;"> Данный ресурс содержит информацию о
                телескопах. Все данные публикуются исключительно в рамках учебной дисциплицны "Сетевые сервисы обработки
                информации в ОТС".
            </div>
        </div>
    </div>
</div>
</body>
<?php require "../../../../parts/footer.php" ?>
</html>
