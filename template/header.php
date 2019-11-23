<?php

// This is the template of the header of the website
//
// You can specify:
// - $title (string) The <head> title

if( empty( $title ) ) {
	throw new Exception( 'the template header need the title parameter' );
}

?>
<!DOCTYPE html>
<html>
<head>
<title><?= esc_html( $title ) ?></title>

<!-- eventually enqueue some JS/CSS -->
<?php load_module( 'header' ) ?>

</head>
<body>
	<h1><?= esc_html( $title ) ?></h1>
