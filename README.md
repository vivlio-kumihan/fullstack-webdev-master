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

```php
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
```

## パスの書き方について

```php
<?php
/**
 * パスの書き方について学ぼう
 * 
 * - マジック定数 __DIR__, __FILE__を使ってみよう
 * - dirnameの使い方を学ぼう
 * - 相対パスと絶対パス
 * - \と/は使い分けよう
 * - "と'は使い分けよう
 */

// 相対パスで指定できる。
require 'file1.php';
// これでもいい。
require './file1.php';
// 一つ上の階層のファイル。
require '../start/file1.php';

// 絶対パス
// まずは、マジック定数を確認する。
// ルートからの絶対パスを参照できるんやってんね。。。
// でこちらは現在編集しているファイルを内包するディレクトリの絶対パスが分かるのよ。
echo __DIR__;
// => /Applications/MAMP/htdocs/fullstack-webdev-master/050_PHP基礎Part3/0500_パスの書き方について学ぼう/start
// となると、ファイルはこうか。
// 素晴らしい。
echo __FILE__;
// => /Applications/MAMP/htdocs/fullstack-webdev-master/050_PHP基礎Part3/0500_パスの書き方について学ぼう/start/index.php

// では、やってみる。この相対パスを絶対パスに書き換える。
require __DIR__ . "/sub/file2.php";

// __DIR__も便利なんだが、
// ファイルのある階層からn階層上を指定できる
// dirname()関数がある。
echo dirname(__FILE__, 2);

// !!!!!!!!!!!!!エスケープシークエンス!!!!!!!!!!!!!
// 『""』の中では『\』はエスケープ・シークエンスとなる。
// \t, \n, \s, \wなどなど。。。意味を持ってしまう。
// 『""』の中でのパスの区切りは『/』だよという話。

// !!!!!!!!!!!!!混ぜるな危険!!!!!!!!!!!!!
// 絶対パスの指定の際に相対パスの記述を混ぜない。
// requireは許容するがディレクトリを一つ上『../』の指定すると
// 独特の挙動をするので。いちいち挙動を覚えてられないから一律禁止にする。
// 頭悪いからな。。。
```

## 名前空間

```PHP
<?php

// 名前空間を利用するための処理
// 名前空間に登録できるのは、
//    => 関数
//    => 定数
//    => クラス
// 今回は、定数TAX_RATEとwith_tax()関数を『lib.php』に
// 名前空間としてファイルを分ける。

// ↓ ここから

namespace lib;

// // namespaceには、define()関数を使ったものには登録できないので、
// // 通常の定数の定義に変更する。
// if(!defined('TAX_RATE')) {
//     define('TAX_RATE', 0.1);
// }
const TAX_RATE = 0.1;
    
function with_tax($base_price, $tax_rate = TAX_RATE) {
    $sum_price = $base_price + ($base_price * $tax_rate);
    $sum_price = round($sum_price);
    return $sum_price;
}

// ↑ ここまでを『lib.php』へ



////////////////////////////////////
// ファイルを分割したので読み込む。
require_once 'lib.php';

// // 呼び出し
// // 合図は、『\』+『名前空間名』+『\』+『関数名』
// // として関数を呼び出す
// $price = \lib\with_tax(1000, 0.08);
// echo $price;

// // 定数を呼び出し。
// echo \lib\TAX_RATE;

// 呼び出し　その2
// 関数の呼び出し
//    『use』を使ってスッキリさせる。
//    これを使った場合、最初の『\』は、
//    グローバル空間を示す。
//    最初の『\』は省略できる。
use function lib\with_tax;
use const lib\TAX_RATE;
$price = with_tax(1000, 0.08);
echo $price;

/////////////////////////////

require_once 'lib.php';
use function lib\with_tax;
$price = with_tax(1000, 0.08);
// echo $price;

use const lib\TAX_RATE;
echo TAX_RATE;

// グローバル空間で関数を定義
function my_echo() {
  echo "hello";
}
```

## クラスを呼ぶときは注意

```PHP

require_once 'lib.php';
use function lib\with_tax;
use const lib\TAX_RATE;

$price = with_tax(1000, 0.08);
echo $price . "<br />";
echo TAX_RATE . "<br />";

function my_echo()
{
  echo "external function!<br />";
}

my_echo();

class GlobalCls
{
  public $name;
  function __construct($name) {
    $this->name = $name;
  }
}
```

```PHP
<?php
namespace lib;

const TAX_RATE = 0.1;
function with_tax($base_price, $tax_rate = TAX_RATE)
{
  $sum_price = $base_price + ($base_price * $tax_rate);
  $sum_price = round($sum_price);
  return $sum_price;
}

// グローバル空間で定義された定数・変数・関数は
// グローバル空間を表す『\』を付けなくていい。
my_echo();

$gc = new \GlobalCls("takahiro");
// echo $gc->name();
```

## クラス

```php
<?php
class Person
{
  // クラス内がスコープ
  private $name;
  // グローバルなスコープ
  public $age;

  // コンストラクター
  function __construct($name, $age)
  {
    $this->name = $name;
    $this->age = $age;
  }

  function hello()
  {
    echo "hello, {$this->name}<br />";
  }
}

$nob = new Person("髙廣", 59);
// プロパティの呼び出し
echo $nob->age . "<br />";
// helloメソッドの呼び出し
$nob->hello();
```

## $thisでチェーン・メソッドができるようにする

```php
<?php 
class Person
{
  private $name;
  public $age;

  function __construct($name, $age)
  {
    // $thisという変数は、
    // インスタンス化されたオブジェクトのことを指す。
    $this->name = $name;
    $this->age = $age;
  }

  function hello() {
    // helloメソッドを読んだら返ってくる命令はこのecho。
    echo "Hello, {$this->name}!<br />";
    // メソッド・チェーンが出来るようにreturnで$thisを呼ぶんだね。
    return $this;
  }
  function bye() {
    echo "Goodbye, {$this->name}!<br />";
    return $this;
  }
}

$john = new Person('John', 40);
$john->hello();
echo "=========================<br />";
$john->bye();
echo "=========================<br />";
// 『return $this;』をすることでメソッド・チェーンができる。
$john->hello()->bye();
echo "=========================<br />";
// 別にインスタンスを生成させて、同じようにメソッド・チェーンする。
$paul = new Person('Paul', 81);
$paul->hello()->bye();
```

## 静的メソッド、プロパティ
 
```php
<?php
class Person
{
  private $name;
  public $age;

  // 静的プロパティ
  public static $whereToLive = "New York";
  // 静的プロパティを定数として
  public const WHERE = "Tokyo";

  function __construct($name, $age)
  {
    $this->name = $name;
    $this->age = $age;
  }

  function hello()
  {
    echo "Hello, {$this->name}!<br />";
    // インスタンス・メソッドの定義部に
    // 静的メソッドでメッセージの送信ができる！
    // Person::bye();
    
    // ただし、クラス内で使用するにはクラス名は使わない。
    static::bye();
    // 場合によってはselfを使うこともある。
    // self::bye();

    return $this;
  }
  // staticメソッド
  //    staticメソッド内では$this変数は持てない。
  //    これはクラス自体が持つメソッド。
  //    いちいちインスタンスを起こす必要はない。
  static function bye()
  {
    echo "Goodbye<br />";
  }
}

// インスタンスの生成
$john = new Person('John', 40);

// // staticメソッドの呼び出しは、
Person::bye();

// インスタンスは静的メソッドがわかる。
// 多分インスタンスはbye静的メソッドが呼ばれたら、
// 自分自身を参照し、なければ親のPersonクラスにあるかどうかを
// 探しに行くようになっている。みたいなイメージだろうね。

// ただし、普通はクラスへ呼び出しをかけるので
// このような呼び出し方はしない。
$john::bye();

// インスタンスのメソッド定義で
// 静的メソッドからメッセージを送ることはできる。
// helloメソッドを呼ぶと、
// 設定されている全ての出力がなされる。
echo "<hr />";
$john->hello();
echo "<hr />";

// 静的プロパティの呼び出し
// 全てのオブジェクトで共通して設定される値で使う。
echo Person::$whereToLive . "<br />";
echo Person::WHERE;
```

