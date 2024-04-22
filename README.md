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

### 練習

```php
<?php
// 正規表現を使って形式が正しいかチェックしてみよう。
/**
 * よく使う表現
 * . 任意の一文字
 * * 0回以上の繰り返し
 * + 1回以上の繰り返し
 * {n} n回の繰り返し
 * [] 文字クラスの作成
 * [abc] aまたはbまたはc
 * [^abc] aまたはbまたはc以外
 * [0-9] 0~9まで
 * [a-z] a~zまで
 * $ 終端一致
 * ^ 先頭一致
 * \w 半角英数字とアンダースコア
 * \d 数値
 * \ エスケープ
 */


/**
 * 郵便番号
 * 
 * 001-0012 -> OK
 * 001-001 -> NG
 * 2.2-3042 -> NG
 * wd3-2132 -> NG
 * 124-56789 -> NG
 */

$char1 = '124-56789';
if (preg_match("/^\d{3}-\d{4}$/", $char1, $result)) {
  print_r($result);
  echo "<h3>{$char1} is match.</h3>";
} else {
  echo "<h3>{$char1} is fail.</h3>";
}

/**
 * Email
 * . _ - と半角英数字が可能
 * 
 * example000@gmail.com -> OK
 * example-0.00@gmail.com -> OK
 * example-0.00@ex.co.jp -> OK
 * example/0.00@ex.co.jp -> NG
 */

$char2 = 'example/0.00@ex.co.jp';
if (preg_match("/^[\w\.\-]+@[\w\-]+\.[\w\.\-]+$/i", $char2, $result)) {
  print_r($result);
  echo "<h3>{$char2} is match.</h3>";
} else {
  print_r($result);
  echo "<h3>{$char2} is fail.</h3>";
}

/**
 * HTML
 * 見出しタグ(h1~h6)の中身のみ取得してみよう。
 */

$char3 = '<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
</head>
<body>
    <h1>見出し１</h1>    
    <h2>見出し２</h2>    
    <h3>見出し３</h3>    
    <header>ヘッダー</header>
</body>
</html>';

if (preg_match_all("/<h[1-6]>(.+?)<\/h[1-6]>/", $char3, $result)) {
  print_r($result);
  // 最後の要素を取り出す方法
  print_r($result[count($result) - 1]);
}
```

## 関数

```php
<?php
/**
 * 関数を作ってみよう（Part. 1）
 * 
 * - 特定の機能を使いまわせるようにまとめたもの。
 * - Input（引数）、Output（戻り値）を設定する
 * - returnが実行された時点でその関数の処理終了
 */

// その1
$numbers = [1,2,3,4];
$numbers2 = [1,2,3,100];

function sum($arg) {
  $sum = 0;
  foreach ($arg as $key => $num) {
    // $sum = $sum + $num;
    $sum += $num;
  }
  echo $sum;
}

sum($numbers);
sum($numbers2);


// その2 戻り値を使う
$numbers = [1,2,3,4];

function sum($arg) {
  $sum = 0;
  foreach ($arg as $key => $num) {
    // $sum = $sum + $num;
    $sum += $num;
  }
  return $sum;
}

$result = sum($numbers);
echo "<h3>合計：{$result}</h3>";
```

```php
/**
 * 関数を作ってみよう（Part. 2）
 * 
 * - デフォルト引数を設定可能
 * - 文字列を関数として実行可能
 */

// デフォルト引数を設定可能
$price = 1000;
$tax = 0.08;
function with_tax($unit_price, $rate = 0.1) {
  $price_including_tax = $unit_price + ($unit_price * $rate);
  $price_including_tax = round($price_including_tax);
  return $price_including_tax;
}

$result = with_tax($price, $tax);
echo $result;

// 文字列を関数として実行可能
$price = 1000;
$tax = 0.08;
function with_tax($unit_price, $rate = 0.1) {
  $price_including_tax = $unit_price + ($unit_price * $rate);
  $price_including_tax = round($price_including_tax);
  return $price_including_tax;
}

// 関数名を文字列としても実行できる。
$result = "with_tax"($price, $tax);
echo $result;

// 関数名を文字列として変数に格納し実行することができる。変態。
$fn = "with_tax";
$result = $fn($price, $tax);
echo $result;
```

