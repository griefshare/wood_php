<?php 
//the correct username/password combo
$correct_username = 'danny';
$correct_password = 'phprules';

//if the form was submitted, try to log them in
if( $_POST['did_login'] ){
	//extract the values the user typed in
	$username = $_POST['username'];
	$password = $_POST['password'];

	//compare user values with correct values. If they match Log them in.
	if( $username == $correct_username AND $password == $correct_password ){
		$logged_in = 1;
	}else{
		$error = 1;	
	}

}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Log in to your account</title>
</head>

<body>
<?php 
//If not logged in, show the form
if( !$logged_in ){


?>

	<h1>Log In!</h1>

	<?php 
	//if an error was triggered, show a message
	if( $error ){
			echo 'Username and password do not match. Try again.';
	}
	?>

	<form method="post" action="login.php">
		
	<label for="username">Username:</label>
		<input type="text" name="username" id="username">
		<br />

		<label for="password">Password:</label>
		<input type="password" name="password" id="password">
		<br />

		<input type="submit" value="Log In">
		<input type="hidden" value="did_login" value="1">
	</form>
<?php  
}//end if logged in 
else{
	echo 'You are logged in';
}?>

</body>
</html>