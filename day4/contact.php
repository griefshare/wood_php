<?php 
//parse form if it was submitted
if( $_POST['did_submit'] ): 
	//extract user submitted info
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];
	$newsletter = $_POST['newsletter'];

	//todo: validate!
	if ( 1 == $newsletter ):
		$newsletter = 'YES!';
	else:
		$newsletter = 'NO!';
	endif;

	//get ready to send mail - set up mail() parameters
	$to = 'dreasent@gmail.com';
	$subject = 'Conact Form from wp310 class demo';

	$body = "Name: $name \n";
	$body .= "Email: $email \n";
	$body .= "Phone: $phone \n\n";
	$body .= "Add to Newsletter List? $newsletter \n\n";
	$body .= "Message: $message \n\n";

	$header = "Reply-to: $email \r\n";
	$header .= "From: $name \r\n";

	//send it! did_send will equal 1 if mail sends. 0 if it fails to send.
	$did_send = mail( $to, $subject, $body, $header );

	//handle success/failure user feedback
	if( $did_send ):
		$display_msg = 'Thank you, ' . $name . ', for your message. I will get back to you soon.';
	else:
		$display_msg = 'Sorry, there was a problem sending your message.';

	endif; //did_send

endif;	//did_submit
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example Contact from - Simple</title>
<style>
body {
	background: url(images/kindajean_@2X.png) repeat;
}

#container {
	width: 30%;
	margin: 0 auto;
}

form {
	width: 80%;
	padding: 20px;
	background-color: #849E91; 
	box-shadow: 10px 10px 5px #888888;
	border: 1px solid #D7D7D7;
}

input[type=text],
input[type=submit],
textarea {
	display: block;
	margin-bottom: 10px;
}
input[type=submit] {
	margin-top: 20px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}
input[id=name],
input[id=email],
input[id=phone] {
	font-style: italic;
	color: #D6D5D1;
}
label {
	font-family: "Franklin Gothic Medium", "Franklin Gothic", "ITC Franklin Gothic", Arial, sans-serif;
	color: #445060;
}
h1 {
	font-family: "Franklin Gothic Medium", "Franklin Gothic", "ITC Franklin Gothic", Arial, sans-serif;
	color: #C14543;
	font-size: 36px;
	border-bottom: 3px dotted #849E91;
	width: 80%;
	-webkit-text-stroke: 5px white;
}
.display {
	background-color: #FFF;
	padding: 10px;
	margin-bottom: 15px;
	font-family: "Franklin Gothic Medium", "Franklin Gothic", "ITC Franklin Gothic", Arial, sans-serif;
	font-style: italic;
	color: #829AB5;
}
</style>



</head>

<body>
<div id="container">
	<header>
		<h1>Contact</h1>
	</header>
	

	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		
		<div class="display"><?php 
	if( isset($display_msg) ):
		echo $display_msg;
	endif;
	?></div
</br>

		<label for ="name">Your Name:</label>
		<input type="text" name="name" id="name" placeholder="Your name"/>

		<label for ="email">Your Email:</label>
		<input type="text" name="email" id="email" placeholder="Your email"/>

		<label for ="phone">Your Phone:</label>
		<input type="text" name="phone" id="phone" placeholder="Your phone"/>

		<label for="message">Your Message:</label>
		<textarea name="message" id="message"></textarea>

		<input type="checkbox" name="newsletter" value="1" id="newsletter" />
		<label for="newsletter">I would like to receive the newsletter!</label>

		<input type="submit" value="Send Message">
		<input type="hidden" name="did_submit" value="1" />
	</form>
</div>
</body>
</html>