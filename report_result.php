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
			print_table($conn,$sql);	
		} else if(strcmp($_GET['report_type'], 'sterile') == 0) {
			$sql = "SELECT * FROM (SELECT * FROM dagr d LEFT JOIN children on d.id = children.parent_id WHERE children.parent_id IS NULL) t, metadata m WHERE m.dagr_id = t.id";
			print_table($conn,$sql);
		} else if(strcmp($_GET['report_type'], 'reach') == 0) {
				$stack =  array();
				$sql = "SELECT * 
				FROM (dagr INNER JOIN children ON children.child_id=dagr.id)
				WHERE parent_id='".$_GET['guid']."'";
				array_unshift($stack,$sql);
				$sql2 = "SELECT * 
				FROM (dagr INNER JOIN children ON children.parent_id=dagr.id)
				WHERE parent_id='".$_GET['guid']."'";
				array_unshift($stack,$sql2);
				echo "<table>";
				echo "	<tr><th>Name</th> 
								<th>Author</th>
								<th>File path</th> 								
								<th>File type</th>
								<th>File size</th> 
								<th>Time Edited</th> 
							</tr>";
				do { 
					$l = array_shift($stack);
					$result = $conn->query($l);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$sql3 = "SELECT * 
							FROM (dagr INNER JOIN children ON children.child_id=dagr.id)
							WHERE parent_id='".$row["id"]."'";
							array_unshift($stack,$sql3);
							$sql4 = "SELECT * 
							FROM (dagr INNER JOIN children ON children.parent_id=dagr.id)
							WHERE parent_id='".$row["id"]."'";
							array_unshift($stack,$sql3);
							echo "<tr><td><a href=\"view_dagr.php?guid=".$row["id"]."\">".$row["name"]."</a>".
							"</td><td>".$row["author"].
							"</td><td>".$row["path"].
							"</td><td>".$row["file_type"].
							"</td><td>".$row["file_size"].
							"</td><td>".$row["time_edited"].
							"</td></tr>";
						}
					}
				} while (sizeof($stack) > 0);
				echo "</table>";

		} else {
			$sql="";
		}

		$conn->close();
	?>
	

	</body>
</html>