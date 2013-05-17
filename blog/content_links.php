<?php  
		//set up the query to get the latest two posts that are public
		$query = 'SELECT url, title, description
					FROM links
					ORDER BY title DESC
					LIMIT 10';
		//run it and check to make sure the result contains posts
		if( $result = $db->query($query) ):
		?>

		<h2>Links:</h2>
		
			<?php 
			//Loop through the list of results
			while( $row = $result->fetch_assoc() ):
			 ?>

		<article class="links">
			<ul>
			<li><a href="<?php echo $row['url']; ?>"><?php echo $row['title']; ?> - <?php echo $row['description']; ?></a></li>
			</ul>
		</article>

		<?php 
		endwhile;
		 ?>

		<?php else: ?>

			<h2>No Links to Show</h2>

			<?php endif; ?>