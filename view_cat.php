<?php   	
	session_start(); 
	$title="Store";
	//header
	include('php/head.php');
	//Navigation
	include('php/nav.php');

$cat=$_GET["cat"];
$type=$_GET["type"];

?>
		<!-- Page Content -->
<div class="container" style="margin-top:30px">
	<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Store
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php" title="Home">Home</a>
                    </li>
                    <li class="active" title="Store">Store</li>
                </ol>
            </div>
        </div>
		<div class="row">
		      <div class="col-md-3" style="margin-top:13px;">
			  <h3 class="page-header"><a href="store.php"><i class="fa fa-mobile"></i> Brand</a></h3>
                <div class="list-group" style="text-align:center">
				<?php
				$result=mysqli_query($conn,"SELECT *FROM category WHERE type='mobile'");
				if(mysqli_num_rows($result)>0){
				$row=mysqli_fetch_array($result);
				do{
					echo '<a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'" class="list-group-item">'.$row["brand"].'</a>';
					}
				while($row=mysqli_fetch_array($result));
				}
				?>
                </div>
			</div>
			<div class="col-md-9">
			    <div class="row">
			
			<h1 class="page-header">Mobile</h1>
				<?php
				if(!empty($cat)&& !empty($type))
				{
					$querycat="AND brand='$cat' AND type_pro='$type'";
				}else{
					if(!empty($type)){
						$querycat="AND type_pro='$type'";
					}else{
						$querycat="";
					}
				}
				$num=9;
				$page=(int)$_GET['page'];
				$count=mysqli_query($conn,"SELECT COUNT(*)FROM product WHERE visible='1' $querycat");
				$temp=mysqli_fetch_array($count);
				
				if($temp[0]>0)
				{
					$tempcount=$temp[0];
					
					//gasim nr de pagini
					$total=(($tempcount-1)/$num)+1;
					$total=intval($total);
					$page=intval($page);
					
					if(empty($page) or $page<0) $page=1;
					  if($page > $total)$page=$total;
					  
					  $start=$page*$num-$num;
					  $query_start_num="LIMIT $start,$num";
				}
				
				
				  $result=mysqli_query($conn,"SELECT *FROM product WHERE visible='1' $querycat $query_start_num");
				if(mysqli_num_rows($result)>0){
				$row=mysqli_fetch_array($result);
				do{
					if($row["img"]!="" && file_exists("uploads_img/mob_brand/".$row["img"])){
						$img_path='uploads_img/mob_brand/'.$row["img"];
						$max_width=230;
						$max_height=231.55;
						list($width,$height)=getimagesize($img_path);
						$rationh=$max_height/$height;
						$rationw=$max_width/$width;
						$ratio=min($rationh,$rationw);
						$width=intval($ratio*$width);
						$height=intval($ratio*$height);
					}else{
						$img_path="img/def_mob.png";
						$width=100;
						$height=200;
					}
					$query_rev=mysqli_query($conn,"SELECT * FROM reviews WHERE idProd='{$row["idProd"]}' AND moderat='1'");		
					$count_rev=mysqli_num_rows($query_rev);	
					echo '
					<div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
						<a href="view_content.php?id='.$row["idProd"].'" title="'.$row["title"].'">
                            <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"></a>
                            <div class="caption">
                                <h4 style="text-align:center"><a href="view_content.php?id='.$row["idProd"].'" title="'.$row["brand"].'">'.$row["title"].'</a></h4>
							<a id="txta" href="view_content.php?id='.$row["idProd"].'"><p id="price-style" title="Price"><i class="fa fa-usd"></i> '.$row["price"].'</p></a>
                            </div>						
							
                        </div>
				</div>
					
					
					';
				}
				while($row=mysqli_fetch_array($result));
				}else{ echo '<h2 class="header"> Not Found</h2>';}
				if($page!=1){$pstr_prev='<li><a href="view_cat.php?page='.($page-1).'">&laquo;</a></li>';}
				if($page!=$total)$pstr_next='<li><a href="view_cat.php?page='.($page+1).'">&raquo;</a></li>';
				
				if($page-5 >0)$page5left='<li><a href="view_cat.php?page='.($page-5).'">'.($page-5).'</a></li>';
				if($page-4 >0)$page4left='<li><a href=view_cat.php?page='.($page-4).'">'.($page-4).'</a></li>';
				if($page-3 >0)$page3left='<li><a href="view_cat.php?page='.($page-3).'">'.($page-3).'</a></li>';
				if($page-2 >0)$page2left='<li><a href="view_cat.php?page='.($page-2).'">'.($page-2).'</a></li>';
				if($page-1 >0)$page1left='<li><a href="view_cat.php?page='.($page-1).'">'.($page-1).'</a></li>';
				
				if($page+5 <=$total)$page5right='<li><a href="view_cat.php?page='.($page+5).'">'.($page+5).'</a></li>';
				if($page+4 <=$total)$page4right='<li><a href="view_cat.php?page='.($page+4).'">'.($page+4).'</a></li>';
				if($page+3 <=$total)$page3right='<li><a href="view_cat.php?page='.($page+3).'">'.($page+3).'</a></li>';
				if($page+2 <=$total)$page2right='<li><a href="view_cat.php?page='.($page+2).'">'.($page+2).'</a></li>';
				if($page+1 <=$total)$page1right='<li><a href="view_cat.php?page='.($page+1).'">'.($page+1).'</a></li>';
				
				if($page+5<$total){
					$strtotal='<li><p class="nav-poit">...</p></li><li><a href="view_cat.php?page='.$total.'">'.$total.'</a></li>';
				}else{
					$strtotal="";
				}
				if($total>1){
					echo '<div class="row text-center">
                         <div class="col-lg-12">
                        <ul class="pagination">';
						echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='view_cat.php?page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$pstr_next;
				echo '    </ul>
						</div>
					</div>';
					}
				
				?>	
            </div>
		</div>
	 </div>		
		<hr>
		<!-- Footer -->
<?php include('php/footer.php');?>
