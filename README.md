## 自己代入
```php
<?php
// 自己代入演算子
// 変数を定義して
$i = 1;
$j = 2;
// 計算
$i = $i + $j; //=> 3
// 自己代入で計算
$i += $j; //=> 3

// インクリメント演算子
$i = $i + 1;
$i++;
?>

<h1><?php echo $i; ?></h1>
```

# isset, empty
```php
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
```

```php
<?php 
/**
 * 何か商品を買った際に合計金額を表示するための
 * プログラムを作成してみましょう。
 * 
 * $price: 一つ当たりの価格（$price >= 0の整数値）
 * $amount: 買った個数（$amount >= 0の整数値）
 * $sum: 合計金額
 * 
 * 表示フォーマット
 * 合計金額が0円より大きい場合
 * 「○○円の商品を○○個買ったので合計金額は○○円です。 」と表示
 * 
 * 合計金額が0円の場合
 * 「何か商品を買いましょう。」と表示
 */

$price = 100;
$amount = 0;
$sum = $price * $amount;

// PHP流儀では、
// 合計が0以外はtrueという言い方は、『$sum > 0』とか『$sum』とはしない。
// 『!empty($sum)』が正しい書き方だそうた。
if(!empty($sum)) {
  echo "{$price}円の商品を{$amount}個買ったので合計金額は{$sum}円です。";
  } else {
  echo "何か商品を買いましょう。";
}
```

## 配列

```php
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
```

### pop, shift, splice

```php
<?php
$arr = [
  ['table', 1000],
  ['chair', 250],
  ['bed', 10000],
];

// 連想配列の特定の値を変更する。
$arr[1][1] = 500;

// 配列の先頭の要素を削除する。
array_shift($arr);


// 配列の最後の要素を削除する。
array_pop($arr);

// インデックスの『何番目』から『いくつ』削除する。
// 第3引数を省略すると最後までを指定することになる。
array_splice($arr, 1, 1);

foreach ($arr as $key => $value) {
  echo "<p>{$value[0]}は{$value[1]}円です。</p>";
  print_r($value);
}
```

## 連想配列

```php
<?php
$hash = [
  'name' => "john",
  'age' => 70,
  'hobby' => ['music', 'love', 'peace']
];

// キーに紐づいた値を参照する。
echo $hash['name'];

// キーに紐づいた値を変更する。
$hash['name'] = 'paul';

// 最初の値を削除する。やり方2つ
array_shift($hash);
unset($hash['name']);

// 最後の値を削除する。
array_pop($hash);
print_r($hash);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <ul>
      <?php foreach ($hash['hobby'] as $key => $value) { ?> 
    <li><?php echo $value; ?></li>
      <?php } ?> 
  </ul>
  <ul>
</ul>

</body>

</html>
```

## 理解度チェック

```php
<?php

/**
 * 商品名 => [価格, 在庫数]
 */
$products = [
  'table' => [1000, 5],
  'chair' => [500, 4],
  'bed' => [10000, 1],
  'light' => [5000, 1]
];

$cart = ['table' => 3, 'bed' => 2];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://unpkg.com/destyle.css@4.0.0/destyle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="./style.css">
  <script src="./behavior.js" defer></script>
</head>

<body>
  <div class="container">
    <!-- 
    * 問１：商品一覧
    *
    * 商品一覧
    * tableは1000円で2個存在します。
    * chairは500円で4個存在します。
    * bedは10000円で2個存在します。
    * lightは5000円で1個存在します。 
    -->
    <h3>商品一覧</h3>
    <ul>
      <?php foreach ($products as $key => $value) { ?>
        <li>
          <?php echo "{$key}は{$value[0]}円で{$value[1]}個あります。" ?>
        </li>
      <?php } ?>
    </ul>

    <!-- 
      * 問２：商品購入
      *
      * $cartの品物を買いたいと想定して、
      * $productsの在庫数が足りている場合、足りていない場合で
      * 以下のように画面に表示してください。
      *
      * 商品購入
      * tableを1個ください。
      * はい。ありがとうございます。 <- 足りている場合 
      * bedを2個ください。 
      * すいません。bedは1個しかありません。 <- 足りていない場合 
      * 購入希望 商品数 $cart=['table'=> 1, 'bed' => 2];
    -->
    <h3>商品購入</h3>
    <p>
      <?php foreach ($cart as $supply => $quantity) { 
        echo "<p>{$supply}を{$quantity}個ください。</p>";
        if ($products[$supply][1] >= $quantity) {
          echo "はい、ありがとうございます。";
        } else {
          echo "すいません{$supply}は、{$products[$supply][1]}個しかありません。";
        }
      }
      ?>
    </p>
  </div>
</body>

</html>
```

## 正規表現

```php
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
```
