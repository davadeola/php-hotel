<?php
require 'phpInterface.php';
session_start();
echo "<script>console.log('Welcome ". $_SESSION['usertype']."')</script>";
if (!isset($_SESSION['username']) && $_SESSION['usertype'] == 'ADMIN ') {
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


<html>
  <head>
    <title>Order Lunch</title>

    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.min.css">
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
                <a href="#">Catalogue</a>
                <a href="adminClients.php">All Clients</a>
                <a href="adminSupplier.php">All Suppliers</a>

                <a href="order.php?logout='1'"><button type="button" name="button" class="btn btn-danger">LOG OUT</button></a>
              <?php endif ?>

            </div>
          </div>
          <div class="col-md-9">
            <div class="">
                <h3 class="text-center display-1">Edit your products</h3>
              <table class="table table-sm">
                <tr>
                  <th class="text-center thead-dark">
                    <h1>Food-Item</h1>
                  </th>
                  <th class="text-center thead-dark">
                    <h1>Image</h1>
                  </th>
                  <th class="text-center thead-dark">
                    <h1>Price in Kshs</h1>
                  </th>
                  <th class="text-center thead-dark">
                    <h1>Edit your entry</h1>
                  </th>
              </tr>
              <?php
              displayItemsInTable();
              ?>
              </table>
            </div>
          </div>

        </div>

      </div>




    </div>
  </body>
</html>
