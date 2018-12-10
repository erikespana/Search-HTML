<?php

include_once "siteHealth/htmlTags.php";
include_once "siteHealth/htmlParser.php";

// base class with member properties and methods
class crawlPages {
	
	var $urls;

	function __construct() {
		//$this->url = $url;
		set_time_limit(600);		// Limit the maximum execution time
		//echo "Searching: " . $this->url;
	}
	
	function loadFromTextfile($readFile) {
		
		$html = new htmlTags();
		
		// Open $readFile
		$handle = @fopen($readFile, "r");
		
		if ($handle) {
			//echo "<td>Open $readFile</td>";
			while (($buffer = fgets($handle, 4096)) !== false) {
				
				// Strip newline character(s) from the end of $buffer
				$path = trim($buffer);
				
				// if the $URL wasn't blank
				if ($path != "") {
					
					$url = "http://tdinet.tdi.texas.gov/" . $path . ".html";
					$this->urls[] = $url;
				}				
			}
			fclose($handle);
			
			//echo $html->tr( $html->td($url) . $html->td("NA") . $html->td("NA") );
		} else {
			echo "<td>Can't open \$readFile<td>";
		}
		return $this->urls;
	}

}

?>