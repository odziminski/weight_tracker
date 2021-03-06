<?php
if (!isset($_SESSION)){
  session_start();
}

$signupHTML="<a class='--link' href='login.php'>Login / Signup</a>";

if (isset($_SESSION['logged'])) {
    $signupHTML="<a class='--link' href='logout.php'>Logout</a>";
} else {
    $signupHTML="<a class='--link' href='login.php'>Login / Signup</a>";
}

if (isset($_SESSION['login'])) {
    $login=$_SESSION['login'];
}

$weightHTML='
<input type="checkbox" name="profile_weight_last">Use my last submitted weight </br>
';
?>

<!DOCTYPE HTML>
<html>
<head>
  <meta charset='utf-8'>
  <title>Your profile — Weight tracker</title>
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

  <main class='Main MainHome --full'>
  <div class='Main__landing'>
    <h2><bold>Your bio</bold></h2>
      <p>Your nickname is <?=$_SESSION['login'].","?>
       you made your account at <?=$_SESSION['registrationDate']?> </p>
      <form class='ProfileBmi' action="" method="post">

      <?php

      if (!isset($_SESSION['sex'])) {
        echo 'I am a: <input type="radio" name="profile_sex" value="male"> Male <input type="radio" name="profile_sex" value="female"> Female </br>';
      }
      else {
        echo "<p> You are a <u>".$_SESSION['sex']."</u></p></br>";
        }

        if (!isset($_SESSION['height'])) {
          echo ' My height is (cm): <input type="number" name="profile_height" placeholder="e.g. 175"></br>';
        }
        else {
        echo "<p> You are <u>".$_SESSION['height']."</u> cm tall </p>";
      }
        if (!isset ($_SESSION['LastWeight']) ){
        echo $weightHTML;
      }
        else{
          echo "<p>You weight <u>".$_SESSION['LastWeight']."</u> kilogrames</p>";
          echo $weightHTML;
        }

        ?>

        <input type="submit"  name="bmi_submit"value="Calculate your BMI">
        <?php  include('profile_bmi.php'); ?>
      </form>
    </div>

    <svg class='Main__background' version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
    	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
       <g>
       	<g>
       		<rect x="96" y="362.67" width="42.667" height="21.333"/>
       	</g>
       </g>
       <g>
       	<g>
       		<rect x="96" y="405.33" width="64" height="21.333"/>
       	</g>
       </g>
       <g>
       	<g>
       		<path d="M502.402,456.139l-118.4-118.414V74.667c0-17.673-14.327-32-32-32H137.6C132.658,18.323,111.137,0,85.335,0
       			S38.013,18.323,33.071,42.667h-1.069c-17.673,0-32,14.327-32,32V480c0,17.673,14.327,32,32,32h320c17.673,0,32-14.327,32-32
       			v-49.73l72.139,72.13c6.128,6.156,14.46,9.612,23.147,9.6c8.682-0.001,17.007-3.453,23.142-9.596
       			C515.198,489.621,515.186,468.907,502.402,456.139z M85.335,21.333c13.932,0,25.778,8.906,30.172,21.333H55.164
       			C59.557,30.239,71.403,21.333,85.335,21.333z M362.669,480c0,5.891-4.776,10.667-10.667,10.667h-320
       			c-5.891,0-10.667-4.776-10.667-10.667V74.667C21.335,68.776,26.111,64,32.002,64h85.333v117.333
       			c0,5.891-4.776,10.667-10.667,10.667c-5.891,0-10.667-4.776-10.667-10.667v-96H74.669v96c0,17.673,14.327,32,32,32
       			s32-14.327,32-32V64h213.333c5.891,0,10.667,4.776,10.667,10.667V316.39l-32-32.004V96c0-5.891-4.776-10.667-10.667-10.667h-160
       			v21.333h149.333V265.38l-59.232-29.55c-3.007-1.507-6.549-1.507-9.556,0c-0.572,0.286-1.099,0.625-1.595,0.994l-0.017-0.023
       			l-30.272,22.677l-17.067-59.733c-0.498-1.747-1.433-3.338-2.718-4.622c-4.167-4.165-10.92-4.163-15.085,0.003L144.919,224H64.002
       			c-5.891,0-10.667,4.776-10.667,10.667v224c0,5.891,4.776,10.667,10.667,10.667h256c5.891,0,10.667-4.776,10.667-10.667v-81.724
       			l32,31.996V480z M279.447,289.718l-10.282-20.545l20.551,10.276L279.447,289.718z M309.335,355.611V448H74.669V245.333h74.667
       			c2.822,0.002,5.53-1.114,7.531-3.104l19.2-19.2l16.341,57.227c0.358,1.256,0.943,2.437,1.727,3.481
       			c3.536,4.712,10.222,5.665,14.934,2.129l32.422-24.316l25.487,50.983l0.027-0.013c0.498,0.989,1.153,1.918,1.978,2.744
       			L309.335,355.611z M291.607,307.723l16.117-16.117l140.908,140.907l-16.117,16.117L291.607,307.723z M487.341,487.339
       			c-4.451,4.451-11.667,4.451-16.117,0L447.6,463.715l16.117-16.117l23.623,23.623C491.792,475.672,491.792,482.888,487.341,487.339
       			z"/>
       	</g>
       </g>
    </svg>
  </main>

</body>
</html>
