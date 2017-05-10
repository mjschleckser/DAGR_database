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
			echo("<li>Author: ".$result['author']."</li>");
			echo("<li>Time Edited: ".$result['time_edited']."</li>");
			echo("<li>File Type: ".$result['file_type']."</li>");
			echo("<li>File Size: ".$result['file_size']."</li>");	
			echo("</ul>");
			
			echo("<h2>Categories</h2>");
			$sql_categories = "SELECT * 
					FROM (dagr_to_categories INNER JOIN categories ON categories.id=dagr_to_categories.category_id)
					WHERE dagr_id='".$_GET['guid']."'";
			$category_result = $conn->query($sql_categories);
			echo("<ul>");
			while($row = $category_result->fetch_assoc()) {
				echo " <li>".$row["name"]."</li> ";
			}
			echo("</ul>");
			
			
			echo("<h2>Children DAGRs: </h2>");
			$sql_child = "SELECT * 
					FROM (dagr INNER JOIN children ON children.child_id=dagr.id)
					WHERE parent_id='".$_GET['guid']."'";
			$children_result = $conn->query($sql_child);
			echo("<ul>");
			while($row = $children_result->fetch_assoc()) {
				echo " <li>".$row["name"]." : " . '<a href="view_dagr.php?guid='.$row["id"].'">' . $row["id"]."</a> </li> ";
			}
			echo("</ul>");
			
			echo("<h2>Parent DAGRs: </h2>");
			$sql_parent = "SELECT * 
					FROM (dagr INNER JOIN children ON children.parent_id=dagr.id)
					WHERE child_id='".$_GET['guid']."'";
			$parent_result = $conn->query($sql_parent);
			echo("<ul>");
			while($row = $parent_result->fetch_assoc()) {
				echo " <li>".$row["name"]." : " . '<a href="view_dagr.php?guid='.$row["id"].'">' . $row["id"]."</a> </li> ";
			}
			echo("</ul>");
			
			$conn->close();
		}
	?>
	
	<form action="delete_dagr_confirm.php" method="get">
	  <input type="hidden" name="guid" value="<?php echo($_GET['guid']);?>" >
	  <input type="submit" value="Delete">
	</form> 
	
	
	</body>
</html>