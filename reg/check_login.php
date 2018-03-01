<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	include("php/inc/db.php");
	include("php/inc/functions.php");
	
	$login=$_POST['login'];
	$result=mysqli_query($conn,"SELECT login FROM reg_user WHERE ='$login'");
	if(mysqli_num_rows($result)>0){
		echo 'false';
	}
	else{
		echo 'true';
	}
}

?>