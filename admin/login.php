<?php
session_start();
include("include/config.php"); 

If($_POST["submit_enter"])
{
	$login=$_POST["input_login"];
	$pass=md5($_POST["input_pass"]);
	$pass=strrev($pass);
	$pass=strtolower("e23423q".$pass."1fd34");
}
if($login && $pass)
{
	$result=mysqli_query($conn,"SELECT *FROM admin WHERE login='$login' AND pass='$pass'");
	if(mysqli_num_rows($result)>0)
	{
		$row=mysqli_fetch_array($result);
		$_SESSION['auth_admin']='yes_auth';
		header("Location: index.php");
	}else{
		$msgerror="Invalid login or password";
	}
}else{
	$msgerror="Specify login and password";
}
include("include/head.php");  
?>

<div id="block-pass-login">
<?php
	if($msgerror)
	{
		echo'<p id="msgerror">'.$msgerror.'</p><hr>';
	}
?>
		<h3 style="text-align:center">Autenfication</h3>
	<form method="post">
		<ul id="pass-login">
		<li><label>Login</label><input type="text" name="input_login"/></li>
		<li><label>Password</label><input type="password" name="input_pass"/></li>
		</ul>
		<p style="text-align:center"><input type="submit" name="submit_enter" id="submit_enter" value="Enter"/></p>
	</form>


</div>
</body>
</html>
