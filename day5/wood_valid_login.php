<?php
//open for a new session or resume the existing session_start
session_start(); 
//the correct username/password combo
$correct_username = 'daniel';
$correct_password = 'phprules';

//if the form was submitted, try to log them in 
if( $_POST['did_login'] ){
	//extract the values the user typed in (sanitize)
	$username = strip_tags(trim($_POST['username']));
	$password = strip_tags(trim($_POST['password']));

	//check to see if minimum lengths are met (validate)
	if( strlen( $username ) >= 5 AND strlen( $password ) >= 5 ){

		//compare user values with correct values. If they match Log them in.
		if( $username == $correct_username AND $password == $correct_password ){
			//use cookies and sessions to remember the user
			$_SESSION['logged_in'] = 1;
			setcookie( 'logged_in', 1, time() + 60 * 10 * 24 * 14 );
		}else{
			$error = 1;	
		}
	}else{
		//username or pass too short
		$error = 1;
	}
}

//if the user is trying to logout, usnet and destroy the session and cookies
if( $_GET['action'] == 'logout'){
	unset( $_SESSION['logged_in'] );
	session_destroy();
	setcookie('logged_in', '', time() - 60 * 60 * 24 * 365 );
}

//if the user visits the page, and the user is still valid, recreate the session variable
elseif( $_COOKIE['logged_in'] == 1 ){
	$_SESSION['logged_in'] = 1; 
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Log in to your account</title>
<link href="format.css" rel="stylesheet" type="text/css"  media="screen"/>
</head>

<body>
<?php 
//If not logged in, show the form
if( !$_SESSION['logged_in'] == 1 ){
?>

	

	

	<form method="post" action="wood_valid_login.php">
		<h1>Log In!</h1>
	
<?php 
	//if an error was triggered, show a message
	if( $error ){
			echo '<div class="error">Username and password do not match. Try again.</div>';
	}
	?>

	<label for="username">Username:</label>
		<input type="text" name="username" id="username" placeholder="username">
		<br />

		<label for="password">Password:</label>
		<input type="password" name="password" id="password" placeholder="password">
		<br />

		<input type="submit" value="Log In">
		<input type="hidden" name="did_login" value="1">
	</form>
<?php  
} //end if logged in 
else{ ?>

	<p>You are logged in!</p>
	<div class="logout">
	<p><a href="wood_valid_login.php?action=logout">Log Out</a></p>
	</div>

<?php }?>

</body>
</html>