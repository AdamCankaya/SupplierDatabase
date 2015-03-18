<?php
	ini_set('display_errors', 'On');
	include 'storedInfo.php';
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "cankayaa-db", $myPassword, $database);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
?>
		
<html>	
	<b><u>Add a new certification to the database:</u></b><p></p><p></p>

	<form name="input" action="new_cert.php" method="post">
		Certification Name: <input type="text" maxlength="255" name="field1-name"><br>
		Revision: <input type="text" maxlength="255" name="field2-name"><br>
		<input id="button" type="submit" value="Add Certificate"><br>
	</form>
</html>

For reference, here are the current certifications available:<p><p></p></p>

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