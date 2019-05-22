<?php
$conn = new mysqli('localhost', 'root', '', 'weight_tracker');
if ($conn->connect_errno) {
    die("Can not connect to the Database ".$conn->connect_error);
}
