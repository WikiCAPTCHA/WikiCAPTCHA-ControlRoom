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
 * Methods for a QueryUser class
 */
trait QueryUserTrait {

	/**
	 * Where the User is...
	 *
	 * @return self
	 */
	public function whereUser( $user ) {
		return $this->whereUserID( $user->getUserID() );
	}

	/**
	 * Where the User ID is...
	 *
	 * @param  int $id User ID
	 * @return self
	 */
	public function whereUserID( $id ) {
		return $this->whereInt( $this->USER_ID, $id );
	}

	/**
	 * Where the User UID is...
	 *
	 * @param  string $uid User UID
	 * @return self
	 */
	public function whereUserUID( $uid ) {
		return $this->whereStr( 'user_uid', $uid );
	}

	/**
	 * Where the User is me
	 *
	 * @return self
	 */
	public function whereUserIsMe() {
		return $this->whereUserID( get_user()->getUserID() );
	}

	/**
	 * Join a table with the User table
	 *
	 * @return
	 */
	public function joinUser( $type = 'INNER' ) {
		return $this->joinOn( $type, 'user', 'user.user_ID', $this->USER_ID );
	}

}

/**
 * Execute a Query against an User
 */
class QueryUser extends Query {

	use QueryUserTrait;

	/**
	 * Univoque User ID column name
	 *
	 * @var string
	 */
	protected $USER_ID = 'user.user_ID';

	/**
	 * Constructor
	 *
	 * @param object $db         Database connection
	 * @param string $class_name Default class name for the results
	 */
	public function __construct( $db = null, $class_name = 'User' ) {

		// set the database connection and the default class name for the results
		parent::__construct( $db, $class_name );

		// set FROM table
		$this->from( 'user' );
	}

}