## クラス継承　その1

```php
<?php
/**
 * クラス継承
 */
class Person {
  // protectedとは、
  //    自身のクラスとそれを継承している
  //    『クラスの内側!!』で使用可能であることを宣言している。
  //    外部からアクセスできないよ！
  protected $name;
  public $age;
  public const WHERE = 'Earth';
  public static $WHERE = 'earth';

  function __construct($name, $age) {
      $this->name = $name;
      $this->age = $age;
  }
  
  function hello() {
    echo "Hello, {$this->name}!";
    return $this;
  }
  
  static function bye() {
    echo 'Good-bye!';
  }
}
  
  // クラス継承をやってみる。
  // 親クラスで設定されたプロパティのスコープがprivateだったら
  // 子に届かない。publicになっていることを確認しないとね。
  class Japanese extends Person {
    // 継承のクラスで静的プロパティも上書きできる。
    public static $WHERE = "大阪";
    public $gender;
    public $adress;
    // 必要なプロパティは最初に宣言が必要だけど、
    // そのまま持ってくるだけ。
    function __construct($name, $age, $gender, $adress)
    {
      $this->name = $name;
      $this->age = $age;
      $this->gender = $gender;
      $this->adress = $adress;
    }
    function hello() {
      echo "こんにちは、{$this->name}さん！<br />";
      echo "年齢は、{$this->age}歳<br />";
      echo "性別は、{$this->gender}性<br />";
      // 変数展開ができない。。。だからこの書き方で統一してあるんだね。。。
      echo "ご出身は、" . static::$WHERE . "ですね。<br />";
      return $this;
    }
}

$personNob = new Person("髙廣", 59);
$nob = new Japanese("髙廣", 59, "男", "大阪");
$nob->hello();
```

## クラス継承　その2

```php
<?php

use Person as GlobalPerson;

/**
 * クラス継承
 */

// abstractを含むメソッドを持っているクラスは、
// 先頭にabstractと書かないといけない。
// で、そうなると、このクラスは直接呼び出すことが出来なくなる。
abstract class Person 
{
  public $name;
  public $age;
  public const WHERE = 'Earth';
  public static $WHERE = 'earth';

  function __construct($name, $age) 
  {
    $this->name = $name;
    $this->age = $age;
    // 自身のプロパティ
    echo self::$WHERE;
    // 静的プロパティを宣言されたクラスの値がかえる。
    // 継承先のクラスで静的プロパティの宣言がなければ『自身』の値が返る。
    echo static::$WHERE;
  }

  // // finalを付けると継承先のクラスではこのメソッドは使えない。
  // final function hello() {
  //   echo "Hello, {$this->name}!";
  //   return $this;
  // }

  // abstract（要旨）を付けると、
  // このメソッドは継承先のクラスで実装を書いていると宣言することになる。
  // ここの宣言が抜けていても継承先でメソッド定義しているので動くのだが、
  // メソッドのルートがここにあることが重要になることがある。
  // 後々わかるだろうからここは大まかにこうするものだと覚えておく。
  abstract function hello();

  static function bye() 
  {
    echo 'Good-bye!';
  }
}

class Japanese extends Person 
{
  // 継承先のクラスで静的プロパティをオーバーライドする。
  public static $WHERE = "大阪";
  // 継承先のクラスで新たにプロパティを宣言する。
  public $gender;

  function __construct($name, $age, $gender)
  {
    // 行数を減らす効果にはならないと思うが、parentで書き直せる。
    // 結局引数を書かないといけないからね。
    parent::__construct($name, $age);
    // $this->name = $name;
    // $this->age = $age;
    $this->gender = $gender;
  }
  function hello() 
  {
    echo "こんにちは、{$this->name}さん！<br />";
    echo "年齢は、{$this->age}歳<br />";
    echo "性別は、{$this->gender}性<br />";
    // static, self, parentについて
    // 静的 === 自身
    echo "ご出身は、" . static::$WHERE . "ですね。<br />";
    echo "ご出身は、" . self::$WHERE . "ですね。<br />";
    // 親のプロパティ
    echo "ご出身は、" . parent::$WHERE . "ですね。<br />";
    return $this;
  }
}

$nob = new Japanese("髙廣", 59, "男", "大阪");
echo "<hr />";
$nob->hello();
echo "<hr />";
echo $nob->name;
echo "<hr />";
echo $nob->age;
```

# HTTP通信

## メソッド
### GET
役割：データの取得

パラメータはURLの一部としてサーバーに送信される。
    GET /path?param1=値&param2=値

このようなURLで、サーバー側でparam1、param2の値を取得することができる。

ブラウザキャッシュは有効。
サーバーから取ってきた情報をブラウザ側で保存することができる。

GETで送るもの
URLの下に、HeaderとBodyがある。
Header
  ブラウザキャッシュの設定値を設定してサーバーへ送る。
Body
  空で送信される。

### post
役割：データの作成、更新
パラメーターはBodyに設定される。

POST /path
Header
  サーバーとの通信における設定値
Body
  param1=値
  param2=値

なので、ブラウザキャッシュは無効

### HTTP通信で覚えるべきこと
HTTP通信はリクエストの前後で状態を保持しないプロトコル。（ステート・レス）

2回目の通信（往復）は、1回目の通信（往復）の内容を知らない。
（これを記憶しておくのがセッションという機能。）

# フォーム

```php
<!-- name属性は必須。これがサーバーに送られるプロパティ。 -->
<form action="get.php" method="GET">
  <input type="text" name="username">
  <input type="text" name="password">
  <input type="submit" value="ボタンを押してね">
  <button type="submit">送信</button>
</form>
```

# GETしてみる

### 送信側
```php
<!-- method="GET"は省略できる。 -->
<form action="get.php" method="GET">
  <input type="text" name="username">
  <input type="password" name="pwd">
  <input type="submit" value="ボタンを押してね">
</form>
```

### 受信側
```php
<div>
  name: <?php echo $_GET['username']; ?>
</div>
<div>
  name: <?php echo $_GET['pwd']; ?>
</div>
```

# POSTしてみる

### 送信側
```php
<form action="post.php" method="POST">
    <input type="text" name="username">
    <input type="password" name="pwd">
    <input type="submit" value="ボタンを押してね">
</form>
```

### 受信側
```php
<div>
    名前：<?php echo $_POST['username'] ?>
</div>
<div>
    パスワード：<?php echo $_POST['pwd'] ?>
</div>
```

## GETとPOSTの使い分け

> URLは最大2000文字程度までしか設定できないので、まとまった量の本文を送信するにはPOSTになるわけ。

> GETではパラメータを含めて共有できる。というかパラメータと値が丸見え。

### GETで通信
index.php
```php
<?php
$students = [
    '1' => [
        'name' => 'taro',
        'age' => 15,
    ],
    '2' => [
        'name' => 'hanako',
        'age' => 14,
    ],
    '3' => [
        'name' => 'jiro',
        'age' => 12,
    ],
];

$id = $_GET['id'];
$student = $students[$id];
$name = $student['name'];
$age = $student['age'];
?>
<div><?php echo "{$name}は{$age}才です。"; ?></div>
```
send.php
```php
<!-- method="GET"は省略できる。 -->
<form action="index.php" method="GET">
  <input type="number" name="id">
  <input type="submit" value="ボタンを押してね">
</form>
```

## フォームで配列を送信する。

```php
<!-- 配列として送る。 -->

<!-- GETで配列送る。 -->

<form action="receive.php" method="GET">
  <div><input type="text" name="members[]"></div>
  <div><input type="text" name="members[]"></div>
  <div><input type="text" name="members[]"></div>
  <button type="submit">送信する</button>
</form> 


<!-- POSTで配列を送る。 -->
<form action="receive.php" method="POST">
  <div><input type="text" name="members[]"></div>
  <div><input type="text" name="members[]"></div>
  <div><input type="text" name="members[]"></div>
  <button type="submit">送信する</button>
</form>


<!-- POSTで配列を送る。 -->
<!-- で、こちらでは引数はそのまま入れている。混乱するな。 -->
<form action="receive.php" method="POST">
  <div><input type="text" name="members[id]"></div>
  <div><input type="text" name="members[name]"></div>
  <div><input type="text" name="members[age]"></div>
  <button type="submit">送信する</button>
</form>
```

