<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	require_once 'includes/db_connect.php';
	
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

		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["avatar"]["tmp_name"]);
		if($check !== false) {
		    // echo "File is an image - " . $check["mime"] . ".";
		    $uploadOk = 1;
		} else {
		    echo "File is not an image.";
		    $uploadOk = 0;
		    header('Location: register.php?error=fakeimage');
		    exit;
		}
	    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }

exit;

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







