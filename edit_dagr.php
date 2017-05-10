<html>
	<head> 
		<title> Edit DAGR </title>
		<link rel="stylesheet" href="scripts/stylesheet.css">
	</head>
	<body>
	
	<?php 
		include 'scripts/credentials.php';
		include 'scripts/functions.php';
		include 'scripts/navbar.php';
	?>
	
	<?php 
		// Terminate if we aren't given a GUID to work with
		if(empty($_GET['guid'])){
			echo("GUID is required to look up a DAGR. </body></html>");
			exit();
		}
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "SELECT * 
				FROM (dagr INNER JOIN metadata ON dagr.id=metadata.dagr_id)
				WHERE dagr_id='".$_GET['guid']."'";
		$result = $conn->query($sql);
		$result = $result->fetch_assoc();

	?>
	<h1 class="centered">Edit DAGR</h1>
	<h2>Basic DAGR Information</h2>
	<form>
		DAGR Name: <input type="text" style='width:20em' name="name" value="<?php echo $result['name']; ?>">
		<br><br>
		DAGR GUID: <input type="text" style='width:20em' name="name" value="<?php echo $result['id'];?>" readonly>
		<br><br>
		Author: <input type="text" style='width:20em' name="name" value="<?php echo $result['author']; ?>">
		<br><br>
		Time Edited: <input type="text" style='width:20em' name="name" value="<?php echo $result['time_edited']; ?>">
		<br><br>
		File Type: <input type="text" style='width:20em' name="name" value="<?php echo $result['file_type']; ?>">
		<br><br>
		File Size: <input type="text" style='width:20em' name="name" value="<?php echo $result['file_size']; ?>">
		<br><br>
		<input type="hidden" name="type" value="basics">
		<input type="submit" value="Save Changes">
	</form>
	
	<h2> Add to a Category </h2>
	<form action="/edit_dagr.php">
		<select name="category">
		<?php
			$result = $conn->query("SELECT * FROM categories");
			while($row = $result->fetch_assoc()) {
				echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
			}
		?>
		</select>
		<br><br>
		<input type="hidden" name="type" value="category">
		<input type="submit">
	</form>
	
	
	<?php 
		$conn->close();
	?>
	</body>
</html>