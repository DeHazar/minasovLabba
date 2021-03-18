<?php
require_once 'app_config.php';

$coding = 'utf8';

$link = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD) OR DIE("conecterror");
$query = "SET NAMES $coding";
$res = mysqli_query($link, $query) or die(mysqli_error($link));
$query = "USE " . DATABASE_NAME;
$res = mysqli_query($link, $query) or die(mysqli_error($link));
mysqli_set_charset($link, $coding);

//Вычисляем сумму текущего пользователя если он в сети
$cart_cum = 0;
?>
