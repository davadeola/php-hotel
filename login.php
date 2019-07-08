<?php include 'loginInterface.php'; ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>LOGIN</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="burgerstyles.css">
  <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
</head>
<body>
  <div class="back">
    <div class="container-fluid d-flex h-100">
      <div class="row content ">
        <div class="justify-content-center align-self-center mx-auto d-block">
          <h1 class="display-1">Login</h1>
          <?php if (count($errors) > 0): ?>
            <div class="">
              <?php foreach ($errors as $error): ?>
                <p class="text-danger"><?php echo $error ?></p>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <form class="form text-center" action="login.php" method="post">
            <div class="form-group">
              <label for="usename">Username</label>
              <input type="text" name="username" value="" class="form-control">
            </div>

            <div class="form-group">
              <label for="pass">Password</label>
              <input type="password" name="pass" value="" class="form-control">
            </div>

            <input type="submit" name="login" value="SUBMIT" class="btn btn-warning">
          </form>
          <a href="register.php"><p class="text-center">Not a member? Register here </p></a>
        </div>
      </div>
      <div class="logo-tab">
        <img src="images/logo.png" alt="">
      </div>
    </div>
  </div>
</body>
</html>
