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





