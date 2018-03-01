<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	include('db.php');
	include('functions.php');
	
	$email=$_POST["email"];
	if($email!="")
	{
		$result=mysqli_query($conn,"SELECT email FROM reg_user WHERE email='$email'");
		if(mysqli_num_rows($result)>0)
		{
			$newpass="chinamobile";
			$pass=md5($newpass);
			$pass=strrev($pass);
			$pass=strtolower("e23423q".$pass."1fd34");
			$update=mysqli_query($conn,"UPDATE reg_user SET pass='$pass' WHERE email='$email'");
			
			send_mail('c-mobilenews@gmail.com',
						$email,
						'New password for website ChinaMobileNews',
						'Your password: '.$newpass);
			echo 'yes';
			
		}else
		{
			echo 'This email is not found!';
		}
	}
}
?>