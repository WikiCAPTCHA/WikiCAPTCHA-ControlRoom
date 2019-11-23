<?php
/**
 * Query an User
 */
class QueryUser extends Query {

	/**
	 * Constructor
	 */
	public function __construct() {

		// construct the Query parent class
		parent::__construct();

		// set SQL 'FROM' to desired table
		$this->from( 'user' );

		// set default class name for the results
		$this->defaultClass( 'User' );
	}

	/**
	 * Where the User ID is...
	 *
	 * @param  int User ID
	 * @return self
	 */
	public function whereUserID( $id ) {
		return $this->whereInt( 'user_ID', $id );
	}

}
