<?php 
	if(isset($_POST)){
		$login = $_POST['login'];
		session_start();
			$_SESSION['user_name'] = $login;
			session_write_close();
	}
?>