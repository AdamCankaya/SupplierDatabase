<?php
	include 'library.php';
	include 'storedInfo.php';
			
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "cankayaa-db", $myPassword, $database);
			
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
		
	$field1 = $_POST['field1-name'];
	$field2 = $_POST['field2-name'];
	
	$query = "INSERT INTO Certifications (cert_name, rev) 
		VALUES (" . "'" . $mysqli->real_escape_string($field1) . "'" . ", " . "'" . $mysqli->real_escape_string($field2) . "'". ")" ;
	//echo $query;
	$mysqli->query($query);
	echo "Success!";
	
	$url = "SuppDB.php";
	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">'; 
?>