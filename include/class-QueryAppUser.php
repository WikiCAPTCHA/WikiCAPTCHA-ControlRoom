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
 * Execute a Query against the 'appuser' table
 */
class QueryAppUser extends Query {

	use QueryAppTrait;
	use QueryUserTrait;

	/**
	 * Univoque User ID column name
	 *
	 * @var string
	 */
	protected $USER_ID = 'appuser.user_ID';

	/**
	 * Univoque App ID column name
	 *
	 * @var string
	 */
	protected $APP_ID = 'app.app_ID';

	/**
	 * Constructor
	 *
	 * @param object $db         Database connection
	 * @param string $class_name Default class name for the results
	 */
	public function __construct( $db = null, $class_name = 'Queried' ) {

		// set the database connection and the default class name for the results
		parent::__construct( $db, $class_name );

		// set FROM table
		$this->from( 'appuser' );
	}

}
