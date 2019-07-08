<?php
  $total;
  $large;  $medium; $toppings; $donate;


function calcPrice($large, $medium, $toppings, $donate){
  $total = (1000* $large) + (700 * $medium);

  if ($toppings == "meat") {
    $total += 150*($large + $medium);
  } else if($toppings == "vegetable") {
    $total +=100 *($large + $medium);
  }else if($donate == "none"){
    $total +=0;;
  }else{
    $total = $total;
  }

  if($donate == "donate"){
    $total +=200;
    echo "<h1>";
    echo "Thank you for donating";
    echo "</h1>";
  }
  return $total;
}

echo $total;
$large = $_POST["large"];
$medium = $_POST["medium"];
$toppings = $_POST["toppings"];
$donate = $_POST["donate"];

echo "<pre> Hello \r world";
$answer = calcPrice($large, $medium, $toppings, $donate);
echo "Your total is Ksh." .$answer;

 ?>
