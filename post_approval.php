<?php

//possible post approval page

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	// require_once 'includes/db_connect.php';
	require_once 'includes/head.php';

	$all_posts = DB::query("SELECT * FROM posts WHERE status = 0");

	foreach($all_posts as $post): ?>
	<?php endforeach; ?>

?>