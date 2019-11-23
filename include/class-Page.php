<?php
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
