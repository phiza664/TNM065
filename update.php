<?php
session_start();
// contect database
include_once("db/db.php");
$link_id = db_connect();




if(isset($_POST["user_id"]) && isset($_POST['user_class']) ){

	$user_id = mysql_real_escape_string($_POST["user_id"]);
	$user_class = mysql_real_escape_string($_POST['user_class']);
	
	if ($user_id != '0' && $user_class != '0'){
		$query = "UPDATE USERCLASS SET User_Class = '$user_class' WHERE User_ID = '$user_id'";
		//$_SESSION['qtest']=$query;
		$result = mysql_query($query);
		if($result){
			exit();
		}else {
			die("Query failed");
		}
	}
}else{
	exit();
}

?>