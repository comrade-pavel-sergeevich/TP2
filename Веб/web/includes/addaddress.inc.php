<?php 
		if(isset($_POST)){
			$data = $_POST['data'];

		require_once 'function.inc.php';
		require_once 'dbpdoconnection.inc.php';
		
		echo addaddress($pdo,$data);
	}
?>