<?php 
namespace lib;

// // namespaceには、define()関数を使ったものには登録できないので、
// // 通常の定数の定義に変更する。
// if(!defined('TAX_RATE')) {
//     define('TAX_RATE', 0.1);
// }
const TAX_RATE = 0.1;
    
function with_tax($base_price, $tax_rate = TAX_RATE) {
    $sum_price = $base_price + ($base_price * $tax_rate);
    $sum_price = round($sum_price);
    return $sum_price;
}

my_echo();
