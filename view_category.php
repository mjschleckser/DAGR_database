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
			echo("GUID is required to look up a category.");
			exit();
		} else {
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 

			echo('<h1 class="centered">View Category</h1>');
			$result = $conn->query("SELECT * FROM categories WHERE id='".$_GET['guid']."'");
			$result = $result->fetch_assoc();
			echo("<h2>Category Name: ".$result["name"]."</h2>");

			
			
			echo("<h2>DAGRs in this category</h2>");
			
			$sql = "SELECT * 
					FROM ((categories INNER JOIN dagr_to_categories ON categories.id=dagr_to_categories.category_id)  
						INNER JOIN dagr on dagr_to_categories.dagr_id = dagr.id)
					WHERE category_id='".$_GET['guid']."'";
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
			
		}
	?>
	
	<form action="delete_confirm.php" method="get">
	  <input type="hidden" name="guid" value="<?php echo($_GET['guid']);?>" >
	  <input type="submit" value="Delete">
	</form> 
	
	
	</body>
</html>