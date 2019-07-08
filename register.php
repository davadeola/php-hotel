<?php
session_start();
require 'phpInterface.php';

$db = connect();
$errors = array();

//REGISTER USER
if(isset($_POST['register'])){
  $fname = $_POST['fname'];
  $sname = $_POST['sname'];
  $username = $_POST['username'];
  $pass = $_POST['pass'];
  $conpass = $_POST['conpass'];
  $usertype = $_POST['usertypes'];

  //form validation
  if (empty($fname) || empty($sname) || empty($username) || empty($pass)) {
    array_push($errors, "Oops! You have empty fields.");
  }

  if ($pass != $conpass) {
    array_push($errors, "Your two passwords don't match");
  }

  //Checking if user does not exist in the database
  $user_check_query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
  $check_result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_array($check_result);

  if ($user) {
    if ($user['username'] == $username) {
      array_push($errors, "The username already exists");
    }
  }

  //Register the user if no errors exists
  if(count($errors) == 0){
    $password = md5($pass);
    $reg_query = "INSERT INTO users(fname, sname, username, pass, usertype) VALUES('$fname', '$sname', '$username', '$password', '$usertype')";

    mysqli_query($db, $reg_query) or die(mysqli_error($db));

    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are logged";
    $_SESSION['usertype'] = $usertype;
    echo "<script>alert('Welcome ". $_SESSION['username']."')</script>";
  }

  if ($_SESSION['usertype'] === 'SUPPLIER ') {
    echo "<script>console.log(typeof(".$user['usertype']."))</script>";
    header('location: upload.php');

  }else if ($_SESSION['usertype']==='CLIENT '){
    echo "<script>console.log('Welcome ". $user['usertype']."')</script>";
    header('location: upload.php');
  }else if($_SESSION['usertype']==='ADMIN '){
    header('location: food.php');
  }

}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>REGISTER</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="burgerstyles.css">
  <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">

</head>
<body>
  <div class="back">
    <div class="container-fluid d-flex h-100">
      <div class="row content">
        <div class="justify-content-center align-self-center mx-auto d-block">
          <h1 class="display-1">Subscribe</h1>
          <div class="">
            <?php if (count($errors) > 0): ?>
              <div class="">
                <?php foreach ($errors as $error): ?>
                  <p><?php echo $error ?></p>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

            <form class="" action="register.php" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" value="" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="sname">Second Name</label>
                    <input type="text" name="sname" value="" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" value="" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" value="" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="conpass">Confirm Password</label>
                    <input type="password" name="conpass" value="" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="type">Select Usertype</label>
                    <select name="usertypes" class="form-control">
                      <option value="">SELECT USER TYPE</option >
                        <?php showUserTypes(); ?>
                      </select>
                    </div>
                  </div>
                </div>
                <input type="submit" name="register" value="REGISTER" class="btn btn-warning">
                <a href="login.php"><p class="text-center">Already a member? Login here </p></a>
              </form>
            </div>
          </div>
        </div>
        <div class="logo-tab">
          <img src="images/logo.png" alt="">
        </div>
      </div>
    </div>
  </body>
  </html>
