<?php
$arr = [
  ['table', 1000],
  ['chair', 250],
  ['bed', 10000],
];

// 連想配列の特定の値を変更する。
$arr[1][1] = 500;

// 配列の先頭の要素を削除する。
array_shift($arr);


// 配列の最後の要素を削除する。
array_pop($arr);

// インデックスの『何番目』から『いくつ』削除する。
// 第3引数を省略すると最後までを指定することになる。
array_splice($arr, 1, 1);

foreach ($arr as $key => $value) {
  echo "<p>{$value[0]}は{$value[1]}円です。</p>";
  print_r($value);
}
