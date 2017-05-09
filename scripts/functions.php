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
	
	
	
?>
