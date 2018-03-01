<?php
include("db.php");
	if($_POST["submit_add"])
	{
		$error=array();
		if(!$_POST["form_title"]){
			$error[]="Specify title";
		}
		if(!$_POST["form_price"]){
			$error[]="Specify price";
		}
		if(!$_POST["form_description"]){
			$error[]="Specify mini description";
		}
		if(!$_POST["txt1"]){
			$error[]="Specify description";
		}
		if(!$_POST["txt2"]){
			$error[]="Specify features";
		}
		if(!$_POST["form_category"]){
			$error[]="Specify category";
		}else{
			$result=mysqli_query($conn,"SELECT * FROM category WHERE id='{$_POST["form_category"]}'");
			$row=mysqli_fetch_array($result);
			$selectbrand=$row["brand"];
		}
		
		if($_POST["chk_visible"]){
			$chk_visible="1";
		}else{$chk_visible="0";}
		
		if(count($error))
		{
			$_SESSION['message']="<p id='form-error'>".implode('<br />',$error)."</p>";
		}else{
			mysqli_query($conn,"INSERT INTO product(title,price,brand,mini_description,description,features,visible,type_pro,brand_id)
						VALUES(
						'".$_POST["form_title"]."',
						'".$_POST["form_price"]."',
						'".$selectbrand."',
						'".$_POST["form_description"]."',
						'".$_POST["txt1"]."',
						'".$_POST["txt2"]."',
						'".$chk_visible."',
						'".$_POST["form_type"]."',
						'".$_POST["form_category"]."'
						)");
			$_SESSION['message']="<p id='form-succes'> Mobile ADD SUCCESS!</p>";
			$id=mysqli_insert_id($conn);
			
			if(empty($_POST["upload_image"]))
			{
				include("actions/upload-image.php");
				unset($_POST["upload_image"]);
			}
				
			if(empty($_POST["galleryimg"]))
			{
				include("actions/upload-gallery.php");
				unset($_POST["galleryimg"]);
			}
				
		}
		
		
	}
	
?>