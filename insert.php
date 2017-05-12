<html>
	<head> 
		<title> Insert Page </title>
		<link rel="stylesheet" href="scripts/stylesheet.css">

	</head>
	<body>
	
	<?php 
		include 'scripts/credentials.php';
		include 'scripts/functions.php';
		include 'scripts/navbar.php';
	?> 

	<p>
	<form method="post" action="insert.php">
	<h1> Upload New DAGR File </h1>
		Local File Path: <input type="text" style='width:30em' name="path">
		<br><br>
		<input type="submit" value="Submit">
		</form>
	</p>
	
	<?php
		if($_SERVER['REQUEST_METHOD']=='POST') {

			// Create SQL connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
	
			if(is_dir($_POST['path'])){
				directory_upload($conn, $_POST['path']);
			} else {
				single_file_upload($conn, $_POST['path'], -1, 1);
			}
			$conn->close();
			
			echo "<h4>Files inserted.</h4>";
		}
	?>
	</body>
</html>