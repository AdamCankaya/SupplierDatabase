<?php
	ini_set('display_errors', 'On');
	include 'storedInfo.php';
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "cankayaa-db", $myPassword, $database);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
?>
		
<html>	
	<b><u>Add a new product to the database:</u></b><p></p><p></p>

	<form name="input" action="new_prod.php" method="post">
		Purchase Order Number: <input type="number" name="field1-name"><br>
		Supplier ID: 			
		<?php
			// Thanks to Katie Beltramini for drop down menu code help ! 
			$sql = "SELECT supp_id, supp_name FROM Suppliers";
			if(!($stmt = $mysqli->prepare($sql))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}
			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($supp_id, $supp_name)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			
			echo "<select name='field2-name'>Supplier Name</option>";
			while($stmt->fetch()){
				echo "<option value=" . $supp_id .  ">"  . $supp_name . "</option>";
			}
			echo "</select><br>";
			$stmt->close();
		?>
		<input id="button" type="submit" value="Add Product"><br>
	</form>
</html>

For reference, here are the current suppliers and products available:<p><p></p></p>

<?php 
	echo "<u>All Current Suppliers</u><br>";
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
	
	echo "<p><p><p><u>All Current Products</u><br>";
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
?>