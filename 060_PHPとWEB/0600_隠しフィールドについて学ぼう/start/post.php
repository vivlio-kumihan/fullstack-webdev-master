<?php 
// POSTから渡ってきた全ての値を確認できるよ。
var_dump($_POST);

$amount = $_POST["amount"];
$price = $_POST["price"];
$discount = $_POST["discount"];
$check_sum = $amount * $price;
$check_sum -= $check_sum * $discount / 100;
$total = round($check_sum);
print_r("［個数: {$amount}個・単価: {$price}円・合計: {$total}円］");