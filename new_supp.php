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
	$field3 = $_POST['field3-name'];
	$field4 = $_POST['field4-name'];
	$field5 = $_POST['field5-name'];
	
	
	
	$query = "INSERT INTO Suppliers (supp_name, fk_cert_id, comp_date, due_date, fk_eng_id) 
		VALUES (" . "'" . $mysqli->real_escape_string($field1) . "'" . ", " . $field2 . ", " . "'" . $field3 . "'" . ", " . "'" . $field4 . "'" . ", " . $field5 . ")" ;
	//echo $query;
	$mysqli->query($query);
	echo "Success!";
	
	$url = "SuppDB.php";
	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">'; 
?>