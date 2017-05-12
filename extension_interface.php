<html>
	<head> 
		<title> Extension Interface </title>
		<link rel="stylesheet" href="scripts/stylesheet.css">
	</head>
	<body>
	
	<?php 
		include 'scripts/credentials.php';
		include 'scripts/functions.php';
	?>
	
	<?php
		// Create SQL connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		if(!empty($_POST['action_type'])){
			if(strcmp($_POST['action_type'], "save") == 0){
				$sql = "UPDATE dagr 
						SET name='".$_POST['name']."',
							annotation='".$_POST['annotation']."'
						WHERE id='".$_POST['guid']."'";
				$conn->query($sql);
			} if(strcmp($_POST['action_type'], "delete") == 0){
				$sql = "DELETE FROM active_dagr WHERE dagr_id='".$_POST['guid']."'";
				$conn->query($sql);
			}if(strcmp($_POST['action_type'], "insert") == 0){
				$new_id = web_upload($conn, $_POST['url'], -1, 1);
				$sql = "INSERT INTO active_dagr (dagr_id) VALUES ('".$new_id."')";
				$conn->query($sql);
			}
		}		
		
		echo "<table><tr> <th>URL</th> <th>GUID</th> <th>Name</th> <th>Notes</th> <th> Save Changes </th> <th> Remove </th> </tr>";
		$sql = "SELECT * FROM active_dagr INNER JOIN dagr on dagr.id=active_dagr.dagr_id";
		$result = $conn->query($sql);
		if(mysqli_num_rows($result) != 0){
			while($row = $result->fetch_assoc()){
				echo "<form action='extension_interface.php' method='post'><tr>".
						"<td><input type='text' style='width:6em' value='".$row["path"]."' readonly></td>".
						"<td><input type='text' style='width:6em' value='".$row["id"]."' readonly></td>".
						"<td><input type='text' name='name' style='width:6em' value='".$row["name"]."'></td>".
						"<td><input type='text' name='annotation' style='width:6em' value='".$row["annotation"]."'></td>".
						"<td style='text-align:center'> 
							<input type=\"hidden\" name = \"guid\" value=\"".$row["id"]."\">
							<input type=\"hidden\" name = \"action_type\" value=\"save\">
							<input type=\"submit\" value=\"Save\">
							</form>
						</td>".
						"<td style='text-align:center'> 
							<form action='extension_interface.php' method='post'>
								<input type='hidden' name='guid' value=\"".$row["id"]."\">
								<input type='hidden' name='action_type' value='delete'>
								<input type='submit' value='Delete'>
							</form>
						</td>".
					"</tr></form>";
			}
		}
		echo "</table>";
	?>
	
	<br>
	<form action='extension_interface.php' method='post' style="text-align:center">
		<input type="hidden" name="url" value='<?php echo $_GET['url'];?> '>
		<input type='hidden' name='action_type' value='insert'>
		<input type="submit" value="Input Current Page">
	</form>
	
	<?php
		$conn->close();
	?>
	</body>
</html>