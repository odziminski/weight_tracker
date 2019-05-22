<?php

$formattedErrors = "";

if (count($errors) > 0) {
  $formattedErrors .= "<div class='error'>";

  foreach ($errors as $error) {
    $formattedErrors .= "<p> $error <p>";
  }

  $formattedErrors .= "</div>";
}

echo $formattedErrors;
