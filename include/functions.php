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
