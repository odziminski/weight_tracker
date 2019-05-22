<?php

if (!isset($_SESSION)){
  session_start();
}

require 'connect.php';

$login = $_SESSION['login'];

$selectPenultimateWeight = "
SELECT waga.Weight, waga.Date FROM waga
JOIN uzytkownik ON uzytkownik.id_uzytkownik = waga.id_uzytkownik
WHERE uzytkownik.login like '$login' ORDER BY waga.Date DESC LIMIT 1,1;
";

$result_previous = mysqli_query($conn,$selectPenultimateWeight);
mysqli_fetch_all($result_previous,MYSQLI_ASSOC);

$_SESSION['result_previous'] = $result_previous;

 ?>
