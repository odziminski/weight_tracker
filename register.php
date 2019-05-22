<?php
      require('server_register.php');
      //require('server_login.php');

  $signupHTML="";

  if (isset($_SESSION['logged'])) {
      $signupHTML="<a class='--link' href='logout.php'>Logout</a>";
  } else {
      $signupHTML="<a class='--link' href='login.php'>Login / Signup</a>";
  }
?>

<!DOCTYPE HTML>
<html>
<head>
  <title>Create an account — Weight tracker</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.5/destyle.css" />
  <link rel="stylesheet" href="mini.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
  <header class='Header'>
    <div class='Header__logo'>
      <a href="." class="--bold">WeightTracker</a>
    </div>

    <div class='Header__contents'>
      <ul class='contents content__links'>
        <?php if (isset($_SESSION['logged'])) {
    echo "<li><a href='weight.php'>Your weight</a></li>";
    echo "<li><a href='profile.php'>Calculate your BMI</a></li>";
}
    ?>
        <li><a href='#about'>About</a></li>
      </ul>

      <ul class='contents content__auth'>
        <li><?= $signupHTML ?></li>
      </ul>
    </div>
  </header>

  <div class='FormWrapper --full'>
    <form class='Form FormLogin' method="post" action="">
      <div class='Form__info'>
        <h1>Create an account</h1>
      </div>

      <div class='Form__inputs'>
        <div class='inputs__username inputs__item'>
          <label for='login'>Username</label>
          <input type="text" id='login' name="login" placeholder="e.g. sasiad18">
        </div>

        <div class='inputs__password inputs__item'>
          <label for='password'>Password</label>
          <input type="password" id='password' name="password">
        </div>

        <div class='inputs__password inputs__item'>
          <label for='passwordconfirm'>Confirm password</label>
          <input type="password" id='passwordconfirm' name="passwordconfirm">
        </div>
      </div>

      <div class='Form__reminder'>
        <span>Not a member yet?</span>
        <a class='--link' href="register.php">Create an account</a>
      </div>

      <?php include('errors.php'); ?>

  		<div class='Form__submit'>
        <input class='--button' type="submit" value="Create" name="register_button">
      </div>
    </form>
  </div>
</body>
</html>
