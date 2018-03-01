<?php
	include("include/config.php");
   	if($_SESSION['auth_admin']=='yes_auth'){

	if(isset($_GET["logout"])){
	unset($_SESSION['auth_admin']);
	header("Location: ../index.php");}
	
	$title="BD - Control";
    $_SESSION['urlpage']="<a href='index.php'>Home</a>";
	include("include/head.php");
?>
	<div id="block-body">
<?php
	include("include/header.php");
	
	$query1=mysqli_query($conn,"SELECT * FROM category");
	$result1=mysqli_num_rows($query1);
	
	$query2=mysqli_query($conn,"SELECT * FROM product");
	$result2=mysqli_num_rows($query2);
	
	$query3=mysqli_query($conn,"SELECT * FROM reg_user");
	$result3=mysqli_num_rows($query3);
	
	$query4=mysqli_query($conn,"SELECT * FROM reviews");
	$result4=mysqli_num_rows($query4);
	
?>
	<div id="block-content">
		<div id="block-parameters">
		<p id="title-page">Total statistic</p>
		</div>
		<ul id="general-statistics">
		<li><p>Users - <span><?php echo $result3;?></span></p></li>
		<li><p>Products - <span><?php echo $result2;?></span></p></li>
		<li><p>Category - <span><?php echo $result1;?></span></p></li>
		<li><p>Reviews - <span><?php echo $result4;?></span></p></li>
		</ul>
	</div>
</div>
</body>
</html>
<?php
}else{
	header("Location:login.php");
}
?>