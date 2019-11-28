<?php
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
