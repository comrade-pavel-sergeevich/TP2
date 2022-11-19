<?php 
	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
	
		require_once 'function.inc.php';
		require_once 'dbpdoconnection.inc.php';
	
		if(emptyField([$email, $pwd])){
			header('location: ../index.php?reg_form=login&error=emptyfield');
			exit();		
		}
		
		
		if(login($pdo, $email, $pwd))			
		{
			session_start();
			//$_SESSION['user_email'] = $email;
			$_SESSION['user_name'] = $email;
			session_write_close();
			header('location: ../index.php');			
		}
		else
		{
			header('location: ../index.php?reg_form=login&error=wrongpass');
		}
		exit();
	}
	else
	{
		header('location: ../index.php?reg_form=login');
	}
?>