<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require_once 'includes/head.php';
	require_once 'includes/header.php';

	$posts = DB::query("SELECT * FROM posts");
?>

<body>

	<h1>Make a post</h1>
	<?php if(isset($_SESSION['username'])): ?>
		<form action="post_process.php" method="post">
		  <div class="form-group">
		    <label for="post-text">Your Manta Ray post</label>
			<textarea id="post-text" name="post_text"></textarea>
		  </div>
		  <button type="submit" class="btn btn-default">Post</button>
		</form>
	<?php else: ?>
		<h3>You must be <a href="login.php">logged in</a> to make a post</h3>
	<?php endif; ?>
	
	<?php foreach($posts as $post): ?>
		<div class="post">
			<div class="user"><?php print $post['username']; ?></div>
			<div class="text"><?php print $post['postText']; ?></div>
			<div class="date"><?php print $post['timestamp']; ?></div>
		</div>
		
	<?php endforeach; ?>

</body>
</html>





