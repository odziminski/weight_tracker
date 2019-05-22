<?php

if (!isset($_SESSION)){
  session_start();
}

$sex  =  $_SESSION['sex'];

@$lastWeight  =  $_SESSION['LastWeight'];

@$bmiSubmit = $_POST['bmi_submit'];

$height  =  $_SESSION['height'];

$BMIword  =  "";

if (isset($bmiSubmit)){
  if (isset($lastWeight)){
      $BMI  =  (($lastWeight/$height/$height)*10000);
      $BMIrounded =  round($BMI , 2);

      if ($BMIrounded < 18.5){
        $BMIword  =  "<u>UNDERWEIGHT</u>";
      }

      if ($BMIrounded > 18.5 && $BMIrounded < 24.99){
        $BMIword  =  "<u>NORMAL WEIGHT</u>";
      }

      if ($BMIrounded >=  25){
        $BMIword  =  "<u>OVERWEIGHT</u>";
      }

      $standardWeight=($height-100);

      if($sex==="male"){
        $idealWeight=($standardWeight*0.9);
      }
      else if ($sex==="female"){
        $idealWeight=($standardWeight*0.85);
      }

      echo "<h3></br>Your Body Mass Index is $BMIrounded and it's: $BMIword</h3><br>";
      echo "<h3></br>Your standard weight is $standardWeight, and your ideal weight is $idealWeight</h3><br>";
  }else exit ("</br>You have to check that checkbox!");
    }

 ?>
