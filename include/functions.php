<?php
# WikiCAPTCHA Control Room
# Copyright (C) 2019 Valerio Bozzolan and contributors
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program. If not, see <http://www.gnu.org/licenses/>.

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
		require_more_privileges();
	}
}

/**
 * Require more privileges
 *
 * If you are logged-in, the page dies.
 * If you are not-logged-in, you will be redirected.
 */
function require_more_privileges() {

	if( is_logged() ) {
		http_response_code( 403 );
		die( "ARE YOU A PIRATE?" );
	}

	$url = http_build_get_query( 'login.php', [
		'redirect' => $_SERVER['REQUEST_URI'],
	] );

	// HTTP 303 redirect: See Other
	http_redirect( $url, 303 );
}

/**
 * Spawn a page not found page
 */
function page_not_found() {
	$page = new PageNotFound();
	$page->printHeader();
	$page->printContent();
	$page->printFooter();
	exit;
}
