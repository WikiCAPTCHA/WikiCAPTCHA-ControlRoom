<?php
/**
 * Homepage of my website
 */
class PageHome extends Page {

	/**
	 * User requested by ID
	 */
	public $requestedUser = false;

	/**
	 * Do something at startup
	 *
	 * @override
	 */
	protected function prepare() {

		// read the ID from the query string or zero
		$id = $_GET['id'] ?? 0;

		// make sure that it's an integer
		$id = (int) $id;

		// if it's non-zero
		if( $id ) {

			// query the User with that ID (or get NULL)
			$this->requestedUser =
				( new QueryUser() )
					->whereUserID( $id )
					->queryRow();
		}
	}

	/**
	 * Get the requested User (if any!)
	 *
	 * @return User|null
	 */
	public function getRequestedUser() {
		return $this->requestedUser;
	}

}
