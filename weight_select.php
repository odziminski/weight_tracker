<?php
require 'connect.php';
if (!isset($_SESSION)){
  session_start();
}
$login = $_SESSION['login'];
$selectWeight = "
SELECT waga.Weight, waga.Date FROM waga
JOIN uzytkownik ON uzytkownik.id_uzytkownik = waga.id_uzytkownik
WHERE uzytkownik.login like '$login' ORDER BY waga.Date DESC LIMIT 1;
";

$results = mysqli_query($conn,$selectWeight);
mysqli_fetch_all($results,MYSQLI_ASSOC);

$_SESSION['results']  =  $results;
