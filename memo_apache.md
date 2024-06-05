
# Apacheの基礎

## プレゼンテーション層担当

Web3層アーキテクチャーのなかでプレゼンテーション層を担当している。

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
* `ディレクティブ`によって設定を変更する。
* `httpd.conf` `.htaccess` へ設定値を編集して追加・変更していく。

## httpd.confを編集する

`MAMP/conf/apache/httpd.conf` このファイルを観察する。

__L29__
`ServerRoot`の部分、これが`ディレクティブ`。

```apache
ServerRoot "/Applications/MAMP/Library"
```

`ServerRoot` => `ディレクティブ`
`"/Applications/MAMP/Library"` => `ディレクティブ`に渡す`値`


__L217__

```apache
DocumentRoot "/Applications/MAMP/htdocs"
```

`公開用`の`ドキュメント・ルート`ととして`Apache Web Server`で動く。

__L227__
これがセクション。
指定する範囲の中でどんなオプションをつけるか。

```apache
<Directory />
  Options Indexes FollowSymLinks
  AllowOverride None
</Directory>  
```

この記述の意味は、`/`pathとそれ以降のディレクトリに対して、
`Options`ディレクティブ、`AllowOverride`ディレクティブに値が設定される。

## Alias（エイリアス）
特定の`path`を`ディレクトリ`や`ファイル`に紐づける。まぁ、主にディレクトリとの紐付け。リダイレクトの設定においてパスの記述量が劇的に減らせることができるから。

```apache
Alias /[エイリアス名] ディレクトリまでの絶対パス
または、
Alias /[エイリアス名] ファイルまでの絶対パス
```
`パスに日本語`が含まれている場合は特に、パスには`ダブルクォーテーション`で囲む。

```apache
Alias /apache "/Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/"

または、

Alias /apache_hello "/Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/0100_【ALIAS】URLをマッピング/start/index.html"
```

* `http://localhost:8888/apache/` => `ドキュメント・ルート + エイリアス名` の `URL` でアクセスすると `Aliasディレクティブ`で指定した `path` に遷移することができる。
* ディレクトリへの遷移は、該当ディレクトリ中のindex.htmlを描画する。
* __なお、ディレクトリに遷移させたいときは `path/to/derectory/` とディレクトリ名の後ろに `/` を付与すること。__

## コンテキスト

### 種類
* サーバー設定ファイル
  * httpd.conf, srm.conf, access.conf etc
* バーチャル・ホスト
  * `<VirtualHost>`内で使用可能
    * 一つのホストで複数のドメインを持つことができる技術
* ディレクトリ
  * `<Directory>`, `<Location>`, `<Files>` etc
    * セクションを表す `<Directory>` ディレクティブは使用頻度大。
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


## https.confでやるディレクトリの設定

### index.html以外のファイルへアクセスさせる
https.confを使ってディレクトリの設定をしてみる。例えば `Alias` ディレクティブを使って、ディレクトリにアクセスしたら包含されている `index.html` を読ませる設定を書く。

別のファイルを読むようにするには、`DirectoryIndex` ディレクティブに `DirectoryIndex` ディレクティブへ表示させたいファイル名を値として与える。

このようにして、任意のファイルへのアクセスを取り扱うことができる。

```apache
<Directory "/Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/">
  DirectoryIndex file1.html
</Directory>
```

### ディレクトリの内容をリスト表示
httpd.confにはデフォルトで、ディレクトリに該当のファイルがない場合は、包含しているファイルやディレクトリをリスト形式で表示するように、`httpd.conf`の`<Directory>` ディレクティブに設定してある。

`Options Indexes`の部分。

__httpd.conf L227__
```apache
<Directory />
    Options Indexes FollowSymLinks
    AllowOverride None
</Directory>
```

デフォルトの挙動を止めるようにするオプションは以下のようにする。

```apache
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

* `httpd.conf`の`AllowOverride All` を設定する。
  * オプションを `All`（反対は、`None`）にすると、`.htaccess` の有無に関わらず全てほディレクトリに対して検索をかける。（パフォーマンスは落ちるが仕方ない。）
* 基本的には `httpd.conf` に設定を追加する。
* 配置したディレクトリ、サブディレクトリで有効になる。
* 下位の階層の設定は、上位の階層で指定された設定を上書きできる。
* 下位の設定で変更があっても、上位の設定は維持される、上書きされない。
  
__.htaccessが有効になる範囲に留意する。__

* 例えば、
  * dir1
    * dir2-1
    * dir2-2
      * dir3-1
      * dir3-2
  * .htaccessファイルが、
    * dir1 => 自身と配下の全てのディレクトリに効く。
    * dir2-2 => 自身と配下の全てのディレクトリに効く。
    * dir3-1 => 自身のディレクトリに効く。
  * __dir3の両方で、それぞれに設定を変更した場合に各個に効く。__
  * __dir2-2は、配下のディレクトリで変更があっても関係ない。自身の設定を維持する。__
  
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

# 値だけをを『.htaccess』、設定後はコメントアウトか削除。
<Directory "/Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/dir-test/">
  DirectoryIndex file2.html
</Directory>
```

