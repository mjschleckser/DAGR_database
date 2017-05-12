<html>
	<head> 
		<title> View DAGR </title>
		<link rel="stylesheet" href="scripts/stylesheet.css">
	</head>
	<body>
	
	<?php 
		include 'scripts/credentials.php';
		include 'scripts/functions.php';
		include 'scripts/navbar.php';
	?>
	
	
	<?php 
	
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		// No GUID provided
		if(empty($_GET['guid']) && empty($_POST['guid'])) {
			echo("This page requires a GUID to perform deletion on");
			exit();
		// GUID provided through GET
		} else if(empty($_POST['guid'])){
			echo("<h2>Are you sure you want to delete this DAGR?</h2>");
			echo("<h3>Affected DAGRs:</h3>");
			$guid = $_GET['guid'];
			$sql = "SELECT * FROM (dagr INNER JOIN children ON dagr.id=children.parent_id) as A
			
			
			
			";
			$result = $conn->query($sql);	

			
			if ($result->num_rows > 0) {
				echo "<table><tr> <th>Name</th> <th>Time Created</th> <th>Annotations</th> </tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tr><td><a href=\"view_dagr.php?guid=".$row["id"]."\">".$row["name"]."</a>".
						"</td><td>".$row["time_created"].
						"</td><td>".$row["annotation"].
						"</td></tr>";
				}
				echo "</table>";
			}
			echo(' <br><br>
					<form action="delete_dagr_confirm.php" method="post"> 
					<input type="hidden" name="guid" value="'.$_GET['guid'].'">
					<input type="submit" value="Delete">
					</form>');
		// GUID provided through POST - delete it
		} else {
			
			delete_dagr($conn, $_POST['guid']);
			
			
			
			echo("<h2>DAGR deleted!</h2>");
			// echo '<script>window.location.href = "main.php";</script>';
		}
		
		$conn->close();
	?>
	
	</body>
</html>