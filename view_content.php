<?php	
	session_start(); 
	$title="Store";
	//header
	include('php/head.php');
	//Navigation
	include('php/nav.php');
	$id=$_GET["id"];
?>
<link href="css/view_content.css" rel="stylesheet">
	<!-- Page Content -->
	<div class="container" style="margin-top:30px">
	<div class="row">
            <div class="col-lg-12">
			<?php
						$result=mysqli_query($conn,"SELECT * FROM product WHERE idProd='$id'");
					if(mysqli_num_rows($result)>0)
						{
						$row=mysqli_fetch_array($result);
						do{
						echo ' <h1 class="page-header" title="'.$row["title"].'">'.$row["title"].'
								</h1>
									<ol class="breadcrumb">
								<li><a href="index.php" title="Home">Home</a></li>
								<li><a href="store.php" title="Store">Store</a></li>
								<li class="active">'.$row["title"].'</li>';
					    }while($row=mysqli_fetch_array($result));
					}
					
					?>
                </ol>
            </div>
        </div>
	<hr>
			<?php
			$result=mysqli_query($conn,"SELECT * FROM product WHERE idProd='$id'");
			if(mysqli_num_rows($result)>0)
			{
				$row=mysqli_fetch_array($result);
				do{
					if($row["img"]!="" && file_exists("uploads_img/mob_brand/".$row["img"])){
						$img_path='uploads_img/mob_brand/'.$row["img"];
						$max_width=800;
						$max_height=400;
						list($width,$height)=getimagesize($img_path);
						$rationh=$max_height/$height;
						$rationw=$max_width/$width;
						$ratio=min($rationh,$rationw);
						$width=intval($ratio*$width);
						$height=intval($ratio*$height);
					}else{
						$img_path="img/def_mob.png";
						$width=100;
						$height=100;
					}
				echo'
				<div class="row">
				 <div class="col-md-8">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class="img-responsive" src="'.$img_path.'" alt="'.$row["brand"].'" width="'.$width.'" height="'.$height.'"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4" style="margin-left:-100px">
                <h3>'.$row["title"].'</h3>
                <p>'.$row["mini_description"].'</p>
				<br>
                <ul>
                    <li><h3>Price: <b style="color:red"><i class="fa fa-usd"></i>'.$row["price"].'</b></h3></li>
                </ul>
            </div>
			</div>
				';
					
				}while($row=mysqli_fetch_array($result));
				
			$result1=mysqli_query($conn,"SELECT * FROM uploads_img WHERE idProd='$id'");
			if(mysqli_num_rows($result1)>0)
			{
				$row=mysqli_fetch_array($result1);
				echo '<div class="row">
				<div id="block-img-slide">
						<ul>';
				do{
					if($row["image"]!="" && file_exists("uploads_img/upload_img/".$row["image"])){
						$img_path='uploads_img/upload_img/'.$row["image"];
						$max_width=80;
						$max_height=70;
						list($width,$height)=getimagesize($img_path);
						$rationh=$max_height/$height;
						$rationw=$max_width/$width;
						$ratio=min($rationh,$rationw);
						$width=intval($ratio*$width);
						$height=intval($ratio*$height);
					}else{
						$img_path="img/def_mob.png";
						$width=70;
						$height=70;
					}
				echo'
				<li><a class="image-modal" href="#image'.$row["id"].'"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/></a></li>
				<a style="display:none;" class="image-modal" rel="group" id="image'.$row["id"].'"><img src="uploads_img/upload_img/'.$row["image"].'" width="800px" height="600px"/></a>
					';
				}while($row=mysqli_fetch_array($result1));
				echo '</ul>
					</div>
				</div>';
				}
				
				$result=mysqli_query($conn,"SELECT *FROM product WHERE idProd='$id'");
				$row=mysqli_fetch_array($result);
			echo '<div class="row">
				  <div id="tabs-container">
					<ul>
					<li><a id="tab1" class="active-tab">Description</a></li>
					<li><a id="tab2">Features</a></li>
					<li><a id="tab3">Comments</a></li>
					</ul>
				  </div>
		<div id="tabs-text">
				<div id="tab-text-1" class="active-tab-text"><p>'.$row["description"].'</p></div>
				<div id="tab-text-2"><p>'.$row["features"].'</p></div>
				
				<div id="tab-text-3">
				<p id="link-send"><a href="#send-reviews" class="send-reviews">Write a review</a></p>';
				
			$result2=mysqli_query($conn,"SELECT * FROM reviews WHERE idProd='$id' AND moderat='1'");
			if(mysqli_num_rows($result2)>0){
				$row=mysqli_fetch_array($result2);
				do{
					
				echo '<div class="block-reviews">
					<p class="author-date"><b>'.$row["name"].'</b> , '.$row["date"].'</p>
					<img src="img/plus.png" width="12px" height="12px"/><p class="txtg">'.$row["goodtxt"].'</p>
					<img src="img/minus.png" width="12px" height="12px"/><p class="txtg">'.$row["badtxt"].'</p>
					<p class="text-comment">'.$row["comment"].'</p>
				</div>';	
				}while($row=mysqli_fetch_array($result2));
			}else
			{
				echo '<p class="title-no-info">No comment(s)</p>';
			}				
				
			echo'
				</div>
				

				<div id="send-reviews">
				<p align="left" id="title-riviews">Publication reviews made after the pre-moderation.</p>
					<ul>
					<li><p align="right"><label id="label-name">Name<span>*</span></label><input type="text" maxlength="15" id="name_rev" /></p></li>
					<li><p align="right"><label id="label-good"><img src="img/plus.png" width="12px" height="12px"/><span>*</span></label><textarea id="good_rev"></textarea></p></li>
					<li><p align="right"><label id="label-bad"><img src="img/minus.png" width="12px" height="12px"/><span>*</span></label><textarea id="bad_rev"></textarea></p></li>
					<li><p align="right"><label id="label-comment">Comment</label><textarea id="comment_rev"></textarea></p></li>
					</ul>
					<input type="submit" id="button-send-review" iid="'.$id.'" value="Send"/>
				   </div>
				</div>
			</div>
				';
			}
			?> 
		<hr>
		<!-- Footer -->
<?php include('php/footer.php');?>
<script type="text/javascript">
$(document).ready(function(){
	 $('#tab1').click(function(){
  $("#tab2").removeClass("active-tab");
  $("#tab3").removeClass("active-tab");
  $("#tab1").addClass("active-tab");
  $("#tab-text-2").removeClass("active-tab-text");
  $("#tab-text-3").removeClass("active-tab-text");
  $("#tab-text-1").addClass("active-tab-text");
 });
 $('#tab2').click(function(){
  $("#tab1").removeClass("active-tab");
  $("#tab3").removeClass("active-tab");
  $("#tab2").addClass("active-tab");
  $("#tab-text-1").removeClass("active-tab-text");
  $("#tab-text-3").removeClass("active-tab-text");
  $("#tab-text-2").addClass("active-tab-text");
 });
 $('#tab3').click(function(){
  $("#tab1").removeClass("active-tab");
  $("#tab2").removeClass("active-tab");
  $("#tab3").addClass("active-tab");
  $("#tab-text-1").removeClass("active-tab-text");
  $("#tab-text-2").removeClass("active-tab-text");
  $("#tab-text-3").addClass("active-tab-text");
 });
	$(".image-modal").fancybox({
		'hideOnContentClick':true,
		'transitionIn' : 'fade',
		'transitionOut' : 'fade'
	});
	$(".send-reviews").fancybox();
	
});	
</script>