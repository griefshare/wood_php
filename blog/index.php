<?php require('db_connect.php'); 
include_once( 'functions.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dan's PHP Blog</title>
</head>

<body>
	<header>
		<h1>Dan's Blog</h1>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="index.php?page=blog">Blog</a></li>
				<li><a href="index.php?page=links">Links</a></li>
			</ul>
		</nav>	
	</header>

	<main>
	<?php
	//logic to load the correct page contents.
	//URI will look like /index.php?page=something
		switch( $_GET['page'] ){
			case 'blog':
				include( 'content_blog.php' );
			break;
			case 'links':
				include( 'content_links.php' );
			break;
			case 'single':
				include( 'content_single.php' );
			break;
			default:
			    include( 'content_home.php' );
		}
		 ?>
	</main>

	<?php include('sidebar.php'); ?>

	<footer>
		<p>&copy; 2013 danwould designs</p>
	</footer>
</body>
</html>