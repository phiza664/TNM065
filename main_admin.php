<?php
// startar sessionen
session_start();

// contect database
include("db/db.php");
include("query.php");
$link_id = db_connect();

//Secure that only logged in users can access the site.
wearify();

// Logout handeler
logout();

//save new card handeler
save_card();

//User_class_handeler
user_class_handeler()

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Inloggad Admin</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" title="main" charset="iso-8859-1"/>
	<script type="text/javascript" src="js/jq.v1.9.0.js"></script>
</head>


<body>
	<div id="header">
		<h1>Congratulation! Admin</h1>
	</div>

	<form id="logoutForm" action="" method="post" name="logoutform"> 
		<button id="logoutbutton" type="submit " name="submit">Logout</button>	
	</form>

	<h2>Post your awsome card!</h2>
	<form id="cardform" action="" method="post" name="cardform">
		<table>
		  
			<tr>
			  <th>Title</th>
			  <td><input name="title" type="text" class="textfield" id="title" /></td>
			</tr>
			<tr>
			  <th>Content </th>
			  <td><input name="content" type="text" class="textfield" id="content" /></td>
			</tr>
			<tr>
			  <th>Image URL</th>
			  <td><input name="imageurl" type="text" class="textfield" id="imageurl" /></td>
			</tr>
			<tr>
			  <th>Signature</th>
			  <td><input name="signature" type="text" class="textfield" id="signature" /></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td><input type="submit" name="submit2" value="Registrera" /></td>
			</tr>
			<?php
			usertable();
			update_userclass();
			if(isset($errmsg_arr)){
				echo $errmsg_arr;
				
			}
			?> 
		</table>
	</form>

</body>
</html>