__`dir-test` ディレクトリに `.htaccess` ファイルを作成し、ディレクティブに抜き取った値を書くだけ。__

ローカルでやると `http://localhost:8888/dir-test/` というURLができて、`file2.html` が表示される。該当ファイルがなければインデックスが表示される。

# URLのリダイレクト

異なるURLへ転送する。（ブラウザのURL表示も変更される。）

* コンテキスト:	
  * サーバ設定ファイル, バーチャルホスト, ディレクトリ, .htaccess
* 構文:
  * Redirect [status] URL-path URL
  * [status] => 301, 302など。。。
* status:
  * 301 
    * 永続的なリダイレクトの設定に使用
    * WEBページ（サーバー）の引越しした際に用いいられる。従前のURLでアクセスされたら新しいURLへの転送を固定する必要がある場合。
  * 302
    * 一時的に表示ページを変更したい場合。例えば、工事中のページにアクセスされた場合に関連するページに飛ばす。（デフォルト）
* ブラウザの挙動:
  * Header のレスポンスヘッダが300番台の場合
  * Locationに指定されたURLへリダイレクト
  * Redirectループに注意

__例）__
では、リダイレクトのルートとなるディレクトリに.htaccessを設定して、`redirect-test`ディレクトリにアクセスされたら`apache`へのリダイレクトやってみる。

`ドメイン`より`下のURL`は完全に書かないといけない。

```apache
Redirect /apache/redirect-test /apache
```
例えば、`redirect-test`ディレクトリは、`Alias` の `apache` の中にあるとして、
`redirect-test`ディレクトリがなければ、または、そこにアクセスされたら、
`apache` ディレクトリにリダイレクトされる。

ちなみに、デフォルトでは、`status` は 302（とChatGPTは言っていた。）

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

# ログの設定と確認

## [LogLevel]

どのレベルまでエラーログを出力するか。
`httpd.confを参照して確認。`

`コンテキスト: サーバ設定ファイル, バーチャルホスト`

|レベル|説明|
|---|---|
|emerg|緊急|
|alert|直ちに対処が必要|
|crit|致命的な状態|
|error|エラー|
|warn|警告（デフォルト）|
|notice|普通だが、重要な情報|
|info|追加情報|
|debug|デバッグメッセージ|

## [ErrorLog]
エラーログの吐き出し場所を指定
`コンテキスト: サーバ設定ファイル, バーチャルホスト`

## [CustomLog]
ログファイルの吐き出し場所を指定
`コンテキスト:	サーバ設定ファイル, バーチャルホスト`

記号の意味は以下のサイトに説明がある。

