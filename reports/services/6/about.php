<!DOCTYPE html>
<lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="with-device-width, initial-scale = 1.0">
    <title>Телескоп</title>
</head>
<body >

<?php require "../../../parts/header.php"?>
<?php
require_once "../../../Script/database_connection.php";

function resize_image($file,$newName, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }

    $newwidth = intval($newwidth);
    $newheight = intval($newheight);
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);

    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    imagejpeg($dst, 'compressed/'.$newName);

    return $newName;
}

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $query= sprintf("SELECT * FROM telescops WHERE id = ".$id);

    $result = $link->query($query);
    $item = $result->fetch_assoc();
}
?>

<h3 class="" style="text-align: center; visibility: visible; "><?php echo $item["Name"]; ?></h1>
<div class="content s12">
    <div class="row">
    <h5 class="center" style ="padding: 20px;">Данные о телескопе</h5>
        <div class="col s3 offset-l4">
            <div class="card grey lighten-3" style="padding-bottom: 20px">
<br>
            <p class="normal center">Фокусное расстояние в мм:</p>
            <p class="normal center">Диаметр объектива (апертура), мм:</p>
            <p class="normal center">Вес в кг:</p>
            <p class="normal center">Цена в рубля:</p>
            </div>
        </div>
        <div class="col s1">
            <div class="card grey lighten-3" style="padding-bottom: 20px">
            <br>
            <p class="center"><?php echo $item["Focus"];?>, мм</p>
            <p class="center"><?php echo $item["Diameter"];?>, мм</p>
            <p class="center"><?php echo $item["Weight"];?>, кг</p>
            <p class="center"><?php echo $item["Price"];?>, руб.</p>
            </div>
        </div>

        <div class="col s1">
            <div class="card grey lighten-3" >
            <?php  
            echo "<a href='../../../image/Telescopes/".$item["image_path"]."'><img src='compressed/"
                                .resize_image("../../../image/Telescopes/".$item["image_path"],$item["image_path"], 400, 200)."'/>";
                                ?>
            </div>
        </div>
    </div>

</div>

</body>
<?php require "../../../parts/footer.php"?>
</html>