```php
<?php
// 配列としてGETから受信する。
$lines = $_GET["members"];
print_r($_GET['members']);

// 配列としてPOSTから受信する。
$lines = $_POST["members"];
print_r($_POST['members']);

// 連想配列としてPOSTから受信する。
// 配列も連想配列も同じ書式。文化が違うと理解する。
$lines = $_POST["members"];
print_r($_POST['members']);
?>

<!-- 受信した配列の値を出力する。 -->
<div><?php echo "{$lines[0]}です。"; ?></div>
<div><?php echo "{$lines[1]}です。"; ?></div>
<div><?php echo "{$lines[2]}です。"; ?></div>

<!-- 受信した連想配列の値を出力する。 -->
<!-- 引数を『''』で囲うのは気持ち悪いが慣れるしかない。 -->
<div><?php echo "{$lines['id']}です。"; ?></div>
<div><?php echo "{$lines['name']}です。"; ?></div>
<div><?php echo "{$lines['age']}です。"; ?></div>
```

## 隠しフィールドでサーバーに値を送る

```php
<!-- ブラウザには見えない入力欄を設けて、適宜サーバーに値を送るためのinput要素。 -->
<!-- ただし、簡単に改竄が可能。計算するとかそういうものには使えない。 -->
<!-- 。。。なんだかなぁ。。。であるが、道のり長いので頑張る。 -->
<form action="post.php" method="POST">
  <div>
    <label for="amount">個数</label>
    <input id="amount" type="number" name="amount">
  </div>
  <div>
    <label for="price">価格</label>
    <input id="price" type="number" name="price">
  </div>
  <div>
    割引: 10%
  </div>
  <!-- type="hidden"に値を与えてサーバーに送ることができる。 -->
  <input type="hidden" name="discount" value="10">
  <button type="submit">送信</button>
</form>
```

```php
<?php 
// POSTから渡ってきた全ての値を確認できるよ。
var_dump($_POST);

$amount = $_POST["amount"];
$price = $_POST["price"];
$discount = $_POST["discount"];
$check_sum = $amount * $price;
$check_sum -= $check_sum * $discount / 100;
$total = round($check_sum);
print_r("［個数: {$amount}個・単価: {$price}円・合計: {$total}円］");
```

## Cookie

```php
<!-- 
HTTPはステート・レス
だが、送信した値を保持したいことがある。
それを実現させるのがCookie・SESSION・データベース。

ブラウザに保存 => Cookie
local（値） => sarver => HTTPのヘッダーに載って（1回目だよ）localへ localで値は保持する。

サーバーに保存 => SESSION・データベース
-->

<?php
setcookie('VISIT_COUNT', 1);

// Response Headers
//    開発ツールのNetwork/Headers/Response Headers
//    localからのHTTPリクエスを送り、
//    serverからのHTTPリクエストのHeaderに設定されているもの、それが『Response Header』。
//    そこを見ると、『Set-Cookie: VISIT_COUNT=1』という値が記載されている。
//    これが、serverから返ってきた時に、serverがCookieに設定した値。

// Application
//    開発ツールのApplication/Storage/Cookies
//    様々なプロパティがある。確認は下記サイトで。
//    https://www.php.net/manual/ja/function.setcookie.php

// NetWork
//    リロードするとRequest HeadersにCookieの項目が現れる。
//    serverに送られたCookieを確認するには以下で確認できる。

var_dump($_COOKIE['VISIT_COUNT']);

// スーパーグローバルの$_COOKIEの値を変更してもserver側での値が変わるわけではない。
// 値を変更するにはsetcookieメソッドを使う。

$_COOKIE['VISIT_COUNT'] = 0;

// ========
// Cookieに設定するオプション
// 引数に配列を渡して、様々なプロパティを渡してみる。

// Expires
// time()関数で現在の時刻を取得
// それに対して『+ 60』とすると、
// 現在の時刻から60秒間Cookieが有効になる。
// その期間を超えるとCookieは破棄される。
// 以下、時間の設定はこれを参照。
//      60 = 1分
//      60 * 60 = 1時間
//      60 * 60 * 24 = 1日
//      60 * 60 * 24 * 30 = 30日

// Path
// そのpath、またはそのpath配下に対してCookieが有効になる。値が飛んでいくと表現しておるようだ。

// HttpOnly, Secureがセキュリティに関する設定
// Secure
//     ここをtrueにすると、https通信の場合のみ、Cookieをserverとやり取りする。
//     つまり、httpsの通信の場合のみ有効になるということ。defaultはfalse。
// HttpOnly
//     これをtrueにすると、JavaScriptからCookieの値を操作することができなくなる。
setcookie('VISIT_COUNT', 1, [
  'expires' => time() + 60 * 60 * 24 * 30,
  'path' => '/'
]);

```

## Session

```php

// Sessionをスタートさせる。
// localには値は残らない、値はserver側に保持する。
session_start();

// Serverに値を送る。
// スーパー・グローバル変数（連想配列）に値を代入する。
$_SESSION['VISIT_COUNT'] = 1;
echo $_SESSION['VISIT_COUNT'];

// リロードして行われることは、
// Application/Name/を見ると、『PHPSESSID』という項目ができる。
// これがServerへ送られたSession ID。
// Valueは、送られてくる端末ごとに違う。
// Serverは、session IDをResponse HeaderのCookieに乗せて
// 端末へ返しブラウザ内部で保持される。
// 2回目以降、Session IDをキーとして値をやり取りする。
// 端末とSession IDは一位。

// では、先ほど、
// $_SESSION['VISIT_COUNT'] = 1;
// として値を格納したSession IDは、どこに保存されているのか？

// 『phpinfo();』として使っているPHPの情報ページを開けて
// 『tmp』という文言で検索する。
// 『upload_tmp_dir』という項目にあるパスをターミナルで開け、
// 『vim』するとテキスト情報として書かれていることを確認できる。
```

## 練習　CookieとSessionを操作する

```PHP
<?php

/**
 * SessionとCookieの理解度チェック
 * 
 * index.phpに訪問（リロード）するたびに訪問回数が
 * １ずつ増える処理を実装してみてください。
 * Session、Cookieの二つのパターンで実装してみましょう。
 * 
 * １回目
 * 訪問回数は 1 回目です。
 * 
 * ２回目
 * 訪問回数は 2 回目です。
 * 
 */
?>

<?php
// Sessionを使った場合
session_start();
if (isset($_SESSION['VISIT_COUNT'])) {
  // echo "2回目以降";
  $_SESSION['VISIT_COUNT']++;
} else {
  // echo "1回目";
  $_SESSION['VISIT_COUNT'] = 1;
}
?>

<h1>訪問回数は <?php echo $_SESSION['VISIT_COUNT']; ?> 回目です。</h1>

<?php 
// Cookieを使った場合
// ただし、ブラウザにデータが保存されるのでデータの改ざんができてしまう。
// 値を変更する実装をしているが実戦ではない。
$visit_count = 1;
if (isset($_COOKIE['VISIT_COUNT'])) {
  $visit_count = $_COOKIE['VISIT_COUNT'] + 1;
}
setcookie('VISIT_COUNT', $visit_count);
?>

<h1>訪問回数は <?php echo $_COOKIE['VISIT_COUNT']; ?> 回目です。</h1>
```

## Sessionを使った認証の仕組みの基本

```PHP
<h1>ログインフォーム</h1>
<p>ID: test / PW: pwd</p>
<form action="dashboard.php" method="POST">
    <input type="text" name="user_name">
    <input type="password" name="pwd">
    <button type="submit">送信</button>
</form>

<a href="dashboard.php">ダッシュボードへ移動</a>
```

