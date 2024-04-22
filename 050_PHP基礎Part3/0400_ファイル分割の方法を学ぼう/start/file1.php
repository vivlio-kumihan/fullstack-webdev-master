<?php

// ファイル分割をして関数定義をする際は、エラー処理を加えておく。
// function_exists()関数に『関数名の文字列』を引数として、
// 指定の関数が定義されていなければ、ブロック内の関数を定義するよ。
if (!function_exists('func1')) {
  function func1() {
    echo "function 1 is called.";
  }
}

// グローバルに定義された連想配列がわかっているのだね。。。
$arr['num']++;
