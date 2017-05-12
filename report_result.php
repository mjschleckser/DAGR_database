<html>
	<head> 
		<title> Report Results </title>
		<link rel="stylesheet" href="scripts/stylesheet.css">
	</head>
	<body>
	
	<?php 
		include 'scripts/credentials.php';
		include 'scripts/functions.php';
		include 'scripts/navbar.php';
	?> 
	
	<h1 style="margin-left:2%"> Report Results </h1>
	
	<?php
		// Create SQL connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		if(empty($_GET['report_type'])){
			echo("Invalid report request. </body></html>");
			exit();
		}		

		if(strcmp($_GET['report_type'], 'orphan') == 0){
			$sql = "SELECT * FROM (SELECT * FROM dagr d LEFT JOIN children on d.id = children.child_id WHERE children.child_id IS NULL) t, metadata m WHERE m.dagr_id = t.id";
			print_table($conn,$sql);	
		} else if(strcmp($_GET['report_type'], 'sterile') == 0) {
			$sql = "SELECT * FROM (SELECT * FROM dagr d LEFT JOIN children on d.id = children.parent_id WHERE children.parent_id IS NULL) t, metadata m WHERE m.dagr_id = t.id";
			print_table($conn,$sql);
		} else if(strcmp($_GET['report_type'], 'reach') == 0) {
				$stack =  array();
				$used =  array();
				$sql = "SELECT * 
				FROM (dagr INNER JOIN children ON children.child_id=dagr.id)
				WHERE parent_id='".$_GET['guid']."'";
				array_unshift($stack,$sql);
				array_unshift($used,$sql);
				$sql2 = "SELECT * 
				FROM (dagr INNER JOIN children ON children.parent_id=dagr.id)
				WHERE parent_id='".$_GET['guid']."'";
				array_unshift($stack,$sql2);
				array_unshift($used,$sql2);
				echo "<table>";
				echo "	<tr>	<th>Name</th> 
								<th>GUID</th>
								<th>Time Created</th> 								
								<th>Annotation</th>
							</tr>";
				do { 
					$l = array_shift($stack);
					$result = $conn->query($l);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$sql3 = "SELECT * 
							FROM (dagr INNER JOIN children ON children.child_id=dagr.id)
							WHERE child_id='".$row["id"]."'";
							if (!in_array($sql3, $used)){
								array_unshift($stack,$sql3);
								array_unshift($used,$sql3);
							}
							$sql4 = "SELECT * 
							FROM (dagr INNER JOIN children ON children.parent_id=dagr.id)
							WHERE parent_id='".$row["id"]."'";
							if (!in_array($sql4, $used)){
								array_unshift($stack,$sql4);
								array_unshift($used,$sql4);
							}
							echo "<tr><td><a href=\"view_dagr.php?guid=".$row["id"]."\">".$row["name"]."</a>".
							"</td><td>".$row["id"].
							"</td><td>".$row["time_created"].
							"</td><td>".$row["annotation"].
							"</td></tr>";
						}
					}
				} while (sizeof($stack) > 0);
				echo "</table>";

		} else {
			$start_time = $_GET['start_time'];
			$end_time = $_GET['end_time'];
			$sql="SELECT * FROM dagr WHERE DATE(dagr.time_created) BETWEEN ". substr($start_time, 0, 9)." AND ". substr($end_time, 0, 9);
			print_table($conn,$sql);
		}

		$conn->close();
	?>
	

	</body>
</html>