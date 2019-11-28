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

/**
 * Methods for a QueryApp class
 */
trait QueryAppTrait {

	/**
	 * Join a table with the App table
	 *
	 * @return
	 */
	public function joinApp( $type = 'INNER' ) {
		return $this->joinOn( $type, 'app', 'app.app_ID', $this->APP_ID );
	}

}

/**
 * Execute a Query against an App
 */
class QueryApp extends Query {

	use QueryAppTrait;

	/**
	 * Constructor
	 *
	 * @param object $db         Database connection
	 * @param string $class_name Default class name for the results
	 */
	public function __construct( $db = null, $class_name = 'App' ) {

		// set the database connection and the default class name for the results
		parent::__construct( $db, $class_name );

		// set FROM table
		$this->from( 'app' );
	}

}
