<html>
	<head> 
		<title> Welcome Page </title>
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
		<h1> Insert New DAGR Object </h2>
	
		Dagr Name: <input type="text" value="" name="name">
		<br> <br>
		Select a file: <input type="file" name="fileToUpload" id="fileToUpload">
		<br> <br>
		<input type="submit" value="Click Me" name="Submit">
	</form>
	</p>
	
	<?php
		if($_SERVER['REQUEST_METHOD']=='POST') {
			// Create SQL connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 

			$guid = GUID();
			
			printf("uniqid(): %s\r\n", $guid);
			
			$sql = "INSERT INTO dagr (id, name) VALUES ('" . $guid . "', 'DagrName');";
			$result = $conn->query($sql);

			echo $result;
			
			$conn->close();
		}
	?>
	</body>
</html>