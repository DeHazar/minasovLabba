<?php require_once '../parts/header.php';
echo "<link href=\"http://k-media.ugatu.su/repository/student/sts-07/14263/Photos/photoStyle.css\" rel=\"stylesheet\">";
?>
<?php
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
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    imagejpeg($dst, 'compressed/'.$newName.'.jpg');
    return $newName;
}

?>
    <div id="wrapper" class="wrapper">
        <div id="container" class="container">
            <div class="photo-grid clearfix">
                <ul class="clearfix">
                    <li style="width: 300px; height: 200px;">
                        <a href="../image/4@3x.png" >
                        <img src="compressed/<?php
                        echo resize_image("../image/4.jpg","4", 300, 400);
                        ?>.jpg" />
                        </a>
                    </li>
                    <li style="width: 300px; height: 300px;">
                        <a href="../image/5@3x.png" >
                            <img src="compressed/<?php
                            echo resize_image("../image/5.jpg","5", 300, 400);
                            ?>.jpg" />
                        </a>
                    </li>
                    <li style="width: 300px; height: 300px;">
                        <a href="../image/6@3x.png" >
                            <img src="compressed/<?php
                            echo resize_image("../image/6.jpg","6", 300, 400);
                            ?>.jpg" />
                        </a>
                    </li>
                    <li style="width: 300px; height: 300px;">
                        <a href="../image/7@3x.png" >
                            <img src="compressed/<?php
                            echo resize_image("../image/7.jpg","7", 300, 400);
                            ?>.jpg" />
                        </a>
                    </li>
                    <li style="width: 300px; height: 300px;">
                        <a href="../image/8@3x.png" >
                            <img src="compressed/<?php
                            echo resize_image("../image/8.jpg","8", 300, 400);
                            ?>.jpg" />
                        </a>
                    </li>
                </ul>
            </div><!-- /photo-grid -->
        </div><!-- /container -->
    </div><!-- /wrapper -->

<?php require_once '../parts/footer.php'?>