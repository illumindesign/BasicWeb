<?php
/** BasicWeb - A procedural framework for basic websites
 * Bobby @ IlluminDesign made this
 *
 * url.php - URL Processor
 *
 * February 2018
 */
if (!defined('aI')) { header('Location: /', true, 301); exit; }

$uDynamic = false;
$_page = $_SERVER['REQUEST_URI'];
$_page = explode("/", $_page);
if (count($_page) > 0)
{
    array_shift($_page);
    if ($_page[0]=='d')
    {
        array_shift($_page);
        $uDynamic = true;
    }
}

/* example: /first/second/third/fourth/fifth/etc.
$uPath[0]; // first part
$uPath[1]; // second part
$uPath[2]; // third part
$uPath[3]; // fourth part
$uPath[4]; // fifth part
$uPath[5]; // etc part

uDynamic example: /d/first/second/third/fourth/fifth/etc.
$uPath[0]; // first part
$uPath[1]; // second part
$uPath[2]; // third part
$uPath[3]; // fourth part
$uPath[4]; // fifth part
$uPath[5]; // etc part*/

if ($_page[0] == 'logout')
{
    if (isset($_SESSION[sPre.'_user'])) unset($_SESSION[sPre.'_user']);
    header("Location: /");
    exit;
}
if ($_page[0] == 'my-account')
{
    if (!isset($_user['loggedin']) || $_user['loggedin'] != true) {
        header("Location: /login");
        exit;
    }
}
elseif (isset($_user['loggedin']) && $_user['loggedin'] == true)
{
    //if (is_url('be-a-scooper', 'login', 'signup', 'recover'))
    if ($_page[0] == 'login' || $_page[0] == 'signup' || $_page[0] == 'recover')
    {
        header("Location: /my-account");
        exit;
    }
}