```PHP
<?php
// ファイル内のやり取りと誤解していた。
// これは、Serverとのやり取り。
// Sessionのkeyを符号にして値のやり取りをしている。

// 認証系のアプリを作る際最初にすることは
// Sessionを開始させること。
// Sessionを儲けたHTML配下に対して領域を設ける。
// Sessionのキーを符号に出入り自由な領域を作っているイメージ。
session_start();

// 確認すること、
// 名前が入力されているか？
// パスワードは入力されているか？
// 入力された名前は正しいか？
// 入力されたパスワードは正しいか？

if (
  isset($_POST['user_name'])
  && isset($_POST['pwd']) 
  && $_POST['user_name'] === 'test'
  && $_POST['pwd'] === 'pwd'
) {
  // trueの場合は、Sessionに連想配列userとして値を設定していく。
  // PHPの連想配列は『[]』なので要注意。気持ち悪いなぁ。
  $_SESSION['user'] = [
    'name' => $_POST['user_name'],
    'pwd' => $_POST['pwd']
  ];
}

if (!empty($_SESSION['user'])) {
  echo "ログインしています。";
} else {
  echo "ログインしていません。";
}
?>
```

# Apacheの基礎

## なんなのか？

### プレゼンテーション層を担当している。

> __Web3層アーキテクチャー__
> * プレゼンテーション層
>   * HTTPリクエストの送受信。
>   * PHPのプログラムの呼び出し。
>     * どのプログラムを実行するのかを制御する。
> * アプリケーション層
>   * ビジネスロジックの実行。
> * データ層
>   * データの保持（書き込み、取得）。

### Apache === WEB Server ソフトウエア
`モジュール`単位で機能を追加・削除ができる。

#### 編集できる主なモジュール
* mod_auth_basic:　基本認証を設定できる。
* mod_dir:　ディレクトリ毎の設定を変更できる。
* mod_rewrite:　URLの書き換えを行う。（__使用頻度高い__）
...
...

## 設定

* `httpd.conf` `.htaccess` に設定を記載する。
* 大文字小文字を区別しない。
* `セクション`によって適用範囲を指定。
* 設定のことを`ディレクティブ`という。
* `httpd.conf` `.htaccess` へ設定値を編集して追加・変更していく。

## httpd.confを編集する

`MAMP/conf/apache/httpd.conf` このファイルを観察する。

__L29__
これがディレクティブ
```
ServerRoot "/Applications/MAMP/Library"
```

`ServerRoot` => `ディレクティブ`
`"/Applications/MAMP/Library"` => `ディレクティブ`に渡す`値`


__L217__
`DocumentRoot "/Applications/MAMP/htdocs"` 
=> 公開用のドキュメント・ルートととしてApache　Web Serverで動く。

__L227__
これがセクション。

```
<Directory />
  Options Indexes FollowSymLinks
  AllowOverride None
</Directory>  
```
`/`pathとそれ以降のディレクトリに対して、
`Options`ディレクティブ、`AllowOverride`ディレクティブに値が設定される。

## ALIAS
特定の`path`を`ディレクトリ`に紐づける。

```
Alias /[エイリアス名] ディレクトリまでの絶対パス
```
パスに日本語が含まれている場合は特に、パスにはダブルクォーテーションで囲む。

```
Alias /apache "/Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/"
```
* `http://localhost:8888/apache/` => `ドキュメント・ルート + エイリアス名` の `URL` でアクセスすると `Alias`ディレクティブで指定した `path` に遷移することができる。
* この場合は、ディレクトリの中のindex.htmlを描画する。
* なお、ディレクトリに遷移させたいときは `path/to/derectory/` とディレクトリ名の後ろに `/` を付与すること。

## コンテキスト

### 種類
* サーバー設定ファイル
  * httpd.comf, srm.conf, access.conf etc
* バーチャル・ホスト
  * `<VirtualHost>`内で使用可能
    * 一つのホストで複数のドメインを持つことができる技術
* ディレクトリ
  * `<Directory>`, `<Location>`, `<Files>` etc
    * セクションを表す `<Directory>` ディレクティブをよく使うらしい。
* .htacces
  * `.htaccess` ファイル内で使用可能
  
### それぞれのディレクティブのコンテキスト

各ディレクティブの詳細はリンクを参照する。
https://httpd.apache.org/docs/2.4/mod/quickreference.html

例）
* `Alias` ディレクティブ
  * コンテキスト:	__サーバ設定ファイル__, バーチャルホスト

* `<Directory>` ディレクティブ
  * コンテキスト:	__サーバ設定ファイル__, バーチャルホスト

* `DirectoryIndex` ディレクティブ
  * コンテキスト:	__サーバ設定ファイル__, バーチャルホスト, __ディレクトリ__, .htaccess

`Alias` ディレクティブ, `<Directory>` ディレクティブ, `DirectoryIndex` ディレクティブともに、__サーバ設定ファイル__ つまり、`httpd.conf` へ設定を書くことができる。

しかし、

`DirectoryIndex` ディレクティブは、 `<Directory>` ディレクティブの中で設定できるが、

`Alias` ディレクティブはコンテキストで __許可されていない__ から設定することはできないというお話です。


## ディレクトリ

`Alias` ディレクティブを使って、ディレクトリにアクセスしたら包含されている `index.html` を読む。

別のファイルを読むようにするには、`DirectoryIndex` ディレクティブに `DirectoryIndex` ディレクティブへ表示させたいファイル名を値として与える。

```
<Directory "/Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/">
  DirectoryIndex file1.html
</Directory>

```

そのディレクトリに該当のファイルがない場合は、包含しているファイルやディレクトリをリスト形式で表示するように、`httpd.conf`の`<Directory>` ディレクティブに設定してある。

その挙動を止めるようにするオプションは以下のようにする。

```
<Directory "/Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/">
  DirectoryIndex file1.html
  Options -Indexes
</Directory>
```

`-Indexes` デフォルトの各種オプションから `Indexes` だけを削除する。
`+Indexes` デフォルトの各種オプションへ `Indexes` を追加する。

注意しないといけないのは、
`Indexes` だけだと、デフォルトの各種オプション全てを `Indexes` で上書きしてしまうこと。

# .htaccess

* `AllowOverride All` を設定する。
  * オプションを `All`（反対は、`None`）にすると、`.htaccess` の有無に関わらず全てほディレクトリに対して検索をかける。（パフォーマンスは落ちるが仕方ない。）
* 基本的には `httpd.conf` に設定を追加する。
* 配置したディレクトリ、サブディレクトリで有効になる。
* 上位の階層で指定された設定は、下位の階層の設定により上書きされる。

## 設定

`httpd.conf` に `.htaccess` を有効にする設定をする。
`httpd.conf` のファイルに、自身の設定をしている場所があるので確認する。

```Apache
<Directory "/Applications/MAMP/htdocs">
    Options All
    AllowOverride All
    Require all granted	
    XSendFilePath "/Applications/MAMP/htdocs"
</Directory>
````

例えば、`httpd.conf` に 以下のディレクトリにディレクティブを設定したとして、これを `.htaccess` に移行する。

```Apache
# エイリアスを設定して、
Alias /dir-test "/Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/dir-test/"

# 値を『.htaccess』へ
<Directory "/Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/dir-test/">
  DirectoryIndex file2.html
</Directory>
```

`dir-test` ディレクトリに `.htaccess` ファイルを作成し、ディレクティブに与えた値を書くだけ。

ローカルでやると `http://localhost:8888/dir-test/` というURLができて、`file2.html` が表示される。該当ファイルがなければインデックスが表示される。

# URLのリダイレクト

異なるURLへ転送する。（ブラウザのURL表示も変更される。）

* コンテキスト:	
  * サーバ設定ファイル, バーチャルホスト, ディレクトリ, .htaccess
* 構文:
  * Redirect [status] URL-path URL
* status:
  * 301 => 永続的なリダイレクトの設定に使用
  * 302 => 一時的に引っ越したことを表す（デフォルト）
* ブラウザの挙動:
  * Header のレスポンスヘッダが300番台の場合
  * Locationに指定されたURLへリダイレクト
  * Redirectループに注意

