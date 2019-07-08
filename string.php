<?php

$my_str = "Hello world";
$my_str_ = 'Hello World';
$strin = "Hello world. It's a beautiful day";
print_r(explode(" ", $strin));


//echo "Hello, $my_str";
// echo 'Hello, $my_str';
// echo $my_str;
// echo $my_str_;
// echo "My name is ".$my_str_.$my_str_;
echo "<pre>I will be back \n to see you later";
echo "</pre>";

echo "<h1>Hello \r a whole new world</h1> ";

 // echo "\tHello \r world";
 // echo str_word_count($my_str);
 // echo strtolower($my_str);
 // echo sha1($strin);
 // echo md5($strin);
 // echo substr($strin, 0, 10);

echo "Using a foreach loop <br/>";
$Myarray = array('Jack' => 19,"Hogo"=> 20, "Alex"=>29, "Sam"=>34, "Quincy"=>29);
foreach ($Myarray as $key => $value) {
    echo "My name is : ".$key." and age is ".$value;
    echo "<br/>";
}
echo "<br/>";
echo "Using a for loop <br/>";
$keys = array_keys($Myarray);//get keys from array $age
print_r($keys);// prints an array in php
echo "<br/>";

$array_size = count($Myarray);



for ($i=0; $i <$array_size ; $i++) {
    echo $keys[$i] . "<====>" . $Myarray[$keys[$i]];
    echo "<br/>";
}

//multidimensional
//arrays

$MultiArray = array(array(1,2,3,4,5,6,7,9), array(11,12,13,14,15,16,17,18,19));
echo "<pre>";
print_r($MultiArray);
echo "</pre>";

echo $MultiArray[0][4]; // to access individual element in multidimensional array
$mult_size = count($MultiArray);

for ($i=0; $i <$mult_size ; $i++) {
    $individual_size = count($MultiArray[$i]);
    echo "In array: ".$i."<br/>";
    for ($j=0; $j <$individual_size ; $j++) {
        echo $MultiArray[$i][$j].", ";
    }
    echo "<br/>";
}
