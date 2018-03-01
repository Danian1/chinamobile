<?php
include("include/config.php"); 

if($_SESSION['auth_admin']=='yes_auth'){		
		if(isset($_GET["logout"])){
	   unset($_SESSION['auth_admin']);
	   header("Location: ../index.php");
		}
   $_SESSION['urlpage']="<a href='index.php'>Home</a> \ <a href='clients.php'>Clients</a>";

   $id=$_GET["id"];
   $action=$_GET["action"];
   if(isset($action)){
	   switch($action){
		   case 'delete':
		   $delete=mysqli_query($conn,"DELETE FROM reg_user WHERE iduser='$id'");
		   break;
	   }
   }
   $title="Clients";
 include("include/head.php");  
?>
	<div id="block-body">
	<?php
	include("include/header.php");
	$all_client=mysqli_query($conn,"SELECT * FROM reg_user");
	$all_client_result=mysqli_num_rows($all_client);
	?>
	<div id="block-content">
		<div id="block-parameters">
		<p id="title-page">Clients - <strong><?php echo $all_client_result;?></strong></p>
		</div>
		<?php
		  $num=5;
		  $page=strip_tags($_GET['page']);
	
		  
		  $count=mysqli_query($conn,"SELECT COUNT(*) FROM reg_user");
		  $temp=mysqli_fetch_array($count);
		  $post=$temp[0];
			$total=(($post-1)/$num)+1;
			$total=intval($total);
			$page=intval($page);
			
			if(empty($page) or $page < 0) $page=1;
			  if($page > $total)$page=$total;
			  
			  $start=$page*$num-$num;
			  $query_start_num="LIMIT $start,$num";
			  
			if($temp[0]>0)
			{				
			$result=mysqli_query($conn,"SELECT * FROM reg_user ORDER BY iduser DESC $query_start_num");
			if(mysqli_num_rows($result) > 0)
		  	{
		  		$row=mysqli_fetch_array($result);
				do{
					
					echo '
						<div class="block-clients">
						<p class="client-datetime">'.$row["datetime"].'</p>
						<p class="client-email"><strong>'.$row["email"].'</strong></p>
						<p class="client-links"><a class="delete" rel="clients.php?id='.$row["iduser"].'&action=delete">Delete</a></p>
						
						<ul>
						<li><strong>Name</strong> - '.$row["name"].'</li>
						<li><strong>Lastname</strong> - '.$row["lastname"].'</li>
						<li><strong>E-Mail</strong> - '.$row["email"].'</li>
						<li><strong>Login</strong> - '.$row["login"].'</li>
						<li><strong>Date registration</strong> - '.$row["datetime"].'</li>
						</ul>						
					</div>
					';	
				}while($row=mysqli_fetch_array($result));
			}
		}
		//paginarea
				if($page!=1){$pstr_prev='<li><a href="clients.php?page='.($page-1).'">&laquo;</a></li>';}
				if($page!=$total)$pstr_next='<li><a href="clients.php?page='.($page+1).'">&raquo;</a></li>';
				
				if($page-5 >0)$page5left='<li><a href="clients.php?page='.($page-5).'">'.($page-5).'</a></li>';
				if($page-4 >0)$page4left='<li><a href="clients.php?page='.($page-4).'">'.($page-4).'</a></li>';
				if($page-3 >0)$page3left='<li><a href="clients.php?page='.($page-3).'">'.($page-3).'</a></li>';
				if($page-2 >0)$page2left='<li><a href="clients.php?page='.($page-2).'">'.($page-2).'</a></li>';
				if($page-1 >0)$page1left='<li><a href="clients.php?page='.($page-1).'">'.($page-1).'</a></li>';
				
				if($page+5 <=$total)$page5right='<li><a href="clients.php?page='.($page+5).'">'.($page+5).'</a></li>';
				if($page+4 <=$total)$page4right='<li><a href="clients.php?page='.($page+4).'">'.($page+4).'</a></li>';
				if($page+3 <=$total)$page3right='<li><a href="clients.php?page='.($page+3).'">'.($page+3).'</a></li>';
				if($page+2 <=$total)$page2right='<li><a href="clients.php?page='.($page+2).'">'.($page+2).'</a></li>';
				if($page+1 <=$total)$page1right='<li><a href="clients.php?page='.($page+1).'">'.($page+1).'</a></li>';
				
				if($page+5<$total){
					$strtotal='<li><p class="nav-poit">...</p></li><li><a href="clients.php?page='.$total.'">'.$total.'</a></li>';
				}else{
					$strtotal="";
				}
				if($total>1){
					echo '<div class="row text-center">
                         <div class="col-lg-12">
                        <ul class="pagination">';
						echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='clients.php?page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$pstr_next;
				echo '    </ul>
						</div>
					</div>';
					}
		?>
	</div>
</div>
</body>
</html>
<?php
}else{
	header("Location:./index.php");
}
?>

<style>
.block-clients{
	border-bottom:1px solid #E0E0E0;
	min-height:40px;
	height:auto;
	cursor:pointer;
}
.block-clients >ul{
	display:none;
	margin-bottom:15px;
}
.block-clients>ul>li{
	margin-left:20px;
	padding-top:4px;
	font:14px sans-serif;
}
.block-clients>ul>li>strong{
	color:#323232;
	font-size:12px;
}
.client-datetime{
	font:14px sans-serif;
	margin-left:10px;
	color:#767676;
	margin-top:10px;
	margin-bottom:0px;
}
.client-email{
	color:black;
	margin-left:10px;
	color:black;
	margin-bottom:10px;
	font:14px sans-serif;
}
.client-links{
	font:14px sans-serif;
	margin-left:760px;
	position:absolute;
	margin-top:-40px;
}
</style>
