<?php require('db_connect.php'); 
include_once( 'functions.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dan's PHP Blog</title>
<link href="format.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
<div id="container" class="cf">
	<header>
		<h1>Dan's Blog</h1>
		<div class="cf nglobal">
		<nav id="global">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="index.php?page=blog">Blog</a></li>
				<li><a href="index.php?page=links">Links</a></li>
			</ul>
		</nav>	
		</div>
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

	<div class="cf">
	</div>

	<footer>
		<p>&copy; 2013 danwould designs</p>
	</footer>
</div>
</body>
</html>