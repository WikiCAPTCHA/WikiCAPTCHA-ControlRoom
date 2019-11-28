<?php
// some functions you may want to have

/**
 * Require a certain page from the template directory
 *
 * @param $name string Template name
 * @param $args array  Arguments to be passed to the template scope
 */
function template( $name, $args = [] ) {

	// extract the variables from the provided array
	extract( $args, EXTR_SKIP );

	require ABSPATH . "/template/$name.php";
}

/**
 * Require a specific permission
 *
 * @param string $permission
 */
function require_permission( $permission ) {
	if( !has_permission( $permission ) ) {

		if( is_logged() ) {
			http_response_code( 403 );
			die( "ARE YOU A PIRATE?" );
		}

		$url = http_build_get_query( 'login.php', [
			'redirect' => $_SERVER['REQUEST_URI'],
		] );

		http_redirect( $url, 303 ); // HTTP 303 redirect: See Other
	}
}
