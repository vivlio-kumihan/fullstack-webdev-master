<?php 
// 注意点
// 回数指定について{1,}スペースを入れると予期しない結果になる。
// 波括弧の前の文字列パターンの最初にマッチ
// => {1}
// 波括弧の前の文字列パターンが1文字以上n回繰り返しにマッチ
// => {1,n}
// 波括弧の前の文字列パターンが1文字以上で最後までにマッチ
// => {1,}

$char = 'takahiro@kumihan.com';
if (preg_match("/[a-zA-Z\.]{1,}/i", $char, $result)) {
  echo 'match'.'<br>';
  print_r($result);
} else {
  echo 'fail';
}

// 注意点
// 行の末尾から検索をする指定。
$char = 'takahiro@kumihan.com';
if (preg_match("/[a-zA-Z\.]{1,}$/i", $char, $result)) {
  echo 'match'.'<br>';
  print_r($result);
} else {
  echo 'fail';
}