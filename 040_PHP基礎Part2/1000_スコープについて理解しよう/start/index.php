<?php

/**
 * スコープ
 * 変数が参照可能な範囲
 * 
 * - グローバルスコープ => ファイルの直下で効く。
 * - ローカルスコープ   => 関数内で有効。
 * - スーパーグローバル
 */

// global scope
$global = "hello global";

// ファイルの直下での呼び出し。
echo $global;

// 関数内で呼び出すともちろんエラー。
function call_in_fn() {
  echo $global;
}
call_in_fn();

// 関数内で呼び出せるようにする。
function call_in_fn() {
  global $global;
  echo $global;
}
call_in_fn();

// グローバルでの変数宣言はできるだけ避けるが定石

// super scope
// ファイル直下はもちろん関数内からも呼び出し可能
function super_global_scope() {
  var_dump($_SERVER);
}
super_global_scope();

// PHPの場合、if文、for文（『{}』で囲まれた範囲）ではスコープは発生しない。
if (true) {
  $in_if_stm = "hello IF";
}
// 外から呼び出せてしまう。
echo $in_if_stm;

// グローバル・スコープの変数は普通に読み込める。当たり前か。。。
$in_if_stm = "Hi, IF!";

if (true) {
  echo $in_if_stm;
}

// local scope
function func() {
  $local = "hello local";
  echo $local;
}
function func_other() {
  echo $local;
}

// スコープが違うから呼び出してもエラーが起こる。
func_other();