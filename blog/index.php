<?php require('db_connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dan's PHP Blog</title>
</head>

<body>
	<header>
		<h1>Dan's Blog</h1>
	</header>

	<main>
		<?php  
		//set up the query to get the latest two posts that are public
		$query = 'SELECT title, body, date, category_id, post_id
					FROM posts
					WHERE is_public = 1
					ORDER BY date DESC
					LIMIT 3';
		//run it and check to make sure the result contains posts
		if( $result = $db->query($query) ):
		?>

		<h2>Most Recent Posts:</h2>
		
			<?php 
			//Loop through the list of results
			while( $row = $result->fetch_assoc() ):
			 ?>

		<article class="posts">
			<h3><?php echo $row['title']; ?></h3>
			<div class="postmeta">Posted on <?php echo $row['date']; ?> | in the category NAME</div>
			<p><?php echo $row['body']; ?></p>
		</article>

		<?php 
		endwhile;
		 ?>

		<?php else: ?>

			<h2>No Posts to Show</h2>

		<?php endif; ?>

	</main>

	<?php include('sidebar.php'); ?>


	<footer>
		<p>&copy; 2013 danwould designs</p>
	</footer>
</body>
</html>