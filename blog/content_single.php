<?php 
// TODO: Validate this so if a user messes with the URL, it doesn't show a blank page 
//what post are we trying to show
$post_id = $_GET['post_id'];

		//set up the query to get the post that we're trying to show if it is public
		$query = "SELECT posts.*, categories.*, users.username, users.user_id
					FROM posts, categories, users
					WHERE posts.is_public = 1
					AND posts.category_id = categories.category_id
					AND posts.user_id = users.user_id
					AND posts.post_id = $post_id
					ORDER BY posts.date DESC
					LIMIT 1";
		//run it and check to make sure the result contains posts
		if( $result = $db->query($query) ):
		?>
			<?php 
			//Loop through the list of results
			while( $row = $result->fetch_assoc() ):
			 ?>

		<article class="posts">
			<h3><?php echo $row['title']; ?></h3>
			<div class="postmeta">Posted on <?php echo $row['date']; ?> 
				 | in the category <?php echo $row['name']; ?>
				 | by <?php echo $row['username']; ?>
			</div>
			<p><?php echo $row['body']; ?></p>
		</article>

		<?php //get all the 'approved' comments on this post, oldest first 
		$query_comm = "SELECT name, date, body 
						FROM comments
						WHERE is_approved = 1
						AND post_id = $post_id
						ORDER BY date ASC";
if( $result_comm = $db->query($query_comm) ):
		?>
		
		<section id="comments">
			<h3><?php echo comments_number($result_comm->num_rows); ?> on this post.</h3>
			<?php if( $result_comm->num_rows > 0 ): ?>
			<ol>
			<?php //loop through each comment
				while( $row_comm = $result_comm->fetch_assoc() ): ?>
				<li>
					<h4><?php echo $row_comm[ 'name' ]; ?> says:</h4>
					<p><?php echo $row_comm[ 'body' ]; ?></p>
					<time datetime="<?php echo $row_comm[ 'date' ] ?>">
						<?php echo convert_date( $row_comm[ 'date' ]); ?>
					</time>
				</li>
			<?php endwhile; 
			//set the comments result free, because we are done with it
			$result_comm->free();?>
			</ol>
		<?php else: ?>
		<h4> Your comment could be the first! </h4>
		<?php endif; //more than 0 results ?>

		</section>
<?php endif; //comment results found ?>


		<?php 
		endwhile;
		 ?>

		<?php else: ?>

			<h2>No Posts to Show</h2>

		<?php endif; ?>