注意点として、該当のディレクトリの直前のディレクトリ（エイリアスでも構わない）までのURLは生きている必要がある。
元々ないところからは話を始められないらしい。

```apache
# httpd.conf
Alias /dir-test "/Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/dir-test/"
```

```apache
# .htaccess
インデックスはfile1.htmlとして、なければインデックスのリストが返る。
DirectoryIndex file1.html
`redirect-test`ディレクトリにアクセスされたら`apache`へリダイレクトする。
Redirect /apache/redirect-test /apache
```
例えば、`redirect-test`ディレクトリは、`Alias` の `apache` の中にあるとして、
`redirect-test`ディレクトリがなければ、または、そこにアクセスされたら、
`apache` ディレクトリにリダイレクトされる。

ちなみに、デフォルトでは、`status` は 301

## 301と302

### 302の挙動

pathの変更があった場合に即時に反映される。

```Apache
Redirect 302 /apache/file1 /apache/dir-test/file1.html
              ↓
Redirect 302 /apache/file1 /apache/dir-test/file2.html
```
### 301の挙動

ブラウザのキャッシュに保存されるので変更が効かなくなる。

変更できるようにするには、`開発ツール` の `Network` で該当箇所を右クリックからメニューを出して `Clear browser cache` を選択してブラウザのキャッシュを消去する必要がある。

```Apache
Redirect 301 /apache/file1 /apache/dir-test/file1.html
              ↓
Redirect 301 /apache/file1 /apache/dir-test/file2.html
```

# RIWRITE URLの書き換え

* RewriteRuleディレクティブを使う。
* URLの書き換えを行うモジュール
* 使用可能なコンテキスト
  * サーバー設定, バーチャルホスト, ディレクトリ, .htaccess

## 使用上の注意

* `httpd.conf`の確認
  * `RewriteEngine On` にする。
  * `Options FollowSymLinks` がディレクトリで記述されている必要あり。
  * 
* 記述方法
  * `RewriteRule Pattern Substitution [flags]`
    * Pattern:
      * Pathにマッチする条件を正規表現で表現
    * Substitution:
      * マッチした場合の書き換え後のパス、またはURL
    * [flags] は任意のオプション
* `Substitution` は以下の３パターンで設定可能
  * URL-path:
    * ドメイン以下のパスによる指定（一番最初のパスがルートディレクトリに存在しない場合にURL-pathとして認識する。）
  * file-system path:
    * PC上のディレクトリ、またはファイルへの絶対パス
  * Absolute URL:
    * http~の絶対URL
  * - (dash) 書き換えしない（フラグのみ使用）
    * フラグのみ使用する際に使用
  * Flags:
    * [R=code] リダイレクト。R=301とすると301リダイレクトを行う。
    * [L] 処理を終了。以降のRewriteRuleは実行しない。
    * [F] 403エラー（閲覧禁止）を発生させて、ページを表示しない。
    * 複数使用したい場合は、[L, R]とカンマで区切る。
  
## やってみる

### まずは、リライトをスタートの宣言

```Apache
RewriteEngine On
```

### リライトを書く

```apache
RewriteRule rewrite-test/index.html /apache/rewrite-test/tmp.html [R]
```

#### Pattern（検索窓に投げるURLのこと）

この`.htaccess` は、エイリアスが `/apache` に設定してあるので、パスの先頭に `/apache` をつける必要はない。
`.htaccess` からの相対パスでファイルを指定する。

#### Substitution（実際にリンクしたいURL）

リンクの置き換えのファイル指定は、パスの先頭に『/apache』をつける必要があるので要注意。

#### 検索窓に表示されるURL

`URL` は `Pattern`（検索窓に投げたURL）が使われる。
`URL` はブラウザには伝えられず、サーバー側で擬似的に切り替えの処理を行うから。
これを `インターナル・リダイレクト` という。
ここが `REDIRECT` とは大きく違うところ。


# ログ

## ログの設定と確認
### [LogLevel] ディレクティブ

どのレベルまでエラーログを出力するか

9段階のレベルがある。下へ行くほど詳細な情報が得られる。活用できるかは別問題。

デフォルトのレベルは、`warn`。

* レベル	説明
* emerg	緊急
* alert	直ちに対処が必要
* crit	致命的な状態
* error	エラー
* warn	警告（デフォルト）
* notice	普通だが、重要な情報
* info	追加情報
* debug	デバッグメッセージ

私の `httpd.conf` には `L323` に `LogLevel warn` となっていた。
  
#### 注意点

コンテキスト:	サーバ設定ファイル, バーチャルホスト
つまり、`.htaccess` には書けない。

### [ErrorLog] ディレクティブ

[LogLevel] ディレクティブで設定した内容が、[ErrorLog] ディレクティブに書き出される。

コンテキスト: サーバ設定ファイル, バーチャルホスト

私の `httpd.conf` には `L316` に
`ErrorLog "/Applications/MAMP/logs/apache_error.log"`
とログファイルまでのパスが記述されている。

本番環境でエラーログを確認する必要が出てくる（フロントエンドでもそんな場面に遭遇するのかな？？？）ので、その際にはここをヒントにファイルまで辿り着くこと。

### [CustomLog] ディレクティブ
ユーザーが独自で設定したログを書き出すファイルを指定する。

コンテキスト:	サーバ設定ファイル, バーチャルホスト

### [LogFormat] ディレクティブ

CustomLogの出力フォーマットを決定

コンテキスト:	サーバ設定ファイル, バーチャルホスト

### ログの確認

Unix系（Mac, Linux）
```zsh
# tail -f ファイルパス
```

とりあえず、

```Apache
ErrorLog "/Applications/MAMP/logs/apache_error.log"
CustomLog "/Applications/MAMP/logs/apache_access.log" common
```

エラーとアクセスに関するログは出力できるようになっているので、`tail -f`メソッドを使って確認できるようになろうという話。

私の`Apache`のバージョンは、

```bash
which apachectl // => Version 2.4 だった。
```
なので、ターミナルで、

```bash
tail -f /Applications/MAMP/logs/apache_error.log
```
とすれば __リライト__ の __ログ__ を確認できる。


で、話が前後するが、httpd.confに書いてある設定を書き換える。

```apache
# LogLevel warn

# ** ログの出力 ** 
# rewrite logの出力
# Ifがついているので振り分け可能。
# 私は、『version 2.4』なので下が適用されるはず。
<IfVersion < 2.3>
    # version 2.2
    LogLevel warn
    # 1 => 小 <==> 9 => 大
    RewriteLogLevel 9
    RewriteLog "C:/MAMP/logs/rewrite.log"
    # Mac,Linux
    # RewriteLog "/Applications/MAMP/logs/rewrite.log"
</IfVersion>

<IfVersion > 2.3>
    # version 2.4
    LogLevel warn rewrite:trace8
    # リライト・ログもエラー・ログに出力される。
    # ここ => ErrorLog "/Applications/MAMP/logs/apache_error.log"
</IfVersion>
```

__リライト__ してみて `tail -f` で確認。ちゃんと出力している!

## [Rewrite]で後方参照を使う

()グループ化を使ってパスを切り取る
$N: $1 ~ $9
[正規表現]よく使う表現
. 任意の一文字
* 0回以上の繰り返し
+ 1回以上の繰り返し
{n} n回の繰り返し
[] 文字クラスの作成
[abc] aまたはbまたはc
[^abc] aまたはbまたはc以外
[0-9] 0~9まで
[a-z] a~zまで
$ 終端一致
^ 先頭一致
\w 半角英数字とアンダースコア
\d 数値
\ エスケープ
() 文字列の抜き出し

RewriteRule rewrite-test/imgs/(\d{3}).jpg imgs/$1.png
RewriteRule rewrite-test/sub1/(.+\.html) sub2/$1

## 渡ってきた文字列が全て確認できる。

