<?php
	require_once 'includes/db_connect.php';
	$json_received = file_get_contents('php://input');
	$decoded_json = json_decode($json_received, true);
	$post_id = $decoded_json['idOfPost'];
	$vote_direction = $decoded_json['voteDirection'];

	DB::insert('votes', array(
		'username' => $_SESSION['username'],
		'vote_direction' => $vote_direction,
		'pid' => $post_id
	));

	print json_encode($_SESSION['username']);

