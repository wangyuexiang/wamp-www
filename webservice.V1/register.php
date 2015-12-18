<?php
	require("config.inc.php");
	
	if(!empty($_POST)){
		echo "message";
	}
	else
	{
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