```apache
[Sat May 11 17:18:46.105637 2024]
        [rewrite:trace3] [pid 11878] mod_rewrite.c(486): [client ::1:64901] ::1 - - 
        [localhost/sid#15903a488][rid#1398126a0/initial] 
        [perdir /Applications/MAMP/htdocs/fullstack-webdev-master/...] 

      => パターンを適用させてURLを見つける。
        applying pattern 'rewrite-test/imgs/(\\d{3}).jpg' to uri 'rewrite-test/imgs/150.jpg'

[Sat May 11 17:18:46.105667 2024]
        [rewrite:trace2] [pid 11878] mod_rewrite.c(486): [client ::1:64901] ::1 - - 
        [localhost/sid#15903a488][rid#1398126a0/initial] 
        [perdir /Applications/MAMP/htdocs/fullstack-webdev-master/...] 

      => URLをここで置換する。
        rewrite 'rewrite-test/imgs/150.jpg' -> 'imgs/150.png'
[Sat May 11 17:18:46.105684 2024]

        [rewrite:trace3] [pid 11878] mod_rewrite.c(486): [client ::1:64901] ::1 - - 
        [localhost/sid#15903a488][rid#1398126a0/initial] 
        [perdir /Applications/MAMP/htdocs/fullstack-webdev-master/...] 
        add per-dir prefix: imgs/150.png -> /Applications/MAMP/htdocs/fullstack-webdev-master/...imgs/150.png
[Sat May 11 17:18:46.105700 2024]
        [rewrite:trace2] [pid 11878] mod_rewrite.c(486): [client ::1:64901] ::1 - - 
        [localhost/sid#15903a488][rid#1398126a0/initial] 
        [perdir /Applications/MAMP/htdocs/fullstack-webdev-master/...] 
        trying to replace prefix /Applications/MAMP/htdocs/fullstack-webdev-master/... with /apache/rewrite-test/
[Sat May 11 17:18:46.105715 2024]
        [rewrite:trace5] [pid 11878] mod_rewrite.c(486): [client ::1:64901] ::1 - - 
        [localhost/sid#15903a488][rid#1398126a0/initial] 
        strip matching prefix: /Applications/MAMP/htdocs/fullstack-webdev-master/...imgs/150.png -> imgs/150.png
[Sat May 11 17:18:46.105728 2024]
        [rewrite:trace4] [pid 11878] mod_rewrite.c(486): [client ::1:64901] ::1 - - 
        [localhost/sid#15903a488][rid#1398126a0/initial] 
        add subst prefix: imgs/150.png -> /apache/rewrite-test/imgs/150.png
[Sat May 11 17:18:46.105757 2024]
        [rewrite:trace1] [pid 11878] mod_rewrite.c(486): [client ::1:64901] ::1 - - 
        [localhost/sid#15903a488][rid#1398126a0/initial] 
        [perdir /Applications/MAMP/htdocs/fullstack-webdev-master/...] 

      => パターンのルール検査が全て終わったタイミングでインターナル・リダイレクが走る。
      => この時点でApache内部でリダイレクト処理がかかる。
        internal redirect with /apache/rewrite-test/imgs/150.png [INTERNAL REDIRECT]

[Sat May 11 17:18:46.105905 2024]
        [rewrite:trace3] [pid 11878] mod_rewrite.c(486): [client ::1:64901] ::1 - - 
        [localhost/sid#15903a488][rid#13a80e958/initial/redir#1] 
        [perdir /Applications/MAMP/htdocs/fullstack-webdev-master/...] 
        strip per-dir prefix: /Applications/MAMP/htdocs/fullstack-webdev-master/...rewrite-test/imgs/150.png -> rewrite-test/imgs/150.png
[Sat May 11 17:18:46.105927 2024]
        [rewrite:trace3] [pid 11878] mod_rewrite.c(486): [client ::1:64901] ::1 - - 
        [localhost/sid#15903a488][rid#13a80e958/initial/redir#1] 
        [perdir /Applications/MAMP/htdocs/fullstack-webdev-master/...] 

      => またサーバー上で検索がかかる。
        applying pattern 'rewrite-test/imgs/(\\d{3}).jpg' to uri 'rewrite-test/imgs/150.png'

[Sat May 11 17:18:46.105942 2024]
        [rewrite:trace1] [pid 11878] mod_rewrite.c(486): [client ::1:64901] ::1 - - 
        [localhost/sid#15903a488][rid#13a80e958/initial/redir#1] 
        [perdir /Applications/MAMP/htdocs/fullstack-webdev-master/...] 

      => ここでサーバーの処理は終了し、ブラウザ側にレスポンスが返却される。という流れ。
        pass through /Applications/MAMP/htdocs/fullstack-webdev-master/...rewrite-test/imgs/150.png
```

# 書き換えの条件を付与

## RewriteCond ディレクティブ

Rewrite ディレクティブは『パス』を使ってリライトしていた、
RewriteCond ディレクティブは、条件にマッチした場合にリライトを行うというもの。
つまり、クエリで渡ってきた値に対してリライトを行ってみる。

### 文法
`RewriteCond TestString CondPatter`

* TestString
  * テスト文字列。%{HTTP_HOST}などのシステム変数を検査する。
    * %{HTTP_HOST} => localhost:8888のこと。
    * %{QUERY_STRING} => 例えば`?`に続けて`var=1`というクエリを書いたりする。
    * その他、詳しくはリンクを参照する。（https://httpd.apache.org/docs/2.2/ja/mod/mod_rewrite.html#RewriteCond）

* CondPatter
  * 正規表現で検査対象の文字列がマッチするかを検査する。
  * ()を使うと、後方参照として%1〜%9までの値を取得できる。

```apache
DirectoryIndex file1.html
RewriteEngine On
RewriteBase /apache/rewrite-test/
# クエリのパラメータでファイル名が渡ってきた時に、そのファイルを出力する条件を書く。
# クエリのパラメータで渡ってきたファイル名は『%{QUERY_STRING}』に格納される。
# それを、ブラウザの検索窓で『URL』+『?』の次に書いた
# 『p』という名前で渡ってきた『(.+)』の正規表現で括れる値を取り出してやる。
RewriteCond %{QUERY_STRING} p=(.+)
# 取り出したパラメータ『(.+)』を後方参照で使用する。
# なお、『?』をつけないと無限に『%1』にマッチしようとしてURLのファイル名がおかしくなる。
# そして、『[R]』オプションをつけるとブラウザの検索窓にマッチした結果が出てくるのでバグ探しのネタになる。
RewriteRule rewrite-test/sub1 sub1/%1? [R]

# 検索窓でのクエリについて複数の検索ができる。
# 例えば、
# http://localhost:8888/apache/rewrite-test/sub1/?p=file.html&?p=index.html
RewriteCond %{QUERY_STRING} p=(.+)&?
RewriteRule rewrite-test/sub1 sub1/%1?

# ファイルが存在するかを『真』『偽』で返す。
# 存在する場合にリダイレクトを実行しろと宣言。
# RewriteCond %{REQUEST_FILENAME} -f
# 存在しない場合にリダイレクトを実行しろと宣言。
RewriteCond %{REQUEST_FILENAME} !-f
# sub2ディレクトリの中に、ファイル名で指定したファイルがない場合、
# sub1ディレクトリの中のファイル名で指定したファイルを探して表示しなさい。という命令。
RewriteRule rewrite-test/sub2/(.+) sub1/$1

RewriteCond %{REQUEST_FILENAME} !-d
# sub2ディレクトリの中に、指定したディレクトリがない場合、
# sub1ディレクトリの中のディレクトリを探し、index.htmlを表示させる。
RewriteRule rewrite-test/sub2/(.+) sub1/$1

# スタックさせると『&&』となる。よく使うらしい。
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
# sub2ディレクトリの中に、指定したディレクトリがない場合、
# sub1ディレクトリの中のディレクトリを探し、index.htmlを表示させる。
RewriteRule rewrite-test/sub2/(.+) sub1/$1
```

## 理解度チェック

問１：
.htmlで来たリクエストを同じファイル名のphpに転送してください。
つまり、検索窓に直接URLで書かれたファイル名ということ === RewriteRuleで書く。

