<?php
require_once("moment/src/Moment.php");
require_once("moment/src/MomentLocale.php");
require_once("moment/src/MomentFromVo.php");
require('weight_select.php');
require('weight_compare.php');

\Moment\Moment::setLocale('en_GB');

$results  =  $_SESSION['results'];
$result_previous  =  $_SESSION['result_previous'];


$currentHTML  =  "";
$previousHTML  =  "";

foreach ($results as $row){
  $m  =  new \Moment\Moment($row['Date']);
  $date  =  mb_strtolower($m->setTimezone('GMT')->calendar());

  $currentHTML  =  "
    <div class = 'results'>
      <p>
        Your last added weight was ${row['Weight']}kg, $date.
      </p>
    </div>
  ";
}

$results->num_rows !=  0 or exit("<center> No weight added yet</center>".include('formWeight.php'));
$result_previous->num_rows !=  0 or exit("<center>It is your first weight ever submitted,to calculate with your previous weight add another one sometime. </center>".include('formWeight.php'));

foreach ($result_previous as $row_previous) {
  $m  =  new \Moment\Moment($row_previous['Date']);
  $date  =  $m->setTimezone('GMT')->calendar();

  $previousHTML  =  "
    <div class = 'results result_previous'>
      <p>
        $date you did weigh ${row_previous['Weight']}kg
      </p>
    </div>
  ";
}

$current_weight  =  $row_previous['Weight'] - $row['Weight'];
$current_weight_abs  =  abs($current_weight);
$weight_info  =  "
  <h2 class = 'Weight Weight--same'>
    <p class = 'Weight__emoji'> 😶 </p>
    <p>Your weight has not changed since last time</p>
  </h2>
";
$weight_word  =  "";
$weight_emoji  =  $current_weight > 0 ? "😥" : "💪";

if ($current_weight < 0) {
  $weight_word  =  "gained";
} else if ($current_weight > 0) {
  $weight_word  =  "lost";
}

if ($current_weight !=  0) {
  $weight_info  =  "
    <h2 class = 'Weight Weight--$weight_word'>
      <p class = 'Weight__emoji'>$weight_emoji</p>
      <p class = 'Weight__content'>You <span>$weight_word $current_weight_abs kg</span> since last time</p>
    </h2>
  ";
}

echo $weight_info;
echo $currentHTML;
echo $previousHTML;
