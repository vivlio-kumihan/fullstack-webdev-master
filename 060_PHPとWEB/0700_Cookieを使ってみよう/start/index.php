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
