<?php 
				//db host, username, password, database name
$db = new mysqli( 'localhost', 'dan_wp310', 'Grief_7878', 'blog_dw_0513' );

//if there is an error connecting, kill the page
if( $db->connect_errno > 0 ){
	die('Unable to connect to the database');
}
