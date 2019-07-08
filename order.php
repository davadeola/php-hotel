<?php require 'phpInterface.php';

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

$db= connect();
$price=getFoodPrices();
$names=getFoodNames();
$namesLength = count($names);
$totalAmount=0;

if (isset($_POST["order"])) {
  for ($i=0; $i <$namesLength ; $i++) {
    $amount=0;
    $newOrder =$names[$i]."_order";
    $amount = $_POST[$newOrder]*$price[$names[$i]];
    $totalAmount+=$amount;


  }
  // echo "<script>console.log('Total amt=".$totalAmount."')</script>";
  $query = "INSERT INTO orders( user_id ,amount) VALUES('".$_SESSION['username']."','".$totalAmount."');";
  if (mysqli_query($db, $query)) {
    $id = getOrderId();
    for ($i=0; $i <$namesLength ; $i++) {
      $newOrder =$names[$i]."_order";
      $query2 = "INSERT INTO order_details( order_id ,unit_amount, description, quantity) VALUES('".$id."', '".$price[$names[$i]]."', '".$names[$i]."','".$_POST[$newOrder]."');";
      if(mysqli_query($db, $query2)){
      }
    }

  } else {
    die(mysqli_error($db));
  }
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
          <p class="text-center">Welcome</p><?php echo "<h1 class='text-center'>".$_SESSION['username']."</h1>" ?>
          <?php  if (isset($_SESSION['username'])) : ?>
            <a href="">Order</a>
            <a href="clientHistory.php">History</a>
            <a href="#">Contact us</a>

            <a href="order.php?logout='1'"><button type="button" name="button" class="btn btn-danger">LOG OUT</button></a>
          <?php endif ?>

        </div>

      </div>
      <div class="col-md-9">
        <div class="order">

          <h1 class="text-center display-1">Make an order</h1>

          <form class="" action="order.php" method="post">
            <div class="container-fluid">
              <div class="row">
                <?php getFoodDes(); ?>
              </div>
            </div>
            <div class="submit">
              <input type="submit" name="order" value="ADD TO ORDER" class="btn btn-warning">
            </div>

          </form>
        </div>

      </div>
    </div>


  </div>
</body>
</html>
