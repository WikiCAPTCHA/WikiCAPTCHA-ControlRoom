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

// load everything
require '../load.php';

// this is the homepage (the business logic of this page it's in this class)
$page = new PageLogin();

// print site header
$page->printHeader();
?>

	<!-- login failed warning -->
	<?php if( $page->isLoginFormSubmitted() ): ?>
		<div class="card-panel">
			<p><?= __( "Login failed!" ) ?></p>
		</div>
	<?php endif ?>

	<!-- login form -->
	<form method="post">

		<?php form_action( 'do-login' ) ?>

		<!-- username -->
		<p>
			<label for="user-uid"><?= esc_html( __( "Username" ) ) ?></label>
			<br />
			<input type="text" id="user-uid" name="user_uid" />
		</p>

		<!-- password -->
		<p>
			<label for="user-pwd"><?= esc_html( __( "Password" ) ) ?></label>
			<br />
			<input type="password" id="user-pwd" name="user_password" />
		</p>

		<!-- submit button -->
		<p><button><?= esc_html( __( "Login" ) ) ?></button></p>

	</form>

<?php
$page->printFooter();
