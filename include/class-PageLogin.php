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

		// eventually go to the homepage
		if( is_logged() ) {
			http_redirect( '' );
		}

		// set the page title
		$this->setTitle( __( "Login" ) );

		// check if we should do the login
		if( is_action( 'do-login' ) ) {

			// process the login form
			login();
		}

	}

}
