<?php  	
	session_start(); 
	$title="Registration";
	//header
	include('php/head.php');
	//Navigation
	include('php/nav.php');	
?>
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
<script type="text/javascript" src="js/registr.js"></script>

<style>
.error{
	font:italic 14px sans-serif;
	color:red;
	margin-left:10px;
}
</style>
<?php
	if(isset($_SESSION['auth']))
		header('Location: index.php');
?>
    <!-- Page Content -->
    <div class="container"  style="margin-top:30px">
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Registration
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Registration</li>
                </ol>
            </div>
        </div>
    <div class="row">
			<div class="signup-main">
				<form method="post" id="form_reg" action="reg/handler_reg.php">
					<p id="reg_message"></p>
		<div id="registr">			
			<div class="register-top">
				<h3>Personal Information</h3>
				</div>
				<div class="sign-left">
					<p>NAME </p>
					<input type="text" name="name" id="name"/>
					
					<p>LASTNAME</p>
					<input type="text" name="lastname"id="lastname" />
				
					<p>EMAIL</p>
					<input type="text" name="email" id="email"/>
			
					<p>LOGIN</p>
					<input type="text" name="login"id="login"/>
				</div>
			<div class="sign-right">
					<p>PASSWORD</p>
					<input type="password" name="password" id="password">
				</div>
				<div class="sign-right">
					<p>CONFIRM PASSWORD</p>
					<input type="password" name="repassword" id="repassword">
				</div>

			<div class="clearfix"></div>
			<div class="register-bottom">
				<input type="submit" value="Confirm" name="submit">
			</div>
		</div>	
				</form>
			</div>
        </div><!-- /.row --> 

        <hr>
        <!-- Footer -->
<?php include('php/footer.php');
?>