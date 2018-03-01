<?php
if($_SESSION['auth']!='yes_auth' && $_COOKIE["rememberme"])
{
	$str=$_COOKIE["rememberme"];
	
	$all_len=strlen($str);
	$login_len=strpos($str,'+');
	$login=substr($str,0,$login_len);
	
	$pass=substr($str,$login_len+1,$all_len);
	
	$result=mysqli_query($conn,"SELECT * FROM reg_user WHERE login='$login' AND pass='$pass'");
	if(mysqli_num_rows($resut)>0)
	{
		$row=mysqli_fetch_array($result);
		session_start();
		
		$_SESSION['auth']='yes_auth';
		$_SESSION['auth_login']=$row["login"];
		$_SESSION['auth_pass']=$row["pass"];
		$_SESSION['auth_name']=$row["name"];
		$_SESSION['auth_lastname']=$row["lastname"];
		$_SESSION['auth_email']=$row["email"];
	}
}
?>