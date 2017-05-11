<?php
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
	
	function post_page($conn, $parent){
		$inputType = $_POST['insert_radio'];
			if ($inputType=='url'){
				$file_path = $_POST['urlToUpload'];
				$children = parse_url($file_path);
				$file_type = 'test/html';
				$file_size = web_page_size($file_path);
			} else {
				//find file path here read email
				$file_path = basename($_FILES['fileToUpload']['name']);
				$file_type = $_FILES['fileToUpload']['type'];
				$file_size = $_FILES['fileToUpload']['size'];
				if ($file_type = 'text/html'){
					$children = parse_url($file_path);
				}else{
					$children = null;
				}
			}

			$guid = GUID($conn);
			printf("uniqid(): %s\r\n", $guid);
			$dagr_name = $_POST['dagr_name']; 
			$stmt = $conn->prepare("INSERT INTO dagr (id, name, path) VALUES (?,?,?)");
			$stmt->bind_param("sss", $guid, $dagr_name, $file_path);
			$result = $stmt->execute();
			
			$stmt = $conn->prepare("INSERT INTO metadata (dagr_id, author, time_edited, file_type, file_size) VALUES (?,?,?,?,?)");
			$datetime=date("Y-m-d H:i:s");
			//author is ip address uof uploading user
			$auth = $_SERVER['REMOTE_ADDR'];
			$stmt->bind_param("sssss", $guid, $auth, $datetime, $file_type, $file_size);
			
			$result = $stmt->execute();
			
			if ($parent != null){
				$stmt = $conn->prepare("INSERT INTO children (child_id,parent_id) VALUES (?,?)");
				$stmt->bind_param("ss", $guid, $parent);
				$result = $stmt->execute();
			}

			if ($children != null){
				for($x = 0;$x < $children.size;$x++){
					post_page($conn, $guid);
				}
			}
			
			echo $result;
			echo $file_path;
			
	}
?>
