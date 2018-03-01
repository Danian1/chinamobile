<?php
$db_host = 'fdb15.biz.nf';
$db_user = '2264337_mobnews';
$db_pass = 'danian@97';
$db_database = '2264337_mobnews';

$conn = mysqli_connect($db_host ,$db_user,$db_pass,$db_database);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>