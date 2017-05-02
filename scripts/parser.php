
<?php

include 'simple_html_dom.php';

//CMSC424
//Jake Gluck 114150998
//Matt Schleckser

//example webpage, class homepage
$example = 'https://www.cs.umd.edu/class/spring2017/cmsc424-0101/';
$values = parseLink($example);
printArray($values);

//returns string array containg of the links in a webpage
function parseLink($link) {

	$count = 0;
	// Create DOM from URL or file
	$html = file_get_html($link);

	foreach($html->find('a') as $element) 
	       $count++;

	$links = array($count);

	// Find all links 
	$i = 0;
	foreach($html->find('a') as $element) {
	    $links[$i] = $element->href;
	  	$i++;
	}

	return $links;

}

//for testing, prints string array neatly
function printArray($array){
	for($i = 0;$i < sizeof($array);$i++){
		echo $array[$i] . PHP_EOL;
	}
}


//parser uses PHP Simple HTML DOM Parser
//http://simplehtmldom.sourceforge.net/

?>