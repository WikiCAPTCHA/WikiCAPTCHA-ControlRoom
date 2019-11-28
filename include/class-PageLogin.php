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
