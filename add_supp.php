<?php
	ini_set('display_errors', 'On');
	include 'storedInfo.php';
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "cankayaa-db", $myPassword, $database);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
?>
		
<html>	
	<b><u>Add a new supplier to the database:</u></b><p></p><p></p>

	<form name="input" action="new_supp.php" method="post">
		Supplier Name: <input type="text" maxlength="255" name="field1-name"><br>
		Certificate: 
		
		<?php
			// Thanks to Katie Beltramini for drop down menu code help ! 
			$sql = "SELECT cert_id, cert_name FROM Certifications";
			if(!($stmt = $mysqli->prepare($sql))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}
			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($cert_id, $cert_name)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			
			echo "<select name='field2-name'>Certificate Name</option>";
			while($stmt->fetch()){
				echo "<option value=" . $cert_id .  ">"  . $cert_name . "</option>";
			}
			echo "</select><br>";
			$stmt->close();
		?>	
		
		Completion Date: <input type="date" name="field3-name"><br> 
		Expiration Date: <input type="date" name="field4-name"><br>
		Assigned Engineer: 
	
		<?php
			// Thanks to Katie Beltramini for drop down menu code help ! 
			$sql = "SELECT eng_id, eng_name FROM Engineers";
			if(!($stmt = $mysqli->prepare($sql))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}
			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($eng_id, $eng_name)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			
			echo "<select name='field5-name'>Engineer Name</option>";
			while($stmt->fetch()){
				echo "<option value=" . $eng_id .  ">"  . $eng_name . "</option>";
			}
			echo "</select><br>";
			$stmt->close();
		?>	
		
		<input id="button" type="submit" value="Add Supplier"><br>
	</form>
</html>

For reference, here are the current certifications and engineers available:

<?php
	echo "<p><p><p><u>All Current Certifications</u><br>";
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
		
	echo "<p><p><p><u>All Current Engineers</u><br>";
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

?>

