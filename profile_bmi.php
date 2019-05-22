<?php
if (!isset($_SESSION)){
  session_start();
}

require('connect.php');

$idUser  =  $_SESSION['id'];
@$sex  =  $_POST['profile_sex'];
@$height  =  $_POST['profile_height'];
@$lastWeightCheckbox  =  $_POST['profile_weight_last'];
$login  =  $_SESSION['login'];
$idUser  =  $_SESSION['id'];

$sexSelect = "
SELECT sex from uzytkownik WHERE id_uzytkownik = $idUser;
";

if ($sex){
  if ($sex === 'male'){
    $updateMale = "
      UPDATE uzytkownik SET sex  = 'male' WHERE id_uzytkownik  =  $idUser;
      ";
      mysqli_query($conn, $updateMale) or die('Can not execute the query. '. mysqli_error($conn));
      }
      else
      {
        $updateFemale = "
        UPDATE uzytkownik SET sex  =  'female' WHERE id_uzytkownik  =  $idUser;
        ";
        mysqli_query($conn, $updateFemale) or die('Can not execute the query. '. mysqli_error($conn));
        }

      $sexSelect;
      $result = mysqli_query($conn, $sexSelect) or die('Can not execute the query. '. mysqli_error($conn));
      $row = mysqli_fetch_assoc($result);
      $_SESSION['sex'] = $row['sex'];
    }
    else echo "";

if ($height){
  if (!empty($height)){
    if (is_numeric($height)){
      $updateHeight = "
        UPDATE uzytkownik SET height  =  '$height' WHERE id_uzytkownik  =  $idUser;
      ";
      mysqli_query($conn, $updateHeight) or die('Can not execute the query. '. mysqli_error($conn));
      $_SESSION['height'] = $height;
    }
 }
}
else echo "";

 if(!empty($lastWeightCheckbox) && (isset($lastWeightCheckbox))){
   $selectLastWeight = "
    SELECT Weight from waga where id_uzytkownik = '$idUser' ORDER BY Date DESC LIMIT 1;
   ";

   $result = mysqli_query($conn,$selectLastWeight) or die('Can not execute the query. '. mysqli_error($conn));
   $row = mysqli_fetch_assoc($result);

   if(mysqli_num_rows($result)!= 0){
   $_SESSION['LastWeight']  =  $row['Weight'];
 }else exit ("</br>You haven't submitted your weight yet!");

 }
require('bmi_calculate.php');
