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
	
		Dagr Name: <input type="text" value="" name="dagr_name">
		<br> <br>
		Select a file: <input type="file" name="fileToUpload">
		<br> <br>
		<input type="submit" value="Submit" name="Submit">
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
			$dagr_name = $_POST['dagr_name'];
			
			$stmt = $conn->prepare("INSERT INTO dagr (id, name) VALUES (?, ?)");
			$stmt->bind_param("ss", $guid, $dagr_name);
			
			$result = $stmt->execute();
			echo $result;
			
			$conn->close();
		}
	?>
	</body>
</html>