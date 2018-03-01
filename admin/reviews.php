<?php
include("include/config.php");
if($_SESSION['auth_admin']=="yes_auth")
	{
   if(isset($_GET["logout"]))
   {
	   unset($_SESSION['auth_admin']);
	   header("Location:../index.php");
   }
   $_SESSION['urlpage']="<a href='index.php'>Home</a> \ <a href='reviews.php'>Reviews</a>";

	$id=$_GET["id"];
	$sort=$_GET["sort"];
	switch($sort){
		case 'accept':
		$sort="moderat='1' DESC";
		$sort_name='Accept reviews';
		break;
		case 'no-accept':
		$sort="moderat='0' DESC";
		$sort_name='No accept reviews';
		break;
		default:
		$sort="reviewsid DESC";
		$sort_name='All';
		break;
	}
$action=$_GET["action"];
if(isset($action)){
	switch($action){
		case 'accept':
		$update=mysqli_query($conn,"UPDATE reviews SET moderat='1' WHERE reviewsid='$id'");
		break;
		case 'delete':
		$delete=mysqli_query($conn,"DELETE FROM reviews WHERE reviewsid='$id'");
		break;
	}
}	
	$title="Reviews";
	include("include/head.php");  
?>
	<div id="block-body">
<?php
		include("include/header.php");
		
		$all_count=mysqli_query($conn,"SELECT * FROM reviews");
		$all_count_result=mysqli_num_rows($all_count);
		
		$no_accept=mysqli_query($conn,"SELECT * FROM reviews WHERE moderat='0'");
		$no_accept_result=mysqli_num_rows($all_count);
		
?>
	<div id="block-content">
		 <div id="block-parameters">
		 
			<ul id="option-list">
				<li>Reviews</li>
				<li><a id="select-links" href="#"> <?php echo $sort_name;?></a>
					<ul id="list-links-sort">
					<li><a href="reviews.php?sort=accept">Accept(s)</a></li>
					<li><a href="reviews.php?sort=no-accept">No accept(s)</a></li>
					</ul>
				</li>
			</ul>
	</div>	
			  
		  <div id="block-info">
		<ul id="review-info-count">
		<li>All reviews- <strong><?php echo $all_count_result;?></strong></li>
		<li>Untested reviews- <strong><?php echo $no_accept_result;?></strong></li>
		</ul>
		</div>
			<?php
			$num=5;
		  $page=strip_tags($_GET['page']);
		  
		  $count=mysqli_query($conn,"SELECT COUNT(*) FROM reviews");
		  $temp=mysqli_fetch_array($count);
		  $post=$temp[0];
			$total=(($post-1)/$num)+1;
			$total=intval($total);
			$page=intval($page);
			
			if(empty($page) or $page < 0) $page=1;
			  if($page > $total)$page=$total;
			  
			  $start=$page*$num-$num;
			  $query_start_num="LIMIT $start,$num";
			  
			$result=mysqli_query($conn,"SELECT * FROM reviews,product WHERE product.idProd=reviews.idProd ORDER BY $sort $query_start_num");
			if(mysqli_num_rows($result) > 0)
		  	{
		  		$row=mysqli_fetch_array($result);
				do{
					if(strlen($row["img"])> 0 && file_exists("../uploads_img/mob_brand/".$row["img"])){
		  				$img_path='../uploads_img/mob_brand/'.$row["img"];
		  				$max_width=210;
		  				$max_height=210;
		  				list($width,$height)=getimagesize($img_path);
		  				$rationh=$max_height/$height;
		  				$rationw=$max_width/$width;
		  				$ratio=min($rationh,$rationw);
		  				$width=intval($ratio*$width);
		  				$height=intval($ratio*$height);
		  			}else{
		  				$img_path="../img/def_mob.png";
		  				$width=90;
		  				$height=164;
		  			}
					
					if($row["moderat"]=='0'){
					$link_accept='<a class="green" href="reviews.php?id='.$row["reviewsid"].'&action=accept">Accept</a> | ';}
					else{
						$link_accept='';
					}
						
						echo'
						<div class="block-reviews">
						<div class="block-title-img">
						<p>'.$row["title"].'</p>
						<center>
						<img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/>
						</center>
						</div>
						<p class="author-date"><strong>'.$row["name"].'</strong>, '.$row["date"].'</p>
						<div class="plus-minus">
							<img src="img/plus.png" width="12px" height="12px"/><p>'.$row["goodtxt"].'</p>
							<img src="img/minus.png" width="12px" height="12px"/><p>'.$row["badtxt"].'</p>
						</div>
					<p class="reviews-comment">'.$row["comment"].'</p>
						<p class="links-actions" align="right">'.$link_accept.'<a class="delete" rel="reviews.php?id='.$row["reviewsid"].'&action=delete">Delete</a></p>
						</div>
						';
					}while($row=mysqli_fetch_array($result));
			}else{
				echo 'No reviews';
			}
					
		
			?>
		</div>
</div>
</body>
</html>
<?php
}else{
	header("Location:../index.php");
	}
?>

<style>
#list-links-sort{
	background-color:white;
	position:absolute;
	border:1px solid #A3C0D2;
	width:100px;
	padding-top:5px;
	padding-bottom:7px;
	height:auto;
	z-index:1;
	display:none;
}
#list-links-sort li{
	margin-top:3px;
}
#list-links-sort a{
	font:15px sans-serif;
	text-decoration:none;
	color:black;
}
#list-links-sort a:hover{
	text-decoration:underline;
}
#review-info-count li{
	float:left;
	margin-left:12px;
	font:14px sans-serif;
}
.block-reviews{
	height:auto;
	width:100%;
	min-height:300px;
	border-bottom:1px solid #E0E0E0;
}
.reviews-comment{
	clear:both;
	margin-left:40px;
	margin-right:15px;
	font:15px sans-serif;
}
.block-title-img{
	margin-left:15px;
	margin-bottom:10px;
	width:200px;
	min-height:200px;
	height:auto;
	float:left;
}
.block-title-img>p{
	text-align:center;
	margin-top:10px;
	margin-left:10px;
	margin-bottom:15px;
	font:bold 15px sans-serif;
}
.plus-minus{
	margin-left:100px;
	margin-bottom:10px;
	min-height:100px;
	height:auto;
	float:left;
}
.plus-minus>img{
	position:absolute;}
.plus-minus>p{
	font:14px sans-serif;
	margin-left:30px;
	margin-top:0px;
}
.block-reviews.author-date{
	font:14px sans-serif;
	color:#525252;
}
.author-date strong{
	margin-left:98px;
}
.links-actions{
	margin-right:15px;
}
</style>