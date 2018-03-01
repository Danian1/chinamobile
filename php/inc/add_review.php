<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	include("db.php");
	include("functions.php");
	
	$id=$_POST['id'];
	$name=$_POST['name'];
	$good=$_POST['good'];
	$bad=$_POST['bad'];
	$comment=$_POST['comment'];

	mysqli_query($conn,"INSERT INTO reviews(idProd,name,goodtxt,badtxt,comment,date)VALUES('".$id."','".$name."','".$good."','".$bad."','".$comment."',NOW())");
echo 'yes';
}
?>