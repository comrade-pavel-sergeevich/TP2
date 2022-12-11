<?php 
	if(isset($_POST)){
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
	
		require_once 'function.inc.php';
		require_once 'dbpdoconnection.inc.php';
	
		if(emptyField([$email, $pwd])){
			echo false;
			exit();		
		}
	
		echo (login($pdo, $email, $pwd));			
	}
	else
	{
		
	}
	echo false;
?>