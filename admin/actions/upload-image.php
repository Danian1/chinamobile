<?php
include('include/db.php');
$error_img=array();

	if($_FILES['upload_image']['error']>0)
	{
		switch($_FILES['upload_image']['error'])
		{
			case 1: $error_img[]='The uploaded file exceeds the UPLOAD_MAX_FILE_SIZE';break;
			case 2: $error_img[]='The uploaded file exceeds the MAX_FILE_SIZE ';break;
			case 3: $error_img[]='The uploaded file was only partially uploaded.';break;
			case 4: $error_img[]='No file was uploaded.';break;
			case 6: $error_img[]='Missing a temporary folder.';break;
			case 7: $error_img[]='Failed to write file to disk.';break;
			case 8: $error_img[]='A PHP extension stopped the file upload.';break;	
		}
	}else
	{
		if($_FILES['upload_image']['type']== 'image/jpeg' || $_FILES['upload_image']['type']== 'image/jpg' || $_FILES['upload_image']['type']== 'image/png')
		{
			$imgext=strtolower(preg_replace("#.+\.([a-z]+)$#i","$1",$_FILES['upload_image']['name']));
			$uploaddir='../uploads_img/mob_brand/';
			$newfilename=$_POST["form_type"]."-".$id.rand(10,100).'.'.$imgext;
			$uploadfile=$uploaddir.$newfilename;
			
			if(move_uploaded_file($_FILES['upload_image']['tmp_name'],$uploadfile))
			{
				$update=mysqli_query($conn,"UPDATE product SET img='$newfilename' WHERE idProd='$id'");
			}else
			{
				$error_img[]="Upload error.";
			}
		}else{
			$error_img[]='Image format:jpg,jpeg,png';
		}
	}

?>