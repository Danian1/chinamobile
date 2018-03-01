<?php
$db_host = 'fdb15.biz.nf';
$db_user = '2264337_mobnews';
$db_pass = 'danian@97';
$db_database = '2264337_mobnews';

$conn=mysqli_connect($db_host,$db_user,$db_pass,$db_database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_errors());
}
?>