<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	include("../include/db.php");
	$path=$_SERVER['DOCUMENT_ROOT']."/uploads_img/upload_img/".$_POST["title"];
	
	if(file_exists($path))
	{
		unlink($path);
		$delete=mysqli_query($conn,"DELETE FROM uploads_img WHERE id='{$_POST["id"]}'");
		echo "yes";
	}else
	{
		echo "yes";
		$delete=mysqli_query($conn,"DELETE FROM uploads_img WHERE id='{$_POST["id"]}'");
	}
	
}


?>