<?php
/**
 * Created by PhpStorm.
 * User: garae
 * Date: 30.04.2019
 * Time: 23:33
 */

session_start();
require_once "sumCart.php";
require_once "database_connection.php";
//Добавляем информацию о покупке и возвращаем сумму клиенту
if (isset($_SESSION['user_id'])) {
    $data = json_decode(stripslashes($_POST['data']));
    $count = $data[0];
    $product_id = $data[1];

    $information_of_product_query = sprintf("SELECT * FROM products WHERE id = '%s'", $product_id);
    $result = $link->query($information_of_product_query);
    while ($product = $result->fetch_array()) {

        $available = $product['amount'];
        $image= $product['image'];
        $price = $product['price'];
        $name = $product['name'];
    }

    //Проверяем и добавляем в таблицу количество заказанного товара
    $check_position_of_user_query = sprintf("SELECT * FROM shopping_cart 
    WHERE user_id = '%s' AND id_product = '%s'", $_SESSION['user_id'], $product_id);
    $check_result = $link -> query($check_position_of_user_query);
    if($check_result -> num_rows == 1){
        $last_fetch = $check_result ->fetch_array();
        $last_count = $last_fetch['count'];
        $update_cart_information_query = sprintf("UPDATE shopping_cart SET count = '%s' WHERE user_id = '%s' AND id_product = '%s'",
            $last_count +$count,$_SESSION['user_id'], $product_id );
        $link ->query($update_cart_information_query);
    }else{
        $insert_sql = sprintf("INSERT INTO shopping_cart " .
            "( user_id, id_product, name, image, available, price, count )" .
            "VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');",
            $link->real_escape_string($_SESSION['user_id']),
            $link->real_escape_string($product_id),
            $link->real_escape_string($name),
            $link->real_escape_string($image),
            $link->real_escape_string(1),
            $link->real_escape_string($price),
            $link->real_escape_string($count)
            );
        $link ->query($insert_sql);
    }

    // Вычисляем общую сумму корзины
    $sum = getSumForAccaunt($link,$_SESSION['user_id']);

    echo json_encode(array('success' => $sum));
}