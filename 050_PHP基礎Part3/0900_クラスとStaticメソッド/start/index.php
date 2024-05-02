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