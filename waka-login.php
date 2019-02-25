<?php
session_start();
include_once('config.php');
		
		$getadminquery	="SELECT * FROM login_master WHERE login_id=1 ";
		$exe_adminquery	= mysqli_query($con,$getadminquery);
		$result_admin	= mysqli_fetch_array($exe_adminquery);

		$admin_username	=	$result_admin['username'];
		$admin_password	=	$result_admin['password'];

		 $username	=	$_POST['username'];
		 $password	=	$_POST['password'];
	
		
		if($username == $admin_username && $password == $admin_password)
		{
			$_SESSION['admin_username']= $username;
			
			header('Location:create-invoice.php');
			
		}
		else
		{
			header('Location:index.html?errmsg="Either Username or Password is incorrect"');
		}
	
?>
