<?php
class Person
{
  // クラス内がスコープ
  private $name;
  // グローバルなスコープ
  public $age;

  // コンストラクター
  function __construct($name, $age)
  {
    $this->name = $name;
    $this->age = $age;
  }

  function hello()
  {
    echo "hello, {$this->name}<br />";
  }
}

$nob = new Person("髙廣", 59);
// プロパティの呼び出し
echo $nob->age . "<br />";
// helloメソッドの呼び出し
$nob->hello();