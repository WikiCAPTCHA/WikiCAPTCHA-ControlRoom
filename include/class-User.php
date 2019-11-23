<?php
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
