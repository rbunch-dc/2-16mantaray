<?php
	require_once 'includes/db_connect.php';
	require_once 'includes/head.php';
	require_once 'includes/header.php';

	// require_once - will only include teh file if it hasnt been included yet, and will die if the file isnt there
	// require -- will include the file, but php will die if the file isn't there
	// include -- will keep going if it cant find the file

	// $all_posts = DB::query("SELECT * FROM posts WHERE status != 0");
	$all_posts = DB::query("SELECT posts.*, 
		COALESCE(SUM(votes.vote_direction),'ha ha, you have no votes, loser') as aggregateVotes
		FROM posts
		LEFT JOIN votes  ON posts.id = votes.pid 
		GROUP BY posts.id;");


	if($_GET['post'] == "success"){
		print "Hoooray! Your post came through";
	}
?>
<div id="content" ng-controller="mantaController">

{{message}}

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
	
	<?php foreach($all_posts as $post): ?>

		<?php 
			date_default_timezone_set('America/New_York');
			$timestamp_as_unix = strtotime($post['timestamp']);
			$formatted_date = date('D F j, Y, h:ia', $timestamp_as_unix);
		?>

		<div class="post">
			<div class="left-container">
				<div class="user">Poster: <?php print $post['username']; ?></div>
				<div class="text">Comment: <?php print $post['postText']; ?></div>
				<div class="date">Date: <?php print $formatted_date; ?></div>
			</div>

			<div class="right-container" id="<?php print $post['id'];?>">
				<div class="arrow-up" ng-click="processVote($event, 1)">X</div>
				<div class="vote-count"><?php print $post['aggregateVotes']; ?></div>
				<div class="arrow-down" ng-click="processVote($event, -1)">X</div>
			</div>

		</div>
		
	<?php endforeach; ?>
	</div>
</body>
</html>





