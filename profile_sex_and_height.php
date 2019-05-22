<?php

$selectSexHeight = "
Select sex,height from uzytkownik where login like '$login';
";

$resultProfile  =  mysqli_query($conn, $selectSexHeight) or die('Can not execute the query. '. mysqli_error($conn));
$row  =  mysqli_fetch_assoc($resultProfile);
$_SESSION['sex']  =  $row['sex'];
$_SESSION['height']  =  $row['height'];
