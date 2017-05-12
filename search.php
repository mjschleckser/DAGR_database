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
	<form action="view_dagr.php" method="get">
	  GUID: <input type="text" style='width:20em' name="guid" value="3270C5C5-F589-4BA2-820B-6EBD0DD4C85E">
	  <br><br>
	  <input type="submit" value="Submit">
	</form> 
	
	<h3 style="margin-left:2%"> Search by metadata </h3>
	<form action="search_result.php"  method="get">
		If a field is left blank, it will not be used in the search.
		<br><br>
		Author: <input type="text" style='width:12em' name="author">
		<br><br>
		File Size (in bytes):	greater than <input type="text" style='width:5em' name="fs_min">
								less than <input type="text" style='width:5em' name="fs_max">
		<br><br>
		File Type (text/html, img/jpg, etc): <input type="text" style='width:10em' name="file_type">
		<br><br>
		<input type="hidden" name="search_type" value="metadata">
		<input type="submit" value="Submit">
	</form>
	
	<h3 style="margin-left:2%"> Search by edit date </h3>
	<form action="search_result.php"  method="get">
		Format is month/day/year
		<br><br>
		Start time: <input type="datetime-local" name="start_time" value="<?php echo date('2000-01-01\T01:00:00.000');?>">
		<br><br>
		End time: <input type="datetime-local" name="end_time" value="<?php echo date('Y-m-d\TH:i');?>">
		<br><br>
		<input type="hidden" name="search_type" value="edit_date">
		<input type="submit" value="Submit">
	</form> 
	
	
	</body>
</html>