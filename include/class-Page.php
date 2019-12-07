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
 * A website page
 *
 * It's useful to print the header, the footer, and who knows
 */
class Page {

	/**
	 * Custom arguments
	 *
	 * @var array
	 */
	protected $args;

	/**
	 * Constructor
	 *
	 * @param array $args Custom arguments
	 */
	public function __construct( $args = [] ) {

		$this->args = $args;

		// is there a known page UID?
		if( isset( $args['uid'] ) ) {

			// check if we know this page
			$page = menu_entry( $args['uid'] );
			if( $page ) {

				// check if I'm allowed to see this page
				if( !$page->isVisible() ) {
					require_more_privileges();
				}

				// set a default page title
				$this->setTitle( $page->name );
			}
		}

		$this->prepare();
	}

	/**
	 * Set a page argument
	 *
	 * @param $name  string
	 * @param $value mixed
	 * @return       self
	 */
	protected function setArg( $name, $value ) {
		$this->args[ $name ] = $value;
		return $this;
	}

	/**
	 * Set the page title
	 *
	 * @param $title string
	 * @return       self
	 */
	protected function setTitle( $title	) {
		return $this->setArg( 'title', $title );
	}

	/**
	 * Do something at startup
	 */
	protected function prepare() {
		// actually nothing. You can override this!
	}

	/**
	 * Print the site header
	 */
	public function printHeader() {
		template( 'header', $this->args );
	}

	/**
	 * Print the site footer
	 */
	public function printFooter() {
		template( 'footer', $this->args );
	}

}
