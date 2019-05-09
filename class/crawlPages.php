<?php

include_once "scrape-web-pages/htmlTags.php";
include_once "scrape-web-pages/htmlParser.php";

// base class with member properties and methods
class crawlPages {
	
	var $urls;

	function __construct() {
		//$this->url = $url;
		set_time_limit(600);		// Limit the maximum execution time
		//echo "Searching: " . $this->url;
	}
	
	function loadFromTextfile($readFile, $domain) {
		
		$html = new htmlTags();
		
		// Open $readFile
		$handle = @fopen($readFile, "r");
		// echo "<p>readFile: " . $readFile . "</p>"; // debug
		
		if ($handle) {
			//echo "<td>Open $readFile</td>";
			while (($buffer = fgets($handle, 4096)) !== false) {
				
				// Strip newline character(s) from the end of $buffer
				$path = trim($buffer);
				
				// if the $URL wasn't blank
				if ( $path != "" ) {
					$position = stripos($path, "http", 0);
					
					// if path starts with http don't add anything
					if ( $position == 0 )
						$url = $path;
					else
						$url = $domain . $path . ".html";
						
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
