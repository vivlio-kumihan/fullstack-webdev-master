<?php
namespace lib;

const TAX_RATE = 0.1;
function with_tax($base_price, $tax_rate = TAX_RATE)
{
  $sum_price = $base_price + ($base_price * $tax_rate);
  $sum_price = round($sum_price);
  return $sum_price;
}

// グローバル空間で定義された定数・変数・関数は
// グローバル空間を表す『\』を付けなくていい。
my_echo();

$gc = new \GlobalCls("takahiro");
// echo $gc->name();