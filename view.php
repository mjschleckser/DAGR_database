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
		if(empty($_GET['guid'])){
			echo("GUID is required to look up a DAGR.");
			exit();
		} else {
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			
			$sql = "SELECT * 
					FROM (dagr INNER JOIN metadata ON dagr.id=metadata.dagr_id)
					WHERE dagr_id='".$_GET['guid']."'";
			$result = $conn->query($sql);
			$result = $result->fetch_assoc();
			print_r($result);
			echo("<h1>Basic DAGR Information</h1>");
			echo("<p>DAGR Name: ".$result['name']."</p>");
			echo("<p>DAGR GUID: ".$result['id']."</p>");
			echo("<p>Time Created: ".$result['time_created']."</p>");
			echo("<p>Time Edited: ".$result['time_edited']."</p>");
			echo("<p>Created by: ".$result['createdby']."</p>");
			echo("<p>Edited by: ".$result['editedby']."</p>");	

			echo("<br><br>");
			
			echo("<h1>Children DAGRs: </h1>");
			$sql2 = "SELECT * 
					FROM (dagr INNER JOIN children ON children.child_id=dagr.id)
					WHERE parent_id='".$_GET['guid']."'";
			$children_result = $conn->query($sql2);
			echo("<ul>");
			while($row = $children_result->fetch_assoc()) {
				echo " <li>" .$row["name"]." : ".$row["id"]."</li> ";
			}
			echo("</ul>");
			
		}
	?>
	
	
	</body>
</html>