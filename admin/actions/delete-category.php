<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	include("../include/db.php");
	
	$delete=mysqli_query($conn,"DELETE FROM category WHERE id='{$_POST["id"]}'");
	echo "delete";
	
}
?>