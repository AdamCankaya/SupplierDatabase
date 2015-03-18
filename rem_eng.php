<?php
	ini_set('display_errors', 'On');
	include 'storedInfo.php';
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "cankayaa-db", $myPassword, $database);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
?>
		
<html>	
	<b><u>Remove an Engineer from the database:</u></b><p></p><p></p>

	<form name="input" action="del_eng.php" method="post">
		Supplier Name: 
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
			
			echo "<select name='field1-name'>Engineer Name</option>";
			while($stmt->fetch()){
				echo "<option value=" . $eng_id .  ">"  . $eng_name . "</option>";
			}
			echo "</select><br>";
			$stmt->close();
		?>	
		
		<input id="button" type="submit" value="Remove Engineer"><br>
	</form>
</html>

For reference, here are the current engineers:<p>

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

