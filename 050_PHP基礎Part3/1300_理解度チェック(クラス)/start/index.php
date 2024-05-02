<?php
/**
 * 理解度チェック（クラス）
 * 
 * ファイル書き込みを行うためのクラスを定義してみましょう。
 * 
 * ヒント）PHP_EOL: 改行するための特殊な定数です。
 * 
 * クラスを定義する。
 * 必要なプロパティを定義する。
 *    ファイル
 *    中身
 *    合成する際に追記するオプション　
 *      -> これは定数で指定する。
 * コンストラクター関数を定義する。
 *    ファイル名を定義する。
 * クラスのインスタンスを生成させると、順に発火していく関数を定義する。
 *    append    追記
 *    newline   改行
 *    commit    ファイルに追記ありで書き込み
 */

class MyFileWriter {
  // 必要なプロパティを定義
  private $file_name;
  private $content = '';
  public const APPEND = FILE_APPEND;

  // コンストラクター関数の定義
  function __construct($file_name) {
    $this->file_name = $file_name;
  }

  // メソッドの定義
  function append($content) {
    $this->$content .= $content;
    return $this;
  }
  function newline() {
    return $this->append(PHP_EOL);
  }
  function commit($flag = null) {
    file_put_contents($this->file_name, $this->content, $flag);
    $this->content = '';
    return $this;
  }
}

/**
 * この問題で求められていること。
 *    クラスの引数は1つ。
 *    メソッドチェーンをする。
 *    commitメソッドでは引数の切り替えが必要。
 *    ファイルに入力が終わったらインスタンスの値は初期化する。
 * これで何をしなければいけないかをイメージできるようになること。
 */
$file = new MyFileWriter('sample.txt');
$file->append('Hello, Bob.')
      ->newline()
      ->append('Bye, ')
      ->append('Bob.')
      ->newline()
      ->commit()
      ->append('Good night, Bob.')
      ->commit(MyFileWriter::APPEND);

// // commit
// file_put_contents('sample.txt', $content);
// $content = '';
// $content = 'Good night, Bob.'; // append
// // commit
// file_put_contents('sample.txt', $content, FILE_APPEND);
// $content = '';

// $content = 'Hello, Bob.'; // append
// $content .= PHP_EOL; // newline
// $content .= 'Bye, '; // append
// $content .= 'Bob.'; // append
// $content .= PHP_EOL; // newline