<?php
session_start();
require_once("moment/src/Moment.php");
require_once("moment/src/MomentLocale.php");
require_once("moment/src/MomentFromVo.php");
require('connect.php');
\Moment\Moment::setLocale('en_GB');

$login=$_SESSION['login'];
$registrationDate=$_SESSION['registrationDate'];

$queryGetDate="
SELECT * FROM uzytkownik WHERE login='$login';
";

$result=mysqli_query($conn,$queryGetDate)  or die('Can not execute the query. '. mysqli_error($conn));
$row=mysqli_fetch_assoc($result);

if ($queryGetDate){
  $m = new \Moment\Moment($row['data_utworzenia']);
  $registrationDate = mb_strtolower($m->setTimezone('GMT')->calendar());

}
var_dump($registrationDate);
