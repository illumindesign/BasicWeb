<?php
/** BasicWeb - A procedural framework for basic websites
 * Bobby @ IlluminDesign made this
 *
 * dependencies.php - Layout Dependencies / Global and Conditional
 *
 * February 2018
 */
if (!defined('aI')) { header('Location: /', true, 301); exit; }

/*# Meta tags
$metaHead[] = '';*/

# CSS Headers
//$cssHead[] = '<link href="'.ga_css.'something.css" rel="stylesheet" media="screen">';

# Javascript Headers
//$jsHead[] = '';

# Mobile Headers
$mobileHead[] = '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="'.ga_ico.'apple-touch-icon-144-precomposed.png">';
$mobileHead[] = '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="'.ga_ico.'apple-touch-icon-114-precomposed.png">';
$mobileHead[] = '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="'.ga_ico.'apple-touch-icon-72-precomposed.png">';
$mobileHead[] = '<link rel="apple-touch-icon-precomposed" href="'.ga_ico.'apple-touch-icon-57-precomposed.png">';

# Javascript Footers
//$jsFoot[] = '<script src="'.ga_js.'something.js"></script>';

# Additional Javascript for Specific Pages
if ($uPath[0] == '')
{
    //$jsFoot[] = '<script src="'.ga_js.'home.js"></script>';
}
elseif ($uPath[0] == 'page')
{
    //$jsFoot[] = '<script src="'.ga_js.'script.js"></script>';
}
elseif ($uPath[0] == 'my-account')
{
    if ($uPath[1] == 'page') {
        //$jsFoot[] = '<script src="'.ga_js.'script.js"></script>';
    }
}
