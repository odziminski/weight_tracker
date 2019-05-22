<?php
session_start();
$signupHTML = "<a class='--link' href='login.php'>Login / Signup</a>";

if (isset($_SESSION['logged'])) {
    $signupHTML = "<a class='--link' href='logout.php'>Logout</a>";
} else {
    $signupHTML = "<a class='--link' href='login.php'>Login / Signup</a>";
}

?>

<!DOCTYPE HTML>
<html>
<head>
  <title>Stay healthy — Weight tracker</title>
  <meta charset="utf-8">
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

  <main class='Main MainWeight'>
    <section class='Main__weights'>
      <?php include("weight_echo.php"); ?>
    </section>

<?php
    include('formWeight.php');
    include('weight_insert.php');
  ?>

</body>
</html>
