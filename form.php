<?php
  $num1; $num2;
  echo "<pre>";
  print_r([$_POST]);
  echo "</pre>";
  function calcSum($num1, $num2){
    $result = $num1 + $num2;
    return $result;
  }
  $num1 = $_POST["num1"];
  echo $num1;
  $num2  = $_POST["num2"];

  $answer = calcSum($num1, $num2);
  echo "<h1>";
  echo $answer;
  echo "</h1>";
?>
