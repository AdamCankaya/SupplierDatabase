<?php
	ini_set('display_errors', 'On');
	include 'storedInfo.php';
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "cankayaa-db", $myPassword, $database);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
?>
		
<html>	
	<b><u>Add a new engineer to the database:</u></b><p></p><p></p>

	<form name="input" action="new_eng.php" method="post">
		Engineer Name: <input type="text" maxlength="255" name="field1-name"><br>
		<input id="button" type="submit" value="Add Engineer"><br>
	</form>
</html>

For reference, here are the current engineers available:

<?php 	
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