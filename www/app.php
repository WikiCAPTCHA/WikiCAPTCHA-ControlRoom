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
$page = new PageApp();

// print site header
$page->printHeader();
?>

	<!-- login failed warning -->
	<?php if( $page->isAppFormSubmitted() ): ?>
		<div class="card-panel">
			<p><?= __( "Saved" ) ?></p>
		</div>
	<?php endif ?>

	<?php template( 'form-app', [
		'app' => $page->getApp(),
	] ) ?>

<?php
$page->printFooter();