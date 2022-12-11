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
	
	function getuser($pdo,$login){
		$sql="SELECT * FROM users WHERE login=?";
		try{
			$stmt = $pdo->prepare($sql);
			$stmt -> execute([$login]);
		}
		catch(PDOExpression $e){
			header("location: ../index.php?error=stmt&message=".$e->get);
			echo '<span style = "color:red">фиговый запрос</span>';
			exit();
		}
		$row = $stmt->fetch();
		return $row;
	}
	function getaddresses($pdo,$login){
		$sql="SELECT address_id, address_name FROM address WHERE address_id in (SELECT address_id FROM user_address WHERE user_id=(SELECT user_id FROM users WHERE login = ?))";
		try{
			$stmt = $pdo->prepare($sql);
			$stmt -> execute([$login]);
		}
		catch(PDOExpression $e){
			header("location: ../index.php?error=stmt&message=".$e->get);
			echo '<span style = "color:red">фиговый запрос</span>';
			exit();
		}
		return $stmt->fetchAll();
	}
	function changepass($pdo, $login,$pass){
		$pass=password_hash($pass, PASSWORD_BCRYPT);
		$sql="Update users  set password=? where login =?";
		try{
			$stmt = $pdo->prepare($sql);
			$stmt -> execute([$pass,$login]);
		}
		catch(PDOExpression $e){
			exit();
		}
	}
	function changeuserdata($pdo, $login,$param,$data){
		$sql="UPDATE users  set ".$param."=? where login =?";
		try{
			$stmt = $pdo->prepare($sql);
			$stmt -> execute([$data,$login]);
		}
		catch(PDOExpression $e){
			exit();
		}
	}
	function addaddress($pdo,$data){
		$sql="INSERT INTO address VALUES(null,?)";
		try{
			$stmt = $pdo->prepare($sql);
			$stmt -> execute([$data]);
		}
		catch(PDOExpression $e){
			exit();
		}
		$sql="SELECT address_id FROM address  WHERE address_name = ? ORDER BY address_id DESC LIMIT 1";
		try{
			$stmt = $pdo->prepare($sql);
			$stmt -> execute([$data]);
		}
		catch(PDOExpression $e){
			exit();
		}
		$row = $stmt->fetch();
		return $row['address_id'];
	}
	function addresstouser($pdo,$login,$id){
		$sql="INSERT INTO user_address VALUES(null,(SELECT user_id FROM users  WHERE login = ?),?)";
		try{
			$stmt = $pdo->prepare($sql);
			$stmt -> execute([$login,$id]);
		}
		catch(PDOExpression $e){
			exit();
		}
	}
	function deladdress($pdo,$id){
		$sql="DELETE FROM user_address WHERE address_id = ?";
		try{
			$stmt = $pdo->prepare($sql);
			$stmt -> execute([$id]);
		}
		catch(PDOExpression $e){
			exit();
		}
	}
	function chaddress($pdo,$id,$name){
		$sql="UPDATE address set address_name = ? WHERE address_id = ?";
		try{
			$stmt = $pdo->prepare($sql);
			$stmt -> execute([$name,$id]);
		}
		catch(PDOExpression $e){
			exit();
		}
	}
?>