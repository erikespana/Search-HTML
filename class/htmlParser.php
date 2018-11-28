<?php
// base class with member properties and methods
class htmlParser {
	var $url;
	var $html;
	var $patternAHref = "/href=\"([^\"]*)\"[^>]*>(.*)<\/a>/Ui";
	var $urlHandle;
	function __construct($url) {
		$this->url = $url;
		set_time_limit(600);		// Limit the maximum execution time
		echo "Searching: " . $this->url;
	}
	
	function getHTML() {
		$this->html = "";
		
		// Open a url
		$urlHandle = fopen($this->url, "r");
		if (FALSE === $urlHandle)
			echo "Failed to open stream to " . ahref($this->url);
		else
			// save the html to $html
			$this->html = stream_get_contents($urlHandle);
		fclose($urlHandle);
		
	}
	
	function reportLinksWithLineNumbers() {
			
		if ($this->html != "") {
			
			// PREG_SET_ORDER - Orders results so that $matches[0] is an array of first set of matches, $matches[1] is an array of second set of matches, and so on.
			if ( preg_match_all($this->patternAHref, $this->html, $matches, PREG_SET_ORDER)) {
				//print_r($matches);
				
				//echo count($matches);
				$matchNum = 1;
				
				foreach ($matches as $val) {
						$link = $val[1];
						$linkedText = $val[2];
						echo $this->tr( 
										$this->td($matchNum) .
										$this->td($linkedText) .
										$this->td( $this->ahref($link) ) 
									) . "\n";
					$matchNum ++;
				}
			}
			
		}
	}
	function showHTML() {
		echo $this->html;
	}
	
	function ahref( $url ) {
		return 	"<a href='$url'>" . $url . "</a>";
	}
	function td( $content ) {
		return 	"<td>" . $content . "</td>";
	}
	function tr( $content ) {
		return 	"<tr>" . $content . "</tr>\n";
	}
}
?>
