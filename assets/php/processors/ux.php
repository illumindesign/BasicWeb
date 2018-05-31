<?php
/** BasicWeb - A procedural framework for basic websites
 * Bobby @ IlluminDesign made this
 *
 * ux.php - User Experience Processor
 *
 * February 2018
 */
if (!defined('aI')) { header('Location: /', true, 301); exit; }

# decide which meta and css to include

$metaHead   = array();
$cssHead    = array();
$jsHead     = array();
$mobileHead = array();
$jsFoot     = array();

if ($ui['legacy']) {
    $metaHead[] = '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    $jsHead[] = '<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->';
    //$jsFoot[] = '<script src="'.ga_js.'smoothscroll.min.js"></script>';
}

if ($ui['animate']) {
    $cssHead[] = '<link href="'.ga_css.'animate.css" rel="stylesheet" media="screen">';
}

if ($ui['bootstrap']) {
    $cssHead[] = '<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" onerror="this.href=\''.ga_css.'bootstrap.min.css\'" rel="stylesheet" media="screen">';
    $jsFoot[]  = '<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" onerror="this.src=\''.ga_js.'bootstrap.min.js\'"></script>';
}

if ($ui['fontawesome']) {
    $cssHead[] = '<link href="//cdn" onerror="this.href=\''.ga_css.'font-awesome.min.css\'" rel="stylesheet" media="screen">';
}

if ($ui['googlemaps']) {
    $jsFoot[] = '<script src="https://maps.googleapis.com/maps/api/js?key='.$ui['gmapsapikey'].'"></script>';
    //$jsFoot[] = '<script src="'.ga_js.'gmaps.js"></script>';
    //$jsFoot[] = '<script src="'.ga_js.'gmaps-setup.js"></script>';
}

if ($ui['jquery']) {
    $jsFoot[]  = '<script src="//cdn" onerror="this.src=\''.ga_js.'jquery-2.1.1.min.js\'"></script>';
}

if ($ui['modernizr']) {
    $jsFoot[]  = '<script src="//cdn" onerror="this.src=\''.ga_js.'modernizr.min.js\'"></script>';
}

if ($ui['wow']) {
    $jsHead[]  = '<script src="'.ga_js.'wow.min.js"></script>';
}

require_once(ga_layout.'dependencies.php');

if (file_exists("assets/css/style.css")) $cssHead[] = '<link href="'.ga_css.'style.css" rel="stylesheet" media="screen">';
else $cssHead[] = '<!-- style.css NOT FOUND! -->';