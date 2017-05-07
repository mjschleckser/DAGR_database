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
	
	<h3 style="margin-left:2%"> Search by GUID </h3>
	<form action="view.php">
	  GUID: <input type="text" style='width:20em' name="guid" value="3270C5C5-F589-4BA2-820B-6EBD0DD4C85E">
	  <br><br>
	  <input type="submit" value="Submit">
	</form> 
	
	<h3 style="margin-left:2%"> Search by metadata </h3>
	<form action="search_result.php">
		If a field is left blank, it will not be used in the search.
		<br><br>
		Author: <input type="text" style='width:12em' name="author">
		<br><br>
		Editor: <input type="text" style='width:12em' name="editor">
		<br><br>
		Keywords: <input type="text" style='width:15em' name="keyword">
		<br><br>
		File Type (png, jpg, etc): <input type="text" style='width:10em' name="type">
		<br><br>
	  
	  <input type="submit" value="Submit">
	</form> 
	
	
	</body>
</html>