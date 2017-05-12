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
		if(empty($_GET['guid']) && empty($_POST['guid'])){
			echo("GUID is required to look up a DAGR. </body></html>");
			exit();
		}
		
		// connect to SQL server
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		// Get our GUID
		if(empty($_GET['guid'])){
			$guid = $_POST['guid'];
		} else { $guid = $_GET['guid']; }
		
		$category_added = 0;
		$category_removed = 0;
		$changes_saved = 0;
		// Script for if we are POSTing
		if(!empty($_POST['type'])){
			if(strcmp($_POST['type'] , "category_add") == 0){
				$sql = "INSERT INTO dagr_to_categories (dagr_id, category_id) 
						SELECT '".$guid."','".$_POST['category']."'
						FROM dual
						WHERE NOT EXISTS 
							(SELECT 1 FROM dagr_to_categories 
							WHERE dagr_id='".$guid."' AND category_id='".$_POST['category']."')";
				$category_added = $conn->query($sql);
			} else if(strcmp($_POST['type'] , "category_remove") == 0) {
				$sql = "DELETE FROM dagr_to_categories
						WHERE dagr_id='".$guid."' AND category_id='".$_POST['category']."'";
				$category_removed = $conn->query($sql);
			} else if(strcmp($_POST['type'] , "basics") == 0) {
				$sql = "UPDATE dagr 
						SET name='".$_POST['name']."',
							path='".$_POST['path']."',
							annotation='".$_POST['annotation']."'
						WHERE id='".$guid."'";
				$changes_saved = $conn->query($sql);
			} else {
				// do nothing
			}
		}
		
		$sql = "SELECT * 
				FROM (dagr INNER JOIN metadata ON dagr.id=metadata.dagr_id)
				WHERE dagr_id='".$guid."'";
		$result = $conn->query($sql);
		$result = $result->fetch_assoc();

	?>
	<h1 class="centered">Edit DAGR</h1>
	
	<form action="edit_dagr.php" method="post">
	<h2>Basic DAGR Information</h2>
		DAGR Name: <input type="text" style='width:20em' name="name" value="<?php echo $result['name']; ?>">
		<br><br>
		File Path: <input type="text" style='width:20em' name="path" value="<?php echo $result['path']; ?>">
		<br><br>
		<input type="hidden" name="guid" value="<?php echo $guid;?>" >
		<input type="hidden" name="type" value="basics">
	
	<h2>Edit Annotation</h2>
		<textarea name="annotation" rows="4" cols="50"><?php echo $result['annotation']; ?></textarea>
	
	<br><br>
	<input type="submit" value="Save Changes">
	
	<?php 
		if($changes_saved == 1){ echo("<br><br>Changes saved."); }
	?>
	
	</form>
	
	<form action="edit_dagr.php" method="post">
	<h2> Add to a Category </h2>
		<select name="category">
		<?php
			$result = $conn->query("SELECT * FROM categories");
			while($row = $result->fetch_assoc()) {
				echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
			}
		?>
		</select>
		<br><br>
		<input type="hidden" name="guid" value="<?php echo $guid;?>" >
		<input type="hidden" name="type" value="category_add">
		<input type="submit">
		<?php 
			if($category_added == 1){ echo("<br><br>Added to category."); }
		?>
	</form>
	
	
	<form action="edit_dagr.php" method="post">
	<h2> Remove from a Category </h2>
		<select name="category">
		<?php
			$result = $conn->query("SELECT * 
									FROM (
										categories inner join dagr_to_categories 
										on categories.id=dagr_to_categories.category_id)
									WHERE dagr_id='".$guid."'");
			$count = mysqli_num_rows($result);
			while($row = $result->fetch_assoc()) {
				echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
			}
		?>
		</select>
		<br><br>
		<input type="hidden" name="guid" value="<?php echo $guid;?>" >
		<input type="hidden" name="type" value="category_remove">
		<?php
			if($count > 0) echo '<input type="submit">';
			if($category_removed == 1){ echo("<br><br>Removed from category."); }
		?>
	</form>
	
	
	<?php 
		$conn->close();
	?>
	</body>
</html>