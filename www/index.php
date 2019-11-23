<?php
// load everything
require '../load.php';

// this is the homepage (the business logic of this page it's in this class)
$page = new PageHome( [
	'title' => __( "Welcome!" ),
] );

// I want this stylesheet
enqueue_js( 'my-style');

// print site header
$page->printHeader();
?>


<?php
$page->printFooter();
