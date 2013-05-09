<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<form method="get" action="get.php">
		<label for="name">What is your name?</label>
		<input type="text" name="name" id="name" />

		<label for="breakfast">What did you eat for breakfast?</label>
		<input type="text" name="breakfast" id="breakfast" />

		<input type="submit" value="go!" />
		<input type="hidden" name="did_submit" value="1" />
	</form>
	
	<?php
	//only shpw the message if the form was submitted
	if( $_GET['did_submit'] ==1 ){
		echo 'Good morning, ';
		echo $_GET['name'];
		echo '. '; 
		echo $_GET['breakfast'];
		echo ' sounds delicious.';

		echo 'Good morning, '. $_GET['name']. '. '. $_GET['breakfast']. 'sounds delicious.'; 
	} 
	?>
</body>
</html>