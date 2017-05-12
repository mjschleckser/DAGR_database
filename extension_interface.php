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
	
		if(!empty($_GET['url'])){
			$_SERVER['active_page'] = $_GET['url'];
		}
		$_SERVER['active_dagrs'] = array();
		array_push($_SERVER['active_dagrs'], '284FC7D4-A49C-4217-B0A9-DE5283705CC0');
		
		// POST HANDLING! YAY
		if(!empty($_POST['action_type']){
			if(strcmp($_POST['action_type'], "save") == 0){
				
			} if(strcmp($_POST['action_type'], "delete") == 0){
				
			}if(strcmp($_POST['action_type'], "insert") == 0){
				single_file_upload($conn, $_POST['url'], -1, 1);
			}
		}
		
		
		
		
		echo "<table><tr> <th>URL</th> <th>Name</th> <th>Notes</th> <th> Save Changes </th> <th> Remove </th> </tr>";
		foreach($_SERVER['active_dagrs'] as $dagr){
			$sql = "SELECT * 
					FROM (dagr INNER JOIN metadata ON dagr.id=metadata.dagr_id)
					WHERE dagr.id='".$dagr."'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			echo "<form action='extension_interface.php' method='post'><tr>".
					"<td><input type='text' style='width:6em' value='".$row["path"]."' readonly></td>".
					"<td><input type='text' style='width:6em' value='".$row["name"]."'></td>".
					"<td><input type='text' style='width:6em' value='".$row["annotation"]."'></td>".
					"<td style='text-align:center'> 
						<input type=\"hidden\" name = \"guid\" value=\"".$row["id"]."\">
						<input type=\"hidden\" name = \"action_type\" value=\"save\">
						<input type=\"submit\" value=\"Save\">
						</form>
					</td>".
					"<td style='text-align:center'> 
						<form action='extension_interface.php' method='post'>
							<input type='hidden' name = 'guid' value=\"".$row["id"]."\">
							<input type='hidden' name = 'action_type' value='delete'>
							<input type='submit' value=\"Delete\">
						</form>
					</td>".
				"</tr></form>";
		}
		echo "</table>";
	?>
	
	<br>
	<form action='extension_interface.php' method='post' style="text-align:center">
		<input type="hidden" name="url" value="<?php echo $_SERVER['active_page'];?>">
		<input type='hidden' name='action_type' value='insert'>
		<input type="submit" value="Input Current Page">
	</form>
	
	<?php
		$conn->close();
	?>
	</body>
</html>