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
$lines = $_POST["members"];
print_r($_POST['members']);

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