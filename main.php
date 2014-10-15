<?php
// startar sessionen
session_start();

//inqlude query.php where all php functions is stored. 
include("query.php");

// $output ligger i 
include "transformations/dbToXml.php";

//Secure that only logged in users can access the site.
wearify();

// Logout handeler
logout();

//save new card handeler
save_card();




if(isset($_GET['format'])){

	if($_GET['format']=='json')
	{
		print $output;
		exit;
	};
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Inloggad</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" title="main" charset="iso-8859-1"/>
	<link rel="stylesheet" href="transformations/design.css"/>
</head>
<body>
	<script src="transformations/jquery-1.9.0.js"></script>
	<script src="transformations/flickrTest.js"></script>
	<div id="header">
	<h1>Congratulation!</h1>
	</div>

	<form id="logoutForm" action="" method="post" name="logoutform"> 
	<button id="logoutbutton" type="submit " name="submit">Logout</button>	
	</form>

	<form id="cardform" action="" method="post" name="cardform">
	<table>
	  <h2>Post your awsome card!</h2>
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
		if(isset($errmsg_arr)){
			echo $errmsg_arr;
		}
		?> 
	</table>
	</form>

<!-- 	<div id="post-card" class="card">
		<div class="large-image-container">
			
		</div>
		<h2 class="card-rubrik">qwe</h2>
		<div class="text-content">
			<p><span class="qoute qoute-first">ʻ</span>qwe<span class="qoute qoute-last">‚</span></p>
		</div>
		
	</div> -->
<?php 
	print $output;

 ?>
 </body>
 </html>
