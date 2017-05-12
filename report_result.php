<html>
	<head> 
		<title> Report Results </title>
		<link rel="stylesheet" href="scripts/stylesheet.css">
	</head>
	<body>
	
	<?php 
		include 'scripts/credentials.php';
		include 'scripts/functions.php';
		include 'scripts/navbar.php';
	?> 
	
	<h1 style="margin-left:2%"> Report Results </h1>
	
	<?php
		// Create SQL connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		if(empty($_GET['report_type'])){
			echo("Invalid report request. </body></html>");
			exit();
		}		

		if(strcmp($_GET['report_type'], 'orphan') == 0){
			$sql = "SELECT * FROM (SELECT * FROM dagr d LEFT JOIN children on d.id = children.child_id WHERE children.child_id IS NULL) t, metadata m WHERE m.dagr_id = t.id";
				
		} else if(strcmp($_GET['report_type'], 'sterile') == 0) {
			$sql = "SELECT * FROM (SELECT * FROM dagr d LEFT JOIN children on d.id = children.parent_id WHERE children.parent_id IS NULL) t, metadata m WHERE m.dagr_id = t.id";
		} else if(strcmp($_GET['report_type'], 'range') == 0) {
		}
		
		$result = $conn->query($sql);
		if(mysqli_num_rows($result) <= 0){
			echo $sql;
			echo("No records returned. Please alter your search and try again.</body></html>");
			exit();
		}
		
		
		echo "<p>";
		if ($result->num_rows > 0) {
			// output data of each row
			echo "<table>	<tr><th>Name</th> 
								<th>Author</th>
								<th>File path</th> 								
								<th>File type</th>
								<th>File size</th> 
								<th>Time Edited</th> 
							</tr>";
			while($row = $result->fetch_assoc()) {
				echo "<tr><td><a href=\"view_dagr.php?guid=".$row["id"]."\">".$row["name"]."</a>".
					"</td><td>".$row["author"].
					"</td><td>".$row["path"].
					"</td><td>".$row["file_type"].
					"</td><td>".$row["file_size"].
					"</td><td>".$row["time_edited"].
					"</td></tr>";
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