<?php
	include 'scripts/simple_html_dom.php';
	function GUID() {
		if (function_exists('com_create_guid') === true) {
			return trim(com_create_guid(), '{}');
		}
		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}

	//returns string array containg of the links in a webpage
	function parseLink($link) {
		$count = 0;
		// Create DOM from URL or file
		$html = file_get_html($link);
		foreach($html->find('a') as $element) 
		      $count++;
	    foreach($html->find('img') as $element) 
		       $count++;

		$links = array($count);
		// Find all links 
		$i = 0;
		foreach($html->find('a') as $element) {
		    $obj = $element->href;
		     if(substr($obj, 0, 4) != 'http') {
			$obj = $link . $obj;
			}
			if (!in_array($obj, $links)){
				$links[$i] = $obj;
				$i++;
			}
		}

		foreach($html->find('img') as $element) {
			$obj = $element->src;
		    if(substr($obj, 0, 4) != 'http') {
			$obj = $link . $obj;
			}
			if (!in_array($obj, $links)){
				$links[$i] = $obj;
				$i++;
			}
		}

		return $links;

	}

	//for testing, prints string array neatly
	function printArray($array){
		for($i = 0;$i < sizeof($array);$i++){
			echo $array[$i] . PHP_EOL;
		}
	}
	
	function web_page_size($file){
		$ch = curl_init($file);
	    curl_setopt($ch, CURLOPT_NOBODY, true);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HEADER, true);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

	    $data = curl_exec($ch);
	    curl_close($ch);

	    if (preg_match('/Content-Length: (\d+)/', $data, $matches)) {

	        // Contains file size in bytes
	        $contentLength = (int)$matches[1];
	        return $contentLength;

    	}
    	return 0;
	}
	
	function single_file_upload($conn, $path, $parent_id, $depth){
		if(!file_exists($path)){
			echo "ERROR: A linked file was not found.<br>";
			return -1;
		}
		
		$guid = GUID();
		$path = $path;
		$name = basename($path);
		$hash = hash_file("sha256", $path);
		$created = date('Y-m-d H:i:s');
		
		// Check for duplicates
		$sql = "SELECT * FROM dagr WHERE hash='".$hash."'";
		$result = $conn->query($sql);
		if(mysqli_num_rows($result) != 0){
			echo "ERROR: A file with an identical hash already exists in the database.<br>";
			return -1;
		}
		
		$stmt = $conn->prepare("INSERT INTO dagr (id, name, path, hash, time_created) VALUES (?,?,?,?,?)");
		$stmt->bind_param("sssss", $guid, $name, $path, $hash, $created);
		$stmt->execute();		
		
		$author = $_SERVER['REMOTE_ADDR'];
		$file_type = pathinfo($path, PATHINFO_EXTENSION);
		$file_size = stat($path)['size'];
		$time_edited = date('Y-m-d H:i:s', stat($path)['mtime']);
		$stmt = $conn->prepare("INSERT INTO metadata (dagr_id, author, time_edited, file_type, file_size) 
								VALUES (?,?,?,?,?)");
		$stmt->bind_param("sssss", $guid, $author, $time_edited, $file_type, $file_size);
		$stmt->execute();
		
		if($parent_id != -1){	// If this DAGR is a child
			$stmt = $conn->prepare("INSERT INTO children (child_id, parent_id) VALUES (?,?)");
			$stmt->bind_param("ss", $guid, $parent_id);
			$stmt->execute();
		} 
		
		if($depth > 0 && strcmp($file_type, "html" == 0)){ // If we are a parent HTML doc
			$children = parseLink($path);
			foreach ($children as $child){
				$child = str_replace($name, "", $child);
				single_file_upload($conn, $child, $guid, ($depth-1));
			}
		}
		return 0;
	}
	
	function directory_upload($conn, $dir){
		$dir_files = scandir($dir);
		$dir_files = array_diff($dir_files, array('.', '..'));
		foreach($dir_files as $df){
			$file_path = $dir . DIRECTORY_SEPARATOR . $df;
			if(is_dir($file_path)){
				directory_upload($conn, $file_path);
			} else {
				single_file_upload($conn, $file_path, -1, 1);
			}
		}
		return 0;
	}
	
	function web_upload($conn){
		// get_meta_tags
	}

	function print_table($conn,$sql){
			$result = $conn->query($sql);
			if(mysqli_num_rows($result) <= 0){
				echo $sql;
				echo("No records returned. Please alter your search and try again.</body></html>");
				exit();
			}
			
			
			echo "<p>";
			if ($result->num_rows > 0) {
				// output data of each row
				echo "<table>	<tr><th>Name</th> 
									<th>Author</th>
									<th>File path</th> 								
									<th>File type</th>
									<th>File size</th> 
									<th>Time Edited</th> 
								</tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tr><td><a href=\"view_dagr.php?guid=".$row["id"]."\">".$row["name"]."</a>".
						"</td><td>".$row["author"].
						"</td><td>".$row["path"].
						"</td><td>".$row["file_type"].
						"</td><td>".$row["file_size"].
						"</td><td>".$row["time_edited"].
						"</td></tr>";
				}
				echo "</table>";
			} else {
				echo "0 results";
			}
			echo "</p>";
		}
?>
