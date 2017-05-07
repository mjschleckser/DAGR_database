<html>
	<head> 
		<title> Search for DAGR </title>
		<link rel="stylesheet" href="scripts/stylesheet.css">
	</head>
	<body>
	
	<?php 
		include 'scripts/credentials.php';
		include 'scripts/functions.php';
		include 'scripts/navbar.php';
	?>
	
	
	<?php 
		echo "<h1> Search by name </h1>";
		echo "<h1> Search by metadata </h1>";
		echo "<h1> Search for orphans/sterile </h1>";
	?>
	
	<form action="view.php">
	  <input type="text" name="guid" value="3270C5C5-F589-4BA2-820B-6EBD0DD4C85E">
	  <br><br>
	  <input type="submit" value="Submit">
	</form> 
	
	
	</body>
</html>