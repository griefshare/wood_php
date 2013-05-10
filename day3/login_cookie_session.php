<?php
//open for a new session or resume the existing session_start
session_start(); 
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
		//use cookies and sessions to remember the user
		$_SESSION['logged_in'] = 1;
		setcookie( 'logged_in', 1, time() + 60 * 10 * 24 * 14 );
	}else{
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
</head>

<body>
<?php 
//If not logged in, show the form
if( !$_SESSION['logged_in'] == 1 ){
?>

	<h1>Log In!</h1>

	<?php 
	//if an error was triggered, show a message
	if( $error ){
			echo 'Username and password do not match. Try again.';
	}
	?>

	<form method="post" action="login_cookie_session.php">
		
	<label for="username">Username:</label>
		<input type="text" name="username" id="username">
		<br />

		<label for="password">Password:</label>
		<input type="password" name="password" id="password">
		<br />

		<input type="submit" value="Log In">
		<input type="hidden" name="did_login" value="1">
	</form>
<?php  
} //end if logged in 
else{ ?>

	<p>You are logged in!</p>
	<p><a href="login_cookie_session.php?action=logout">Log Out</a></p>

<?php }?>

</body>
</html>