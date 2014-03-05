<?php
	// startar sessionen
	session_start();

	include_once("db/db.php");
	$link_id = db_connect();
	$_SESSION["qtest"] ="delete.php";
	//Secure that only inlogged admin can delete from database
	if ((!isset($_SESSION["inloggning"])) || ($_SESSION["inloggning"] != true) && (isset($_SESSION["class"]) != "admin")) {
	exit;
	}
	
	
	
	if(isset($_GET['action'])){
	
		//If action is delete
		//
		if($_GET['action'] == "delete_user"){
			if( isset($_POST['delete_id']) && !empty($_POST['delete_id'])) {
			  $delete_id = mysql_real_escape_string($_POST['delete_id']);
			  $result = mysql_query("DELETE FROM CARD WHERE Card_ID IN (SELECT Card_ID FROM MAKES WHERE User_ID = '$delete_id')");
			  $result = mysql_query("DELETE FROM MAKES WHERE User_ID = '$delete_id'");
			  $result = mysql_query("DELETE FROM USERCLASS WHERE User_ID = '$delete_id'");
			  $result = mysql_query("DELETE FROM USER WHERE User_ID = '$delete_id'");
			  if($result !== false) {
				echo 'true';
			  }
			}
		}
		
		//If action is delete
		//
		if($_GET['action'] == "delete_card"){
			if( isset($_POST['delete_id']) && !empty($_POST['delete_id'])) {
			  $delete_id = mysql_real_escape_string($_POST['delete_id']);
			  $result = mysql_query("DELETE FROM CARD WHERE Card_ID = '$delete_id'");
			  $result = mysql_query("DELETE FROM MAKES WHERE Card_ID = '$delete_id'");

			  if($result !== false) {
				echo 'true';
			  }
			}
		}
	}
?>