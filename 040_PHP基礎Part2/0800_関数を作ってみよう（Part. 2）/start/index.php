<?php

/**
 * 関数を作ってみよう（Part. 2）
 * 
 * - デフォルト引数を設定可能
 * - 文字列を関数として実行可能
 */

// デフォルト引数を設定可能
$price = 1000;
$tax = 0.08;
function with_tax($unit_price, $rate = 0.1) {
  $price_including_tax = $unit_price + ($unit_price * $rate);
  $price_including_tax = round($price_including_tax);
  return $price_including_tax;
}

$result = with_tax($price, $tax);
echo $result;

// 文字列を関数として実行可能
$price = 1000;
$tax = 0.08;
function with_tax($unit_price, $rate = 0.1) {
  $price_including_tax = $unit_price + ($unit_price * $rate);
  $price_including_tax = round($price_including_tax);
  return $price_including_tax;
}

// 関数名を文字列としても実行できる。
$result = "with_tax"($price, $tax);
echo $result;

// 関数名を文字列として変数に格納し実行することができる。変態。
$fn = "with_tax";
$result = $fn($price, $tax);
echo $result;