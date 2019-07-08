<?php
session_start();
require 'phpInterface.php';


if (!isset($_SESSION['username']) && $_SESSION['usertype'] == 'SUPPLIER ') {
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


$item = $_POST["item"];
$price = $_POST["price"];
$image = $_FILES["image"]["name"];
addItems($item, $price, $image);

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
  <div class="">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="menu">
            <div class="logo">
              <img src="images/logo.png" alt="">
            </div>
            <p class="text-center">Welcome <?php echo $_SESSION['usertype'] ?></p><?php echo "<h1 class='text-center'>".$_SESSION['username']."</h1>" ?>
            <?php  if (isset($_SESSION['username'])) : ?>
              <a href="index.html">Home</a>
              <a href="upload.php">Supply today</a>
              <a href="#">Contact us</a>


              <a href="order.php?logout='1'"><button type="button" name="button" class="btn btn-danger">LOG OUT</button></a>
            <?php endif ?>

          </div>

        </div>
        <div class="col-md-9">
            <div class="row upload">
              <div class="justify-content-center align-self-center mx-auto d-block">
                <h1 class="display-3">Upload Item</h1>
                <div class=""><form class="" action="upload.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="item">Food Item :</label>
                    <input type="text" name="item" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="image">Upload image :</label>
                    <input type="file" name="image" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="price">Price :</label>
                    <input type="text" name="price" class="form-control">
                  </div>
                  <input type="submit" name="submit" value="SAVE" class="btn btn-success">
                </form>
              </div>
            </div>

        </div>
        </div>
      </div></div></div>


</body>
</html>
