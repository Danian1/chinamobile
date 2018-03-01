<?php
include("include/config.php");
if($_SESSION['auth_admin']=="yes_auth")
	{

   if(isset($_GET["logout"]))
   {
	   unset($_SESSION['auth_admin']);
	   header("Location:./index.php");
   }
   $_SESSION['urlpage']="<a href='index.php'>Home</a> \ <a href='product.php'>Mobile</a> \ <a>Edit Mobile</a>";
  $title="ADD Mobile";
   include("include/head.php");
	include("include/addprod.php");
?>
	<div id="block-body">
<?php
		include("include/header.php");
?>
	<div id="block-content">
		 <div id="block-parameters">
		 <p id="title-page">ADD Product</p>
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
		<form enctype="multipart/form-data" method="post">
		   <ul id="edit-prod">
		     <li><label>Title</label><input type="text" name="form_title"/></li>
			 <li><label>Price</label><input type="text" name="form_price"/></li>
			 <li><label>Mini description</label><textarea name="form_description"></textarea></li>
			 <li><label>Type</label>
			 <select name="form_type" id="type" size="1">
				<option value="mobile">Mobile</option>
			 </select>
			 </li>
			 <li><label>Brand</label>
			 <select name="form_category" size="10">
			<?php
				$category=mysqli_query($conn,"SELECT * FROM category");
				if(mysqli_num_rows($category)>0)
				{
					$result_category=mysqli_fetch_array($category);
					do{
					echo '<option value="'.$result_category["id"].'">'.$result_category["brand"].'</option>';
					}while($result_category=mysqli_fetch_array($category));
				}
				?>
			 </select>
			 </li>
			 <label class="stylelabel">Image mobile</label>
				<div id="baseimg-upload">
				<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
				<input type="file" name="upload_image"/>
				</div>
			</ul>
			
			 <h3 class="h3click">Description</h3>
			 <div class="div-editor1">
				<textarea id="editor1" name="txt1" cols="100" rows="20"></textarea>
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
				<textarea id="editor2" name="txt2" cols="100" rows="20"></textarea>
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
			
			<h3 class="h3title">Option product</h3>
			<ul id="chkbox">
				<li><input type="checkbox" name="chk_visible" id="chk_visible"/><label for="chk_visible">Show mobile</label>
			</ul>
			<p align="center"><input type="submit" id="submit_form" name="submit_add" value="ADD Mobile"/></p>
			</form>
		
	</div><!--block-content-->
</div><!--block-body-->
</body>
</html>
<?php
	}else{
	header("Location:./index.php");
	}
?>