<?php 
$arr = ["信之", "和恵", "茉李"];

// 配列や連想配列の型を表示する関数
print_r($arr);

// インデックスを元にして参照。
echo $arr[1];

// インデックスを元にして値を変更。
$arr[1] = "茉李";
echo $arr[1];

// 配列の末尾に値を追加
$arr[] = "john";
var_dump($arr);

// 配列の中身を順番に出力する。
// for
for ($idx=0; $idx < count($arr); $idx++) {
  echo "<p>{$arr[$idx]}</p>";
}

// foreach
foreach ($arr as $idx => $val) {
  $num = $idx + 1;
  echo "<p>{$num}. {$val}</p>";

}