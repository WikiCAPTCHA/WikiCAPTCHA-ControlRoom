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
	 * Generator of my App(s)
	 *
	 * @generator
	 */
	private $apps;

	/**
	 * Do something at startup
	 *
	 * @override
	 */
	protected function prepare() {

		// must be logged-in
		require_permission( 'backend' );

		// set page title
		$this->setTitle( __( "Panel" ) );

		// query my App(s)
		$this->apps =
			( new QueryAppUser() )
				->select( [
					'app.app_ID',
					'app_name',
				] )
				->whereUserIsMe()
				->joinApp()
				->queryGenerator();

	}

	/**
	 * Check if I have apps
	 *
	 * @return boolean
	 */
	public function areThereMyApps() {
		return $this->apps->valid();
	}

	/**
	 * Get a generator of my apps
	 *
	 * @generator
	 */
	public function getMyApps() {
		return $this->apps;
	}

}
