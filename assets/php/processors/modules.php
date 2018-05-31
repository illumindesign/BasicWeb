<?php
/** BasicWeb - A procedural framework for basic websites
 * Bobby @ IlluminDesign made this
 *
 * modules.php - Load Necessary Modules
 *
 * February 2018
 */
if (!defined('aI')) { header('Location: /', true, 301); exit; }

# Always load the global functions
require_once(ga_php.'functions.php');

# Load this if the database is turned on
if ($db['enabled'] == true) require_once(ga_proc.'database.php');

# If the gateway file requested, things above will
if ($_SERVER['SCRIPT_NAME'] == '/basicweb.php')
{
    # POST Processor =====-----
    require_once(ga_proc.'post.php');

    # Traffic Module =====-----
    $tI['code'] = 200;
    require_once(ga_proc.'traffic.php');

    # URL Processor =====-----
    require_once(ga_proc.'url.php');

    # Layout Processor =====-----
    require_once(ga_proc.'layout.php');
}
