<?php
/**
 * Created by PhpStorm.
 * User: garae
 * Date: 24.05.2019
 * Time: 21:21
 */
session_start();
require_once "database_connection.php";
require_once "sumCart.php";

$date = trim($_POST['date']);
$address = trim($_POST['address']);

$getCartQuery = sprintf("SELECT * FROM shopping_cart WHERE user_id = '%s'", $_SESSION['user_id']);
$cartsItemsResult = $link->query($getCartQuery);

$productsBuy = "";
$productsCountBuy = "";
$productsIdBuy = "";
while ($cartsItem = $cartsItemsResult->fetch_array()) {
    $productsBuy = $productsBuy . $cartsItem['name'] . ";";
    $productsCountBuy = $productsCountBuy . $cartsItem['count'] . ";";
    $productsIdBuy = $productsIdBuy . $cartsItem['id_product'] . ";";
    $deleteFromProductsQuery = "UPDATE products SET amount=amount - ".(int)$cartsItem['count']." WHERE id =".$cartsItem['id_product'].";";
     $res = $link->query($deleteFromProductsQuery);

}
$sum = getSumForAccaunt($link, $_SESSION['user_id']);

$insertQuery = sprintf("INSERT INTO checks ( date,address,productsNames,counts,user_id,sum,productsId) 
VALUES('%s','%s','%s','%s','%s', '%s','%s')", $date, $address, $productsBuy, $productsCountBuy, $_SESSION['user_id'], $sum, $productsIdBuy);

$result = $link->query($insertQuery);
if ($result) {
    echo "OK";
    $clear_cart_query = "DELETE FROM shopping_cart WHERE user_id = " . $_SESSION['user_id'];
    $result = $link->query($clear_cart_query);
    exit();
} else {
    echo "ERROR";
    exit();
}