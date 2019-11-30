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

/*
 * This file describes the website core.
 * This file is automagically called after the 'load.php' file.
 */

// name of the website
define( 'SITE_NAME', 'WikiCAPTCHA' );

// set the default class for the User retrieved from database
define( 'SESSIONUSER_CLASS', 'User' );

// register a custom CSS stylesheet
register_css( 'my-style', 'static/my-style.css' );

// register a custom JavaScript
register_js( 'my-script', 'static/my-script.js' );

// register an 'user' role with some permissions
register_permissions('user', [
	'backend',
] );

// register an 'analist' role that it's somehow more than an 'user'
inherit_permissions( 'analist', 'user', [
	'view-dashboard',
	'create-monsters',
] );

/**
 * register an 'admin' role that can edit everything
 */
inherit_permissions( 'admin', 'analist', [
	'edit-all-app',
] );

// autoload classes and traits from the 'include' directory
spl_autoload_register( function( $missing_class_name ) {

	// if the class name ends with 'Trait' just autoload it's class
	$suffix = substr( $missing_class_name, -5 );
	if( $suffix === 'Trait' ) {
		$missing_class_name = substr( $missing_class_name, 0, -5 );
	}

	// the class should be there
	$path = ABSPATH . "/include/class-{$missing_class_name}.php";

	// eventually load if valid
	if( file_exists( $path ) ) {
		require $path;
	}
} );

// load some additional functions
require ABSPATH . '/include/functions.php';
