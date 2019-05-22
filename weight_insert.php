<?php

if (!isset($_SESSION)){
  session_start();
}

require('connect.php');
$date  =  date("Y/m/d G:i:s a");

if (isset($_POST['weight_button'])){
  if (!empty($_POST['weight'])){
    if (is_numeric($_POST['weight'])){
    $idUser = $_SESSION['id'];
    $login = $_SESSION['login'];
    $_SESSION['weight'] = $_POST['weight'];
    $weight = $_SESSION['weight'];

    $queryInsertWeight =  "
INSERT INTO waga (id_uzytkownik,id_waga,Weight,Date) VALUES ('$idUser','','$weight','$date');
    ";
    mysqli_query($conn, $queryInsertWeight) or die('Can not execute the query. '. mysqli_error($conn));

    header('Location: weight.php');

}
}
  else{
    echo "You must enter your weight!";
    return;
  }

}

 ?>
