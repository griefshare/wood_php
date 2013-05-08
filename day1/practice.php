<?php
//create status var - possible values are 'success' or 'error'
$status = 'success';

 
//logic to control the message text based on status
if( $status == 'success'){
	$message = 'You rock!';
}
else{ 
	$message = 'You must die';
}

?>

<!DOCTYPE html>
<html>
<head>
<style>
	.error {
		background-color: #900;
	}
	.success {
		background-color: #0F0;
	}
</style>
</head>

<body>
	<div class="<?php echo $status; ?>">
		<h2>
	<?php 
//this is a secret
	echo $message; ?>
	</h2>
</div>

</body>
</html>




