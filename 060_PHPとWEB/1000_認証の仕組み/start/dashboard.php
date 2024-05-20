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
