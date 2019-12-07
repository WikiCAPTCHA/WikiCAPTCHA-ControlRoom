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

/*
 * This is the template to change an App
 *
 * Available variables:
 *
 *  $app (App|null)
 */
?>

<?php if( has_permission( 'add-app' ) ): ?>
	<form method="post" action="<?= ROOT ?>/app.php">

		<?php form_action( 'save-app' ) ?>

		<p>
			<label for="app-name"><?= __( "App Name" ) ?></label><br />
			<input type="text" name="name" id="app-name"<?php
				if( $app ) {
					echo value( $app->getAppName() );
				}
			?> />
		</p>

		<?php if( $app ): ?>
			<input type="hidden" name="id"<?= value( $app->getAppID() ) ?> />
		<?php endif ?>

		<p>
			<button type="submit"><?=
				$app ? __( "Save"   )
				     : __( "Create" )
			?></button>
		</p>
	</form>
<?php endif ?>
