<?php
  require 'phpInterface.php';
  session_start();
  echo "<script>console.log('Welcome ". $_SESSION['usertype']."')</script>";
  if (!isset($_SESSION['username']) && $_SESSION['usertype'] == 'CLIENT ') {
    $_SESSION['msg'] = "You must log in first as client";
    echo "<script>alert('".$_SESSION['msg']."')</script>";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['usertype']);
    header("location: login.php");
  }

 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 <head>
   <meta charset="utf-8">
   <title>ORDER</title>
   <link rel="stylesheet" href="bootstrap.min.css">
   <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="burgerstyles.css">
 </head>
 <body>
   <div class="container-fluid">
     <div class="row">
       <div class="col-md-3">
         <div class="menu">
           <div class="logo">
             <img src="images/logo.png" alt="">
           </div>
           <p class="text-center">Welcome <?php echo $_SESSION['username'] ?></p><?php echo "<h1 class='text-center'>".$_SESSION['username']."</h1>" ?>
           <?php  if (isset($_SESSION['username'])) : ?>
             <a href="order.php">Order</a>
             <a href="#">History</a>
             <a href="#">Contact us</a>

             <a href="order.php?logout='1'"><button type="button" name="button" class="btn btn-danger">LOG OUT</button></a>
           <?php endif ?>
         </div>
       </div>
       <div class="col-md-9">
         <?php getAllClientHistory($_SESSION['username']); ?>
        </div>
     </div>


   </div>
 </body>
 </html>
