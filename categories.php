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
		// Create SQL connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		// If they have posted a new category, add it to the DB
		if(!empty($_GET['name'])){
			
		}

		$sql = "SELECT * FROM categories";
		$result = $conn->query($sql);

		echo "<h1>List of Categories</h1>";
		
		echo "<p>";
		if ($result->num_rows > 0) {
			// output data of each row
			echo "<table><tr> <th>Category Name</th> <th> Category GUID </th> </tr>";
			while($row = $result->fetch_assoc()) {
				echo " <tr> <td>" . $row["name"] . "</td> <td> <a href=\"/dataAggregator/view_category.php?guid=".$row["id"]."\">". $row["id"]. "</a> </td> </tr> ";
			}
			echo "</table>";
		} else {
			echo "0 results";
		}
		echo "</p>";
		$conn->close();
	?>
	
	<h1>Add a New Category</h1>
	<form action="categories.php" method="post">
	  Category Name: <input type="text" style='width:20em' name="name" value="">
	  <br><br>
	  <input type="submit" value="Submit">
	</form> 
	</body>
</html>