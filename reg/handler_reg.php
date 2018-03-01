<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
session_start();
include("../php/inc/db.php");
include("../php/inc/functions.php");

$error=array();

	$login=strtolower($_POST['login']);
	$pass=strtolower($_POST['password']);
	$repass=strtolower($_POST['repassword']);
	
	$name=$_POST['name'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	
if(strlen($login)<5 or strlen($login)>15){$error[]="Login, 5 do 15 characters";
}else{
	$result=mysqli_query($conn,"SELECT login FROM reg_user WHERE login='$login'");
	if(mysqli_num_rows($result)>0)
	{
		$error[]="Login not available!";
	}
}
if(strlen($pass)<7 or strlen($pass)>15)$error[]="Password, 7 to 15 characters";
if(strlen($name)<3 or strlen($name)>20)$error[]="Name, 3 to 20 characters";
if(strlen($lastname)<3 or strlen($lastname)>20)$error[]="Lastname 3 to 20 characters";
if(!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",trim($email)))$error[]="Invalid Email";
if($pass!=$repass)$error[]="Incorrect confirm password!";

if(count($error))
{
	echo implode('<br/>',$error);
}else{
	if($pass==$repass){
	$pass=md5($pass);
	$pass=strrev($pass);
	$pass="e23423q".$pass."1fd34";
	
	$ip=$_SERVER['REMOTE_ADDR'];
	
mysqli_query($conn,"INSERT INTO reg_user(login,name,lastname,pass,datetime,ip,email)
			VALUES(
			'".$login."',
			'".$name."',
			'".$lastname."',
			'".$pass."',
			NOW(),
			'".$ip."',
			'".$email."')");
	}
echo 'true';
}
}
?>