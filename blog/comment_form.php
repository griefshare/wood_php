<section id="commentform">
	<h3>Leave a comment:</h3>
	
	<?php 
	//error/success reporting
	if( isset($message) ):
		echo '<div class="message">' .$message. '</div>';
	endif;
	?>

	<!--remove br tag after CSS styling-->
	<form method="post" action="#commentform">
		<label for="name">Your Name:</label>
		<input type="text" name="name" id="name" required="required" placeholder="required" />	
		
		<label for="email">Email Address: (will not be published)</label>
		<input type="email" name="email" id="email" required="required" placeholder="required" />


		<label for="url">Your Website Address:</label>
		<input type="url" name="url" id="url" />
	

		<label for="comment">Comment:</label>
		<textarea name="comment" id="comment" required="required" rows="10"></textarea>


		<input type="submit" value="Post Comment" />
		<input type="hidden" name="did_comment" value="1" />
		
	</form>

</section>