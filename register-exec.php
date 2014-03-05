<?php
	//mdflgmdfmgassd
	//Page to handle login 
	//Start session
	session_start();
	
include("db/db.php");
$link_id = db_connect();

	$user_name = ($_POST['new_user_name']);
	$password =($_POST['new_password']);
	$name = ($_POST['new_name']);
	$errflag = false;
	
	if($user_name == '') {
		$errmsg_arr = 'Användarnamn saknas ';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr .= 'Lösenord saknas ';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr .= 'Namn saknas ';
		$errflag = true;
	}
	
	$date = getdate();
	$date = "$date[year]-$date[mon]-$date[mday]";

	//Check for duplicate användarnamn ID
	if($user_name != '') {
		$qry = "SELECT * FROM USER WHERE User_Name='$user_name'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr .= 'email_adress används redan ';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		$errmsg_arr = '';
		session_write_close();
		header("location: http://localhost/projekt/index.php");
		
		exit();
	}

	//Create INSERT query
	$qry = "INSERT INTO USER(User_Name, Password, Name, Date_Created) VALUES('$user_name','$password', '$name', '$date')";
	$result = @mysql_query($qry);
	$user_id = @mysql_insert_id($link_id);
	//$class = "user";

	$qry = "INSERT INTO userclass(User_Class, User_ID) VALUES('user','$user_id')";
	$result2 = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result || $result2) {
		$errmsg_arr = '';				  //Empty error massage 
		$_SESSION['user_id'] = $user_id; //Save User_ID
		$_SESSION['class'] = "user";	//Save user class defult value user
		// Set inlog to true 
		$_SESSION["inloggning"] = true;

		// After registration user i moved to the main page
		header("Location: http://localhost/projekt/main.php"); 
		exit();
	}else {
		die("Query failed");
	}
?>