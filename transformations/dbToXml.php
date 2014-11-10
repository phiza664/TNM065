<?php

//Fixr transformen av sidan och displayar den
include 'transform.php';
/*
 *
This file handles the xml extraction from the database
and creates xml structured

<?xml version="1.0" encoding="UTF-8"?>
<cards>
	<card>
		<Card_ID>1</Card_ID>
		<User_ID>1</User_ID>
		<Date_Created>2012-12-06</Date_Created>
		<Content>Jag luktar tomat</Content>
		<Signature>pissluffaren</Signature>
		<Title>Mitt första inlägg</Title>
		<Image_URL>http://www.image.com/image.jpg</Image_URL>
	</card>
	.
	.
	.
</cards>

*/

//only to test this file alone
if(isset($_GET['test'])){
		echo $_GET['test'];
		$format = $_GET['format'];
		include '../db/db.php';	//includes db connection
		db_connect();
		$user_id = $_GET['test']; //should escape
}else{

	$user_id = $_SESSION['user_id']; //User_ID from login
}


mysql_query('SET NAMES utf8');
mysql_query('SET CHARACTER_SET utf8;');
$result = mysql_query("SELECT * FROM card WHERE Card_ID in (SELECT Card_ID FROM makes WHERE  User_ID = '$user_id')");
$xmlString = "";
$xmlString .="<?xml version=\"1.0\" encoding=\"UTF-8\"?>";				
//$xmlString .="<!DOCTYPE cards SYSTEM \"cards.dtd\">";

$xmlString .="<cards>";
while($row = mysql_fetch_object($result))
{
	$xmlString .="<card>";
	foreach($row as $key => $value){
		$xmlString .= "<$key>";
		//$xmlString .= "<![CDATA[$value]]>";
		$xmlString .= "$value";
		$xmlString .= "</$key>";
	}
	$xmlString .="</card>";
//	$card = $row->Card_ID;
//	$user = $row->User_ID;
//	$date = $row->Date_Created;
//	$content = $row->Content;
//	$signature = $row->Signature;
//	$title = $row->Title;
//	$image = $row->Image_URL;
	
}	
$xmlString .="</cards>";


//Decide in which format the xml should be outputted in
if(isset($_GET['format'])){
	$format = $_GET['format'];
}
else
{
	$format = "html";
}


$output = transformXML($xmlString, $format);

?>


