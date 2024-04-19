<?php
// データ型

// 文字列型
// 文字列型が何かPHPに問う。
$str = "hello";
var_dump($str);
//=> string(5) "hello"
// string型でlengthは5、値は"hello"であると言ってる。

// 違う文字列型の和をPHPがどう判断するか。
$num = 1;
// 1 => true
// 0 => false
var_dump($str + $num);
//=> int(1)
// 文字列を数列の和について、文字列は0（偽）と判断されているみたい。

// 真偽値型
$bool = true;
var_dump($bool);