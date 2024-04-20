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