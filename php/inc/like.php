<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_SESSION['likeid']!=(int)$_POST["id"])
	{
		include("db.php");
		$id=(int)$_POST["id"];
		$result=mysqli_query($conn,"SELECT * FROM product WHERE idProd='$id'");
		
		if(mysqli_num_rows($result)>0)
		{
			$row=mysqli_fetch_array($result);
			$new_count=$row["yes_like"]+1;
			$update=mysqli_query($conn,"UPDATE product SET yes_like='$new_count' WHERE idProd='$id'");
			echo $new_count;
		}
		$_SESSION['likeid']=(int)$_POST["id"];
		
	}else
	{
		echo 'no';
	}
}
?>