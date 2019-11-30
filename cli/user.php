#!/usr/bin/php
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
 * Command line script to add-remove an User
 */

// not in command line? no party
if( ! isset( $argv[0] ) ) {
	exit( 1 );
}

// autoload the framework
require __DIR__ . '/../load.php';

// command line arguments
$opts = getopt( 'h', [
	'uid:',
	'role:',
	'active:',
	'pwd::',
	'confirm',
	'help',
] );

// check if we have to show help message
if(
	// missing an important parameter?
	!isset( $opts['uid'] )
	||
	// or just want help message?
	isset( $opts['help'] )
) {

	// create a list of known roles for the help message
	$roles = get_existing_roles();
	$roles_list = implode( '|', $roles );

	// show help message
	printf( "Usage: %s [OPTIONS]\n", $argv[0] );
	echo "OPTIONS:\n";
	echo "    --uid=UID       user UID\n";
	echo "    --role=ROLE     user role ($roles_list)\n";
	echo "    --pwd           generate password (default)\n";
	echo "    --pwd=PASSWORD  set this password\n";
	echo "    --active=1|0    active status (default 1)\n";
	echo "    --confirm       confirm save\n";
	echo "    --help          show this help and exit\n";

	// kill this script
	exit( 0 );
}

// look for existing user
$user = ( new QueryUser() )
	->whereUserUID( $opts['uid'] )
	->queryRow();

if( !$user ) {

	// set some default arguments

	// set default role
	if( empty( $opts['role'] ) ) {
		$opts['role'] = 'user';
	}

	// set default activation status
	if( empty( $opts['active'] ) ) {
		$opts['active'] = 1;
	}
}

// generate a random strong password if you specify a --pwd='' or if you are creating an User
if( isset( $opts['pwd'] ) || !$user ) {
	if( empty( $opts['pwd'] ) ) {
		$opts['pwd'] = base64_encode( openssl_random_pseudo_bytes( 30 ) );
	}
}

// data to be saved
$data = [];

// eventually change the role
if( isset( $opts['role'] ) ) {

	// validate
	if( !Permissions::instance()->roleExists( $opts['role'] ) ) {

		// wtf
		printf( "The role '%s' does not exist\n", $opts['role'] );
		exit( 1 );
	}

	$data['user_role'] = $opts['role'];
}

// eventually change the password
if( isset( $opts['pwd'] ) ) {
	$data['user_password'] = User::encryptPassword( $opts['pwd'] );
}

// eventually change active status
if( isset( $opts['active'] ) ) {
	$data['user_active'] = $opts['active'] ? 1 : 0;
}

// eventually save User UID
if( !$user ) {
	$data['user_uid'] = $opts['uid'];
}

// you must specify the --confirm parameter to save
if( $data && !isset( $opts['confirm'] ) ) {
	echo "Nothing done because --confirm is not set \n";
	$data = [];
}

// is there something to be saved?
if( $data ) {

	$query = new QueryUser();

	// update existing user or insert a new one
	if( $user ) {

		echo "Updating User... ";

		$query->whereUser( $user )
		      ->update( $data );
	} else {
		echo "Creating User... ";

		$query->insertRow( $data );
	}

	echo "Done! \n";

	// refresh infos
	$user = ( new QueryUser() )
		->whereUserUID( $opts['uid'] )
		->queryRow();
}

// print some details
if( $user ) {

	echo "INFO \n";

	printf(
		"  UID:      %s \n",
		$user->getUserUID()
	);

	printf(
		"  Role:     %s \n",
		$user->getUserRole()
	);

	printf(
		"  Active:   %s \n",
		$user->isUserActive() ? 'yep' : 'nope'
	);

	if( isset( $opts['pwd'] ) ) {
		printf(
			"  Password: %s \n",
			$opts['pwd']
		);
	}


} else {
	printf( "You can create the User with UID '%s' \n",
		$opts['uid']
	);
}

/**
 * This function get a list of available roles
 *
 * Well, it just remove the DEFAULT_USER_ROLE from the roles.
 *
 * @return array
 */
function get_existing_roles() {

	$good_get_existing_roles = [];

	// get the existing roles
	foreach( Permissions::instance()->getRoles() as $role ) {
		if( $role !== DEFAULT_USER_ROLE ) {
			$good_get_existing_roles[] = $role;
		}
	}

	return $good_get_existing_roles;
}

function print_user_infos( $user ) {

}
