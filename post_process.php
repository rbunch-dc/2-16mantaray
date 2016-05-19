<?php
	require_once 'includes/db_connect.php';
	if(!isset($_SESSION['username'])){
		//you aren't logged in. You should not be here. Goodbye.
		header('Location: login.php');
		exit;
	}

	DB::insert('posts', array(
		'username' => $_SESSION['username'],
		'postText' => $_POST['post_text']
		// 'status' => 0
	));

	header('Location: index.php?post=success');







