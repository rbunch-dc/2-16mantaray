<?php
	require_once 'includes/db_connect.php';

	if(!isset($_SESSION['username'])){
		print "notLoggedIn";
		exit;
	}else{

		$json_received = file_get_contents('php://input');
		$decoded_json = json_decode($json_received, true);
		$poster_username = $decoded_json['username'];

		

		DB::insert('following', array(
			'follower' => $_SESSION['username'],
			'poster' => $poster_username
		));

		print 'success';
	}

