<?php
	ini_set('display_errors', 'On');
	include 'storedInfo.php';
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "cankayaa-db", $myPassword, $database);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
?>
		
<html>	
	<b><u>Remove a product from the database:</u></b><p></p><p></p>

	<form name="input" action="del_prod.php" method="post">
		Product ID: 
		<?php
			// Thanks to Katie Beltramini for drop down menu code help ! 
			$sql = "SELECT prod_id FROM Products";
			if(!($stmt = $mysqli->prepare($sql))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}
			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($prod_id)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			
			echo "<select name='field1-name'>Product ID Number</option>";
			while($stmt->fetch()){
				echo "<option value=" . $prod_id .  ">"  . $prod_id . "</option>";
			}
			echo "</select><br>";
			$stmt->close();
		?>	
		
		<input id="button" type="submit" value="Remove Product"><br>
	</form>
</html>

For reference, here are the current products:<p>

<?php
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