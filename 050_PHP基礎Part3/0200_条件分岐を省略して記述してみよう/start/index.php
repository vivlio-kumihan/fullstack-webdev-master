<?php
/**
 * 条件分岐を省略して記述してみよう
 * 
 * - 三項演算子の使い方
 * - null合体演算子
 */

// 何をしているかというと
// 欲しい連想配列に値があればその値を
// 値がなければなんかするみたいなことをしたいわけ。

$arry = [
  'key' => 10,
];

// if文
if (isset($arry['key'])) {
  $arry['key'] *= 10;
} else {
  $arry['key'] = 1;
}
echo $arry['key'];

// 三項演算子
$arry['key'] = isset($arry['key']) ? $arry['key'] * 10 : 1;
echo $arry['key'];

// null合体演算子
// $arry['key']がnull以外なら??より左の値、
// $arry['key']がnullなら??より右の値が代入される。
$arry['key'] = $arry['key'] ?? 1;
echo $arry['key'];
