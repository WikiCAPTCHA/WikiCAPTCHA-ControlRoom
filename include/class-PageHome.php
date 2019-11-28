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
 * Homepage of my website
 */
class PageHome extends Page {

	/**
	 * Do something at startup
	 *
	 * @override
	 */
	protected function prepare() {

		// must be logged-in
		require_permission( 'backend' );

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
	 * Get a generator of my apps
	 *
	 * @generator
	 */
	public function myAppsGenerator() {

		return ( new QueryAppUser() )
			->select( [
				'app.app_ID',
				'app_name',
			] )
			->whereUserIsMe()
			->joinApp()
			->queryGenerator();

	}

}
