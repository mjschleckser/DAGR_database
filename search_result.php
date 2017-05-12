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

		if(empty($_GET['search_type'])){
			echo("Invalid search query. </body></html>");
			exit();
		}		

		if(strcmp($_GET['search_type'], 'metadata') == 0){
			$sql = "SELECT * 
				FROM (dagr INNER JOIN metadata on dagr.id=metadata.dagr_id)
				WHERE 1";
			if(!empty($_GET['author'])) $sql .= " AND author LIKE '".$_GET['author']."'";
			if(!empty($_GET['annotation'])) $sql .= " AND annotation LIKE '%".$_GET['annotation']."%'";
			if(!empty($_GET['fs_min'])) $sql .= " AND file_size > ".$_GET['fs_min'];
			if(!empty($_GET['fs_max'])) $sql .= " AND file_size < ".$_GET['fs_max	'];
			if(!empty($_GET['file_type'])) $sql .= " AND file_type LIKE '".$_GET['file_type']."'";
		} else if(strcmp($_GET['search_type'], 'edit_date') == 0) {
			$start_time = str_replace("T"," ",$_GET['start_time']);
			$end_time = str_replace("T"," ",$_GET['end_time']);
			$sql = "SELECT * 
				FROM (dagr INNER JOIN metadata on dagr.id=metadata.dagr_id)
				WHERE time_edited > '".$start_time.
				"' AND time_edited < '".$end_time."'";
		}
		
		$result = $conn->query($sql);
		if(mysqli_num_rows($result) <= 0){
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