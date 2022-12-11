<?php 
		if(isset($_POST)){
			$id = $_POST['id'];
			$name = $_POST['name'];

		require_once 'function.inc.php';
		require_once 'dbpdoconnection.inc.php';
		
		chaddress($pdo,$id,$name);
	}
?>