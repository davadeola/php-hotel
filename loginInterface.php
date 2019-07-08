<?php
$db = mysqli_connect("localhost", "root", "Abimbola02", "hotel")or die("Error connecting");
//mysqli_real_escape_string($db, $_POST['username']);

$errors = array();


if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $pass = $_POST['pass'];

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($pass)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $pass = md5($pass);
    $login_query = "SELECT * FROM users WHERE username ='$username' AND pass='$pass'";
    $login_result= mysqli_query($db, $login_query);

    if (mysqli_num_rows($login_result)==1) {
      $user = mysqli_fetch_array($login_result);
      session_start();
      $_SESSION['username'] = $username;
      //$_SESSION['success'] = "'$username', You are now logged in";
      $_SESSION['usertype'] = $user['usertype'];

      if ($_SESSION['usertype'] === 'SUPPLIER ') {
        echo "<script>console.log(typeof(".$user['usertype']."))</script>";
         header('location: upload.php');

      }else if ($_SESSION['usertype']==='CLIENT '){
        echo "<script>console.log('Welcome ". $_SESSION['usertype']."')</script>";
        header('location: order.php');
      }else if($_SESSION['usertype']==='ADMIN '){
        header('location: food.php');
      }


    }else{
      array_push($errors, "Wrong username & email combination");
    }
  }
}



?>
