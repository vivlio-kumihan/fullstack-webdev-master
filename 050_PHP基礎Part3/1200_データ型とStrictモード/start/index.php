<?php declare(strict_types=1);
// この宣言があるファイルについて、
// データ型について厳密に検査するモードになる。

/**
 * データ型とStrictモード
 */
// (int $val)
// 引数に対して型を宣言する。

// : { 戻り値 }
// 戻り値に対して型を宣言する。
function add1 (int $val): int {
  // return $val + 1;
  // 例えば、戻り値を文字列型にしておくと。。。
  return (string) ($var + 1);
}

$result = add1(1);
var_dump($result);