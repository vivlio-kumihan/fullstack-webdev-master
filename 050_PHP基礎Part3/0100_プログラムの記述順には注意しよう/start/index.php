<?php

/**
 * プログラムの記述順には注意しよう
 * 
 * - 関数内の処理は関数が実行されて初めて動く
 * - 関数宣言はプログラムの実行よりも前に準備される
 * - それ以外は上から順に実行される
 */

$num = 0;
echo counter(1000);

function counter($step = 1)
{
  global $num;
  $num += $step;
  return $num;
}
