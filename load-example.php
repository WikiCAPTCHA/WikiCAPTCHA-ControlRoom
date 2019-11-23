<?php
/*******************************************************
 * This is the secret configuration file of my website *
 *                                                     *
 * Fill and rename this file as 'load.php'             *
 *                                                     *
 * NEVER PUT IN GIT YOUR 'load.php'!                   *
 *******************************************************/

// Database configuration
$username = 'my.project.user';
$password = 'super secret password of my.project.user';
$database = 'myproject';
$location = 'localhost';
$charset  = 'utf8mb4';

// Prefix for every your database table (if any)
//  You can use something as 'foobar_' or an empty string
$prefix = '';

// How you visit your website?
//  Use an empty string if you visit it with http://localhost/
//  Use '/project'      if you visit it with http://localhost/project/
define( 'ROOT', '' );

// Absolute pathname to this directory
//  Usually leave it as-is
define( 'ABSPATH', __DIR__ );

// Load the framework
//  You know where the framework is
//  For example I put it in: '/usr/share/php/suckless-php/load.php'
//  but often you want to put it in this same directory,
//  in that case just use this pathname:    'suckless-php/load.php'
//  Anyway, it may be everywhere. You can choose.
require 'suckless-php/load.php';
