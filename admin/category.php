<?php
include("include/config.php"); 
if($_SESSION['auth_admin']=="yes_auth")
{
   if(isset($_GET["logout"])){
	   unset($_SESSION['auth_admin']);
	   header("Location:../index.php");
   }
   
   $_SESSION['urlpage']="<a href='index.php'>Home</a> \ <a href='category.php'>Category</a>";
   
   if($_POST["submit_cat"])
   {
	   $error=array();
	   if(!$_POST["cat_type"])$error[]="Specify type!";
	   if(!$_POST["cat_brand"])$error[]="Specify brand!";
	   
	   if(count($error))
	   {
		   $_SESSION['message']="<p id='form-error'>".implode('<br />',$error)."</p>";
	   }else
	   {
		   $cat_type=$_POST["cat_type"];
		   $cat_brand=$_POST["cat_brand"];
		   
		   mysqli_query($conn,"INSERT INTO category(type,brand)
				VALUES(
						'".$cat_type."',
						'".$cat_brand."'
		   )");
		    $_SESSION['message']="<p id='form-succes'>Success add brand</p>";
	   }
   }
   $title="Category";
   include("include/head.php"); 
?>
	<div id="block-body">
<?php
	include("include/header.php");
?>
	<div id="block-content">
		<div id="block-parameters">
		<p id="title-page">Category</p>
		</div>
		<?php
		if(isset($_SESSION['message'])){
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		}
		?>
		<form method="post">
		<ul id="cat_products">
		<li>
		<label>List Category</label>
		<div>
		<a class="delete-cat">Delete</a>
		</div>
		<select name="cat_type" id="cat_type" size="12">
		<?php
			$result=mysqli_query($conn,"SELECT *FROM category ORDER BY type DESC");
			if(mysqli_num_rows($result)>0)
			{
				$row=mysqli_fetch_array($result);
				do{
					echo '<option value="'.$row["id"].'">'.$row["type"].' - '.$row["brand"].'</option>';
				}while($row=mysqli_fetch_array($result));
			}
		?>
				</select>
		</li>
		<li><label>Type product</label><input type="text" name="cat_type"/></li>
		<li><label>Brand product</label><input type="text" name="cat_brand"/></li>
		</ul>
		<p align="center"><input type="submit" id="submit_form" name="submit_cat" value="ADD Category"/></p>
		</form>
	</div>
</div>
</body>
</html>
<?php
}else{
	header("Location:login.php");
}
?>