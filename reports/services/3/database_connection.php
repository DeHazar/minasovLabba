<?php
require_once 'app_config.php';

$coding = 'utf8';
$link = mysqli_init();
$link->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
$link->real_connect(DATABASE_HOST,DATABASE_USERNAME , DATABASE_PASSWORD, DATABASE_NAME);

if ($link->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $link->connect_errno . ") " . $link->connect_error;
}

?>
