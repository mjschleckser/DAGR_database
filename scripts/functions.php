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
	
	function post_page_with_parent($conn, $parent, $file_path){
			$has_children = "yes";
			$file_type = pathinfo($file_path, PATHINFO_EXTENSION);
			$file_size = web_page_size($file_path);


			$guid = GUID();
			printf("uniqid(): %s\r\n", $guid);
			$dagr_name = $file_path; 
			$created = date('Y-m-d H:i:s');
			$stmt = $conn->prepare("INSERT INTO dagr (id, name, path, time_created) VALUES (?,?,?,?)");
			$stmt->bind_param("ssss", $guid, $dagr_name, $file_path, $created);
			$result = $stmt->execute();
			
			$stmt = $conn->prepare("INSERT INTO metadata (dagr_id, author, time_edited, file_type, file_size) VALUES (?,?,?,?,?)");
			$datetime=date("Y-m-d H:i:s");
			//author is ip address uof uploading user
			$auth = $_SERVER['REMOTE_ADDR'];
			$stmt->bind_param("sssss", $guid, $auth, $datetime, $file_type, $file_size);
			
			$result = $stmt->execute();
			
			//insert children relationships
			$stmt = $conn->prepare("INSERT INTO children (child_id,parent_id) VALUES (?,?)");
			$stmt->bind_param("ss", $guid, $parent);
			$result = $stmt->execute();

			echo $result;
			echo $file_path;
			
	}

	function post_page_without_parent($conn){
		$has_children = "yes";
		$inputType = $_POST['insert_radio'];
			if ($inputType=='url'){
				$file_path = $_POST['urlToUpload'];
				$children = parseLink($file_path);
				$file_type = 'html';
				$file_size = web_page_size($file_path);
			} else {
				//find file path here read email
				$file_path = basename($_FILES['fileToUpload']['name']);
				$file_type = $_FILES['fileToUpload']['type'];
				$file_size = $_FILES['fileToUpload']['size'];
				echo date('Y-m-d H:i:s', stat($_FILES['fileToUpload']['tmp_name'])['atime'])."<br>";
				echo hash_file("sha256", $_FILES['fileToUpload']['tmp_name'])."<br>";
				$has_children = "none";
			}

			$guid = GUID();
			printf("uniqid(): %s\r\n", $guid);
			$dagr_name = $_POST['dagr_name'];
			$created = date('Y-m-d H:i:s');
			$stmt = $conn->prepare("INSERT INTO dagr (id, name, path, time_created) VALUES (?,?,?,?)");
			$stmt->bind_param("ssss", $guid, $dagr_name, $file_path, $created);
			$result = $stmt->execute();
			
			$stmt = $conn->prepare("INSERT INTO metadata (dagr_id, author, time_edited, file_type, file_size) VALUES (?,?,?,?,?)");
			$datetime=date("Y-m-d H:i:s");
			//author is ip address of uploading user
			$auth = $_SERVER['REMOTE_ADDR'];
			$stmt->bind_param("sssss", $guid, $auth, $datetime, $file_type, $file_size);
			
			$result = $stmt->execute();
			
			//call children
			if ($has_children != "none" && sizeof($children) > 0){
				foreach ($children as $child){
					post_page_with_parent($conn, $guid, $child);
				}
			}

			echo $result;
			echo $file_path;
			
	}
?>
