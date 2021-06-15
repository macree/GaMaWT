<?php

$dbServerName = "localhost";
$dbUserName = "root";
$dbPassword = ""; //no $dbPassword
$dbName = "loginsystem";

$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
  }
 ?>
