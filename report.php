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
	<form action="report_result.php"  method="get">
		<input name="report_type" value="orphan" type="hidden">
		<input type="submit" value="Get Report">
	</form>

	<h2>Sterile Report</h2>
	<form action="report_result.php">
		<input name="report_type" value="sterile" type="hidden">
		<input type="submit" value="Get Report">
	</form>
	
	<h2>Reach Query</h2>
	<form action="report_result.php">
		 GUID: <input type="text" style='width:20em' name="guid" value="">
		<br><br>
		<input name="report_type" value="reach" type="hidden">
		<input type="submit" value="Get Report">
	</form>
	
	<h2> Time Range Report</h2>
	<form action="report_result.php">
		Format is month/day/year
		<br><br>
		Start time: <input type="datetime-local" name="start_time" value="<?php echo date('2000-01-01\T01:00:00.000');?>">
		<br><br>
		End time: <input type="datetime-local" name="end_time" value="<?php echo date('Y-m-d\TH:i');?>">
		<br><br>
		<input name="report_type" value="time_range" type="hidden" >
		<input type="submit" value="Get Report">
	</form> 
	
	</body>
</html>