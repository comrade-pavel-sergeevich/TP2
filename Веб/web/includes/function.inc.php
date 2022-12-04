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
	function existUser($pdo, $login){
		$sql ="SELECT * FROM users WHERE login = ?;";
		$stmt = $pdo->prepare($sql);
		$stmt -> execute([$login]);
		
		if($stmt){
			return($stmt->rowCount()===1);
		}
	}
	function createUser($pdo, $ln, $fn, $pn, $phn, $login, $email, $pwd){
		$sql="INSERT INTO users  VALUES(NULL, ?,?,?,?,?,?,?);";
		try{
			$stmt = $pdo->prepare($sql);
			//$hashPwd = password_hash($pwd, PASSWORD_BCRYPT);
			$stmt -> execute([$ln, $fn, $pn, $email,$phn, $login, $pwd]);
		}
		catch(PDOExpression $e){
			exit();
		}
	}
	function login($pdo, $login, $pwd){
		$sql="SELECT password FROM users WHERE login=?";
		try{
			$stmt = $pdo->prepare($sql);
			$stmt -> execute([$login]);
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
	
	function getmenu($pdo){
		$sql="SELECT * FROM products ORDER BY product_id";
		try{
			$stmt = $pdo->prepare($sql);
			$stmt -> execute();
		}
		catch(PDOExpression $e){
			header("location: ../index.php?error=stmt&message=".$e->get);
			echo '<span style = "color:red">фиговый запрос</span>';
			exit();
		}
		return $stmt->fetchAll();
		//$data = $stmt->fetchAll();
		//return json_encode($data, JSON_UNESCAPED_UNICODE);
	}
	
?>