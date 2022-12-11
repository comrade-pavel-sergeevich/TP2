<?php 
		if(isset($_POST)){
			$login = $_POST['login'];
			$param = $_POST['param'];
			$data = $_POST['data'];

		require_once 'function.inc.php';
		require_once 'dbpdoconnection.inc.php';
		
		changeuserdata($pdo,$login,$param,$data);
	}
?>