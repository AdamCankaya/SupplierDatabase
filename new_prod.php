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
	
	$query = "INSERT INTO Products (PO_num, fk_supp_id) VALUES (" . $field1 . ", " . $field2 .")";
	$mysqli->query($query);
	
	$query_fk_supp_id = "SELECT fk_supp_id FROM Products WHERE PO_num=" . $field1;
	if ($result = $mysqli->query($query_fk_supp_id)) {
                  while ($row = $result->fetch_object()) { 
					$supp_id = $row->fk_supp_id;
                  }
    }
    
    $query_fk_eng_id = "SELECT fk_eng_id FROM Suppliers WHERE supp_id=" . $supp_id;
    if ($result_fk = $mysqli->query($query_fk_eng_id)) {
    	while ($row = $result_fk->fetch_object()) { 
        	$eng_id = $row->fk_eng_id;
        }
    }
	
	$query = "UPDATE Products SET fk_supp_eng_id=" . $eng_id . " WHERE fk_supp_id=" . $supp_id;
	$mysqli->query($query);
	
	echo "Success!";	
	$url = "SuppDB.php";
	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">'; 
?>