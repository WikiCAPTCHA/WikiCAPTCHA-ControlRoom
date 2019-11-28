<?php
/**
 * Login page of my website
 */
class PageLogin extends Page {

	/**
	 * Do something at startup
	 *
	 * @override
	 */
	protected function prepare() {

		// set the page title
		$this->setTitle( __( "Login" ) );

		// check if we should do the login
		if( $this->isLoginFormSubmitted() ) {

			// process the user_uid and the user_password sent via POST
			login();
		}

		// eventually go to the homepage if logged-in
		if( is_logged() ) {
			http_redirect( '', 303 );
		}
	}

	/**
	 * Check if the login form was submitted
	 *
	 * @return boolean
	 */
	public function isLoginFormSubmitted() {
		return is_action( 'do-login' );
	}

	/**
	 * Check if the login failed
	 *
	 * @return boolean
	 */
	public function isLoginFormFailed() {
		return $this->isLoginFormSubmitted() && !is_logged();
	}

}
