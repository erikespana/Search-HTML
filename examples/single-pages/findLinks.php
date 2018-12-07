<?php
/*
	findLinks.php
	
	Finds all the hyperlinks in a file. File can be a URL.
*/


// Checks if script was passed a "file" parameter.
if ( empty( $_GET["file"] ) ) {
	
	$file = "tcptsec07c.html";
	//$file = "https://www.tdi.texas.gov/title/tcptsec07a.html";

} else {
	// Scrape the file passed as a parameter.
	$file = $_GET["file"];
}
?>
<html>
<head>
	<link href="https://www.tdi.texas.gov/_global/css/styles.css" rel="stylesheet"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

</head>
<header>
	<div class="one-row">
		<div class="col6"><a href="https://www.tdi.texas.gov/"><img alt="Texas Department of Insurance" class="logonew" src="https://www.tdi.texas.gov/_global/images/tdi-logo-new-web.png"></a></div>
	</div>
</header>
<main class="standard wrapper">

	
	<section class="mainContent ">

<p>Searching: <?php echo $file ?></p>

	<table id="table_id" class="display">
		<thead>
			<tr>
				<th>Match</th>
				<th>Link</th>
				<th>Linked Text</th>
			</tr>
		</thead>
		<tbody>
<?php

// include class
include_once "scrape-web-pages/htmlParser.php";
$obj = new htmlParser();

// Saves contents of $file as a string, in class property: $this->html.
$obj->getHTML($file);

// List all the links in $file,
// matched by a regular expression (class: $patternAHref).
$obj->reportLinksWithLineNumbers();

// Debugging: Prints the contents of the class's $html variable.
//$obj->showHTML();

?>
		</tbody>
	</table>
	</section>
</main>

<script>
$(document).ready( function () {
    $('#table_id').DataTable( {
		"dom":"firt",
		// Turn paging off so the entire table is displayed.
		"paging": false,
		"language": {
            "search": "Search this table "
		}
	});
} );
</script>

</html>
