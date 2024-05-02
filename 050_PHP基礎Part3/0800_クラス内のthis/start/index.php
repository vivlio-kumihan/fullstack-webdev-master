<?php 
class Person
{
  private $name;
  public $age;

  function __construct($name, $age)
  {
    // $thisという変数は、
    // インスタンス化されたオブジェクトのことを指す。
    $this->name = $name;
    $this->age = $age;
  }

  function hello() {
    // helloメソッドを読んだら返ってくる命令はこのecho。
    echo "Hello, {$this->name}!<br />";
    // メソッド・チェーンが出来るようにreturnで$thisを呼ぶんだね。
    return $this;
  }
  function bye() {
    echo "Goodbye, {$this->name}!<br />";
    return $this;
  }
}

$john = new Person('John', 40);
$john->hello();
echo "=========================<br />";
$john->bye();
echo "=========================<br />";
// 『return $this;』をすることでメソッド・チェーンができる。
$john->hello()->bye();
echo "=========================<br />";
// 別にインスタンスを生成させて、同じようにメソッド・チェーンする。
$paul = new Person('Paul', 81);
$paul->hello()->bye();