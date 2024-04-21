<?php
function counter($step = 1)
{
  global $num;
  $num += $step;
  return $num;
}
$num = 0;
echo counter(100);