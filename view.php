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

			echo('<h1 class="centered">View DAGR</h1>');
			echo("<h2>Basic DAGR Information</h2>");
			
			echo('<ul class="no-bullets">');
			echo("<li>DAGR Name: ".$result['name']."</li>");
			echo("<li>DAGR GUID: ".$result['id']."</li>");
			echo("<li>Time Created: ".$result['time_created']."</li>");
			echo("<li>Time Edited: ".$result['time_edited']."</li>");
			echo("<li>Created by: ".$result['createdby']."</li>");
			echo("<li>Edited by: ".$result['editedby']."</li>");	
			echo("</ul>");
			
			echo("<h2>Children DAGRs: </h2>");
			$sql_child = "SELECT * 
					FROM (dagr INNER JOIN children ON children.child_id=dagr.id)
					WHERE parent_id='".$_GET['guid']."'";
			$children_result = $conn->query($sql_child);
			echo("<ul>");
			while($row = $children_result->fetch_assoc()) {
				echo " <li>" .$row["name"]." : ".$row["id"]."</li> ";
			}
			echo("</ul>");
			
			echo("<h2>Parent DAGRs: </h2>");
			$sql_parent = "SELECT * 
					FROM (dagr INNER JOIN children ON children.parent_id=dagr.id)
					WHERE child_id='".$_GET['guid']."'";
			$parent_result = $conn->query($sql_parent);
			echo("<ul>");
			while($row = $parent_result->fetch_assoc()) {
				echo " <li>" .$row["name"]." : ".$row["id"]."</li> ";
			}
			echo("</ul>");
			
		}
	?>
	
	
	</body>
</html>