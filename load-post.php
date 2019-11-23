<?php
// this files describes my website and it's automagically called after the famework load

define( 'SITE_NAME', 'My Amazing Website' );

register_css( 'my-style',  'static/my-style.css' );

register_js(  'my-script', 'static/my-script.js' );

// register an 'user' role with some permissions
register_permissions('user', [
	'say-hello',
] );

// register an 'admin' role that it's somehow more than an 'user'
inherit_permissions( 'admin', 'user', [
	'edit-every-hello',
	'create-monsters',
] );

// autoload my classes from my /include directory
// I just have to remember to create classes as 'class-Foo.php'
// then when inside the code I will do:
//    $a = new Foo();
// this function will do the magic and will requires it
spl_autoload_register( function( $missing_class_name ) {

	// my class should be there
	$path = ABSPATH . "/include/class-{$missing_class_name}.php";

	// if it's really mine, require it
	if( file_exists( $path ) ) {
		require $path;
	}
} );

// you may also want to load some yours additional functions
require ABSPATH . '/include/functions.php';