例）
http://localhost:8888/apache/rewrite-test/file1.html
-> http://localhost:8888/apache/rewrite-test/file1.php
```apache
RewriteEngine On
DirectoryIndex file1.html
RewriteBase /apache/rewrite-test/

# 先頭の『/?』をなぜつけるのか？
# .htaccessなら不必要。httpd.confでは必要。
# 書き分けるのが邪魔くさいので付けておくとのこと。
RewriteRule /?rewrite-test/(.+)\.html$ $1.php
```

問２：
rewrite-test/sub1内のファイルに対してリクエストを送信
した際に同じファイル名でsub2内に存在するファイルは
sub2のものを表示してください。存在しなければ、sub1内の
ファイルを表示してください。
```apache
例）
http://localhost:8888/apache/rewrite-test/sub1/file1.html
-> http://localhost:8888/apache/rewrite-test/sub2/file1.html
```

```apache
http://localhost:8888/apache/rewrite-test/sub1/file2.html
-> Internal Redirect は行わない。
```
### 注意点
入力値に対して、{REQUEST_FILENAME}は使えない。
探すのは『sub1』ディレクトリだが、転送先は『sub2』だから。

`/Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/rewrite-test/sub2/`

の中に検索結果で返ってきたグループ『$1』があれば。。。という条件を書く必要がある。

```apache
RewriteEngine On
RewriteBase /apache/rewrite-test/
RewriteCond /Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/rewrite-test/sub2/$1 -f
```

### ここの注目

『sub1』ディレクトリの中に何かがあれば、とりあえずまとめて『S1』に送りRewriteCondで吟味して『真』が返ったら『sub2/$1』で転送する。
配列のforを見えない状態でやっているわけだ。
```apache
RwriteRule /?rewrite-test/sub1/(.*) sub2/$1
```
ファイルとディレクトリで検索をやる。
ファイルがあるかとディレクトリがあるかを『&& 論理積』の条件付はできないので『|| 論理和』でやる。

```apache
RewriteEngine On
RewriteBase /apache/rewrite-test/
RewriteCond /Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/rewrite-test/sub2/$1 -f [OR]
RewriteCond /Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/rewrite-test/sub2/$1 -d
RewriteRule /?rewrite-test/sub1/(.*) sub2/$1
```

# Webp画像の設定

jpeg、またはjpg,png拡張子のファイルにアクセスがあった場合に
Webp拡張子の画像が存在する場合はそれを返す。

```apache
# 例）
# http://localhost:8888/apache/rewrite-test/img/150.jpg
# -> http://localhost:8888/apache/rewrite-test/img/150.webp
```

```apache
RewriteEngine On
RewriteBase /apache/rewrite-test/

# webpに対応しているかどうかを調べる
# Applications/MAMP/conf/apache/mime.type
# image/webp  webp
# 『webp』というファイルに対して、
# 『image/webp』の『Content-Type』を返す
# 制御が入っているブラウザだということ。

# 対応していないブラウザへの対策として以下の命令を記述しておく。
# 『.webp』の拡張子があれば、『image/webp』という『mimeタイプ』を紐づける。
# 今回は、対応しているのでコメントアウトする。
AddType image/webp .webp

# 『Request Headers』の中の『Accept』の項目。
# ブラウザがどのmimeタイプを理解できるのかをサーバー側に教える。
# Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,
# image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
# これを検索条件に加えてやり、『Accept』に『image/webp』があればそれを返す『RewriteCond』を書く。

RewriteCond %{HTTP_ACCEPT} image/webp
RewriteCond /Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/rewrite-test/imgs/$1.webp -f
RewriteRule /?imgs/(.*)\.(jpe?g|png) imgs/$1.webp
```

# サブドメインの設定
ちょっと飛ばす。もう、意味がわからん。
このセクションは、モチベーションが下がりっぱなしなのでとりあえず次に行く。


# DBの基本

テーブル(エンティティ)
属性(カラム)
値(フィールド)

ID === 重複しない・変更しない、レコードを一意に特定するキーである。
『主キー（Primary Key）』と呼ばれる。

DB設計の基本
主キーは複数あっても構わない。
複数の属性でレコードを一意に特定する。

|商品ID|店舗名|商品名|数量|
|:---:|:---:|:---|---:|
|__001__|__店舗A__|タンス|1|
|__002__|__店舗A__|椅子|2|
|__001__|__店舗B__|タンス|10|
|__002__|__店舗B__|椅子|5|

店舗の名称は変わる可能性がある。
それはキーにできないので、店舗名にIDをふる。

|商品ID|店舗ID|店舗名|商品名|数量|
|:---:|:---:|:---|:---|---:|
|__001__|__01__|店舗A|タンス|1|
|__002__|__01__|店舗A|椅子|2|
|__001__|__02__|店舗B|タンス|10|
|__002__|__02__|店舗B|椅子|5|

店舗名を変更するのが面倒。
まだ在庫を持たない店舗C, D...があるかもしれない。

店舗と商品の情報を分ける。

#### 商品テーブル
|商品ID|店舗ID|商品名|数量|
|:---:|:---:|:---|---:|
|__001__|__01__|タンス|1|
|__002__|__01__|椅子|2|
|__001__|__02__|タンス|10|
|__002__|__02__|椅子|5|

#### 店舗テーブル
|店舗ID|店舗名|
|:---:|:---:|
|__001__|店舗A|
|__002__|店舗B|
|__003__|店舗C|
|__004__|店舗D|

分けたテーブルをつなぐ必要がある。
その際に『外部キー（Foreing Key）』を使う。
他のテーブルと結合させるために使用する『キー』。

例では、店舗IDが外部キーにあたる。

そういう意味で、まだテーブルを分割する必要がある。
商品名を分けてみる。

#### 商品数量テーブル
|商品ID|店舗ID|数量|
|:---:|:---:|---:|
|__001__|__01__|1|
|__002__|__01__|2|
|__001__|__02__|10|
|__002__|__02__|5|

#### 商品名テーブル
|商品ID|商品名|
|:---:|:---:|
|__001__|タンス|
|__002__|椅子|

## 正規化の手順

何も正規化を行なっていない状態を __非正規形__ という。
下の例では、店舗Aと東京がそれぞれマージされている状態。
つまり、行と列のデータが1：1とならない状態。

|店舗名|都道府県|商品名|数量|
|:---|:---:|:---|---:|
|店舗A|東京|タンス|10|
|||椅子|5

### 第一正規化

データを一行一行にして数行に分ける。

|店舗ID|店舗名|都道府県ID|都道府県名|商品ID|商品名|数量|
|:---:|:---:|:---:|:---:|:---:|:---|---:|
|001|店舗A|01|東京|0001|タンス|10|
|001|店舗A|01|東京|0002|椅子|5

主キーを決める。今回は、`店舗ID`、`商品ID`

この状態を `第一正規形` という。

### 第二正規化

主キーに従属している属性を別のテーブルに分ける。
部分関数従属を取り除く処理のこと。

|属性名|内容|例|
|:---|:---|:---|
|__部分関数従属__|店舗ID、商品IDの __どちらか一方の属性__ によって特定される属性|店舗名、商品名など
|__完全関数従属__|店舗ID、商品IDの __両方の属性__ によって特定される属性|数量

#### 部分関数属性での括り
|店舗ID|店舗名|都道府県ID|都道府県名|
|:---:|:---:|:---:|:---:|
|001|店舗A|01|東京|
|001|店舗A|01|東京|

|商品ID|商品名|
|:---:|:---|
|0001|タンス|10|
|0002|椅子|5|

#### 完全関数属性での括り

両方のIDが必要なので取り除く必要がない。
反対に言えば、どちらか一方の属性がなければ成立しない『値』。

|店舗ID|商品ID|数量|
|:---:|:---|---:|
|001|0001|10|
|001|0002|5|

### 第三正規化

#### 推移的関数従属

主キー以外の属性に従属している属性を別テーブルに分ける。

|属性名|内容|例|
|:---|:---|:---|
|__推移的関数従属__|主キー以外の属性に関数従属している属性|都道府県名は都道府県IDに従属|

|都道府県ID|都道府県名|
|:---:|:---:|
|01|東京|

#### 部分関数属性

|店舗ID|店舗名|都道府県ID
|:---:|:---:|:---:|
|001|店舗A|01|

