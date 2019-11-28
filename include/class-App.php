<?php
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
}

/**
 * Class that can wrap an App retrieved from the database
 */
class App {

}
