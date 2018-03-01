<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	
	include('db.php');
	include('functions.php');
	
	$login=$_POST["login"];
	$pass=md5($_POST["pass"]);
	$pass=strrev($pass);
	$pass=strtolower("e23423q".$pass."1fd34");
	
	if($_POST["rememberme"]=="yes")
	{
		setcookie('rememberme',$login.'+'.$pass,time()+3600*24*31,"/");
	}
	
	$result=mysqli_query($conn,"SELECT * FROM reg_user WHERE (login='$login' OR email='$login') AND pass='$pass'");
	if(mysqli_num_rows($result)>0)
	{
		$row=mysqli_fetch_array($result);
		session_start();
		
		$_SESSION['auth']='yes_auth';
		$_SESSION['auth_login']=$row["login"];
		$_SESSION['auth_pass']=$row["pass"];
		$_SESSION['auth_name']=$row["name"];
		$_SESSION['auth_lastname']=$row["lastname"];
		$_SESSION['auth_email']=$row["email"];
		echo 'yes_auth';
	}else
	{
		echo 'no_auth';
	}	
	
}
?>