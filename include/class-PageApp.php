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
 * Page for editing a single App
 */
class PageApp extends Page {

	/**
	 * App
	 *
	 * @var App
	 */
	private $app;

	/**
	 * Do something at startup
	 *
	 * @override
	 */
	protected function prepare() {

		// process the request
		$this->processQueryString();

		// set the page title
		$this->setTitle( __( "App" ) );

		// check if we should do the App
		if( $this->isAppFormSubmitted() ) {
			$this->processUpdate();
		}
	}

	/**
	 * Process the Query string
	 */
	public function processQueryString() {

		// get the page ID
		$id = $_POST['id'] ?? $_GET['id'] ?? null;
		$id = (int) $id;

		if( $id ) {

			// query an App I can edit
			$this->app = ( new QueryAppUser() )
				->joinApp()
				->whereAppID( $id )
				->whereUserIsMe()
				->queryRow();

			// no app (or not mine) no party
			if( !$this->app ) {
				page_not_found();
			}

		} else {
			// missing App ID - want to create an App
			require_permission( 'add-app' );
		}
	}

	/**
	 * Process the App update
	 */
	public function processUpdate() {

		$data = [];

		$name = $_POST['name'] ?? null;
		$name = (string) $name;

		// update the name if provided
		if( $name ) {
			$data['app_name'] = $name;
		}

		if( $data ) {
			if( $this->app ) {

				// update existing App
				( new QueryApp() )
					->whereApp( $this->app )
					->update( $data );

				$id = $this->app->getAppID();
			} else {

				// insert a new App

				query( 'START TRANSACTION' );

				// insert new App
				( new QueryApp() )
					->insertRow( $data );

				// ID of this App
				$id = last_inserted_ID();

				// associate the App to this User
				( new QueryAppUser() )
					->insertRow( [
						'app_ID'  => $id,
						'user_ID' => get_user()->getUserID(),
					] );

				query( 'COMMIT' );
			}

			// POST -> redirect -> GET
			http_redirect( http_build_get_query( 'app.php', [
				'id' => $id,
			] ) );
		}
	}

	/**
	 * Check if the App form was submitted
	 *
	 * @return boolean
	 */
	public function isAppFormSubmitted() {
		return is_action( 'save-app' );
	}

	/**
	 * Check if the App failed
	 *
	 * @return boolean
	 */
	public function isAppFormFailed() {
		return $this->isAppFormSubmitted();
	}

	/**
	 * Get the App (if any)
	 *
	 * @return App
	 */
	public function getApp() {
		return $this->app;
	}
}
