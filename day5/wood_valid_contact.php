<?php 
include_once('functions.php');

//parse form if it was submitted
if( $_POST['did_submit'] ): 
	//extract user submitted info
	$name = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
	$email = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL );
	$phone = filter_var( $_POST['phone'], FILTER_SANITIZE_NUMBER_INT );
	//allow certain tags in the message, strip all others
	$message = strip_tags( trim($_POST['message']), '<b><i><strong><em><p>' );
	$newsletter = $_POST['newsletter'];

	//validate!
	$valid = true;

	//check for empty name field
	if( 0 == strlen($name) ){
		$valid = false;
		$errors['name'] = 'Please fill out your name.';
	}
	//check for invalid email format
	if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
		$valid = false;
		$errors['email'] = 'Please provide a valid email address.';
	}
	//check for message too long
	if( strlen( $message ) > 250 ){
		$valid = false;
		$errors['message'] =  'Make sure your message is less than 250 characters.';
	}


	if ( 1 == $newsletter ):
		$newsletter = 'YES!';
	else:
		$newsletter = 'NO!';
	endif;
	
	//only send mail if form was valid
	if( true == $valid ):

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
			$css_class = 'success';
		else:
			$display_msg = 'Sorry, there was a problem sending your message.';
			$css_class = 'error';
		endif; //did_send

	endif; //still valid

endif;	//did_submit
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example Contact Form - Simple</title>
<style>
body {
	background: url(images/kindajean_@2X.png) repeat;
	font-family: "Franklin Gothic Medium", "Franklin Gothic", "ITC Franklin Gothic", Arial, sans-serif;
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
input[type=text] {
		width: 60%;
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
}
.display {
	background-color: #E7F8F3;
	padding: 10px;
	margin-bottom: 15px;
	font-family: "Franklin Gothic Medium", "Franklin Gothic", "ITC Franklin Gothic", Arial, sans-serif;
	font-style: italic;
	color: #829AB5;
}
.success {
	font-family: "Franklin Gothic Medium", "Franklin Gothic", "ITC Franklin Gothic", Arial, sans-serif;
	font-style: italic;
	color: #445060;
	width: 80%;
	padding: 20px;
	background-color: #849E91; 
	box-shadow: 10px 10px 5px #888888;
	border: 1px solid #D7D7D7;
}
.error {
	background-color: #D7D7D7;
}

</style>



</head>

<body>
<div id="container">


	<header>
		<h1>Contact</h1>
	</header>
	
	<?php 
	if( isset($display_msg) ):
		echo "<div class='$css_class'>";
		echo $display_msg;
		echo '</div>';
	endif;
	?>
	<?php  	
	//gide the form if it sent correctly
	if (!$did_send): ?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for ="name">Your Name:</label>
		<input type="text" name="name" id="name" value="<?php sticky_field($name); ?>" />
		<?php display_error( $errors, 'name' ); ?>

		<label for ="email">Your Email:</label>
		<input type="text" name="email" id="email" value="<?php sticky_field($email); ?>"/>
		<?php display_error( $errors, 'email') ?>

		<label for ="phone">Your Phone:</label>
		<input type="text" name="phone" id="phone" value="<?php sticky_field($phone); ?>" />

		<label for="message">Your Message:</label>
		<textarea name="message" id="message"> <?php sticky_field($message); ?></textarea>
		<?php display_error( $errors, 'message' ); ?>

		<input type="checkbox" name="newsletter" value="1" id="newsletter" 
		<?php checked( 'YES!', $newsletter ); ?> />
		<label for="newsletter">I would like to receive the newsletter!</label>

		<input type="submit" value="Send Message">
		<input type="hidden" name="did_submit" value="1" />
	</form>
	<?php endif; //hide form if did_send ?>

</div>
</body>
</html>