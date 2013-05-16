<aside>
		<?php 
		//set up query to get the titles & post_id of the lastest 10 posts
		//vars getting diffferent names when multiple queries on page
		$query_latest = "SELECT title, post_id
						FROM posts
						WHERE is_public = 1
						ORDER BY date DESC
						LIMIT 10";
						//run it and check for results
						if( $result_latest = $db->query($query_latest) ):
		$query_cat = "SELECT name
						FROM categories	
						ORDER BY name DESC
						LIMIT 10";

						if( $result_cat = $db->query($query_cat) ):
 
		 $query_link = "SELECT url, title, description, user_id
						FROM links	
						ORDER BY title DESC
						LIMIT 10";

						if( $result_link = $db->query($query_link) ):
		 ?>
		<h2>Latest Post</h2>
			<ul>
				
				<?php
				//from the list of results, go through each row , one at a time
				 while( $row_latest = $result_latest->fetch_assoc() ): ?>
				<li><a href="#"><?php echo $row_latest['title']; ?></a></li>
				<?php endwhile; ?>
			</ul>
			<?php endif; ?>


		<h2>Categories</h2>
			<ul>
				<?php 
				//from the list of results, go through each row , one at a time
				while ( $row_cat = $result_cat->fetch_assoc() ): ?>
				<li><a href="#"><?php echo $row_cat['name']; ?></a></li>
			<?php endwhile; ?>
			</ul>
			<?php endif; ?>



		<h2>Links</h2>
			<ul>
				<?php 

				while ( $row_link = $result_link->fetch_assoc() ): ?>
				<li><a href="<?php echo $row_link['url']; ?>"><?php echo $row_link['title'] ?></a></li>
				<?php endwhile; ?>
			</ul>
			<?php endif; ?>
</aside>