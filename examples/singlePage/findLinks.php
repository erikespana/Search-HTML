<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

</head>
<header>
	<div class="one-row">
		<div class="col6">List of hrefs</div>
	</div>
</header>
<main class="standard wrapper">

	
	<section class="mainContent ">

	<table id="table_id" class="display">
		<thead>
			<tr>
				<th>Match</th>
				<th>Linked Text</th>
				<th>Link</th>
			</tr>
		</thead>
		<tbody>
<?php
$file = "file.html";
// include class
include_once "htmlParser.php";
$obj = new htmlParser($file);
$obj->getHTML();
$obj->reportLinksWithLineNumbers();
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
