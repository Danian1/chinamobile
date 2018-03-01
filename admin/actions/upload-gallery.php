<?php
if($_FILES['galleryimg']['name'][0])
{
	for($i=0;$i<count($_FILES['galleryimg']['name']);$i++){
		$error_gallery="";
		if($_FILES['galleryimg']['name'][$i]){
			$galleryimgType=$_FILES['galleryimg']['type'][$i];
			$types=array(
							"image/jpeg",
							"image/jpg",
							"image/png",
							"image/gif"
						);
						
						$imgext=strtolower(preg_replace("#.+\.([a-z]+)$#i","$1",$_FILES['galleryimg']['name'][$i]));
						$uploaddir='../uploads_img/upload_img/';
						$newfilename=$_POST["form_type"]."-".$id.rand(100,500).'.'.$imgext;
						$uploadfile=$uploaddir.$newfilename;
						
						if(!in_array($galleryimgType,$types)){
							$error_gallery="<p id='form-error'>Image format:jpg,jpeg,png,gif</p>";
							$_SESSION['answer']=$error_gallery;
							continue;
						}
						if(empty($error_gallery))
						{
							if(@move_uploaded_file($_FILES['galleryimg']['tmp_name'][$i],$uploadfile))
							{
								mysqli_query($conn,"INSERT INTO uploads_img(idProd,image)VALUES('".$id."','".$newfilename."')");
							}else{
								$_SESSION['answer']="Error upload files";
							}
						}
	
		}
		
	}

}
?>