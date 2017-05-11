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
		
		// No GUID provided
		if(empty($_GET['guid']) && empty($_POST['guid'])) {
			echo("This page requires a GUID to perform deletion on");
			exit();
		// GUID provided through GET
		} else if(empty($_POST['guid'])){
			echo("Are you sure you want to delete this DAGR?");
			echo('<form action="delete_confirm.php" method="post"> 
					<input type="hidden" name="guid" value="'.$_GET['guid'].'">
					<input type="submit" value="Delete">
					</form>');
		// GUID provided through POST - delete it
		} else {
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			$sql = "DELETE FROM dagr_to_categories WHERE dagr_id='".$_POST['guid']."'";
			query($sql);
			$sql = "DELETE FROM children WHERE parent_id='".$_POST['guid']."'";
			query($sql);
			$sql = "DELETE FROM children WHERE child_id='".$_POST['guid']."'";
			query($sql);
			$sql = "DELETE FROM metadata WHERE dagr_id='".$_POST['guid']."'";
			query($sql);
			$sql = "DELETE FROM dagr WHERE id='".$_POST['guid']."'";
			query($sql);
			
			$conn->close();
			echo("<h2>DAGR deleted!</h2>");
			// echo '<script>window.location.href = "main.php";</script>';
		}
	?>
	
	</body>
</html>