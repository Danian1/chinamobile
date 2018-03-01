<?php
	$result=mysqli_query($conn,"SELECT * FROM reviews WHERE moderat='0'");
	$count=mysqli_num_rows($result);
	if($count>0){
		$count_str='<p>+'.$count.'</p>';
	}else{$count_str='';}
?>
<div id="block-header">
	<div id="block-header1">
	<h3>ChinaMobileNews-Control Panel</h3>
	<p id="link-nav"><?php echo $_SESSION['urlpage'];?></p>
	</div>
	
	<div id="block-header2">
		<p align="right"><a href="?logout">Logout</a></p>
		<p align="right">You- <span>Administrator</span></p>
	</div>
	</div>
	
	<div id="left-nav">
		<ul>
			<li><a href="product.php">Mobile</a></li>
			<li><a href="category.php">Category</a></li>
			<li><a href="reviews.php">Reviews</a><?php echo $count_str; ?></li>
			<li><a href="clients.php">Clients</a></li>
		</ul>	
	</div>
	
<style>
#left-nav p{
	font:14px sans-serif;
	color:white;
	margin-top:-22px;
	margin-left:110px;
	position:absolute;
	background-color:#F5A9A9;
	padding:5px;
}

</style>