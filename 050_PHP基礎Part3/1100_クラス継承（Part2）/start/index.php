<?php

use Person as GlobalPerson;

/**
 * クラス継承
 */

// abstractを含むメソッドを持っているクラスは、
// 先頭にabstractと書かないといけない。
// で、そうなると、このクラスは直接呼び出すことが出来なくなる。
abstract class Person 
{
  public $name;
  public $age;
  public const WHERE = 'Earth';
  public static $WHERE = 'earth';

  function __construct($name, $age) 
  {
    $this->name = $name;
    $this->age = $age;
    // 自身のプロパティ
    echo self::$WHERE;
    // 静的プロパティを宣言されたクラスの値がかえる。
    // 継承先のクラスで静的プロパティの宣言がなければ『自身』の値が返る。
    echo static::$WHERE;
  }

  // // finalを付けると継承先のクラスではこのメソッドは使えない。
  // final function hello() {
  //   echo "Hello, {$this->name}!";
  //   return $this;
  // }

  // abstract（要旨）を付けると、
  // このメソッドは継承先のクラスで実装を書いていると宣言することになる。
  // ここの宣言が抜けていても継承先でメソッド定義しているので動くのだが、
  // メソッドのルートがここにあることが重要になることがある。
  // 後々わかるだろうからここは大まかにこうするものだと覚えておく。
  abstract function hello();

  static function bye() 
  {
    echo 'Good-bye!';
  }
}

class Japanese extends Person 
{
  // 継承先のクラスで静的プロパティをオーバーライドする。
  public static $WHERE = "大阪";
  // 継承先のクラスで新たにプロパティを宣言する。
  public $gender;

  function __construct($name, $age, $gender)
  {
    // 行数を減らす効果にはならないと思うが、parentで書き直せる。
    // 結局引数を書かないといけないからね。
    parent::__construct($name, $age);
    // $this->name = $name;
    // $this->age = $age;
    $this->gender = $gender;
  }
  function hello() 
  {
    echo "こんにちは、{$this->name}さん！<br />";
    echo "年齢は、{$this->age}歳<br />";
    echo "性別は、{$this->gender}性<br />";
    // static, self, parentについて
    // 静的 === 自身
    echo "ご出身は、" . static::$WHERE . "ですね。<br />";
    echo "ご出身は、" . self::$WHERE . "ですね。<br />";
    // 親のプロパティ
    echo "ご出身は、" . parent::$WHERE . "ですね。<br />";
    return $this;
  }
}

$nob = new Japanese("髙廣", 59, "男", "大阪");
echo "<hr />";
$nob->hello();
echo "<hr />";
echo $nob->name;
echo "<hr />";
echo $nob->age;