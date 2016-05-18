<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	session_start();
	require_once 'includes/meekrodb.2.3.class.php';
	DB::$user = 'x';
	DB::$password = 'x';
	DB::$dbName = 'mantaray';
	DB::$host = '127.0.0.1';
	DB::$error_handler = false; // since we're catching errors, don't need error handler
	DB::$throw_exception_on_error = true;	

	//Let's check to see if the username they requested already exists.
	$result = DB::query("SELECT * FROM users where username = %s", $_POST['username']);
	if(!$result){
		$can_register = true;
	}else{
		$can_register = false;
	}

	if($can_register && ($_POST['password'] == $_POST['password2'])){
		//THey can register. Passwords are equal username not taken.
		$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		try{
			DB::insert('users', array(
				'username' => $_POST['username'],
				'password' => $hashed_password,
				'email' => $_POST['email'],
				'realName' => $_POST['realName']
			));
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['email'] = $_POST['email'];
			header('Location: index.php?welcome=yes');
			exit;
		}catch(MeekroDBException $e){
			header('Location: /register.php?error=yes');
			exit;
		}
	}else{
		header('Location: /register.php?error=usernameexists');
	}

?>







