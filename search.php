<?php 	
	session_start(); 
	$title="Search";
	//header
	include('php/head.php');
	//Navigation
	include('php/nav.php');
	$search=$_GET["q"];
?>

    <!-- Content -->
    <div class="container" style="margin-top:30px">
		 <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $search;?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Search</li>
                </ol>
            </div>
        </div>
		<div class="row">
		<?php
			if(strlen($search)>=2 && strlen($search)<65)
			{
				$num=9;
				$page=(int)$_GET['page'];
				$count=mysqli_query($conn,"SELECT COUNT(*)FROM product WHERE title LIKE '%$search%' ");
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
				
				if($temp[0]>0)
				{
				$result=mysqli_query($conn,"SELECT *FROM product WHERE title LIKE '%$search%' $query_start_num ");
				if(mysqli_num_rows($result)>0){
				$row=mysqli_fetch_array($result);
				do{
					if($row["img"]!="" && file_exists("uploads_img/mob_brand/".$row["img"])){
						$img_path='uploads_img/mob_brand/'.$row["img"];
						$max_width=300;
						$max_height=200;
						list($width,$height)=getimagesize($img_path);
						$rationh=$max_height/$height;
						$rationw=$max_width/$width;
						$ratio=min($rationh,$rationw);
						$width=intval($ratio*$width);
						$height=intval($ratio*$height);
					}else{
						$img_path="img/def_mob.png";
						$width=100;
						$height=160;
					}
					echo '
						<div class="col-md-4 text-center">
							<div class="thumbnail">
							<a href="view_content.php?id='.$row["idProd"].'">
							 <img class="img-responsive" src="'.$img_path.'" width="'.$width.'" height="'.$height.'">
							<div class="caption1">
									<h3>'.$row["title"].'<br></a>
                        </h3>
                        <p>'.$row["mini_descr"].'<a href="view_content.php?id='.$row["idProd"].'">Read More</a></p>
                    </div>
                </div>
            </div>
					
					';
				}
				while($row=mysqli_fetch_array($result));
				}
				
				//paginarea
				if($page!=1){$pstr_prev='<li><a href="search.php?page='.($page-1).'">&laquo;</a></li>';}
				if($page!=$total)$pstr_next='<li><a href="search.php?page='.($page+1).'">&raquo;</a></li>';
				
				if($page-5 >0)$page5left='<li><a href="search.php?q="'.$search.'"&page='.($page-5).'">'.($page-5).'</a></li>';
				if($page-4 >0)$page4left='<li><a href="search.php?q="'.$search.'"&page='.($page-4).'">'.($page-4).'</a></li>';
				if($page-3 >0)$page3left='<li><a href="search.php?q="'.$search.'"&page='.($page-3).'">'.($page-3).'</a></li>';
				if($page-2 >0)$page2left='<li><a href="search.php?q="'.$search.'"&page='.($page-2).'">'.($page-2).'</a></li>';
				if($page-1 >0)$page1left='<li><a href="search.php?q="'.$search.'"&page='.($page-1).'">'.($page-1).'</a></li>';
				
				if($page+5 <=$total)$page5right='<li><a href="search.php?q="'.$search.'"&page='.($page+5).'">'.($page+5).'</a></li>';
				if($page+4 <=$total)$page4right='<li><a href="search.php?q="'.$search.'"&page='.($page+4).'">'.($page+4).'</a></li>';
				if($page+3 <=$total)$page3right='<li><a href="search.php?q="'.$search.'"&page='.($page+3).'">'.($page+3).'</a></li>';
				if($page+2 <=$total)$page2right='<li><a href="search.php?q="'.$search.'"&page='.($page+2).'">'.($page+2).'</a></li>';
				if($page+1 <=$total)$page1right='<li><a href="search.php?q="'.$search.'"&page='.($page+1).'">'.($page+1).'</a></li>';
				
				if($page+5<$total){
					$strtotal='<li><p class="nav-poit">...</p></li><li><a href="search.php?q="'.$search.'"&page='.$total.'">'.$total.'</a></li>';
				}else{
					$strtotal="";
				}
				if($total>1){
					echo '<div class="row text-center">
                         <div class="col-lg-12">
                        <ul class="pagination">';
						echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='search.php?q=".$search."&page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$pstr_next;
				echo '    </ul>
						</div>
					</div>';
					}
				}else
				{
					echo '<h2 align="center">Nothing found!</h2>';
				}
			}else{
				echo '<p align="center">The search value must be from 2 to 65 characters!</p>';
			}
                 ?>

        </div> <!-- /.row -->

        <hr>

        <!-- Footer -->
 <?php include('php/footer.php');?>