[Apache モジュール mod_log_config](https://httpd.apache.org/docs/2.4/ja/mod/mod_log_config.html)

## [LogFormat]
CustomLogの出力フォーマットを決定
`コンテキスト:	サーバ設定ファイル, バーチャルホスト`

## ログの確認
Unix系（Mac, Linux）
```
tail -f ファイルパス
```
```
tail -f /Applications/MAMP/logs/apache_error.log
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
  * `-` (dash) 書き換えしない（フラグのみ使用）
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
RewriteRule rewrite-test/index.html /apache/rewrite-test/tmp.html
```

#### Pattern（検索窓に投げるURLのこと）

この`.htaccess` は、エイリアスが `/apache` に設定してあるので、パスの先頭に `/apache` をつける必要はない。
`.htaccess` からの相対パスでファイルを指定する。

#### Substitution（実際にリンクしたいURL）

リンクの置き換えのファイル指定は、パスの先頭に『/apache』をつける必要があるので要注意。

#### 検索窓に表示されるURL

`URL` は `Pattern`（検索窓に投げたURL）が使われる。
`URL` はブラウザには伝えられず、サーバー側で擬似的に切り替えの処理を行うから。
このように`RewriteRule`を使った、Apacheの内部で行われるリダイレクトの処理を `インターナル・リダイレクト` という。
ここが `REDIRECT` とは大きく違うところ。

これに`Rオプション`をつけると普通のリダイレクトになる。
__URLも切り替わる__。

```apache
RewriteRule rewrite-test/index.html /apache/rewrite-test/tmp.html [R]
```

### - (dash) 書き換えしない（フラグのみ使用）

* フラグのみ使用する際に使用

書き換えをせずに[F]オプションをつけると
```apache
RewriteRule redirect-test/index.html - [F]

// => Forbidden(禁止)
// => You don't have permission to access this resource.
```

### もっとRewriteRuleでやるインターナル・リダイレクト

__その1__

検索窓に入力して、結果は意図通り出力するが、検索窓に変化なし。

```apache
RewriteRule redirect-test/index.html /apache/redirect-test/tmp.html
```

__その2__

フラグをつける。`[R]`でリダイレクトにしてみる。

```apache
RewriteRule redirect-test/index.html /apache/redirect-test/tmp.html [R]
```

__その3__

`jpg`ファイルを`png`へリダイレクトする。
検索窓には拡張子が`jpg`のままだけど検証で見ると`png`にちゃんとリダイレクトしている。

```apache
RewriteRule redirect-test/imgs/150.jpg /apache/redirect-test/imgs/150.png
```

__その4__　`問題あり`の記述。解決は`後方参照`でやる。

単純に、sub1/index.htmlをsub2/index.htmlへリダイレクトなら問題ないが、この記載では意図しない動きになることがある。
この書式の状態で、sub1/file.html sub1/file2.htmlにアクセスすると全てsub2（sub2/index.html）へアクセスしてしまうから。

```apache
RewriteRule redirect-test/sub1/ /apache/redirect-test/sub2/
```

## RewriteBase

リダイレクトするパスが同じなら略記法がある。

```apache
RewriteEngine On

RewriteBase /apache/redirect-test/

RewriteRule redirect-test/index.html tmp.html
RewriteRule redirect-test/imgs/150.jpg imgs/150.png
RewriteRule redirect-test/sub1/ sub2/
```

## RewriteLogの設定とバージョンの確認

`httpd.conf`に追記する。

```apache
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

### Apacheのバージョンの確認

`httpd.comf` => `ServerRoot "/Applications/MAMP/Library"`

このディレクトリの中の`bin/apachectl`がアプリケーションなので、

```zsh
$ apachectl -v

Server version: Apache/2.4.58 (Unix)
Server built:   Feb 10 2024 01:12:11
```

# [Rewrite]で後方参照を使う

`()`グループ化を使ってパスを切り取る
$N: `$1〜$9`

|記号|意味|
|---|---|
|.|任意の一文字|
|*|0回以上の繰り返し|
|+|1回以上の繰り返し|
|{n}|n回の繰り返し|
|[]|文字クラスの作成|
|[abc]|aまたはbまたはc|
|[^abc]|aまたはbまたはc以外|
|[0-9]|0~9まで|
|[a-z]|a~zまで|
|$|終端一致|
|^|先頭一致|
|\w|半角英数字とアンダースコア|
|\d|数値|
|\ |エスケープ|
|()|文字列の抜き出し（グループ化）|

```apache
RewriteRule rewrite-test/imgs/(\d{3}).jpg imgs/$1.png
RewriteRule rewrite-test/sub1/(.+\.html) sub2/$1
```

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
つまり、クエリで渡ってきた値を設定された変数に格納、または、絶対パスにしてリライトを行ってみる。

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
# そして、『[R]』オプションをつけるとブラウザの検索窓にマッチした結果が出てくるのでバグ探し材料になる。
# クエリパラメータをクリアするためですとの説明は理解できない。
RewriteRule rewrite-test/sub1 sub1/%1? [R]

RewriteCond %{QUERY_STRING} p=(.+)
# .* は任意の文字列に一致する正規表現です。
# - は置換部分で、ここでは「何も変更しない」という意味です。
# [F] は「Forbidden」で、403 Forbidden ステータスコードを返すフラグです。
RewriteRule .* - [F]

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
# %{HTTP_ACCEPT}の条件は、開発ツールのネットワークのリクエスト・ヘッダーのアクセプトに行って、image/webpがあればtrueを返してRewriteRuleを実行させる。
RewriteCond %{HTTP_ACCEPT} image/webp
RewriteCond /Applications/MAMP/htdocs/fullstack-webdev-master/070_Apacheの基礎/rewrite-test/imgs/$1.webp -f
RewriteRule /?rewrite-test/imgs/(.+)\.(jpe?g|png) imgs/$1.webp
```

# サブドメインの設定

例えば、`dev.local`という`ドメイン`があった場合、
`先頭に任意の文字列`をつけたものを`サブドメイン`という。

## hostsにドメインとサブドメインを設定

この書式で `hosts` ファイルに設定する。
`127.0.0.1` => ループ・バック・アドレス
`dev.local` => ドメイン

```apache
127.0.0.1 dev.local
127.0.0.1 www.dev.local
127.0.0.1 vhost.dev.local
```

* Windowsの場合
  * `C:\Windows\System32\drivers\etc\hosts`
* Mac, Linuxの場合
  * `/private/etc/hosts`

## wwwなしのドメインにリダイレクト

`www.dev.local:8888/apache/` で検索されたら、
`dev.local:8888/apache/` のパスをリダイレクトする。

* `%{HTTP_HOST}` => ドメインとポートを取る。
* ドメインが、正規表現の`^www\.dev\.local`にマッチしたら、
* `[NC]` => 大文字小文字の区別をしないオプションをつけてリダイレクトする。
* `RewriteRule` の `.?` には、検索窓に入力されたコンテキスト・パスが入るのだが、ドメインを変えてしまうので `リダイレクト` には必要ない。とりあえず、引数として入れておかなければいけないからというだけの意味合い。

```apache
RewriteCond %{HTTP_HOST} ^www\.dev\.local [NC]
RewriteRule .? http://dev.local:8888%{REQUEST_URI} [R=301]
```

## 特定のディレクトリをサブ・ドメインのルートにする

### 完成コード

```apache
RewriteCond %{HTTP_HOST} ^vhost\.dev\.local [NC]
RewriteCond %{REQUEST_URI} !^/apache/rewrite-test/vhost/
RewriteRule (.*) vhost/$1
```

### 前提の確認

```apache
RewriteRule A B
```
* A => コンテキスト・パスが入っている。
  * エイリアス `apache` までは省略できる。
* B => コンテキスト・パスが入っている。
  * `rewrite-test` までは省略できる。

### 留意点

理解できたことは、`RewriteRule`の処理の中で __『パスは相殺される』__ こと。

このルールに対して、

```apache
RewriteRule (.*) vhost/$1
```

検索窓に `http://vhost.dev.local:8888/apache/` を入力する。
`(.*)`には __『↑このコンテキスト・パス』__ が入る。

ここで重要なのは、
共通部分の `http://vhost.dev.local:8888/apache/` を __相殺する__ から、
文字が『有』っても『無』くても連続した文字列ということになる。

リダイレクトする文字列は、

```apache
vhost/$1
    ↓
`http://vhost.dev.local:8888/apache/rewrite-test/vhost/文字が『有』っても『無』くても連続した文字列`
```
ここへリダイレクトする。

そして、`vhostディレクト` に `file1.html` というファイルがあるとして、
検索窓に `http://vhost.dev.local:8888/apache/file1.html` を入力する。

リダイレクトする文字列は、

```apache
vhost/$1
    ↓
`http://vhost.dev.local:8888/apache/rewrite-test/vhost/file1.html`
```
このようにして、`vhost`にあるファイルへのパスが通りリダイレクトされる。

コンテキスト・パスに対して起点となるエイリアスを作っておくことは重要。

# DEFLATE gzipを使ったデータの圧縮

## [AddOutputFilterByType]

> __コンテキスト：サーバ設定ファイル, バーチャルホスト, ディレクトリ, .htaccess__

`gzip` で `Apache` からクライアントに返すレスポンスの容量を軽くする。
`mod_deflate.c` というモジュールを使う。
`mime` タイプが一致したものを `DEFLATE` というフィルターをかまして圧縮する。

次のモジュールが有効になっていることを確認します。
`mod_deflate, filter_module`

```apache
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/css text/javascript
</IfModule>
```
## [DeflateCompressionLevel]
> __コンテキスト：サーバ設定ファイル, バーチャルホスト__

1（低圧縮）から9（高圧縮）のレベルがある。
`httpd.conf` に設定する。

```apache
DeflateCompressionLevel 5
```

# WEBとキャッシュ

## キャッシュの種類

* ブラウザ側に保存
  * 画像、CSS、JSなど
* サーバー側に保存
  * メモリ上にファイルなどを読み込む
  * PHPの実行結果などをHTMLとして保持

## ブラウザのキャッシュ制御

|検知の種類|内容|
|---|---|
|__ETag__ で変更を検知|__INode、変更日時、サイズ__ で判定|
|__Last-Modified__ で変更を検知|__最終更新日時__ で判定|

## Etag キャッシュの有効化

ブラウザのキャッシュを使わずにサーバーから直接ファイルを読む。
ステータス：200

サーバーからの応答であるレスポンス・ヘッダーに
E-tag："128-5e59f61af6a40"
INode、更新日時、ファイルサイズの情報によって出猟される固有の番号がブラウザに返る。

これをブラウザからサーバーへ同じリクエストで送信する場合に、リクエスト・ヘッダー内のパラメーターとしてE-tagを付与する。

コマンドRすると、ステータスは304でブラウザのキャッシュを使っている状態になり、
If-None-Matchのパラメーターに先ほどのE-tagで設定された値が入る。

サーバーは自身のE-tagの値と送られてきたIf-None-Matchの値を比べ同じであれば、ページ内容に変更がないようだからブラウザ側のキャッシュを使って表示してねと304を返す。

## Last-Modified キャッシュの有効化