<?php
session_start();
require_once  "database_connection.php";

$clear_cart_query = "DELETE FROM shopping_cart WHERE user_id = ".$_SESSION['user_id'];
$result = $link -> query($clear_cart_query);