## PHP-DOCの書き方

```php
<?php
// スラッシュ + アスタリスク二つでエンター
// DOC COMMENT
/**
 * 税率計算の関数を記述するためのファイル
 * 
 * @author quad9
 * @since 0.0.0
 */

// リファレンスは
// https://zonuexe.github.io/phpDocumentor2-ja/references/phpdoc/index.html

/**
 * title: 
 * 税込み金額を取得する関数
 * 
 * 詳しい説明はこちら。
 * 
 * @param int $base_price 価格
 * @param float $tax_rate 税率
 * 
 * @return int 税込み金額
 * 戻り値を返さない場合は
 * @return void
 * 
 * 参考資料がある場合
 * @see https://example.com/
 */

function with_tax($base_price, $tax_rate = 0.1) {
    $sum_price = $base_price + ($base_price * $tax_rate);
    $sum_price = round($sum_price);
    return $sum_price;
}
```

## スコープ

```php
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
```

## 復習問題

```php
<?php
/**
 * 理解度チェック（関数とスコープ）
 * 
 * 以下のDocコメントを元に関数を作成してみてください。
 */

/**
 * 問１：生徒の点呼をとる関数(tenko)
 * 
 * 以下のような点呼をとりましょう。
 * ```
 * （出席しているとき）
 * taroは出席しています。
 * （欠席しているとき）
 * taroは欠席しています。
 * ```
 * $is_absentのデフォルト引数はfalseとしてください。
 * 
 * @param string $student 生徒
 * @param bool $is_absent true:欠席 false:出席
 * @return void 
 */

$student1 = 'taro';
$student2 = 'jiro';
$student3 = 'hanako';

function muster($student, $isabsent = false) {
  if ($isabsent) {
    echo "{$student}は欠席しています。";
  } else {
    echo "{$student}は出席しています。";
  }
}

muster($student1, true);

/**
 * 問２：カウンター関数(counter)
 * 
 * グローバルスコープに定義された $num に対して、
 * 引数でわたってきた $step を足し合わせた数値を
 * $num に再び格納して、画面に出力するプログラムを作成してください。
 * $stepのデフォルト引数は 1 としてください。
 * 
 * @global int $num 足し合わせる元となる数値
 * 
 * @param int $step 足し合わせる数値
 * 
 * @return int 合計値 ($num + $step)
 */

function counter($step = 1) {
  global $num;
  $num += $step;
  return $num;
}
$num = 0; 
echo counter(100);
echo counter(100);
```

# プログラムの実行順

```php
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
```

## if文

```php
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
```

## 定数

```php
/**
 * 定数の使い方
 * 
 * - define, constでの定義方法
 * - constはif文や関数の中では使えない
 * - defineではグローバルスコープに値が配置される
 * - constは名前空間内に配置される（名前空間のレクチャーで紹介）
 */

// 定数の定義
// if文や関数の中では使えない
const TAX_RATE = 0.1;

function with_tax($unit_price, $rate = TAX_RATE) {
  $price_including_tax = $unit_price + ($unit_price * $rate);
  $price_including_tax = round($price_including_tax);
  return $price_including_tax;
}

$price = with_tax(1000, 0.08);
echo $price;

// define関数を使って定数を定義
define('TAX_RATE', 0.1);

function with_tax($unit_price, $rate = TAX_RATE) {
  $price_including_tax = $unit_price + ($unit_price * $rate);
  $price_including_tax = round($price_including_tax);
  return $price_including_tax;
}

$price = with_tax(1000, 0.08);
echo $price;
```

## ファイル分割