|商品ID|商品名|
|:---:|:---|
|0001|タンス|
|0002|椅子|

#### 完全関数属性

|店舗ID|商品ID|数量|
|:---:|:---|---:|
|001|0001|10|
|001|0002|5|


## ER図

## SQL

### ステートメント

DBに対する命令。クエリと呼ばれることもある。

### 種類

* DDL
  * データ定義言語
  * Data Definition Language
  * DBオブジェクトの定義に使用する。
    * 例）
      * テーブル
      * インデックス
      * ファンクション
      * トリガー　etc
* DML
  * データ操作言語
  * Data Maniqulation Language
  * テーブルデータの操作に使用
    * データの取得、更新、削除、挿入


  
### データ定義言語　DDL

#### 命令の実行

命令の行にカーソルを置いて `control + return`


#### 複数の命令を実行

複数行選択して `option+x`

#### テーブルの作成

```sql
create table テーブル名 (
  カラム名 データ型 defalult デフォルト値 制約 comment 'コメント', ..., 表制約
) ENGINE = [INNODB | MyISAM];
```

データベースの種類（省略可）
`ENGINE = [INNODB | MyISAM]`

__データ型__

|データ型|内容|
|:---|:---|
|INT|整数値|
|FLOAT|浮動小数点<br />※正の値に限定する場合は unsigned を使用。|
|DATETIME|日時|
|TIMESTAMP|日時|
|CHAR|固定長文字列|
|VARCHAR|可変長文字列|
|BLOB|バイナリデータ（画像や音声、動画など）|

|制約|内容|
|:---|:---|
|UNIQUE|一意制約|
|NOT NULL|NOT NULL制約|
|CHECK|チェック制約|
|PRIMARY KEY|主キー制約|
|FOREIGN KEY|外部キー制約|


#### 書いてみる

__データベースの作成__

```sql
create database test_db;
```

__データベースの削除__

```sql
drop database test_db;
```

__テーブルの作成__

```sql
create table test_db.test_table (
	id int(6) unsigned default 0 comment 'ID',
	val varchar(20) default 'hello' comment '値'
);
```

__テーブルの削除__

```sql
drop table test_db.test_table;
```

__describe（記述する）__

DBeaver（コンソール）でデータベースを表組みになっている状態で確認する。

```sql
-- テーブルをデフォルトで出力。
desc test_db.test_table ;
-- commentありで出力
show full columns from test_db.test_table ;
-- 現時点でのクエリの内容を出力する。
show create table test_db.test_table ;
```

#### アクティブなDBの切り替え

`useキーワード`を使って`アクティブ`なDBを設定できる。

`test_db.test_table`と記述していたものが前をDBを省略して、
`test_table`とかける。

また、現在実行中のDBを確認するには、

`select database();`

__ここまでのまとめ__

```sql
-- DB作成。
create database test_db;
-- DB削除。
drop database test_db;
-- アクティブなDBの切り替え。
use test_db;
-- テーブルを作成する。
create table test_table (
	id int(6) unsigned default 0 comment 'ID',
	val varchar(20) default 'hello' comment '値'
);
-- テーブルを削除する。
drop table test_table ;
-- テーブルの詳細を記述する。
desc test_table ;
-- columns付きでテーブルの詳細を記述する。
show full columns from test_table ;
-- 現時点でのクエリの内容が出力される。
show create table test_table ;
-- 現在実行中のデータベースの確認。
select databese() ;
```

#### 制約（CONSTANT）

制約は、カラム・テーブルに対して行う。
制約を与えることで、カラム・テーブルの状態を正しい状態に保つことができる。

__制約の種類と内容__
|名称|内容|
|---|---|
|UNIQUE|__一意制約__<br />カラムに制約をかけた場合、登録される値は必ず一意であることを担保する。|
|NOT NULL|__NOT NULL__<br />制約カラムに登録される値には必ず値があることを担保する|
|PRIMARY KEY|__主キー制約__|
|FOREIGN KEY|__外部キー制約__|
|CHECK|__チェック制約 (MySQL8.0)__<br /><small>※実装で使う機会はない。</small>|


* __表制約__
  * 表（テーブル）に対して行う制約
    例）複合主キー、外部キー制約など

* __列制約__
  * 列に対して行う制約
    例）NOT NULL 制約など


__書式__

```sql
create table テーブル名 (
    カラム名 データ型 列制約, 表制約
);
```

* `not null`の制約をかけたので、`Null`の欄が『Nullが入ってはいけない。』という意味で『NO』が入る。
* `unique`と制約をかけたので、`Key`の欄が『UNI』となり、一意であることを担保している。
```sql
create table test_table (
	id int not null default 0 comment 'ID',
	val varchar(20) unique comment '値'
)

use test_db;
show full columns from test_table ;
```

#### 主キーの作成（PK: Primary Key）

主キー（レコードを一位に特定するキー）を作成する。

|商品ID|商品名|数量|
|:---:|:---|---:|
|__001__|タンス|10|
|__002__|椅子|5|
|__003__|テーブル|20|
|__004__|タンス|100|

__主キーが一つの場合__

```sql
-- 一旦テーブルを削除する。
drop table test_table ;
-- PK有りのテーブルを作成する。
create table test_table (
	key1 int primary key
);
show full columns from test_table;

-- KeyがPRIになっており、プライマリー・キーに設定されたことを示している。
-- 何も制約を指示しなくても、not null, uniqueはついている。
```


__複合主キーを設定__
```sql
-- 複数のキーで値を特定できればいいので、ユニークである必要はない。
-- Nullになっていなければいい。
create table test_table (
	key1 int,
	key2 int,
	primary key (key1, key2)
);
```

#### 自動IDの付与（AUTO INC）


Key_nameがPRIMAEYになっていたらOK

auto incrementは1つのテーブルにつき1つだけ。
デフォルト値をわざわざ指定する必要はないので、デフォルト値はつけられない。

__自動IDを付与する__

主キーは一意の値であればなんでもいい場合に付与する。

`auto_increment`を設定する場合にインデックスが振られるようにしないといけない。
`primary key` または `unique`をつけることでインデックスが振られるようにできる。

```sql
create table test_table (
	key1 int auto_increment primary key
)
```

テーブルを確認する。
```sql
show full columns from test_table ;
または、
desc test_table ;
```

インデックスが振られるようになっているかを確認する。
`Key_name`が`PRIMAEY`になっていれば設定OK。
```sql
show index from test_table;
```

#### テーブル定義の変更（ALTER TABLE）

__名前と年齢のカラムを追加する。__

```sql
alter table test_table 
add column name varchar(20) not null default '髙廣信之' comment '氏名',
add column age int(11) not null default 59 comment '年齢';
```

__任意のカラムの後ろに新規でカラムを追加する。__

```sql
alter table test_table 
add column gender varchar(10) not null default '男' comment '性別' after name;
```

__カラムの最初に追加する。__

```sql
alter table test_table 
add column country varchar(20) not null default '日本' comment '日本' first;
```

__カラムの属性を変更する。__
カラムの情報を変更すると元のものは削除されて新たに設定された値だけになる。
例えば、varchar(20) だったのを　text(100)だけだとそれ以降にせってしたあった情報は全てなくなる。

```sql
alter table test_table 
modify column gender varchar(10) not null default 'man' comment 'gender';
```

__カラムを削除する__。
```sql
ALTER table test_table 
drop column country;
```

__primary keyを削除する。__
auto incrementを削除してからではないとエラーになる。
エラーが出たらChatGPTで調べる。解決してくれる。

```sql
ALTER table test_table 
modify column key1 int(11) not null,
drop primary key;
```

#### テーブルを作成

```sql
create table shops (
id int(10) unsigned auto_increment primary key,
name varchar(20) not null,
pref_id int(2) unsigned not null);
```

複合主キーがある場合。
```sql
create table stoks (
product_id int(10) unsigned,
shop_id int(10) unsigned,
amount int(10) unsigned not null,
primary key (product_id, shop_id)
);
```

primary_keyした時点でnot_nullつくよ。