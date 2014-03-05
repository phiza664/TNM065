<?php
//Start session
session_start();
	
// contect database
include("db/db.php");
db_connect();

 if (isset($_POST['submit'])) {
	
	$user = $_POST['user'];
	$user = mysql_real_escape_string($user);
	
	$pass = $_POST['pass'];
	$pass = mysql_real_escape_string($pass);

	$result = mysql_query("SELECT * 
	FROM USER
	LEFT JOIN userclass ON user.user_id = userclass.user_id
	WHERE user.User_Name =  '$user'
	AND user.Password =  '$pass'");
	
	
	while ($row = mysql_fetch_array($result)) {
	//Save user_id and user_class to the session.
	$_SESSION['user_id'] = $row['User_ID']; 
	$_SESSION['class'] = $row['User_Class'];
	// approve the login
	$_SESSION["inloggning"] = true;
	
	
	//Move user to correct place acording to user_class
	if ($row['User_Class'] == "admin"){
		header("Location: main_admin.php");
	}
	else{
		header("Location: main.php");
	}
	exit; 
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Test</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" title="main" charset="iso-8859-1"/>
</head>

<div id="header">
<h1>Worlds greatest postcard site!</h1>
</div>

<p><img id="welcomeimage" src="happy-people.jpg" alt="welcomeimage" /></p>

<form id="loginForm" action="" method="post" name="loginform"> 
<table> 
<h2>Logga in</h2>
<tr><th>Användarnamn (email-adress)</th><td><input name="user" type="text"></td></tr>
<tr><th>Lösenord</th><td><input name="pass" type="password"></td></tr> 
<tr><td>&nbsp;</td><td><input type="submit" name="submit" value="Logga in"></td></tr> 
</table> 
</form>

<form id="regForm" name="regForm" method="post" action="register-exec.php">
  <table>
  <h2>Registrera ny användare</h2>
    <tr>
      <th>önskat namn </th>
      <td><input name="new_name" type="text" class="textfield" id="new_name" /></td>
    </tr>
    <tr>
      <th>email-adress </th>
      <td><input name="new_user_name" type="text" class="textfield" id="new_user_name" /></td>
    </tr>
    <tr>
      <th>önskat Lösenord</th>
      <td><input name="new_password" type="password" class="textfield" id="new_password" /></td>
    </tr>

    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit2" value="Registrera" /></td>
    </tr>
  </table>
<?php
	if(isset($_SESSION['ERRMSG_ARR'])){
		print $_SESSION['ERRMSG_ARR'];
	}
?>  
</form>

</html>