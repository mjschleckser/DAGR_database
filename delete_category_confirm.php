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
	
		$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
		// No GUID provided
		if(empty($_GET['guid']) && empty($_POST['guid'])) {
			echo("This page requires a GUID to perform deletion on.");
			$conn->close();
			exit();
		// GUID provided through GET
		} else if(empty($_POST['guid'])){
			$sql = "SELECT * FROM categories WHERE id='".$_GET['guid']."'";
			$result = $conn->query($sql);
			$result = $result->fetch_assoc();
			echo("<h1>Are you sure you want to delete this category?</h1><br>");
			echo $result['name']."<br><br>";
			echo('<form action="delete_category_confirm.php" method="post"> 
					<input type="hidden" name="guid" value="'.$_GET['guid'].'">
					<input type="submit" value="Delete">
					</form>');
		// GUID provided through POST - delete it
		} else {
			 
			$sql = "DELETE FROM dagr_to_categories WHERE category_id='".$_POST['guid']."'";
			$conn->query($sql);
			$sql = "DELETE FROM categories WHERE id='".$_POST['guid']."'";
			$conn->query($sql);
			
			echo("<h2>Category deleted!</h2>");
			// echo '<script>window.location.href = "main.php";</script>';
		}
		
		$conn->close();
	?>
	
	</body>
</html>