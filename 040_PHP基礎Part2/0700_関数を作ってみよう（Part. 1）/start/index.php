<?php

/**
 * 関数を作ってみよう（Part. 1）
 * 
 * - 特定の機能を使いまわせるようにまとめたもの。
 * - Input（引数）、Output（戻り値）を設定する
 * - returnが実行された時点でその関数の処理終了
 */

その1
$numbers = [1,2,3,4];
$numbers2 = [1,2,3,100];

function sum($arg) {
  $sum = 0;
  foreach ($arg as $key => $num) {
    // $sum = $sum + $num;
    $sum += $num;
  }
  echo $sum;
}

sum($numbers);
sum($numbers2);


// その2 戻り値を使う
$numbers = [1,2,3,4];

function sum($arg) {
  $sum = 0;
  foreach ($arg as $key => $num) {
    // $sum = $sum + $num;
    $sum += $num;
  }
  return $sum;
}

$result = sum($numbers);
echo "<h3>合計：{$result}</h3>";
