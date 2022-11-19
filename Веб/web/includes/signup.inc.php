<?php 
	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$pwdrepeat = $_POST['pwdrepeat'];
	
		require_once 'function.inc.php';
		require_once 'dbpdoconnection.inc.php';
	
		if(emptyField([ $email, $pwd, $pwdrepeat])){
			header('location: ../index.php?reg_form=register&error=emptyfield');
			exit();		
		}
		if(existUser($pdo, $email)){
			header('location: ../index.php?reg_form=register&error=email');
			exit();
		}
		if($pwd!=$pwdrepeat){
			header('location: ../index.php?reg_form=register&error=diffpass');
			exit();
		}
		
		$phash = password_hash($pwd, PASSWORD_BCRYPT);
		createUser($pdo, $email, $phash);
		header('location: ../index.php?reg_form=login');
	}
	else
	{
		header('location: ../index.php?reg_form=register');
	}
?>