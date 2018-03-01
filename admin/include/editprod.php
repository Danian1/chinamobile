<?php
if($_POST["submit_save"])
	{
		$error=array();
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
		if(empty($_POST["upload_image"]))
			{
				include("actions/upload-image.php");
				unset($_POST["upload-image"]);
			}
		
		if($_POST["chk_visible"]){
			$chk_visible="1";
		}else{$chk_visible="0";}
		
		if(count($error))
		{
			$_SESSION['message']="<p id='form-error'>".implode('<br />',$error)."</p>";
		}else{
			
			$querynew="title='{$_POST["form_title"]}',price='{$_POST["form_price"]}',brand='$selectbrand',mini_description='{$_POST["form_description"]}',description='{$_POST["txt1"]}',features='{$_POST["txt2"]}',visible='$chk_visible',type_pro='{$_POST["form_type"]}',brand_id='{$_POST["form_category"]}'";
			$update=mysqli_query($conn,"UPDATE product SET $querynew WHERE idProd='$id'");
		
			$_SESSION['message']="<p id='form-succes'> Mobile it's EDIT SUCCESS!</p>";
			
		}
		
		
	}



?>