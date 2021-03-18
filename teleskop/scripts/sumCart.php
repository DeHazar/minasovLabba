<?php
/**
 * Created by PhpStorm.
 * User: garae
 * Date: 01.05.2019
 * Time: 0:35
 */


function  getSumForAccaunt(mysqli $link , $user_id){
    $compute_sum_query = sprintf("SELECT * FROM shopping_cart 
    WHERE user_id = '%s'", $user_id);
    $result = $link ->query($compute_sum_query);
    $sum = 0;
    while($result_array = $result -> fetch_array()){
        $sum += $result_array['price']*$result_array['count'];
    }
    return $sum;
}
