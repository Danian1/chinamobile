<?php
include("include/config.php");
if($_SESSION['auth_admin']=="yes_auth")
{
   if(isset($_GET["logout"]))
   {
	   unset($_SESSION['auth_admin']);
	   header("Location:../index.php");
   }
   $_SESSION['urlpage']="<a href='index.php'>Home</a> \ <a href='product.php'>Mobile</a>";

	
	$cat=$_GET["cat"];
	$type=$_GET["type"];
	
	if(isset($cat)){
		switch($cat){
			case 'mobile': $cat_name="All Mobile"; $url="cat=mobile&";$cat="WHERE type_pro='mobile'";
			break;
			default:
			$cat_name=$cat;
			$url="type=".$type."&cat=".$cat."&";
			$cat="WHERE type_pro='".$type."' AND brand='".$cat."'";
			break;
		}
	}else{
		$cat_name="All Mobile";
		$url="";
		$cat="";
	}
   
$action=$_GET["action"];
if(isset($action)){
	$id=(int)$_GET["id"];
	switch($action){
		case 'delete': $delete=mysqli_query($conn,"DELETE FROM product WHERE idProd='$id'");
		break;
	}
}
$title="Mobile";
include("include/head.php");
?>

	<div id="block-body">
<?php
		include("include/header.php");
	
		$all_count=mysqli_query($conn,"SELECT * FROM product");
		$all_count_result=mysqli_num_rows($all_count);
?>
	<div id="block-content">
		 <div id="block-parameters">
		 
			<ul id="option-list">
				<li>Product </li>
				<li><a id="select-links" href="#"> <?php echo $cat_name;?></a>
				<div id="list-links">
					<ul>
					<li><a href="product.php?cat=mobile"><strong>Mobile</strong></a></li>
				<?php 
				$result=mysqli_query($conn,"SELECT * FROM category WHERE type='mobile'");
				if(mysqli_num_rows($result)>0)
				{
					$row=mysqli_fetch_array($result);
					do{
						echo '<li><a href="product.php?type='.$row["type"].'&cat='.$row["brand"].'">'.$row["brand"].'</a></li>';
					}while($row=mysqli_fetch_array($result));
				}
				?>
		       </ul>
			  </div>
			</li>
		</ul>
	</div>	
			  
		  <div id="block-info">
		<p id="count-style">Count Mobile - <strong><?php echo $all_count_result;?></strong></p>
		<p align="right" id="add-style"><a href="add_product.php">ADD Mobile</a></p>
		
		</div>
		<ul id="block-mobile">
	
	<?php
		  $num=8;
		  $page=(int)$_GET['page'];
		  
		  $count=mysqli_query($conn,"SELECT COUNT(*) FROM product $cat");
		  $temp=mysqli_fetch_array($count);
		  $post=$temp[0];
			
			//gasim nr de pagini
			$total=(($post-1)/$num)+1;
			$total=intval($total);
			$page=intval($page);
			
			if(empty($page) or $page < 0) $page=1;
			  if($page > $total)$page=$total;
			  
			  $start=$page*$num-$num;
			  $query_start_num="LIMIT $start,$num";
				
			if($temp[0]>0)
			{	
		  	$result=mysqli_query($conn,"SELECT * FROM product $cat ORDER BY idProd DESC $query_start_num");
		  	if(mysqli_num_rows($result)>0)
		  	{
		  		$row=mysqli_fetch_array($result);
		  		do{
		  			if(strlen($row["img"])> 0 && file_exists("../uploads_img/mob_brand/".$row["img"])){
		  				$img_path='../uploads_img/mob_brand/'.$row["img"];
		  				$max_width=160;
		  				$max_height=160;
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
		  			echo '
		  			<li>
		  			<h4>'.$row["title"].'</h4>
		  			<center><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/></center>
					<p><center>Price: &#36;'.$row["price"].'</center></p>
		  			<p align="center" class="link-action">
		  			<a class="green" href="edit_product.php?id='.$row["idProd"].'">Edit</a> | <a rel="product.php?'.$url.'id='.$row["idProd"].'&action=delete" class="delete">Delete</a>
		  			</p></li>';					
		  		}while($row=mysqli_fetch_array($result));
		  		echo '</ul>';		
		  	}
		}
			
		  
		  		if($page!=1)$pstr_prev='<li><a class="pstr-prev" href="product.php?'.$url.'page='.($page-1).'">&laquo;</a></li>';
		  		if($page!=$total)$pstr_next='<li><a class="pstr-next" href="product.php?'.$url.'page='.($page+1).'">&raquo;</a></li>';
		  		
		  		if($page-5 >0)$page5left='<li><a href="product.php?'.$url.'page='.($page-5).'">'.($page-5).'</a></li>';
		  		if($page-4 >0)$page4left='<li><a href="product.php?'.$url.'page='.($page-4).'">'.($page-4).'</a></li>';
		  		if($page-3 >0)$page3left='<li><a href="product.php?'.$url.'page='.($page-3).'">'.($page-3).'</a></li>';
		  		if($page-2 >0)$page2left='<li><a href="product.php?'.$url.'page='.($page-2).'">'.($page-2).'</a></li>';
		  		if($page-1 >0)$page1left='<li><a href="product.php?'.$url.'page='.($page-1).'">'.($page-1).'</a></li>';
		  		                                                   
		  		if($page+5 <=$total)$page5right='<li><a href="product.php?'.$url.'page='.($page+5).'">'.($page+5).'</a></li>';
		  		if($page+4 <=$total)$page4right='<li><a href="product.php?'.$url.'page='.($page+4).'">'.($page+4).'</a></li>';
		  		if($page+3 <=$total)$page3right='<li><a href="product.php?'.$url.'page='.($page+3).'">'.($page+3).'</a></li>';
		  		if($page+2 <=$total)$page2right='<li><a href="product.php?'.$url.'page='.($page+2).'">'.($page+2).'</a></li>';
		  		if($page+1 <=$total)$page1right='<li><a href="product.php?'.$url.'page='.($page+1).'">'.($page+1).'</a></li>';
		  		
		  		if($page+5<$total){
		  			$strtotal='<li><p class="nav-point">...</p></li><li><a href="product.php?'.$url.'page='.$total.'">'.$total.'</a></li>';
		  		}else{
		  			$strtotal="";
		  		}
		  	echo '<div id="clearfix"></div>';
		  		if($total>1){
		  			echo '<center><div class="pstrnav"><ul>';
		  				echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='product.php?page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$pstr_next;
		  			echo ' </ul>
		  				  </div>
		  			</center>';
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