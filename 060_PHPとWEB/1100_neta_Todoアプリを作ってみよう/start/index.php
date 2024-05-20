<?php
// セッション開始
session_start();

// 自身のURLが取得するときに使うスーパー・グローバル変数『$_SERVER』の
// 引数『PHP_SELF』
$self_url = $_SERVER['PHP_SELF'];
?>

<form action="<?php echo $self_url; ?>" method="post">
  <input type="text" name="title">
  <!-- ここがトリガー『create』 -->
  <input type="submit" name="type" value="create">
</form>

<?php
/**
 * スーパー・グローバル変数$_POSTに引数['type']を渡すと、
 * input要素でvalue属性の値と紐づく！！
 */
?>

<?php
// だからボタンを押したらその押したアプリが発火する。
// if文の中でボタンの属性を踏まえた処理をしていく寸法。
if (isset($_POST['type'])) {
  if ($_POST['type'] === 'create') {
    // インデックスと入力した中身が紐づいた配列を作ったらいいだけ。
    // インデックスは、引数『id』と自動的に紐づくのだね。
    $_SESSION['todos'][] = $_POST['title'];
    echo "新しいタスク[{$_POST['title']}]が追加されました。<br>";
  } elseif ($_POST['type'] === 'update') {
    $id = $_POST['id'];
    $_SESSION['todos'][$id] = $_POST['title'];
    echo "タスク[{$_POST['title']}]に変更されました。<br>";
  } elseif ($_POST['type'] === 'delete') {
    $id = $_POST['id'];
    array_splice($_SESSION['todos'], $id, 1);
    echo "タスク[{$_POST['title']}]が削除されました。<br>";
  }
}

if (empty($_SESSION['todos'])) {
  $_SESSION['todos'] = [];
  echo "タスクを入力しましょう！";
  die();
}
?>
<ul>
  <?php foreach ($_SESSION['todos'] as $idx => $value) : ?>
    <li>
      <form action="<?php echo $self_url; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $idx; ?>">
        <input type="text" name="title" value="<?php echo $value; ?>">
        <!-- トリガー『delete』 -->
        <input type="submit" name="type" value="delete">
        <!-- トリガー『update』 -->
        <input type="submit" name="type" value="update">
      </form>
    </li>
  <?php endforeach; ?>
</ul>

<!-- 
<?php for ($idx = 0; $idx < count($_SESSION['todos']); $idx++) : ?>
  <li>
    <form action="<?php echo $self_url; ?>" method="post">
      <input type="hidden" name="id" value="<?php echo $idx; ?>">
      <input type="text" name="title" value="<?php echo $_SESSION['todos'][$idx]; ?>">
      <input type="submit" name="type" value="delete">
      <input type="submit" name="type" value="update">
    </form>
  </li>
<?php endfor; ?>
-->
