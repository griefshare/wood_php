<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
	<form method="post" action="post.php">
		<label for="name">What is your name?</label>
		<input type="text" name="name" id="name" />

		<label for="breakfast">What did you eat for breakfast?</label>
		<input type="text" name="breakfast" id="breakfast" />

		<input type="submit" value="go!" />
		<input type="hidden" name="did_submit" value="1" />
	</form>
	
	<?php
	//only shpw the message if the form was submitted
	if( $_REQUEST['did_submit'] ==1 ){
		
		/*echo 'Good morning, ';
		echo $_REQUEST['name'];
		echo '. '; 
		echo $_REQUEST['breakfast'];
		echo ' sounds delicious.';*/

		echo 'Good morning, ' . $_REQUEST['name'] . '. '. $_REQUEST['breakfast'] . ' sounds delicious.'; 
	} 
	?>
</body>
</html>