<?php 
	
		require_once 'function.inc.php';
		require_once 'dbpdoconnection.inc.php';
		
		if(login($pdo, $_GET['name'], $_GET['pwd']))			
		{
			session_start();
			//$_SESSION['user_email'] = $_GET['email'];
			$_SESSION['user_name'] = $_GET['name'];
			session_write_close();
			echo "ok";	exit();		
		}
			echo 'wrongpass';	
			exit();
?>