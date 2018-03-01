<?php      
	session_start();
	$title="Profile";
	//header
	include('php/head.php');
	//Navigation
	include('php/nav.php');

	if($_SESSION['auth']=='yes_auth'){
		if($_POST["save_submit"])
		{
			$_POST["info_email"]=$_POST["info_email"];
			$_POST["info_name"]=$_POST["info_name"];
			$_POST["info_lastname"]=$_POST["info_lastname"];
			
			$error=array();
			
			$pass=md5($_POST["info_pass"]);
			$pass=strrev($pass);
			$pass="e23423q".$pass."1fd34";
			
			if($_SESSION['auth_pass']!=$pass)
			{
				$error[]='Incorrect current password';
			}else{
				if($_POST["info_new_pass"]!="")
				{
					if(strlen($_POST["info_new_pass"])<7 || strlen($_POST["info_new_pass"]) >15)
					{
						$error[]="Specify new password from 7 to 15 characters";
					}else{
						$newpass=md5($_POST["info_new_pass"]);
						$newpass=strrev($newpass);
						$newpass="e23423q".$newpass."1fd34";
						$newpassquery="pass='".$newpass."',";
					}
				}
				if(strlen($_POST["info_name"])<3 || strlen($_POST["info_name"]) >20)
				{
					$error[]="Specify name from 3 to 20 characters";
				}
				if(strlen($_POST["info_lastname"])<3 || strlen($_POST["info_lastname"]) >20)
				{
					$error[]="Specify lastname from 3 to 20 characters";
				}
				if(!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",trim($_POST["info_email"])))
					{
						$error[]="Invalid Email";
					}
				
			}
			if(count($error))
			{
				$_SESSION['msg']="<p align='left' id='form-error'>".implode('<br/>',$error)."</p>";
			}else
			{
				$_SESSION['msg']="<p align='left' id='form-success'>Data saved success!</p>";
				$dataquery=$newpassquery."name='".$_POST["info_name"]."',lastname='".$_POST["info_lastname"]."',email='".$_POST["info_email"]."'";
				$update=mysqli_query($conn,"UPDATE reg_user SET $dataquery WHERE login='{$_SESSION['auth_login']}'");
				
				if($newpass){$_SESSION['auth_pass']=$newpass;}
				$_SESSION['auth_name']=$_POST["info_name"];
				$_SESSION['auth_lastname']=$_POST["info_lastname"];
				$_SESSION['auth_email']=$_POST["info_email"];
	
			}

		}

?>

    <!-- Page Content -->
    <div class="container" style="margin-top:30px">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Profile
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Profile</li>
                </ol>
            </div>
        </div><!-- /.row -->
		<div class="row">
		<?php 
				if($_SESSION['msg'])
				{
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				}
				
				
				?>
			<form method="POST">
				<ul id="info-profile">
				<li><label for="info_pass">Current password*</label>
				<input type="password" name="info_pass" id="info_pass"/></li>
				
				<li><label for="info_new_pass">New password</label>
				<input type="password" name="info_new_pass" id="info_new_pass" /></li>
			
				<li><label for="info_name">Name*</label>
				<input type="text" name="info_name" id="info_name" value="<?php echo $_SESSION['auth_name']; ?>" /></li>
				
				<li><label for="info_lastname">Lastname*</label>
				<input type="text" name="info_lastname" id="info_lastname" value="<?php echo $_SESSION['auth_lastname']; ?>"/></li>
				
				<li><label for="info_email">Email*</label>
				<input type="text" name="info_email" id="info_email" value="<?php echo $_SESSION['auth_email']; ?>"/></li>
				</ul>	
				<div class="register-bottom">
				<p align="center"><input type="submit" id="form_submit" name="save_submit" value="Save"/></p>
				</div>
				</form>
			</div><!-- /.row -->
        <hr>

        <!-- Footer -->
     <?php include('php/footer.php');?>
<?php
}else{header("Location: index.php");}
?>