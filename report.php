<html>
	<head> 
		<title> DAGR Reports </title>
		<link rel="stylesheet" href="scripts/stylesheet.css">
	</head>
	<body>
	
	<?php 
		include 'scripts/credentials.php';
		include 'scripts/functions.php';
		include 'scripts/navbar.php';
	?>
	<h1 class="centered">DAGR Database Reports</h1>
	
	<h2>Orphan Report</h2>
	<form>
		<input name="report_type" value="orphan" type="hidden">
		<input type="submit" value="Get Report">
	</form>

	<h2>Sterile Report</h2>
	<form>
		<input name="report_type" value="sterile" type="hidden">
		<input type="submit" value="Get Report">
	</form>
	
	<h2>Reach Query</h2>
	<form>
		 GUID: <input type="text" style='width:20em' name="guid" value="3270C5C5-F589-4BA2-820B-6EBD0DD4C85E">
		<br><br>
		<input name="report_type" value="reach" type="hidden">
		<input type="submit" value="Get Report">
	</form>
	
	</body>
</html>