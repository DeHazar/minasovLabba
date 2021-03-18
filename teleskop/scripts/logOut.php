<?php
/**
 * Created by PhpStorm.
 * User: garae
 * Date: 28.04.2019
 * Time: 16:13
 */

session_start();

unset( $_SESSION['user_id']);
unset( $_SESSION['login']);
header("Location: ../index.php");
exit();