<?php
include("include/config.php");
if($_SESSION['auth_admin']=="yes_auth")
	{
   define('myproject',true);

   if(isset($_GET["logout"]))
   {
	   unset($_SESSION['auth_admin']);
	   header("Location:../index.php");
   }
   $_SESSION['urlpage']="<a href='index.php'>Home</a> \ <a href='product.php'>Mobile</a> \ <a>Edit Mobile</a>";

   $id=$_GET["id"];
   $action=$_GET["action"];

if(isset($action))
{
	switch($action){
		case 'delete': 
						if(file_exists("../uploads_img/mob_brand/".$_GET["img"]))
						{
							unlink("../uploads_img/mob_brand/".$_GET["img"]);
						}
						break;
	}				
}	
   include("include/head.php");
	include("include/editprod.php");
	
?>
	<div id="block-body">
<?php
		include("include/header.php");
?>
	<div id="block-content">
		 <div id="block-parameters">
		 <p id="title-page">EDIT Product</p>
		</div><!--block-parameters-->
		<?php 
		if(isset($_SESSION['message'])){
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		}
		if(isset($_SESSION['answer'])){
			echo $_SESSION['answer'];
			unset($_SESSION['answer']);
		}
		?>
		<?php
			$result=mysqli_query($conn,"SELECT * FROM product WHERE idProd='$id'");
			if(mysqli_num_rows($result)>0)
			{
				$row=mysqli_fetch_array($result);
				do{
					echo '<form enctype="multipart/form-data" method="post">
							<ul id="edit-prod">
							<li><label>Title</label><input type="text" name="form_title" value="'.$row["title"].'"/></li>
							<li><label>Price</label><input type="text" name="form_price" value="'.$row["price"].'"/></li>
							<li><label>Mini description</label><textarea name="form_description">'.$row["mini_description"].'</textarea></li>';
								
				$category=mysqli_query($conn,"SELECT * FROM category");
				if(mysqli_num_rows($category)>0)
				{
					$result_category=mysqli_fetch_array($category);
					if($row["type_pro"]=="mobile")$type_mobile="selected";
					echo '<li><label>Type</label>
							<select name="form_type" id="type" size="1">
								<option '.$type_mobile.'value="mobile">Mobile</option>
							</select>
							</li>
							<li><label>Brand</label>
							<select name="form_category" size="10">
						';
					
					do{
					echo '<option value="'.$result_category["id"].'">'.$result_category["type"].' - '.$result_category["brand"].'</option>';
					}while($result_category=mysqli_fetch_array($category));
				}
				
				echo '</select>
			 </li>
			 ';
			 if(strlen($row["img"])> 0 && file_exists("../uploads_img/mob_brand/".$row["img"])){
		  				$img_path='../uploads_img/mob_brand/'.$row["img"];
		  				$max_width=110;
		  				$max_height=110;
		  				list($width,$height)=getimagesize($img_path);
		  				$ratioh=$max_height/$height;
		  				$ratiow=$max_width/$width;
		  				$ratio=min($ratioh,$ratiow);
		  				$width=intval($ratio*$width);
		  				$height=intval($ratio*$height);			 
			 
			 echo '
			 <label class="stylelabel">Image</label>
				<div id="baseimg">
				  <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
				  <a href="edit_product.php?id='.$row["idProd"].'&img='.$row["img"].'&action=delete"><img src="img/delete.png" width="15px" height="15px"/></a>
				</div>
			';
			 }else{
				 echo '
				 <label class="stylelabel">Image</label>
				<div id="baseimg-upload">
				<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
				<input type="file" name="upload_image"/>
				</div>
			';
			 }
			
			echo'
			</ul>
			 <h3 class="h3click">Description</h3>
			 <div class="div-editor1">
				<textarea id="editor1" name="txt1" cols="100" rows="20">'.$row["description"].'</textarea>
				<script type="text/javascript">
						var ckeditor1=CKEDITOR.replace("editor1");
						AjexFileManager.init({
							returnTo:"ckeditor",
							editor:ckeditor1
						})
				</script>
		    </div>
			
			<h3 class="h3click">Features</h3>
			 <div class="div-editor2">
				<textarea id="editor2" name="txt2" cols="100" rows="20">'.$row["features"].'</textarea>
				<script type="text/javascript">
						var ckeditor1=CKEDITOR.replace("editor2");
						AjexFileManager.init({
							returnTo:"ckeditor",
							editor:ckeditor1
						})
				</script>
		    </div>
			<label class="stylelabel">Gallery photo</label>
			 <div id="objects">
				<div id="addimage1" class="addimage">
				<input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
				<input type="file" name="galleryimg[]"/>
					</div>
				</div>
				
				<p><a id="add-im">add image</a></p>
				
				<ul id="gallery-img">';
				
			$query_img=mysqli_query($conn,"SELECT * FROM uploads_img WHERE idProd='$id'");
				if(mysqli_num_rows($query_img)>0)
				{
					$result_img=mysqli_fetch_array($query_img);
					do{
						if(strlen($result_img["image"])> 0 && file_exists("../uploads_img/upload_img/".$result_img["image"])){
		  				$img_path='../uploads_img/upload_img/'.$result_img["image"];
		  				$max_width=100;
		  				$max_height=100;
		  				list($width,$height)=getimagesize($img_path);
		  				$ratioh=$max_height/$height;
		  				$ratiow=$max_width/$width;
		  				$ratio=min($ratioh,$ratiow);
		  				$width=intval($ratio*$width);
		  				$height=intval($ratio*$height);			
						}else{
							$img_path="../img/def_mob.png";
							$width=70;
							$height=70;
						}
						echo'
						<li id="del'.$result_img["id"].'">
						<img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" title="'.$result_img["image"].'"/>
						<a class="del-img" img_id="'.$result_img["id"].'"><img src="img/delete.png" width="15px" height="15px"/></a>
						</li>
						';
					}while($result_img=mysqli_fetch_array($query_img));
					}
				echo "</ul>";
				
			if($row["visible"]=='1')$checked="checked";
			echo '
			<h3 class="h3title">Option product</h3>
			<ul id="chkbox">
				<li><input type="checkbox" name="chk_visible" id="chk_visible" '.$checked.'/><label for="chk_visible">Show mobile</label>
			</ul>
			<p align="center"><input type="submit" id="submit_form" name="submit_save" value="SAVE"/></p>
			</form>';
				}while($row=mysqli_fetch_array($result));
			}
				?>
	</div><!--block-content-->
</div><!--block-body-->
</body>
</html>
<?php
	}else{
	header("Location:../index.php");
	}
?>

<style>
#gallery-img{
	height:125px;
	margin-top:20px;
}

#gallery-img li{
	float:left;
	margin-left:20px;
}
#gallery-img img{float:left;}
#gallery-img a{
	float:right;
	cursor:pointer;
	margin-left:5px;
}
</style>