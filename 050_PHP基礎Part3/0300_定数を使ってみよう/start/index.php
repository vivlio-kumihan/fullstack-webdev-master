<?php
/**
 * 定数の使い方
 * 
 * - define, constでの定義方法
 * - constはif文や関数の中では使えない
 * - defineではグローバルスコープに値が配置される
 * - constは名前空間内に配置される（名前空間のレクチャーで紹介）
 */

// // 定数の定義
// // if文や関数の中では使えない
// const TAX_RATE = 0.1;

// function with_tax($unit_price, $rate = TAX_RATE) {
//   $price_including_tax = $unit_price + ($unit_price * $rate);
//   $price_including_tax = round($price_including_tax);
//   return $price_including_tax;
// }

// $price = with_tax(1000, 0.08);
// echo $price;

// define関数を使って定数を定義
define('TAX_RATE', 0.1);

function with_tax($unit_price, $rate = TAX_RATE) {
  $price_including_tax = $unit_price + ($unit_price * $rate);
  $price_including_tax = round($price_including_tax);
  return $price_including_tax;
}

$price = with_tax(1000, 0.08);
echo $price;