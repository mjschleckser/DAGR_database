<html>
	<head> 
		<title> Welcome Page </title>
		<link rel="stylesheet" href="scripts/stylesheet.css">
	</head>
	<body>
	
	<?php 
		include 'scripts/credentials.php';
		include 'scripts/functions.php';
		include 'scripts/navbar.php';
	?>
	
	<?php
		// Create SQL connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT * FROM dagr ORDER BY time_created DESC";
		$result = $conn->query($sql);

		echo "<h1>Welcome to the DAGR database.</h1>";
		echo "<h2>There are currently ".mysqli_num_rows($result)." DAGRs in the database.</h2>";		
		
		echo "<p>";
		if ($result->num_rows > 0) {
			// output data of each row
			echo "<table><tr> <th>Name</th> <th>DAGR GUID</th> <th>Time Created</th> </tr>";
			while($row = $result->fetch_assoc()) {
				echo "<tr>".
						"<td>".$row["name"]."</td>".
						"<td>".'<a href="view_dagr.php?guid='.$row["id"].'">'.$row["id"]."</a></td>".
						"<td>".$row["time_created"]."</td>".
					"</tr> ";
			}
			echo "</table>";
		} else {
			echo "0 results";
		}
		echo "</p>";
		$conn->close();
	?>
	</body>
</html>