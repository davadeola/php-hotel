<?php
session_start();
require 'phpInterface.php';


  if (!isset($_SESSION['username']) && $_SESSION['usertype'] == 'ADMIN ') {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
    unset($_SESSION['usertype']);
    unset($_SESSION['username']);
  	header("location: login.php");
  }

$item = $_POST["item_name"];
$price = $_POST["price"];
$image = $_FILES["image"]["name"];
updateItems($item, $price, $image);

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Upload a new Food Item</title>
     <link rel="stylesheet" href="bootstrap.min.css">
     <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="burgerstyles.css">
   </head>
   <body>
     <div class="back">
       <div class="container-fluid d-flex h-100">
         <div class="row content">
           <div class="justify-content-center align-self-center mx-auto d-block">
             <h1 class="display-3">Update Items</h1>
             <div class="">
               <form class="" action="edit.php" method="post">

                 <div class="form-group">
                   <label for="image">Upload image :</label>
                   <input type="file" name="image" class="form-control">
                 </div>

                 <div class="form-group">
                   <label for="price">Price :</label>
                   <input type="text" name="price" class="form-control">
                 </div>
                 <input type="submit" name="submit" value="UPDATE" class="btn btn-success">

               </form>
               <a href="food.php"><button class="btn btn-warning back-btn">Back to dashboard</button></a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </body>
 </html>
