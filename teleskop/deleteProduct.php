<?php
/**
 * Created by PhpStorm.
 * User: garae
 * Date: 30.05.2019
 * Time: 20:25
 */
require_once "scripts/database_connection.php";
session_start();
$query = "SELECT * FROM users WHERE id=" . $_SESSION['user_id'] . " AND is_admin=1";
$result = $link->query($query);
if ($result->num_rows != 1) {
    echo "Недостаточно прав пользователя!";
    exit();
}

$deletQuery = "DELETE FROM products WHERE id=".$_REQUEST['product_id'];
$result = $link -> query($deletQuery);

header("Location: admin.php");
exit();