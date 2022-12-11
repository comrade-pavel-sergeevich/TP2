<?php 
		$login = $_POST['login'];
	
		require_once 'function.inc.php';
		require_once 'dbpdoconnection.inc.php';
		
		if(existUser($pdo, $login))			
		{			
			echo "exist";	exit();		
		}
			echo 'no';	
			exit();
?>