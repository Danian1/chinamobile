<?php 	
	
	session_start(); 
	$title="China Mobile News";
	//header
	include('php/head.php');
	//Navigation
	include('php/nav.php');
?>

    <!-- Content -->
    <div class="container" style="margin-top:30px">
	
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
					<img class="img-responsive" src="img/logo.png" alt="ChinaMobileNews" width="1200px" height="300px">
                </h1>
            </div>
        </div><!-- /.row -->
		
	<div class="row">
		 <div class="col-lg-12">
                <h2 class="page-header text-center">Top Selling Phones</h2>
            </div>
				<?php
				$num=9;
				$page=(int)$_GET['page'];
				$count=mysqli_query($conn,"SELECT COUNT(*)FROM product WHERE visible='1'");
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
				
				$result=mysqli_query($conn,"SELECT *FROM product WHERE visible='1' $query_start_num ");
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
					$query_rev=mysqli_query($conn,"SELECT * FROM reviews WHERE idProd='{$row["idProd"]}'");		
					$count_rev=mysqli_num_rows($query_rev);	
					echo '
					<div class="col-md-4">
                        <div class="thumbnail">
						<a href="view_content.php?id='.$row["idProd"].'" title="'.$row["title"].'">
                            <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"></a>
                            <div class="caption">
                                <h4 style="text-align:center"><a href="view_content.php?id='.$row["idProd"].'" title="'.$row["brand"].'">'.$row["title"].'</a></h4>
						<a  id="txta" href="view_content.php?id='.$row["idProd"].'"><p id="price-style" style="margin-left:80px" title="Price">Price: '.$row["price"].'<i class="fa fa-usd"></i></p></a>
                            </div>						
					
                        </div>
				</div>
					
					';
				}
				while($row=mysqli_fetch_array($result));
				}
                 ?>
		</div>

        <hr>

        <!-- Footer -->
 <?php include('php/footer.php');?>