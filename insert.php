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
	
	<script type="text/javascript">
		function onchange_handler(obj, id) {
		    var other_id = (id == 'fileToUpload')? 'urlToUpload' : 'fileToUpload';
		    var text_id = 'displayInputType';

		    if (other_id == 'fileToUpload'){
		    	document.getElementById(text_id).innerHTML = 'Enter URL:';
		    }else{
		    	document.getElementById(text_id).innerHTML = 'Select a file:';
		    }


		    if(obj.checked) {
		        document.getElementById(id).style.display = 'block';
		        document.getElementById(other_id).style.display = 'none';
		    } else {
		        document.getElementById(id).style.display = 'none';
		        document.getElementById(other_id).style.display = 'block';
		    }
		}
	</script>

	<p>
	<form method="post" action="insert.php">
		<h1> Insert New DAGR Object </h2>
	
		<input type="radio" value="file" name="insert_radio" id="radio_file" style="margin:0px !important" checked="checked" onchange="onchange_handler(this, 'fileToUpload');" onmouseup="onchange_handler(this, 'fileToUpload');">
    		<strong>File Upload</strong>

    	<br> <br>
    	<input type="radio" value="url" name="insert_radio" id="radio_url" style="margin:0px !important" onchange="onchange_handler(this, 'urlToUpload');" onmouseup="onchange_handler(this, 'urlToUpload');">
    	<strong>URL</strong>

    	<br> <br>


		Dagr Name: <input type="text" id="dagr_name" name="dagr_name">
		<br> <br>

		<span id ="displayInputType"> Select a file: </span>

		<br><br>

		<input type="text" style = "display:none;" id="urlToUpload" name="urlToUpload">

		<input type="file" id="fileToUpload" name="fileToUpload">

		

		<br> <br>
		<input type="submit" value="Submit" name="Submit">
	</form>
	</p>
	
	<?php
		if($_SERVER['REQUEST_METHOD']=='POST') {


			$inputType = $_POST['insert_radio'];
			if ($inputType="url"){
				$file_path = $_POST['urlToUpload'];
				$children = parse_url($file_path);
			}else{
				$file_path = $_POST['fileToUpload'];
			}

			// Create SQL connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 

			$guid = GUID();
			printf("uniqid(): %s\r\n", $guid);
			$dagr_name = $_POST['dagr_name']; 
			$stmt = $conn->prepare("INSERT INTO dagr (id, name, path) VALUES (?,?,?)");
			$stmt->bind_param("sss", $guid, $dagr_name, $file_path);
			
			
			$result = $stmt->execute();
			echo $result;
			echo $file_path;
			
			$conn->close();
		}
	?>
	</body>
</html>