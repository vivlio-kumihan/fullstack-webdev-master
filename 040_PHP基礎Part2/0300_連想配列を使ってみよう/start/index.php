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