<?php 
$score = 70;
$non_attend = 1;

if($score < 50 || $non_attend >= 5) {
  echo "不合格";
} elseif($score < 70) {
  echo "合格";
} else {
  echo "優秀";
}