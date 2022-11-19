<?php 
		$email = $_GET['email'];
	
		require_once 'function.inc.php';
		require_once 'dbpdoconnection.inc.php';
		
		if(existUser($pdo, $email))			
		{			
			echo "exist";	exit();		
		}
			echo 'no';	
			exit();
?>