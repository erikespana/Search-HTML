<?php
include_once "scrape-web-pages/htmlTags.php";

/*
Searches local text-files or URLs for words, links and more.
*/
class htmlParser {
	// The location of the file or web page
	var $url;
	// Holds the text from a web page 
	var $html;
	// Regular expression to match links. Saves the link and linked text.
	var $patternAHref = "/href=\"([^\"]*)\"[^>]*>(.*)<\/a>/Ui";
	// File handle
	var $urlHandle;
	var $tag;

	function __construct($url = "") {
		set_time_limit(600);		// Limit the maximum execution time
		$this->tag = new htmlTags();
	}
	
	// Save contents of $file as a string, in class property: $this->html.
	function getHTML($url) {
		
		$this->html = "";
		
		if (! empty($url) ) {
			$this->url = $url;
		
		
			// Open a url
			$urlHandle = fopen($this->url, "r");
			if (FALSE === $urlHandle)
				echo "Failed to open stream to " . $this->tag->ahref($this->url);
			else
				// save the html to $html
				$this->html = stream_get_contents($urlHandle);
			fclose($urlHandle);
		}
		
	}
	
	// Look for $needle in $url and return two td tags 
	function findTextInPage($needle) {
		
		// if the page wasn't blank
		if ($this->html != "") {
			
			$offset = stripos($this->html, $needle);
			if($offset === false){
				return "";
			} else {
				return $this->tag->td($needle) . $this->tag->td($offset);
			}
		}
	}
	
	// List all the links matched by the regular expression ($patternAHref),
	// given the contents of a file or web page ($html).
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
										$this->td( $this->ahref($link) ) .
										$this->td($linkedText)
									) . "\n";
					$matchNum ++;
				}
			}
			
		}

	}
	// Prints the contents of the $html variable. Used for debugging.
	function showHTML() {
		echo $this->html;
	}
	// Given a $url, returns an HTML hyperlink.
	function ahref( $url ) {
		return 	"<a href='$url'>" . $url . "</a>";
	}
	
	// Given some $content, returns an HTML table cell.
	function td( $content ) {
		return 	"<td>" . $content . "</td>";
	}
	
	// Given some $content, returns an HTML table row.
	function tr( $content ) {
		return 	"<tr>" . $content . "</tr>\n";
	}
}

?>
