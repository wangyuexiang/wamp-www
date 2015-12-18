<?php
	require("config.inc.php");
	
	$query = "select * from users";
	
	try{
		$stmt = $db -> prepare($query);
		$stmt -> execute();
	}
	catch(PDOException $ex){
		$response["success"] = 0;
		$response["message"] = "Database Error.";
		die(json_encode($response));
	}
	
	$row = $stmt -> fetchAll();
	
	if($row){
		$response["success"] = 1;
		$response["message"] = "Post Available!";
		$response["posts"] = array();
		
		foreach($row as $row){
			$post = array();
			$post["id"] = $row["id"];
			$post["username"] = $row["username"];
			$post["passwprd"] = $row["password"];
			
			array_push($response["posts"], $post);
		}
		echo json_encode($response);

	} else {
			$response["success"] = 0;
			$response["message"] = "No Post Available!";
			die(json_encode($response));
	}
?>