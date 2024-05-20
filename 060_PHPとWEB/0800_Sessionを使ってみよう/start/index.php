<?php

// Sessionをスタートさせる。
// localには値は残らない、値はserver側に保持する。
session_start();

// Serverに値を送る。
// スーパー・グローバル変数（連想配列）に値を代入する。
$_SESSION['SESSION_VISIT_COUNT'] = 1;
echo $_SESSION['SESSION_VISIT_COUNT'];

// リロードして行われることは、
// Application/Name/を見ると、『PHPSESSID』という項目ができる。
// これがServerへ送られたSession ID。
// Valueは、送られてくる端末ごとに違う。
// Serverは、session IDをResponse HeaderのCookieに乗せて
// 端末へ返しブラウザ内部で保持される。
// 2回目以降、Session IDをキーとして値をやり取りする。
// 端末とSession IDは一位。

// では、先ほど、
// $_SESSION['SESSION_VISIT_COUNT'] = 1;
// として値を格納したSession IDは、どこに保存されているのか？

// 『phpinfo();』として使っているPHPの情報ページを開けて
// 『tmp』という文言で検索する。
// 『upload_tmp_dir』という項目にあるパスをターミナルで開け、
// 『vim』するとテキスト情報として書かれていることを確認できる。