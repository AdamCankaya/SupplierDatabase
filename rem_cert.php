<?php
	ini_set('display_errors', 'On');
	include 'storedInfo.php';
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "cankayaa-db", $myPassword, $database);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
?>
		
<html>	
	<b><u>Remove a supplier from the database:</u></b><p></p><p></p>

	<form name="input" action="del_cert.php" method="post">
		Certificate Name - Revision: 
		<?php
			// Thanks to Katie Beltramini for drop down menu code help ! 
			$sql = "SELECT cert_id, cert_name, rev FROM Certifications";
			if(!($stmt = $mysqli->prepare($sql))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}
			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($cert_id, $cert_name, $rev)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			
			echo "<select name='field1-name'>Certificate Name</option>";
			while($stmt->fetch()){
				echo "<option value=" . $cert_id .  ">"  . $cert_name . "- ". $rev . "</option>";
			}
			echo "</select><br>";
			$stmt->close();
		?>	
		
		<input id="button" type="submit" value="Remove Certification"><br>
	</form>
</html>

For reference, here are the current certifications:<p>

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
?>