<?php 
		if(isset($_POST)){
			$id = $_POST['id'];

		require_once 'function.inc.php';
		require_once 'dbpdoconnection.inc.php';
		
		deladdress($pdo,$id);
	}
?>