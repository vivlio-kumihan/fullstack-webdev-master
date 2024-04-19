<?php 
/*
- isset
変数が定義されていて、null以外の値の時にtrueを返す。

- empty
issetがfalse、または値がfalsyな時にtrueを返す。

!isset($val) || $val == false
- falsyな値
"" (空文字)
0 (数値、文字列)
NULL
FALSE
*/

$a = null;
$b = 1;

if(isset($a)) {
  echo "設定されている。";
} else {
  echo "設定されていない。";
}