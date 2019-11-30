<?php
/*******************************************************
 * This is the secret configuration file of my website *
 *                                                     *
 * Fill and rename this file as 'load.php'             *
 *                                                     *
 * NEVER PUT IN GIT YOUR 'load.php'!                   *
 *******************************************************/

// Database configuration
$database = 'wikicaptcha';
$username = 'wikicaptcha';
$password = 'super secret password of wikicaptcha user';
$location = 'localhost';
$charset  = 'utf8mb4';

// Prefix for every your database table (if any)
//  Ask to Ludovico Pavesi if the API support this as well
$prefix = 'wcaptcha_';

// How you visit the homepage of this project?
//  Use '' (empty) if you visit the homepage with http://localhost/
//  Use '/project' if you visit the homepage with http://localhost/project/
define( 'ROOT', '' );

// Absolute pathname to the directory containing this configuration file
// You may leave this set to the magic word __DIR__ that means this directory
define( 'ABSPATH', __DIR__ );

// Load the framework
//  You know where the framework is
//  For example I put it in: '/usr/share/php/suckless-php/load.php'
//  but often you want to put it in this same directory,
//  in that case just use this pathname:   ABSPATH . '/suckless-php/load.php'
//  it could also be in the parent dir:    ABSPATH . '/../suckless-php/load.php'
//  etc.
//  Anyway, it may be everywhere. You can choose.
require ABSPATH . '/suckless-php/load.php';
