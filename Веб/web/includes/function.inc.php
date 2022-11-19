<?php 
	function emptyField($fiels){
		$result = false;
		foreach ($fiels as $field)
		{
			if (empty($field)){
				$result=true;
				break;
			}
		}
		return $result;
	}
	function existUser($pdo, $email){
		$sql ="SELECT * FROM users WHERE mail = ?;";
		$stmt = $pdo->prepare($sql);
		$stmt -> execute([$email]);
		
		if($stmt){
			return($stmt->rowCount()===1);
		}
	}
	function createUser($pdo, $name, $email, $pwd){
		$sql="INSERT INTO users (name, mail, password) VALUES(?,?,?);";
		try{
			$stmt = $pdo->prepare($sql);
			//$hashPwd = password_hash($pwd, PASSWORD_BCRYPT);
			$stmt -> execute([$name,$email,$pwd]);
		}
		catch(PDOExpression $e){
			exit();
		}
	}
	function login($pdo, $email, $pwd){
		$sql="SELECT password FROM users WHERE name=?";
		try{
			$stmt = $pdo->prepare($sql);
			$stmt -> execute([$email]);
		}
		catch(PDOExpression $e){
			header("location: ../index.php?reg_form=login&error=stmt&message=".$e->get);
			echo '<span style = "color:red">фиговый запрос</span>';
			exit();
		}
		try{
		$row = $stmt->fetch(PDO::FETCH_LAZY);if($row!=null){
		$hash = $row['password'];
		return password_verify($pwd, $hash);}
		}
	catch(PDOExpression $e){}	return false;		
	}
	
	
	
	function getname($pdo,$email){
		$sql="SELECT name FROM users WHERE name=?";
		try{
			$stmt = $pdo->prepare($sql);
			$stmt -> execute([$email]);
		}
		catch(PDOExpression $e){
			header("location: ../index.php?error=stmt&message=".$e->get);
			echo '<span style = "color:red">фиговый запрос</span>';
			exit();
		}
		$row = $stmt->fetch(PDO::FETCH_LAZY);
		return $row->name;
	}
	
	
?>