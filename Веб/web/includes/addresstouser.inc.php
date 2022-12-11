<?php 
		if(isset($_POST)){
			$login=$_POST['login'];
			$data = $_POST['id'];

		require_once 'function.inc.php';
		require_once 'dbpdoconnection.inc.php';
		
		echo addresstouser($pdo,$login,$data);
	}
?>