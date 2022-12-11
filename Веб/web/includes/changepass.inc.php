<?php 
		if(isset($_POST)){
			$login = $_POST['login'];
			$pass = $_POST['pass'];
		
		require_once 'function.inc.php';
		require_once 'dbpdoconnection.inc.php';
		
		changepass($pdo,$login,$pass);
	}
?>