<?php 	
		session_start();
		if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];exit();}
?>