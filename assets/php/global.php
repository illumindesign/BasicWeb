<?php
/** BasicWeb - A procedural framework for basic websites
 * Bobby @ IlluminDesign made this
 *
 * global.php - Global Site Settings
 *
 * February 2018
 */
session_start();
ini_set('error_reporting', E_ALL);
date_default_timezone_set('America/Chicago');
$isMobile = preg_match('/(tablet|pad|mobile|phone|symbian|android|ipod|ios|blackberry|webos)/i', $_SERVER['HTTP_USER_AGENT']) ? 1 : 0;

# App Title =====-----
define('aTitle',       'Brainerd Lakes Web Development');
define('aDescription', 'Brainerd Lakes Area web development. Building websites in the Brainerd Lakes area.');
define('aKeywords',    'brainerd, lakes, mn, web, development, design, programming');

# Application UI =====-----
$ui = [
    /* Settings =====----- */
    'layout'      => 'default',
    'legacy'      => false,
    /* Modules =====----- */
    'animate'     => true,
    'bootstrap'   => false,
    'fontawesome' => false,
    'googlemaps'  => false,
    'gmapsapikey' => '',
    'distancekey' => '',
    'jquery'      => false,
    'modernizr'   => false,
    'wow'         => true
];

# Database Information =====-----
$db = [
    'enabled'     => false,
    'module'      => 'pdo',
    'host'        => 'localhost',
    'database'    => '',
    'username'    => '',
    'password'    => '',
    'charset'     => 'utf8',
    'driver'      => 'mysql'
];

# SESSION Prefix =====-----
define('sPre', 'pp');
if (isset($_SESSION[sPre.'_user'])) $_user = $_SESSION[sPre.'_user'];
else $_user = null;

# Accept Includes =====-----
define('aI', true);

# Application File Path =====-----
define('aF', '/assets/');

# Application Root Path =====-----
define('aR', __DIR__.'/');

# Application Base URL =====-----
define('aBase', $_SERVER['HTTP_HOST']);

# Global Assets =====-----
define('ga_ajax',   aF.'php/ajax/',   true); # Front End
define('ga_css',    aF.'css/',        true); # Front End
define('ga_img',    aF.'images/',     true); # Front End
define('ga_ico',    aF.'images/ico/', true); # Front End
define('ga_js',     aF.'js/',         true); # Front End
define('ga_layout', aR.'layout/'.$ui['layout'].'/', true); # Back End
define('ga_php',    aR,                             true); # Back End
define('ga_pages',  aR.'pages/',                    true); # Back End
define('ga_proc',   aR.'processors/',               true); # Back End
define('ga_widget', aR.'widgets/',                  true); # Back End

# Load Modules =====-----
require_once(ga_proc.'modules.php');