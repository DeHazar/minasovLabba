<?php
session_start();
require_once "database_connection.php";
$decode = json_decode(stripslashes($_POST['data']));
$product_id = $decode[0];
$user_id = $_SESSION['user_id'];

$get_last_count = sprintf("SELECT count FROM shopping_cart 
    WHERE user_id = '%s' AND id_product = '%s'", $user_id, $product_id);
$result = $link -> query($get_last_count);
$count = $result -> fetch_array()['count'];

$minus_query = sprintf("UPDATE shopping_cart SET count = '%s' 
WHERE user_id = '%s' AND id_product = '%s'",$count + 1, $user_id, $product_id);
$result = $link -> query($minus_query);

echo json_encode(array('success' => $result, 'user_id' => $user_id, 'id' => $product_id));
?>