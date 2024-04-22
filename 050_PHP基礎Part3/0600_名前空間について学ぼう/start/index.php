<?php

// 名前空間を利用するための処理
// 名前空間に登録できるのは、
//    => 関数
//    => 定数
//    => クラス
// 今回は、定数TAX_RATEとwith_tax()関数を『lib.php』に
// 名前空間としてファイルを分ける。

// // ↓ ここから

// namespace lib;

// // define()関数を使ったものには登録できないので、
// // 通常の定数の定義に変更する。
// // if(!defined('TAX_RATE')) {
// //     define('TAX_RATE', 0.1);
// // }
// const TAX_RATE = 0.1;
    
// function with_tax($base_price, $tax_rate = TAX_RATE) {
//     $sum_price = $base_price + ($base_price * $tax_rate);
//     $sum_price = round($sum_price);
//     return $sum_price;
// }

// // ↑ ここまでを『lib.php』へ

// 定数と関数を呼び出す。
require_once 'lib.php';

// // 合図は、『\』+『名前空間名』+『\』+『関数名』
// $price = \lib\with_tax(1000, 0.08);
// echo $price;
// // 定義た定数の呼び出し。
// echo \lib\TAX_RATE;

// useを使ってスッキリさせる。
// これを使った場合、最初の『\』は、
// グローバル空間を示す。
// 最初の『\』は省略できる。
use function lib\with_tax;
$price = with_tax(10, 0.1);
echo $price;

use const lib\TAX_RATE;
echo TAX_RATE;