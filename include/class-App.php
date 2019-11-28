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
 * Methods of an App class
 */
trait AppTrait {

	/**
	 * Get the App ID
	 *
	 * @return int
	 */
	public function getAppID() {
		return $this->get( 'app_ID' );
	}

	/**
	 * Get the App name
	 *
	 * @return string
	 */
	public function getAppName() {
		return $this->get( 'app_name' );
	}

	/**
	 * Normalize an App after being retrieved from database
	 */
	protected function normalizeApp() {
		$this->integers( 'app_ID' );
	}
}

/**
 * Class that can wrap an App retrieved from the database
 *
 * An App rappresents an instance of a WikiCAPTCHA application
 * assigned to a website.
 */
class App {

	use AppTrait;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->normalizeApp();
	}

}
