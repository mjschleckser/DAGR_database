<html>
	<head> 
		<title> Search Results </title>
		<link rel="stylesheet" href="scripts/stylesheet.css">
	</head>
	<body>
	
	<?php 
		include 'scripts/credentials.php';
		include 'scripts/functions.php';
		include 'scripts/navbar.php';
	?> 
	
	<h1 style="margin-left:2%"> Search Results </h1>
	
	<?php
		// Create SQL connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT * FROM dagr";
		$result = $conn->query($sql);
		
		echo "<p>";
		if ($result->num_rows > 0) {
			// output data of each row
			echo "<table><tr> <th>Name</th> <th>DAGR GUID</th> </tr>";
			while($row = $result->fetch_assoc()) {
				echo " <tr> <td>" . $row["name"] . "</td> <td>" . $row["id"] . "</td> </tr> ";
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