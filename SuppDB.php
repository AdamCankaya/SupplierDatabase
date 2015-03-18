<?php
	ini_set('display_errors', 'On');
	include 'storedInfo.php';
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "cankayaa-db", $myPassword, $database);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}	
	
	echo "<b><u>Welcome to Adam's Supplier Quality Management Database</b></u><p><p>";
	echo "Here are the current database entries as of " . date("D M d, Y G:i a") ." PST <p><p>" ;
	
	
	// Join all tables together to show all data points available
	echo "<u>Combined table showing all products and related data</u><br>";
		$query = "SELECT * FROM Suppliers 
			INNER JOIN Certifications ON Suppliers.fk_cert_id=Certifications.cert_id 
			INNER JOIN Engineers ON Suppliers.fk_eng_id=Engineers.eng_id 
			INNER JOIN Products ON Suppliers.supp_id=Products.fk_supp_id
			ORDER BY prod_id ASC
			";
		$result = $mysqli->query($query);
		$rowCount = mysqli_num_rows($result);
			
		echo "<table>";
		echo "<tr>";
		echo "<td>Product ID</td>";
		echo "<td>PO Number</td>";
		echo "<td>Supplier ID</td>";
		echo "<td>Supplier Name</td>";
		echo "<td>Certification ID</td>";
		echo "<td>Certification Name</td>";
		echo "<td>Certification Revision</td>";
		echo "<td>Completion Date</td>";
		echo "<td>Due Date</td>";
		echo "<td>Assigned Engineer ID</td>";
		echo "<td>Engineer Name</td>";
		echo "</tr>";
		while($rowCount > 0) {
			$row = $result->fetch_array(MYSQLI_BOTH);
			echo "<tr>";
			echo "<td><center>".$row["prod_id"]."</center></td>";
			echo "<td><center>".$row["PO_num"]."</center></td>";
			echo "<td><center>".$row["supp_id"]."</center></td>";
			echo "<td><center>".$row["supp_name"]."</center></td>";
			echo "<td><center>".$row["fk_cert_id"]."</center></td>";
			echo "<td><center>".$row["cert_name"]."</center></td>";
			echo "<td><center>".$row["rev"]."</center></td>";
			echo "<td><center>".$row["comp_date"]."</center></td>";
			echo "<td><center>".$row["due_date"]."</center></td>";
			echo "<td><center>".$row["fk_eng_id"]."</center></td>";
			echo "<td><center>".$row["eng_name"]."</center></td>";
			echo "</tr>";
			$rowCount--;
		}	
		echo "</table>";
		
		// Display Suppliers table
		echo "<u><p>All Current Suppliers</u> - <a href='add_supp.php'>Add a New Supplier</a>  <a href='rem_supp.php'>Delete a Supplier</a><br>";
		$query = "SELECT * FROM Suppliers";
		$result = $mysqli->query($query);
		$rowCount = mysqli_num_rows($result);
		
		echo "<table>";
		echo "<tr>";
		echo "<td>Supplier ID</td>";
		echo "<td>Supplier Name</td>";
		echo "<td>Certification ID</td>";
		echo "<td>Completion Date</td>";
		echo "<td>Due Date</td>";
		echo "<td>Assigned Engineer ID</td>";
		echo "</tr>";
		while($rowCount > 0) {
			$row = $result->fetch_array(MYSQLI_BOTH);
			echo "<tr>";
			echo "<td><center>".$row["supp_id"]."</center></td>";
			echo "<td>".$row["supp_name"]."</td>";
			echo "<td><center>".$row["fk_cert_id"]."</center></td>";
			echo "<td>".$row["comp_date"]."</td>";
			echo "<td>".$row["due_date"]."</td>";
			echo "<td><center>".$row["fk_eng_id"]."</center></td>";
			echo "</tr>";
			$rowCount--;
		}	
		echo "</table>";
	
		// Display Engineers table	
		echo "<p><p><p><u>All Current Engineers</u> - <a href='add_eng.php'>Add a New Engineer</a>  <a href='rem_eng.php'>Delete an Engineer</a><br>";
		$query = "SELECT * FROM Engineers";
		$result = $mysqli->query($query);
		$rowCount = mysqli_num_rows($result);
		
		echo "<table>";
		echo "<tr>";
		echo "<td>Engineer ID</td>";
		echo "<td>Engineer Name</td>";
		echo "</tr>";
		while($rowCount > 0) {
			$row = $result->fetch_array(MYSQLI_BOTH);
			echo "<tr>";
			echo "<td><center>".$row["eng_id"]."</center></td>";
			echo "<td>".$row["eng_name"]."</td>";
			echo "</tr>";
			$rowCount--;
		}	
		echo "</table>";
		
		// Display Products table
		echo "<p><p><p><u>All Current Products</u> - <a href='add_prod.php'>Add a New Product</a>  <a href='rem_prod.php'>Delete a Product</a><br>";
		$query = "SELECT * FROM Products";
		$result = $mysqli->query($query);
		$rowCount = mysqli_num_rows($result);
		
		echo "<table>";
		echo "<tr>";
		echo "<td>Product ID</td>";
		echo "<td>PO Number</td>";
		echo "<td>Approved Supplier ID</td>";
		echo "<td>Assigned Engineer ID</td>";
		echo "</tr>";
		while($rowCount > 0) {
			$row = $result->fetch_array(MYSQLI_BOTH);
			echo "<tr>";
			echo "<td><center>".$row["prod_id"]."</center></td>";
			echo "<td>".$row["PO_num"]."</td>";
			echo "<td><center>".$row["fk_supp_id"]."</center></td>";
			echo "<td><center>".$row["fk_supp_eng_id"]."</center></td>";
			echo "</tr>";
			$rowCount--;
		}	
		echo "</table>";	

		// Display Certifications table
		echo "<p><p><p><u>All Current Certifications</u> - <a href='add_cert.php'>Add a New Certification</a>  <a href='rem_cert.php'>Delete a Certification</a><br>";
		$query = "SELECT * FROM Certifications";
		$result = $mysqli->query($query);
		$rowCount = mysqli_num_rows($result);
		
		echo "<table>";
		echo "<tr>";
		echo "<td>Certificate ID</td>";
		echo "<td>Certificate Name</td>";
		echo "<td>Revision</td>";
		echo "</tr>";
		while($rowCount > 0) {
			$row = $result->fetch_array(MYSQLI_BOTH);
			echo "<tr>";
			echo "<td><center>".$row["cert_id"]."</center></td>";
			echo "<td>".$row["cert_name"]."</td>";
			echo "<td>".$row["rev"]."</td>";
			echo "</tr>";
			$rowCount--;
		}	
		echo "</table>";
