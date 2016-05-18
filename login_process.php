<?php
	session_start();
	require_once 'includes/meekrodb.2.3.class.php';
	DB::$user = 'x';
	DB::$password = 'x';
	DB::$dbName = 'mantaray';
	DB::$host = '127.0.0.1';
	DB::$error_handler = false; // since we're catching errors, don't need error handler
	DB::$throw_exception_on_error = true;

	$result = DB::query("SELECT * FROM users WHERE username = %s", $_POST['username']);
	$hashed_password = $result[0]['password'];
	$password_verify = password_verify($_POST['password'], $hashed_password);

	if($password_verify){
		//The passwords match!!
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['uid'] = $result[0]['id'];
		header ('Location: index.php?welcome=yes');
	}else{
		header('Location: login.php?error=nomatch');
	}







