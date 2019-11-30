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
 * Class that can wrap an User retrieved from the database
 */
class User extends Sessionuser {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get the User name
	 *
	 * @return string
	 */
	public function getUserName() {
		return $this->get( 'user_name' );
	}

	/**
	 * Get the User ID
	 *
	 * @return int
	 */
	public function getUserID() {
		return $this->getSessionuserID();
	}

	/**
	 * Get the User UID
	 *
	 * @return string
	 */
	public function getUserUID() {
		return $this->getSessionuserUID();
	}

	/**
	 * Get the User role
	 *
	 * @return string
	 */
	public function getUserRole() {
		return $this->getSessionuserRole();
	}

	/**
	 * Check if the User is active
	 *
	 * @return boolean
	 */
	public function isUserActive() {
		return $this->isSessionuserActive();
	}

	/**
	 * Check if the user is me
	 *
	 * @return boolean
	 */
	public function isUserMe() {

		// if I'm logged, compare the IDs
		if( is_logged() ) {
			return $this->getUserID() === get_user()->getUserID();
		}

		return false;
	}

}
