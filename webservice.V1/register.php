<?php
	require("config.inc.php");
	
	if(!empty($_POST)){
		if(empty($_POST['username']) || empty($_POST['password'])){
			$reponse["success"] = 0;
			$response["message"] = "Please Enter Both a Username and Password.";
			die(json_encode($response));
		}
		
		// verify if username already exists
		$query = "select 1 rom users where username = :user";
		$query_params = array(':user' => $_POST['username']);
		
		try{
			$stmt = $db -> prepare($query);
			$result = $stmt -> execute($query_params);			
		}
		catch(PDOException $ex){
			$response["success"] = 0;
			$response["message"] = "Database Error1. Please Try Again";
			die(json_encode($response));
		}
		
		$row = $stmt -> fetch();
		if($row){
			$response["success"] = 0;
			$response["message"] = "I'm sorry, this username is already in use. Please Try Again";
			die(json_encode($response));
		}
		
		// insert
		$query = "insert into users (username, password) values (:user, :pass)";
		$query_params = array(
			':user' => $_POST['username'],
			':pass' => $_POST['password']
		);
		
		try{
			$stmt = $db -> prepare($query);
			$result = $stmt -> execute($query_params);			
		}
		catch(PDOException $ex){
			$response["success"] = 0;
			$response["message"] = "Database Error2. Please Try Again";
			die(json_encode($response));
		}
		$response["success"] = 1;
		$response["message"] = "Username Successfully Added";
		echo json_encode($response);
	}	else{
		?>
		<h1>Register</h1>
		<form action="register.php" method="post">
			Username:<br />
			<input type="text" name="username" value="" />
			<br /><br />
			Password:<br />
			<input type="password" name="password" value="" />
			<br /><br />
			<input type="submit" value="Register New User" />
		</form>
		<?php
	}
?>

