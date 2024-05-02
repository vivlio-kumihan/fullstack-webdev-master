<?php
/**
 * クラス継承
 */
class Person {
  // protectedとは、
  //    自身のクラスとそれを継承している
  //    『クラスの内側!!』で使用可能であることを宣言している。
  //    外部からアクセスできないよ！
  protected $name;
  public $age;
  public const WHERE = 'Earth';
  public static $WHERE = 'earth';

  function __construct($name, $age) {
      $this->name = $name;
      $this->age = $age;
  }
  
  function hello() {
    echo "Hello, {$this->name}!";
    return $this;
  }
  
  static function bye() {
    echo 'Good-bye!';
  }
}
  
  // クラス継承をやってみる。
  // 親クラスで設定されたプロパティのスコープがprivateだったら
  // 子に届かない。publicになっていることを確認しないとね。
  class Japanese extends Person {
    // 継承のクラスで静的プロパティも上書きできる。
    public static $WHERE = "大阪";
    public $gender;
    public $adress;
    // 必要なプロパティは最初に宣言が必要だけど、
    // そのまま持ってくるだけ。
    function __construct($name, $age, $gender, $adress)
    {
      $this->name = $name;
      $this->age = $age;
      $this->gender = $gender;
      $this->adress = $adress;
    }
    function hello() {
      echo "こんにちは、{$this->name}さん！<br />";
      echo "年齢は、{$this->age}歳<br />";
      echo "性別は、{$this->gender}性<br />";
      // 変数展開ができない。。。だからこの書き方で統一してあるんだね。。。
      echo "ご出身は、" . static::$WHERE . "ですね。<br />";
      return $this;
    }
}

$personNob = new Person("髙廣", 59);
$nob = new Japanese("髙廣", 59, "男", "大阪");
$nob->hello();