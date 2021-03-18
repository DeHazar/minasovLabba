<?php
session_start();
require_once "database_connection.php";
$decode = json_decode(stripslashes($_POST['data']));
$product_id = $decode[0];
$user_id = $_SESSION['user_id'];

$delete_product_query = sprintf("DELETE FROM shopping_cart 
WHERE user_id = '%s' AND id_product = '%s'", $user_id, $product_id);
$result = $link -> query($delete_product_query);

echo json_encode(array('success' => $result, 'user_id' => $user_id, 'id' => $product_id));
?>