?>

<p><p><p></p></p></p>
<h2><u>Additional Queries</h2></u><p></p>

<?php
	// Display all suppliers that have expired or no certification on file
	echo "<b><u>Suppliers With Expired (or no) Certifications On File</b></u>";
		$query = "SELECT * FROM Suppliers 
					INNER JOIN Certifications ON Suppliers.fk_cert_id=Certifications.cert_id 
					WHERE due_date < CURDATE()";
		$result = $mysqli->query($query);
		$rowCount = mysqli_num_rows($result);
		
		echo "<table>";
		echo "<tr>";
		echo "<td>Supplier ID</td>";
		echo "<td>Supplier Name</td>";
		echo "<td>Certification ID</td>";
		echo "<td>Certification Name</td>";
		echo "<td>Revision</td>";
		echo "<td>Completion Date</td>";
		echo "<td>Due Date</td>";

		echo "</tr>";
		while($rowCount > 0) {
			$row = $result->fetch_array(MYSQLI_BOTH);
			echo "<tr>";
			echo "<td><center>".$row["supp_id"]."</center></td>";
			echo "<td>".$row["supp_name"]."</td>";
			echo "<td><center>".$row["fk_cert_id"]."</center></td>";
			echo "<td><center>".$row["cert_name"]."</center></td>";
			echo "<td><center>".$row["rev"]."</center></td>";
			echo "<td>".$row["comp_date"]."</td>";
			echo "<td><font color='red'>".$row["due_date"]."</font></td>";
			echo "</tr>";
			$rowCount--;
		}	
		echo "</table>";
?>
<p><p>
<?php
	// Display all suppliers with certifications due in the next month
	echo "<b><u>Suppliers With Certifications Due Within 30 days</b></u>";
		$query = "SELECT * FROM Suppliers
					INNER JOIN Certifications ON Suppliers.fk_cert_id=Certifications.cert_id 
					WHERE due_date BETWEEN CURDATE() AND CURDATE() + 30 ";
		$result = $mysqli->query($query);
		$rowCount = mysqli_num_rows($result);
		
		echo "<table>";
		echo "<tr>";
		echo "<td>Supplier ID</td>";
		echo "<td>Supplier Name</td>";
		echo "<td>Certification ID</td>";
		echo "<td>Certification Name</td>";
		echo "<td>Revision</td>";
		echo "<td>Completion Date</td>";
		echo "<td>Due Date</td>";

		echo "</tr>";
		while($rowCount > 0) {
			$row = $result->fetch_array(MYSQLI_BOTH);
			echo "<tr>";
			echo "<td><center>".$row["supp_id"]."</center></td>";
			echo "<td>".$row["supp_name"]."</td>";
			echo "<td><center>".$row["fk_cert_id"]."</center></td>";
			echo "<td><center>".$row["cert_name"]."</center></td>";
			echo "<td><center>".$row["rev"]."</center></td>";
			echo "<td>".$row["comp_date"]."</td>";
			echo "<td><font color='orange'>".$row["due_date"]."</font></td>";
			echo "</tr>";
			$rowCount--;
		}	
		echo "</table>";
?>


<p><p><b><u>Suppliers Assigned to Each Engineer</b></u><br>
<?php
		// Display all Engineers and the suppliers they are responsible for
		$query = "SELECT * FROM Suppliers 
			INNER JOIN Engineers ON Suppliers.fk_eng_id=Engineers.eng_id 
			ORDER BY eng_id ASC";
			
		$result = $mysqli->query($query);
		$rowCount = mysqli_num_rows($result);
		
		echo "<table>";
		echo "<tr>";
		echo "<td>Assigned Engineer ID</td>";
		echo "<td>Engineer Name</td>";
		echo "<td>Supplier ID</td>";
		echo "<td>Supplier Name</td>";

		echo "</tr>";
		while($rowCount > 0) {
			$row = $result->fetch_array(MYSQLI_BOTH);
			echo "<tr>";
			echo "<td><center>".$row["fk_eng_id"]."</center></td>";
			echo "<td><center>".$row["eng_name"]."</center></td>";
			echo "<td><center>".$row["supp_id"]."</center></td>";
			echo "<td>".$row["supp_name"]."</td>";
			echo "</tr>";
			$rowCount--;
		}	
		echo "</table>";
?>