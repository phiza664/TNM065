<?php

function printjs(){

	echo "<script>
	  $(document).ready(function(){
		$('.del_btn').click(function(){
		   var del_id = $(this).attr('rel');
		   $.post('delete.php?action=delete_card', {delete_id:del_id}, function(data) {
			  if(data == 'true') {
				$('#'+del_id).remove();
			  } else {
				alert('Could not delete!');
			  }
		   });
		});
		
		$('#fff').submit(function() {
			alert('Handler for .submit() called.');
		  return false;
		});
		
		$('#knapp').click(function() {
			
			var name = $(\"input#user_class\").val();
			alert(name);
		});
		
		
		
	  });
	</script>";

	echo "<script>
	  $(document).ready(function(){
		$('.del_btn').click(function(){
		   var del_id = $(this).attr('rel');
		   $.post('delete.php?action=delete_user', {delete_id:del_id}, function(data) {
			  if(data == 'true') {
				$('#'+del_id).remove();
				$('#card'+del_id).remove();
			  } else {
				alert('Could not delete!');
			  }
		   });
		});
	  });
	</script>";	

}

function usertable(){

	$user_result = mysql_query("SELECT * FROM USER JOIN USERCLASS ON user.user_id = userclass.user_id");


	while ($row = mysql_fetch_array($user_result)) {
	echo "<table border=\"1\"><tr>USER ",$row['User_Name'],"</tr>";
	echo "<td>Name</td><td>User_Name</td><td>Date_Created</td><td>User_ID</td><td>User_Class</td>";

	echo "<tr id = ", $row['User_ID'], ">";
	echo "<td>", $row['Name'], "</td>";
	echo "<td>", $row['User_Name'], "</td>";
	echo "<td>", $row['Date_Created'], "</td>";
	echo "<td>", $row['User_ID'], "</td>";
	echo "<td>", $row['User_Class'], "</td>";
	echo "<td><input type = ","button"," value = ","DELETE"," class=\"del_btn\" rel=\"".$row['User_ID']."\"></td>";

			  
	echo "</tr>";
	echo "</table>";
	//echo "<td>";
	cardtable($row['User_ID']);
	//echo "</td>";
}

	 
 
}

function cardtable($user_id){
	$card_result = mysql_query("SELECT DISTINCT Card_ID, Title, Content, Image_URL, Date_Created FROM 
	CARD WHERE Card_ID  IN (SELECT Card_id FROM MAKES WHERE  makes.user_id = '$user_id')");
	echo "<table  id=\"card$user_id\" class=\"card_table\" border=","1","><tr>CARDS FOR User_ID = '$user_id'</tr>";
	echo "<td>Card_ID</td><td>Titel</td><td>Content</td><td>Date_Created</td>";
	while ($row2 = mysql_fetch_array($card_result)) {
		echo "<tr  id = ", $row2['Card_ID'], ">";
		echo "<td>", $row2['Card_ID'], "</td>";
		echo "<td>", $row2['Title'], "</td>";
		echo "<td>", $row2['Content'], "</td>";
		echo "<td>", $row2['Date_Created'], "</td>";
		echo "<td><input type = ","button"," value = ","DELETE"," class=\"del_btn\"  rel=\"".$row2['Card_ID']."\"></td>";
	} 
	echo "</table>";



}

function update_userclass(){
	echo "<form id=\"fff\" action=\"http://localhost/TNM065/projekt/update.php\" method=\"post\">";

	$result = mysql_query ("SELECT * FROM USERCLASS");
	echo "<select id='user_id' name='user_id'><option value=\"\">Select one…</option>";
	while ($row = mysql_fetch_array($result)) {
		echo "<option value='$row[User_ID]'>$row[User_ID]</option>";
	}
	echo "</select>";// Closing of list box

	echo "<select id='user_class' name='user_class' ><option value=\"\">Select one…</option>";
	echo "<option value='admin'>admin</option>";
	echo "<option value='user'>user</option>";
	echo "</select>";// Closing of list box
	echo "<input type = \"submit\" value = \"Change\" />";
	echo "</form>";	
}

function user_class_handeler(){
if(isset($_POST["user_id"]) && isset($_POST['user_class']) ){

	$user_id = mysql_real_escape_string($_POST["user_id"]);
	$user_class = mysql_real_escape_string($_POST['user_class']);
	
	if ($user_id != '0' && $user_class != '0'){
		$query = "UPDATE USERCLASS SET User_Class = '$user_class' WHERE User_ID = '$user_id'";
		$result = mysql_query($query);
		if($result){

		}else {
			die("Query failed");
		}
	}
}
}

// Save card funtion
function save_card(){
	global $link_id;
	if (isset($_POST['submit2'])){

		$title = $_POST['title'];
		$title = mysql_real_escape_string($title);
		
		$content = $_POST['content'];
		$content = mysql_real_escape_string($content);
		
		$imageurl = $_POST['imageurl'];
		$imageurl = mysql_real_escape_string($imageurl);
		
		$signature = $_POST['signature'];
		$signature = mysql_real_escape_string($signature);
		
		$date = getdate();
		$date = "$date[year]-$date[mon]-$date[mday]";
		
		$errmsg_arr = '';
		$errflag = false;
		
		if($title == '') {
			$errmsg_arr .= 'Titel saknas ';
			$errflag = true;
		}
		if($imageurl == '') {
			$errmsg_arr .= 'Namn saknas ';
			$errflag = true;
		}
		if($signature == '') {
			$errmsg_arr .= 'Signatur saknas ';
			$errflag = true;
		}
		
		//Create INSERT query
		if($errflag != true){
		$qry = "INSERT INTO CARD(Title, Content, Image_URL, Signature, Date_Created) 
		VALUES('$title','$content', '$imageurl', '$signature', '$date')";
		
		$result = mysql_query($qry);
		$card_id = mysql_insert_id($link_id);
		
	 	if($result) {
			$errmsg_arr .= 'Kortet sparat! ';
			$user_id = $_SESSION['user_id']; //User_ID from login
			//Insert Query to create link between card_id and user_id in makes.
			$qry2 = "INSERT INTO MAKES(Card_ID, User_ID) VALUES ('$card_id', '$user_id')";
			$result = mysql_query($qry2);
			if($result){
				$errmsg_arr .= 'Kortet länkat med användare!';
			}else{
				die("Query failed! Makes");
			}
		}
		else{
			die("Query failed! Card");
		} 
		}
	}
}

function logout(){
if (isset($_POST['submit'])){
	unset($_SESSION["inloggning"]);
	unset($_SESSION["User_Class"]);
	unset($_SESSION["User_ID"]);
	header("Location: index.php" );
}
}

function update_card($card_id){

}

function update_user(){

}

function wearify(){
	if ((!isset($_SESSION["inloggning"])) || ($_SESSION["inloggning"] != true)) {
		header("Location: index.php");
		exit;
	}
}




?>