<?php require 'phpInterface.php';
session_start();
echo "<script>console.log('Welcome ". $_SESSION['usertype']."')</script>";
if (!isset($_SESSION['username']) && $_SESSION['usertype'] == 'ADMIN ') {
  $_SESSION['msg'] = "You must log in first as an admin";
  echo "<script>alert('".$_SESSION['msg']."')</script>";
  header('location: login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  unset($_SESSION['usertype']);
  header("location: login.php");
}
$db=connect();
$username =$_POST['username'];
$query = "DELETE FROM users WHERE username='".$username."'";
if (mysqli_query($db, $query)) {
  echo "<script>console.log('".$username."')</script>";
} else {
  die(mysql_error($db));
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Your subscribers</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="burgerstyles.css">
  <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet"></head>
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
                <a href="food.php">Catalogue</a>
                <a href="adminClients.php">All Clients</a>
                <a href="adminSupplier.php">All Suppliers</a>

                <a href="order.php?logout='1'"><button type="button" name="button" class="btn btn-danger">LOG OUT</button></a>
              <?php endif ?>

            </div>

          </div>
          <div class="col-md-9">
            <div class="panels">
              <h1>All Suppliers</h1>
              <?php getSuppliers(); ?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </body>
  </html>
