<?php
/**
 * ファイル分割の方法を学ぼう
 * - require、includeの違い
 * - require、require_onceの使い方
 */

$arr = ['num' => 0];

// // 分割先の関数を呼び出す。
// // グローバルで定義された関数はどこからでも呼び出すことができる。
// require('file1.php');

// // ファイルに定義された関数を実行する。
// func1();

// // 分割先のファイルをHTMLが記述してあるとして、
// // 何回も呼び出すと回数分のHTMLが呼び出される。
// require('file2.php');
// require('file2.php');
// require('file2.php');

// // いまいち意味合いがわからんが、
// // 最初だけ呼び出したい時は、require_once()関数を使う
// require_once('file2.php');
// require_once('file2.php');
// require_once('file2.php');

// // こちらの連想配列を渡した覚えはないが、グローバルに定義されたものは
// // どこからでも分かるスコープなのね。。。
// // で、file1.phpで連想配列に加工を加えると、こちらで該当のファイルを
// // 呼び出すたびに加工が発火して値が蓄積されると。。。
// // JSの方がお行儀がいいような気がする。。。
// require('file1.php');
// require('file1.php');
// require('file1.php');
// require('file1.php');
// echo $arr['num'];

// これをrequire_once()関数を使うと一回しか計算しない。
require_once('file1.php');
require_once('file1.php');
require_once('file1.php');
require_once('file1.php');
echo $arr['num'];

// require => 絶対に必要なファイルの読み込み。
              // 関数の読み込み
// include => なくてもなんとかなるのはこちらで読み込み
              // HTMLのテンプレート（と言われても意味わからん。。。）
