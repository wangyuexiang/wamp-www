<?php
	require("config.inc.php");
	
	if(!empty($_POST)){
		$query = "insert into comments (username, title, message)
							values (:user, :title, :message)";
		$query_params = array(
			':user' => $_POST['username'],
			':title' => $_POST['title'],
			':message' => $_POST['message'],
		);
		
		try{
			$stmt = $db -> prepare($query);
			$result = $stmt -> execute($query_params);
		}
		catch(PDOException $ex){
			$response["success"] = 0;
			$response["message"] = "Database Error. Couldn't add post!";
			die(json_encode($response));
		}
		
		$response["success"] = 1;
		$response["message"] = "Username Successully Added!";
		die(json_encode($response));
		
	} else {
?>
		<h1>Add Comment</h>
		<form action="addcomment.php" method="post">
			Username:<br />
			<input type="text" name="username" placeholder="name" />
			<br /><br />
			Title:<br />
			<input type="text" name="title" placeholder="post title" value="" />
			<br /><br />
			Message:<br />
			<input type="text" name="message" placeholder="post message" value="" />
			<br /><br />
			<input type="submit" value="Add Comment" />
		</form>
	<?php
}
?>