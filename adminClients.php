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
              <a href="#">All Clients</a>
              <a href="adminSupplier.php">All Suppliers</a>

              <a href="order.php?logout='1'"><button type="button" name="button" class="btn btn-danger">LOG OUT</button></a>
            <?php endif ?>

          </div>

        </div>
        <div class="col-md-3">
          <div class="panels">
            <h1>All clients</h1>
            <form class="" action="adminClients.php" method="post">
              <?php getClients(); ?>
              <div class="">
                <input type="submit" name="view" value="VIEW DETAILS" class="btn btn-warning">
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-3">
          <div class="results panels">
            <?php
            $db = connect();
            if(isset($_POST['view'])){
              $query = "SELECT * FROM users WHERE username='".$_POST['users']."'";
              $usersGot = mysqli_query($db, $query);
              if ($usersGot) {

                while ($users = mysqli_fetch_array($usersGot)) {
                  $query2="SELECT FORMAT(SUM(amount), 2)total FROM orders WHERE user_id='".$_POST['users']."'";
                  $sum = mysqli_query($db, $query2);
                  while ($mySum=mysqli_fetch_array($sum)) {
                    echo "<div><h3>Total amount spent= </h3><p>kshs.".$mySum['total']."</p></div>";
                    echo "<div class='row'><div class='col-md-6'><h3>Date ordered</h3></div><div class='col-md-6'><h3>Status</h3></div></div>";
                    $queryToJoin = "SELECT orders.user_id, orders.date_created, order_details.description, order_details.quantity, orders.status FROM order_details INNER JOIN orders ON order_details.order_id= orders.id";
                    $itemsGot = mysqli_query($db, $queryToJoin)or die(mysql_error($db));
                    if ($itemsGot) {
                      while ($row = mysqli_fetch_array($itemsGot)) {
                        if ($row['user_id'] == $_POST['users']) {
                          echo "<div class='row'>";
                          echo  "<div class='col-md-6'><p>".$row['date_created']."</p></div>";
                          echo  "<div class='col-md-6'><p>";
                          if ($row['status']==0) {
                            echo "<span class='badge badge-danger'>Pending</span>";
                          } else {
                            echo "<span class='badge badge-success'>Paid</span>";
                          }

                          echo "</p></div>";
                          echo "</div>";
                        }
                      }
                    }

                  }
                }

              } else {
                die(mysql_error($db));
              }
            }
            ?>
          </div>

        </div>
      </div>
    </div>
  </div>
</body>
</html>
