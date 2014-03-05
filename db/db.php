<?php

	function db_connect() {
		$host     = "localhost";
		$user     = "root"; 		//byt ut **
		$password = ""; 	//mysql-lösenord
		$database = "sebra729"; 		//byt ut **
		
		$link_id = mysql_connect($host, $user, $password) or die("Fel: kunde inte koppla upp mot databasservern.");
		mysql_select_db($database) or die("Fel: något är fel med databasen.");
		return $link_id;
}
db_connect();
?>